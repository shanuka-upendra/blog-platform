<x-admin-layout>
    <x-slot name="title">Users</x-slot>

    <div style="background:#fff; border-radius:12px; border:1px solid #e5e7eb; overflow:hidden;">

        <div style="padding:20px 24px; border-bottom:1px solid #f3f4f6; display:flex; justify-content:space-between; align-items:center;">
            <h3 style="font-size:15px; font-weight:700; color:#151c27;">All Users ({{ $users->total() }})</h3>
        </div>

        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:#f9fafb; border-bottom:1px solid #e5e7eb;">
                    <th style="padding:12px 24px; text-align:left; font-size:11px; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em;">User</th>
                    <th style="padding:12px 24px; text-align:left; font-size:11px; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em;">Joined</th>
                    <th style="padding:12px 24px; text-align:left; font-size:11px; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em;">Status</th>
                    <th style="padding:12px 24px; text-align:right; font-size:11px; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr style="border-bottom:1px solid #f3f4f6;">
                    <td style="padding:16px 24px;">
                        <div style="display:flex; align-items:center; gap:12px;">
                            <div style="width:38px; height:38px; background:#e7eefe; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                <span class="material-symbols-outlined" style="font-size:18px; color:#575e70;">person</span>
                            </div>
                            <div>
                                <p style="font-size:13px; font-weight:600; color:#151c27;">{{ $user->name }}</p>
                                <p style="font-size:11px; color:#9ca3af;">{{ $user->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td style="padding:16px 24px; font-size:12px; color:#6b7280;">
                        {{ $user->created_at->format('M d, Y') }}
                    </td>
                    <td style="padding:16px 24px;">
                        <div style="display:flex; gap:6px; flex-wrap:wrap;">
                            @if($user->is_premium)
                            <span style="background:#fefce8; color:#854d0e; border:1px solid #fef08a; padding:3px 10px; border-radius:999px; font-size:11px; font-weight:700;">⭐ Premium</span>
                            @else
                            <span style="background:#f3f4f6; color:#6b7280; border:1px solid #e5e7eb; padding:3px 10px; border-radius:999px; font-size:11px; font-weight:600;">Free</span>
                            @endif
                            @if($user->is_admin)
                            <span style="background:#eff6ff; color:#1d4ed8; border:1px solid #bfdbfe; padding:3px 10px; border-radius:999px; font-size:11px; font-weight:700;">Admin</span>
                            @endif
                        </div>
                    </td>
                    <td style="padding:16px 24px; text-align:right;">
                        <div style="display:flex; justify-content:flex-end; gap:8px;">
                            {{-- Toggle Premium --}}
                            <form method="POST" action="/admin/users/{{ $user->id }}/toggle-premium">
                                @csrf
                                <button type="submit"
                                    style="padding:6px 12px; border-radius:8px; font-size:11px; font-weight:600; cursor:pointer; border:1px solid #e5e7eb; background:#fff; color:#374151; transition:all 0.15s;"
                                    onmouseover="this.style.background='#f3f4f6'" onmouseout="this.style.background='#fff'">
                                    {{ $user->is_premium ? 'Remove Premium' : 'Make Premium' }}
                                </button>
                            </form>
                            {{-- Toggle Admin --}}
                            @if($user->id !== Auth::id())
                            <form method="POST" action="/admin/users/{{ $user->id }}/toggle-admin">
                                @csrf
                                <button type="submit"
                                    style="padding:6px 12px; border-radius:8px; font-size:11px; font-weight:600; cursor:pointer; border:1px solid #bfdbfe; background:#eff6ff; color:#1d4ed8; transition:all 0.15s;">
                                    {{ $user->is_admin ? 'Remove Admin' : 'Make Admin' }}
                                </button>
                            </form>
                            {{-- Delete --}}
                            <form method="POST" action="/admin/users/{{ $user->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Delete {{ $user->name }}? This cannot be undone.')"
                                    style="padding:6px 12px; border-radius:8px; font-size:11px; font-weight:600; cursor:pointer; border:1px solid #fecaca; background:#fef2f2; color:#dc2626; transition:all 0.15s;">
                                    Delete
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        <div style="padding:16px 24px; border-top:1px solid #f3f4f6;">
            {{ $users->links() }}
        </div>

    </div>
</x-admin-layout>