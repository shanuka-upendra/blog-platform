<x-admin-layout>
    <x-slot name="title">Posts</x-slot>

    <div style="background:#fff; border-radius:12px; border:1px solid #e5e7eb; overflow:hidden;">

        <div style="padding:20px 24px; border-bottom:1px solid #f3f4f6;">
            <h3 style="font-size:15px; font-weight:700; color:#151c27;">All Posts ({{ $posts->total() }})</h3>
        </div>

        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:#f9fafb; border-bottom:1px solid #e5e7eb;">
                    <th style="padding:12px 24px; text-align:left; font-size:11px; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em;">Post</th>
                    <th style="padding:12px 24px; text-align:left; font-size:11px; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em;">Author</th>
                    <th style="padding:12px 24px; text-align:left; font-size:11px; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em;">Status</th>
                    <th style="padding:12px 24px; text-align:left; font-size:11px; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em;">Date</th>
                    <th style="padding:12px 24px; text-align:right; font-size:11px; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr style="border-bottom:1px solid #f3f4f6;">
                    <td style="padding:16px 24px; max-width:280px;">
                        <p style="font-size:13px; font-weight:600; color:#151c27; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                            {{ $post->title }}
                        </p>
                        @if($post->is_premium)
                        <span style="font-size:10px; color:#854d0e; font-weight:700;">⭐ Premium</span>
                        @endif
                    </td>
                    <td style="padding:16px 24px; font-size:12px; color:#6b7280;">
                        {{ $post->author->name ?? 'Unknown' }}
                    </td>
                    <td style="padding:16px 24px;">
                        @if($post->status === 'published')
                        <span style="background:#f0fdf4; color:#166534; border:1px solid #bbf7d0; padding:3px 10px; border-radius:999px; font-size:11px; font-weight:700;">Published</span>
                        @else
                        <span style="background:#f3f4f6; color:#6b7280; border:1px solid #e5e7eb; padding:3px 10px; border-radius:999px; font-size:11px; font-weight:600;">Draft</span>
                        @endif
                    </td>
                    <td style="padding:16px 24px; font-size:12px; color:#6b7280;">
                        {{ $post->created_at->format('M d, Y') }}
                    </td>
                    <td style="padding:16px 24px; text-align:right;">
                        <div style="display:flex; justify-content:flex-end; gap:8px;">
                            <a href="/blog/{{ $post->id }}"
                                style="padding:6px 12px; border-radius:8px; font-size:11px; font-weight:600; border:1px solid #e5e7eb; background:#fff; color:#374151; text-decoration:none;">
                                View
                            </a>
                            <form method="POST" action="/admin/posts/{{ $post->id }}/toggle">
                                @csrf
                                <button type="submit"
                                    style="padding:6px 12px; border-radius:8px; font-size:11px; font-weight:600; cursor:pointer; border:1px solid #bfdbfe; background:#eff6ff; color:#1d4ed8;">
                                    {{ $post->status === 'published' ? 'Unpublish' : 'Publish' }}
                                </button>
                            </form>
                            <form method="POST" action="/admin/posts/{{ $post->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Delete this post? Cannot be undone.')"
                                    style="padding:6px 12px; border-radius:8px; font-size:11px; font-weight:600; cursor:pointer; border:1px solid #fecaca; background:#fef2f2; color:#dc2626;">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div style="padding:16px 24px; border-top:1px solid #f3f4f6;">
            {{ $posts->links() }}
        </div>

    </div>
</x-admin-layout>