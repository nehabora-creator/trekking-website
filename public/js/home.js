/* Home page behaviour. All content comes from the database through window.APP (see home.blade.php). */
(function () {
  const $ = id => document.getElementById(id);
  const A = window.APP;
  const csrf = (document.querySelector('meta[name="csrf-token"]') || {}).content || "";
  const esc = s => String(s == null ? "" : s).replace(/[&<>"']/g, c => ({ "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;" }[c]));

  /* ===== Banner slider (slides are drawn by the server; this only switches them) ===== */
  const slideEls = [...document.querySelectorAll("#slides .slide")];
  const count = slideEls.length;
  $("dots").innerHTML = count > 1
    ? slideEls.map((_, i) => `<button type="button" aria-label="Go to slide ${i + 1}" data-d="${i}" class="h-2.5 rounded-full bg-white/60 w-2.5"></button>`).join("") : "";
  if (count < 2) { $("prev").classList.add("hidden"); $("next").classList.add("hidden"); }
  let cur = 0, timer;
  function go(i) {
    cur = (i + count) % count;
    slideEls.forEach((el, j) => {
      el.classList.toggle("opacity-0", j !== cur);
      el.classList.toggle("pointer-events-none", j !== cur);
    });
    document.querySelectorAll("#dots button").forEach((b, j) => {
      b.classList.toggle("w-8", j === cur); b.classList.toggle("w-2.5", j !== cur); b.classList.toggle("bg-white", j === cur);
    });
  }
  const play = () => {
    clearInterval(timer);
    if (count > 1 && !matchMedia("(prefers-reduced-motion:reduce)").matches) timer = setInterval(() => go(cur + 1), 6000);
  };
  $("prev").onclick = () => { go(cur - 1); play(); };
  $("next").onclick = () => { go(cur + 1); play(); };
  $("dots").onclick = e => { const b = e.target.closest("[data-d]"); if (b) { go(+b.dataset.d); play(); } };
  const hero = $("top");
  hero.onmouseenter = () => clearInterval(timer); hero.onmouseleave = play;
  let sx = 0;
  hero.ontouchstart = e => sx = e.touches[0].clientX;
  hero.ontouchend = e => { const d = e.changedTouches[0].clientX - sx; if (Math.abs(d) > 50) { go(cur + (d < 0 ? 1 : -1)); play(); } };
  if (count) { go(0); play(); }

  /* ===== Trek chips, filter panel and carousel ===== */
  const T = A.treks.map(t => Object.assign({ months: [], themes: [], upcoming: false }, t));
  const MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  const SE = ["Spring", "Summer", "Monsoon", "Autumn", "Winter"];
  const LADDER = ["Easy", "Easy to Moderate", "Moderate", "Moderate to Difficult", "Difficult", "Challenging"];
  const RG = A.regions.map(r => r.name);
  const RI = Object.fromEntries(A.regions.map(r => [r.name, r.image]));
  const col = ["from-sky-700", "from-emerald-700", "from-violet-700", "from-amber-700", "from-rose-700"];
  const uniq = arr => [...new Set(arr.filter(Boolean))];
  const COUNTRIES = uniq(T.map(t => t.country));
  const GRADES = LADDER.filter(g => T.some(t => t.grade === g)).concat(uniq(T.map(t => t.grade)).filter(g => !LADDER.includes(g)));
  const INTERESTS = uniq(T.map(t => t.interest));
  const THEMES = uniq(T.flatMap(t => t.themes)).sort();

  /* one place that remembers every filter */
  const F = { q: "", upcoming: false, country: "", season: "", region: "", month: "", difficulty: "", interest: "", theme: "" };

  const heart = on => `<svg width="22" height="22" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="fill:${on ? "#ef4444" : "none"};color:${on ? "#ef4444" : "inherit"}" aria-hidden="true"><path d="M12 21s-7-4.6-9.3-9.1C1 8.6 3 5 6.4 5c2 0 3.5 1.1 4.2 2.4h.8C12.1 6.1 13.6 5 15.6 5 19 5 21 8.6 19.3 11.9 17 16.4 12 21 12 21z"/></svg>`;
  const pin = '<svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2a7 7 0 0 0-7 7c0 5 7 13 7 13s7-8 7-13a7 7 0 0 0-7-7zm0 9.5A2.5 2.5 0 1 1 12 6.5a2.5 2.5 0 0 1 0 5z"/></svg>';

  /* round chip in the carousel row (region chips show a photo) */
  const chip = (key, v, img) => {
    const on = F[key] === v;
    return `<button type="button" data-k="${key}" data-v="${esc(v)}" aria-pressed="${on}" class="shrink-0 inline-flex items-center gap-2 rounded-full border text-lg font-semibold whitespace-nowrap ${img ? "pl-1.5 pr-5 py-1.5" : "px-6 py-2.5"} ${on ? "bg-flag border-flag text-white" : "border-slate-300 dark:border-slate-600 hover:border-slate-500"}">${img ? `<img src="${esc(img)}" alt="" loading="lazy" class="w-9 h-9 rounded-full object-cover ${on ? "ring-2 ring-white" : ""}">` : ""}${esc(v)}</button>`;
  };
  /* small chip inside the big filter panel */
  const pchip = (key, v, on) =>
    `<button type="button" data-k="${key}" data-v="${esc(v)}" aria-pressed="${on}" class="rounded-full border px-3.5 py-1.5 text-sm font-semibold transition ${on ? "bg-flag border-flag text-white" : "border-slate-300 dark:border-slate-600 hover:border-flag"}">${esc(v)}</button>`;
  const group = (title, key, values) => values.length
    ? `<p class="mt-5 mb-2 text-xs font-bold tracking-widest uppercase text-slate-500">${title}</p><div class="flex flex-wrap gap-2">${values.map(v => pchip(key, v, F[key] === v)).join("")}</div>` : "";

  function card(t, idx) {
    const imgs = [t.img1, t.img2].filter(Boolean).map((s, k) =>
      `<img src="${esc(s)}" alt="${esc(t.title)}" loading="lazy" class="absolute inset-0 w-full h-full object-cover transition duration-500 motion-reduce:transform-none group-hover:scale-110 ${k ? "opacity-0 group-hover:opacity-100" : ""}">`).join("");
    return `<article class="snap-start transition-transform duration-300 hover:scale-[1.03] hover:shadow-xl motion-reduce:transform-none shrink-0 w-[290px] sm:w-[340px] bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl shadow-sm overflow-hidden flex flex-col">
<div class="relative h-64 overflow-hidden bg-gradient-to-br ${col[idx % col.length]} to-slate-900 group">${imgs}
${t.region ? `<span class="absolute top-3 left-3 inline-flex items-center gap-1 bg-slate-900/90 text-white text-xs rounded px-2.5 py-1.5">${pin}${esc(t.region)}</span>` : ""}
${t.badge ? `<span class="absolute bottom-3 left-0 bg-flag text-white text-sm px-4 py-1">${esc(t.badge)}</span>` : ""}
<button type="button" data-f="${t.id}" aria-label="Save ${esc(t.title)}" aria-pressed="${t.fav}" class="absolute top-3 right-3 w-10 h-10 rounded-full bg-white/90 text-slate-800 flex items-center justify-center shadow">${heart(t.fav)}</button></div>
<div class="p-4 flex flex-col gap-2 flex-1"><h4 class="font-display font-bold text-xl leading-snug">${esc(t.title)}</h4>
<p class="text-sm uppercase tracking-wide text-slate-600 dark:text-slate-400"><b class="font-semibold">Duration:</b> ${t.days} days</p>
<p class="text-sm uppercase tracking-wide text-slate-600 dark:text-slate-400"><b class="font-semibold">Grade:</b> ${esc(t.grade)}</p>
<a href="${esc(t.url)}" class="mt-auto text-center rounded py-2.5 font-semibold bg-flag text-white transition hover:bg-black">View Trek Details</a></div></article>`;
  }

  const matches = t =>
    (!F.q || t.title.toLowerCase().includes(F.q)) &&
    (!F.upcoming || t.upcoming) &&
    (!F.country || t.country === F.country) &&
    (!F.season || t.season === F.season) &&
    (!F.region || t.region === F.region) &&
    (!F.month || t.months.includes(MONTHS.indexOf(F.month) + 1)) &&
    (!F.difficulty || t.grade === F.difficulty) &&
    (!F.interest || t.interest === F.interest) &&
    (!F.theme || t.themes.includes(F.theme));

  function renderPanel() {
    const box = $("more"), keep = box.scrollTop;
    $("groups").innerHTML =
      `<p class="mt-5 mb-2 text-xs font-bold tracking-widest uppercase text-slate-500">Quick pick</p><div class="flex flex-wrap gap-2">${pchip("upcoming", "Upcoming Treks", F.upcoming)}</div>` +
      group("Country", "country", COUNTRIES) + group("Season", "season", SE) + group("Region", "region", RG) +
      group("Month", "month", MONTHS) + group("Difficulty", "difficulty", GRADES) +
      group("Interests", "interest", INTERESTS) + group("Theme", "theme", THEMES);
    box.scrollTop = keep;
  }

  function render() {
    const sl = $("chips").scrollLeft;
    $("chips").innerHTML = SE.map(s => chip("season", s)).join("") + RG.map(r => chip("region", r, RI[r])).join("") + MONTHS.map(m => chip("month", m)).join("");
    $("chips").scrollLeft = sl;
    renderPanel();

    const rb = $("rbanner");
    if (F.region && RI[F.region]) {
      $("rbimg").src = RI[F.region]; $("rbimg").alt = F.region; $("rbt").textContent = F.region;
      const n = T.filter(t => t.region === F.region).length;
      $("rbc").textContent = n + " trek" + (n === 1 ? "" : "s") + " in this region";
      rb.classList.remove("hidden");
    } else rb.classList.add("hidden");

    const L = T.filter(matches);
    const active = Object.keys(F).some(k => k !== "q" ? F[k] : F.q);
    $("ttl").textContent = F.region && !F.season && !F.month ? `Unforgettable Trails of ${F.region}` : active ? "Treks matching your filters" : "Unforgettable Himalayan Trails";
    $("tcount").textContent = L.length + " trek" + (L.length === 1 ? "" : "s") + " found";
    $("grid").innerHTML = L.length ? L.map(t => card(t, T.indexOf(t))).join("")
      : '<p class="text-slate-500">No treks match these filters. Use "Clear all" to start again.</p>';
    $("grid").scrollLeft = 0;
  }

  /* chips (top row and panel) set one filter. Pressing the same chip again removes it. */
  const pick = e => {
    const b = e.target.closest("[data-k]"); if (!b) return;
    const k = b.dataset.k, v = b.dataset.v;
    if (k === "upcoming") F.upcoming = !F.upcoming; else F[k] = F[k] === v ? "" : v;
    render();
  };
  $("chips").onclick = pick;
  $("groups").onclick = pick;
  $("cn").onclick = () => $("chips").scrollBy({ left: 320, behavior: "smooth" });

  const setPanel = open => {
    $("more").classList.toggle("hidden", !open);
    $("ft").setAttribute("aria-expanded", open);
  };
  $("ft").onclick = () => setPanel($("more").classList.contains("hidden"));
  document.addEventListener("click", e => {
    if (!$("more").classList.contains("hidden") && !$("filterwrap").contains(e.target)) setPanel(false);
  });
  document.addEventListener("keydown", e => { if (e.key === "Escape") setPanel(false); });
  $("q").addEventListener("input", () => { F.q = $("q").value.trim().toLowerCase(); render(); });
  $("reset").onclick = () => {
    Object.keys(F).forEach(k => F[k] = k === "upcoming" ? false : "");
    $("q").value = "";
    render();
  };
  $("gp").onclick = () => $("grid").scrollBy({ left: -340, behavior: "smooth" });
  $("gn").onclick = () => $("grid").scrollBy({ left: 340, behavior: "smooth" });

  /* Heart button: saves the trek to the user's account (login needed) */
  $("grid").onclick = async e => {
    const f = e.target.closest("button[data-f]"); if (!f) return;
    if (!A.user) { location.href = A.loginUrl; return; }
    try {
      const r = await fetch(A.favUrl.replace("__ID__", f.dataset.f), { method: "POST", headers: { "X-CSRF-TOKEN": csrf, "Accept": "application/json" } });
      if (!r.ok) throw new Error("failed");
      const j = await r.json();
      f.setAttribute("aria-pressed", j.saved);
      f.innerHTML = heart(j.saved);
      const t = T.find(x => String(x.id) === f.dataset.f); if (t) t.fav = j.saved;
    } catch (err) { /* ignore */ }
  };
  render();

  /* ===== Stay informed tabs + arrows ===== */
  let ut = "update";
  const upVisible = () => document.querySelector("[data-up]:not(.hidden)");
  $("utabs").onclick = e => {
    const b = e.target.closest("[data-ut]"); if (!b) return;
    ut = b.dataset.ut;
    document.querySelectorAll("[data-ut]").forEach(x => {
      const on = x.dataset.ut === ut;
      x.setAttribute("aria-selected", on);
      ["bg-flag", "text-white", "border-flag"].forEach(c => x.classList.toggle(c, on));
      ["border-slate-300", "dark:border-slate-600"].forEach(c => x.classList.toggle(c, !on));
    });
    document.querySelectorAll("[data-up]").forEach(p => p.classList.toggle("hidden", p.dataset.up !== ut));
  };
  $("up").onclick = () => upVisible().scrollBy({ left: -340, behavior: "smooth" });
  $("un").onclick = () => upVisible().scrollBy({ left: 340, behavior: "smooth" });

  /* ===== Reviews carousel ===== */
  const rc = $("rcar");
  if (rc.firstElementChild && rc.firstElementChild.tagName === "ARTICLE") {
    const stepR = () => rc.firstElementChild.offsetWidth + 20;
    const nextR = () => rc.scrollLeft + rc.clientWidth >= rc.scrollWidth - 4 ? rc.scrollTo({ left: 0, behavior: "smooth" }) : rc.scrollBy({ left: stepR(), behavior: "smooth" });
    $("rn").onclick = nextR;
    $("rp").onclick = () => rc.scrollBy({ left: -stepR(), behavior: "smooth" });
    let rt;
    const rplay = () => { clearInterval(rt); if (!matchMedia("(prefers-reduced-motion:reduce)").matches) rt = setInterval(nextR, 4500); };
    rc.onmouseenter = () => clearInterval(rt); rc.onmouseleave = rplay; rplay();
  }

  /* ===== FAQ tabs + accordion ===== */
  const ftabs = $("ftabs");
  if (ftabs) {
    $("tp").onclick = () => ftabs.scrollBy({ left: -260, behavior: "smooth" });
    $("tn").onclick = () => ftabs.scrollBy({ left: 260, behavior: "smooth" });
    ftabs.onclick = e => {
      const b = e.target.closest("[data-ft]"); if (!b) return;
      document.querySelectorAll("[data-ft]").forEach(x => {
        const on = x === b;
        x.setAttribute("aria-selected", on);
        ["bg-flag", "border-flag", "text-white"].forEach(c => x.classList.toggle(c, on));
        ["bg-white", "dark:bg-slate-800", "border-slate-300", "dark:border-slate-600"].forEach(c => x.classList.toggle(c, !on));
      });
      document.querySelectorAll("[data-fp]").forEach(p => p.classList.toggle("hidden", p.dataset.fp !== b.dataset.ft));
      const r = b.getBoundingClientRect(), c = ftabs.getBoundingClientRect();
      ftabs.scrollBy({ left: r.left - c.left - (c.width - r.width) / 2, behavior: "smooth" });
    };
    document.querySelectorAll("[data-fp]").forEach(panel => {
      panel.addEventListener("click", e => {
        const b = e.target.closest("[data-fb]"); if (!b) return;
        const wasOpen = b.getAttribute("aria-expanded") === "true";
        panel.querySelectorAll("[data-fb]").forEach(x => {
          const on = x === b && !wasOpen;
          x.setAttribute("aria-expanded", on);
          x.querySelector("[data-chev]").classList.toggle("rotate-180", on);
          const body = x.nextElementSibling;
          body.classList.toggle("grid-rows-[1fr]", on); body.classList.toggle("grid-rows-[0fr]", !on);
        });
      });
    });
  }

  /* ===== Why us: highlight card on hover + count-up numbers ===== */
  const wc = [...document.querySelectorAll("#why [data-card]")];
  const actW = c => wc.forEach(x => { const on = x === c; x.classList.toggle("border-flag", on); x.classList.toggle("border-transparent", !on); });
  wc.forEach(c => { c.onmouseenter = () => actW(c); c.onclick = () => actW(c); });
  if (!matchMedia("(prefers-reduced-motion:reduce)").matches && "IntersectionObserver" in window) {
    const io = new IntersectionObserver(es => es.forEach(en => {
      if (!en.isIntersecting) return;
      io.unobserve(en.target);
      const el = en.target, n = +el.dataset.n, t0 = performance.now();
      const f = t => { const k = Math.min(1, (t - t0) / 1200); el.textContent = Math.round(n * k).toLocaleString("en-US"); if (k < 1) requestAnimationFrame(f); };
      requestAnimationFrame(f);
    }));
    document.querySelectorAll("#why .cnt").forEach(el => io.observe(el));
  }

  /* ===== Contact form: topic chips + prefill from ?trek= and ?batch= ===== */
  const TP = ["Book a trek", "Ask a question", "Group or family", "School or college"];
  let tp = $("topic").value || TP[0];
  const drawT = () => {
    $("topics").innerHTML = TP.map(t => `<button type="button" data-t="${t}" aria-pressed="${t === tp}" class="rounded-full border px-4 py-2 text-base font-semibold transition ${t === tp ? "bg-flag border-flag text-white" : "border-slate-300 dark:border-slate-600 hover:border-slate-500"}">${t}</button>`).join("");
    $("topic").value = tp;
  };
  $("topics").onclick = e => { const b = e.target.closest("[data-t]"); if (b) { tp = b.dataset.t; drawT(); } };
  drawT();
  const qp = new URLSearchParams(location.search);
  if (qp.get("trek")) $("trek").value = qp.get("trek");
  if (location.hash === "#contact") setTimeout(() => $("contact").scrollIntoView(), 150);
})();
