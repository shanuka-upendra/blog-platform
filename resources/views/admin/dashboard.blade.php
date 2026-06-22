<x-admin-layout>
    <x-slot name="title">Dashboard</x-slot>

    {{-- Stats cards --}}
    <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:20px; margin-bottom:32px;">

        <div style="background:#fff; border-radius:12px; padding:24px; border:1px solid #e5e7eb; box-shadow:0 1px 4px rgba(0,0,0,0.04);">
            <div style="display:flex; justify-content:space-between; align-items:flex-start;">
                <div>
                    <p style="font-size:12px; font-weight:600; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:8px;">Total Users</p>
                    <p style="font-size:36px; font-weight:800; color:#151c27;">{{ $stats['total_users'] }}</p>
                    <p style="font-size:12px; color:#22c55e; margin-top:4px;">+{{ $stats['new_users_today'] }} today</p>
                </div>
                <div style="width:48px; height:48px; background:#eff6ff; border-radius:12px; display:flex; align-items:center; justify-content:center;">
                    <span class="material-symbols-outlined" style="color:#3b82f6; font-size:24px;">group</span>
                </div>
            </div>
        </div>

        <div style="background:#fff; border-radius:12px; padding:24px; border:1px solid #e5e7eb; box-shadow:0 1px 4px rgba(0,0,0,0.04);">
            <div style="display:flex; justify-content:space-between; align-items:flex-start;">
                <div>
                    <p style="font-size:12px; font-weight:600; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:8px;">Premium Users</p>
                    <p style="font-size:36px; font-weight:800; color:#151c27;">{{ $stats['premium_users'] }}</p>
                    <p style="font-size:12px; color:#6b7280; margin-top:4px;">of {{ $stats['total_users'] }} total</p>
                </div>
                <div style="width:48px; height:48px; background:#fefce8; border-radius:12px; display:flex; align-items:center; justify-content:center;">
                    <span class="material-symbols-outlined filled" style="color:#ca8a04; font-size:24px;">star</span>
                </div>
            </div>
        </div>

        <div style="background:#fff; border-radius:12px; padding:24px; border:1px solid #e5e7eb; box-shadow:0 1px 4px rgba(0,0,0,0.04);">
            <div style="display:flex; justify-content:space-between; align-items:flex-start;">
                <div>
                    <p style="font-size:12px; font-weight:600; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:8px;">Total Posts</p>
                    <p style="font-size:36px; font-weight:800; color:#151c27;">{{ $stats['total_posts'] }}</p>
                    <p style="font-size:12px; color:#6b7280; margin-top:4px;">{{ $stats['published_posts'] }} published</p>
                </div>
                <div style="width:48px; height:48px; background:#f0fdf4; border-radius:12px; display:flex; align-items:center; justify-content:center;">
                    <span class="material-symbols-outlined" style="color:#22c55e; font-size:24px;">article</span>
                </div>
            </div>
        </div>

        <div style="background:#fff; border-radius:12px; padding:24px; border:1px solid #e5e7eb; box-shadow:0 1px 4px rgba(0,0,0,0.04);">
            <div style="display:flex; justify-content:space-between; align-items:flex-start;">
                <div>
                    <p style="font-size:12px; font-weight:600; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:8px;">Premium Posts</p>
                    <p style="font-size:36px; font-weight:800; color:#151c27;">{{ $stats['premium_posts'] }}</p>
                    <p style="font-size:12px; color:#6b7280; margin-top:4px;">gated content</p>
                </div>
                <div style="width:48px; height:48px; background:#fff7ed; border-radius:12px; display:flex; align-items:center; justify-content:center;">
                    <span class="material-symbols-outlined" style="color:#f97316; font-size:24px;">lock</span>
                </div>
            </div>
        </div>

        <div style="background:linear-gradient(135deg,#b61722,#da3437); border-radius:12px; padding:24px; box-shadow:0 4px 16px rgba(182,23,34,0.3);">
            <p style="font-size:12px; font-weight:600; color:rgba(255,255,255,0.7); text-transform:uppercase; letter-spacing:0.05em; margin-bottom:8px;">Monthly Revenue</p>
            <p style="font-size:36px; font-weight:800; color:#fff;">${{ number_format($stats['premium_users'] * 9.99, 2) }}</p>
            <p style="font-size:12px; color:rgba(255,255,255,0.7); margin-top:4px;">$9.99 × {{ $stats['premium_users'] }} subscribers</p>
        </div>

        <div style="background:#fff; border-radius:12px; padding:24px; border:1px solid #e5e7eb; box-shadow:0 1px 4px rgba(0,0,0,0.04);">
            <div style="display:flex; justify-content:space-between; align-items:flex-start;">
                <div>
                    <p style="font-size:12px; font-weight:600; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:8px;">Conversion Rate</p>
                    <p style="font-size:36px; font-weight:800; color:#151c27;">
                        {{ $stats['total_users'] > 0 ? round(($stats['premium_users'] / $stats['total_users']) * 100) : 0 }}%
                    </p>
                    <p style="font-size:12px; color:#6b7280; margin-top:4px;">free → premium</p>
                </div>
                <div style="width:48px; height:48px; background:#fdf4ff; border-radius:12px; display:flex; align-items:center; justify-content:center;">
                    <span class="material-symbols-outlined" style="color:#a855f7; font-size:24px;">trending_up</span>
                </div>
            </div>
        </div>

    </div>

    {{-- Recent activity --}}
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:24px;">

        {{-- Recent users --}}
        <div style="background:#fff; border-radius:12px; border:1px solid #e5e7eb; overflow:hidden;">
            <div style="padding:20px 24px; border-bottom:1px solid #f3f4f6; display:flex; justify-content:space-between; align-items:center;">
                <h3 style="font-size:15px; font-weight:700; color:#151c27;">Recent Users</h3>
                <a href="/admin/users" style="font-size:12px; color:#b61722; font-weight:600;">View all →</a>
            </div>
            @foreach($recent_users as $user)
            <div style="padding:14px 24px; border-bottom:1px solid #f9fafb; display:flex; align-items:center; justify-content:space-between;">
                <div style="display:flex; align-items:center; gap:12px;">
                    <div style="width:36px; height:36px; background:#e7eefe; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                        <span class="material-symbols-outlined" style="font-size:18px; color:#575e70;">person</span>
                    </div>
                    <div>
                        <p style="font-size:13px; font-weight:600; color:#151c27;">{{ $user->name }}</p>
                        <p style="font-size:11px; color:#9ca3af;">{{ $user->email }}</p>
                    </div>
                </div>
                <div style="display:flex; gap:6px;">
                    @if($user->is_premium)
                    <span style="background:#fefce8; color:#854d0e; border:1px solid #fef08a; padding:2px 8px; border-radius:999px; font-size:10px; font-weight:700;">⭐ Premium</span>
                    @endif
                    @if($user->is_admin)
                    <span style="background:#eff6ff; color:#1d4ed8; border:1px solid #bfdbfe; padding:2px 8px; border-radius:999px; font-size:10px; font-weight:700;">Admin</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        {{-- Recent posts --}}
        <div style="background:#fff; border-radius:12px; border:1px solid #e5e7eb; overflow:hidden;">
            <div style="padding:20px 24px; border-bottom:1px solid #f3f4f6; display:flex; justify-content:space-between; align-items:center;">
                <h3 style="font-size:15px; font-weight:700; color:#151c27;">Recent Posts</h3>
                <a href="/admin/posts" style="font-size:12px; color:#b61722; font-weight:600;">View all →</a>
            </div>
            @foreach($recent_posts as $post)
            <div style="padding:14px 24px; border-bottom:1px solid #f9fafb; display:flex; align-items:center; justify-content:space-between;">
                <div>
                    <p style="font-size:13px; font-weight:600; color:#151c27; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; max-width:220px;">{{ $post->title }}</p>
                    <p style="font-size:11px; color:#9ca3af;">by {{ $post->author->name ?? 'Unknown' }} · {{ $post->created_at->diffForHumans() }}</p>
                </div>
                <div style="display:flex; gap:6px; flex-shrink:0;">
                    @if($post->status === 'published')
                    <span style="background:#f0fdf4; color:#166534; border:1px solid #bbf7d0; padding:2px 8px; border-radius:999px; font-size:10px; font-weight:700;">Published</span>
                    @else
                    <span style="background:#f3f4f6; color:#6b7280; border:1px solid #e5e7eb; padding:2px 8px; border-radius:999px; font-size:10px; font-weight:700;">Draft</span>
                    @endif
                    @if($post->is_premium)
                    <span style="background:#fefce8; color:#854d0e; border:1px solid #fef08a; padding:2px 8px; border-radius:999px; font-size:10px; font-weight:700;">⭐</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

    </div>
</x-admin-layout>