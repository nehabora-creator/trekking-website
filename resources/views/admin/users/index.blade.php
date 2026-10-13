@extends('admin.layout')
@section('title', 'Users')
@section('content')
<h1 class="font-display font-extrabold text-3xl">Users</h1>
<div class="mt-6 rounded-xl bg-white shadow-sm overflow-x-auto">
 <table class="w-full text-left">
  <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500"><tr><th class="px-4 py-3">Name</th><th class="px-4 py-3">Email</th><th class="px-4 py-3">Joined</th><th class="px-4 py-3">Role</th><th class="px-4 py-3"></th></tr></thead>
  <tbody>
   @foreach($items as $u)
    <tr class="border-t">
     <td class="px-4 py-3">{{ $u->name }}</td>
     <td class="px-4 py-3">{{ $u->email }}</td>
     <td class="px-4 py-3 whitespace-nowrap">{{ $u->created_at->format('j M Y') }}</td>
     <td class="px-4 py-3"><span class="inline-block rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $u->is_admin ? 'bg-flag/10 text-flag' : 'bg-slate-200 text-slate-600' }}">{{ $u->is_admin ? 'Admin' : 'Member' }}</span></td>
     <td class="px-4 py-3 text-right">
      @if($u->id !== auth()->id())
       <form method="POST" action="{{ route('admin.users.toggle', $u) }}">@csrf @method('PATCH')<button type="submit" class="text-flag font-semibold underline">{{ $u->is_admin ? 'Remove admin' : 'Make admin' }}</button></form>
      @endif
     </td>
    </tr>
   @endforeach
  </tbody>
 </table>
</div>
<div class="mt-4">{{ $items->links() }}</div>
@endsection
