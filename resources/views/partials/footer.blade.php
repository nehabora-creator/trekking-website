<footer class="bg-slate-100 dark:bg-slate-950 text-slate-600 dark:text-slate-400 text-base py-8 border-t border-slate-200 dark:border-slate-800">
 <div class="max-w-6xl mx-auto px-5">
  {{ setting('site_name', 'Himalaya Trails') }} &middot; {{ setting('address', '') }} &middot; {{ setting('email', '') }} &middot; {{ setting('phone', '') }}
  @if(setting('footer_note'))<br>{{ setting('footer_note') }}@endif
 </div>
</footer>
