/* "Choose Trek" dropdown in the header: open/close and live search by trek name. */
(function () {
  var btn = document.getElementById("choose-btn");
  var mega = document.getElementById("mega");
  if (!btn || !mega) return;

  function set(open) {
    mega.classList.toggle("hidden", !open);
    btn.setAttribute("aria-expanded", open);
  }
  btn.addEventListener("click", function (e) {
    e.stopPropagation();
    set(mega.classList.contains("hidden"));
  });
  document.addEventListener("click", function (e) {
    if (!mega.classList.contains("hidden") && !mega.contains(e.target) && !btn.contains(e.target)) set(false);
  });
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") set(false);
  });

  var q = document.getElementById("mega-q");
  var items = Array.prototype.slice.call(document.querySelectorAll("#mega-list li"));
  if (q) {
    q.addEventListener("input", function () {
      var v = q.value.trim().toLowerCase();
      items.forEach(function (li) {
        li.classList.toggle("hidden", v !== "" && li.dataset.name.indexOf(v) === -1);
      });
    });
  }
})();
