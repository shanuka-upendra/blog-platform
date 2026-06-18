<x-app-layout>
<x-slot name="title">MyBlog - Stories, ideas and insights</x-slot>

<div class="w-full max-w-6xl mx-auto px-6 py-16">

    {{-- Hero --}}
    <section class="text-center mb-16">
        <h1 style="font-size:48px; font-weight:800; color:#151c27; line-height:1.15; letter-spacing:-0.02em;" class="mb-4">
            Stories, ideas and insights
        </h1>
        <p style="font-size:18px; color:#575e70; max-width:560px; margin:0 auto; line-height:1.7;">
            Explore thought-provoking articles, practical guides, and deep dives into design, technology, and beyond.
        </p>
    </section>

    @if($posts->isEmpty())
        {{-- Empty state --}}
        <div class="text-center py-24">
            <span class="material-symbols-outlined" style="font-size:64px; color:#c5c6c8; display:block; margin-bottom:16px;">edit_note</span>
            <p style="font-size:20px; color:#575e70; font-weight:600;">No posts yet.</p>
            <a href="/posts/create" style="color:#b61722; font-size:15px; margin-top:8px; display:inline-block;">
                Create the first one →
            </a>
        </div>
    @else

        {{-- Featured post (first post - full width) --}}
        @php $featured = $posts->first(); $rest = $posts->skip(1); @endphp

        <a href="/blog/{{ $featured->id }}" class="block mb-8 group">
            <div style="background:#fff; border:1px solid #e8e8e8; border-radius:16px; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,0.04); transition:box-shadow 0.2s;" onmouseover="this.style.boxShadow='0 8px 32px rgba(0,0,0,0.10)'" onmouseout="this.style.boxShadow='0 2px 8px rgba(0,0,0,0.04)'">
                <div style="display:flex; flex-direction:row; min-height:280px;">

                    {{-- Image side --}}
                    <div style="width:45%; flex-shrink:0; background:#f0f3ff; position:relative; overflow:hidden;">
                        @if($featured->cover_image)
                            <img src="{{ Storage::url($featured->cover_image) }}"
                                 alt="{{ $featured->title }}"
                                 style="width:100%; height:100%; object-fit:cover; display:block;"/>
                        @else
                            <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; background:linear-gradient(135deg, #f0f3ff 0%, #dce2f3 100%);">
                                <span class="material-symbols-outlined" style="font-size:64px; color:#8f6f6d; opacity:0.4;">article</span>
                            </div>
                        @endif
                        {{-- Badge --}}
                        <div style="position:absolute; top:16px; left:16px;">
                            @if($featured->is_premium)
                                <span style="background:#fefce8; color:#854d0e; border:1px solid #fef08a; padding:4px 12px; border-radius:999px; font-size:11px; font-weight:700; letter-spacing:0.05em; text-transform:uppercase; display:inline-flex; align-items:center; gap:4px;">
                                    <span class="material-symbols-outlined" style="font-size:12px; font-variation-settings:'FILL' 1;">star</span> Premium
                                </span>
                            @else
                                <span style="background:#f0fdf4; color:#166534; border:1px solid #bbf7d0; padding:4px 12px; border-radius:999px; font-size:11px; font-weight:700; letter-spacing:0.05em; text-transform:uppercase;">
                                    Free
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Content side --}}
                    <div style="flex:1; padding:40px 48px; display:flex; flex-direction:column; justify-content:center;">
                        <p style="font-size:12px; color:#8f6f6d; font-weight:600; letter-spacing:0.05em; text-transform:uppercase; margin-bottom:12px;">
                            Featured · {{ $featured->created_at->diffForHumans() }}
                        </p>
                        <h2 style="font-size:28px; font-weight:800; color:#151c27; line-height:1.3; margin-bottom:16px; letter-spacing:-0.01em;">
                            {{ $featured->title }}
                        </h2>
                        <p style="font-size:15px; color:#575e70; line-height:1.7; margin-bottom:24px; display:-webkit-box; -webkit-line-clamp:3; -webkit-box-orient:vertical; overflow:hidden;">
                            {{ Str::limit(strip_tags($featured->body), 180) }}
                        </p>
                        <div style="display:flex; align-items:center; justify-content:space-between;">
                            <div style="display:flex; align-items:center; gap:10px;">
                                <div style="width:36px; height:36px; border-radius:50%; background:#e7eefe; display:flex; align-items:center; justify-content:center;">
                                    <span class="material-symbols-outlined" style="font-size:18px; color:#575e70;">person</span>
                                </div>
                                <span style="font-size:14px; font-weight:600; color:#151c27;">
                                    {{ $featured->author->name ?? 'Unknown' }}
                                </span>
                            </div>
                            <span style="font-size:13px; font-weight:700; color:#b61722; display:flex; align-items:center; gap:4px;">
                                Read article
                                <span class="material-symbols-outlined" style="font-size:16px;">arrow_forward</span>
                            </span>
                        </div>
                    </div>

                </div>
            </div>
        </a>

        {{-- Grid of remaining posts --}}
        @if($rest->count() > 0)
            <div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:24px;">
                @foreach($rest as $post)
                    <a href="/blog/{{ $post->id }}" style="text-decoration:none; display:block;">
                        <div style="background:#fff; border:1px solid #e8e8e8; border-radius:14px; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,0.04); transition:box-shadow 0.2s; height:100%;" onmouseover="this.style.boxShadow='0 8px 24px rgba(0,0,0,0.10)'" onmouseout="this.style.boxShadow='0 2px 8px rgba(0,0,0,0.04)'">

                            {{-- Card image --}}
                            <div style="width:100%; height:180px; background:#f0f3ff; position:relative; overflow:hidden;">
                                @if($post->cover_image)
                                    <img src="{{ Storage::url($post->cover_image) }}"
                                         alt="{{ $post->title }}"
                                         style="width:100%; height:100%; object-fit:cover; display:block;"/>
                                @else
                                    <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; background:linear-gradient(135deg, #f0f3ff 0%, #dce2f3 100%);">
                                        <span class="material-symbols-outlined" style="font-size:40px; color:#8f6f6d; opacity:0.4;">article</span>
                                    </div>
                                @endif
                                {{-- Badge --}}
                                <div style="position:absolute; top:12px; left:12px;">
                                    @if($post->is_premium)
                                        <span style="background:#fefce8; color:#854d0e; border:1px solid #fef08a; padding:3px 10px; border-radius:999px; font-size:10px; font-weight:700; letter-spacing:0.05em; text-transform:uppercase; display:inline-flex; align-items:center; gap:3px;">
                                            <span class="material-symbols-outlined" style="font-size:10px; font-variation-settings:'FILL' 1;">star</span> Premium
                                        </span>
                                    @else
                                        <span style="background:#f0fdf4; color:#166534; border:1px solid #bbf7d0; padding:3px 10px; border-radius:999px; font-size:10px; font-weight:700; letter-spacing:0.05em; text-transform:uppercase;">
                                            Free
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- Card content --}}
                            <div style="padding:20px 24px 24px;">
                                <p style="font-size:11px; color:#8f6f6d; font-weight:600; letter-spacing:0.05em; text-transform:uppercase; margin-bottom:8px;">
                                    {{ $post->created_at->diffForHumans() }}
                                </p>
                                <h3 style="font-size:17px; font-weight:700; color:#151c27; line-height:1.4; margin-bottom:10px; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">
                                    {{ $post->title }}
                                </h3>
                                <p style="font-size:13px; color:#575e70; line-height:1.6; margin-bottom:16px; display:-webkit-box; -webkit-line-clamp:3; -webkit-box-orient:vertical; overflow:hidden;">
                                    {{ Str::limit(strip_tags($post->body), 100) }}
                                </p>
                                <div style="display:flex; align-items:center; justify-content:space-between; padding-top:14px; border-top:1px solid #f0f3ff;">
                                    <span style="font-size:12px; font-weight:600; color:#151c27;">
                                        {{ $post->author->name ?? 'Unknown' }}
                                    </span>
                                    <span style="font-size:12px; font-weight:700; color:#b61722; display:flex; align-items:center; gap:3px;">
                                        Read
                                        <span class="material-symbols-outlined" style="font-size:14px;">arrow_forward</span>
                                    </span>
                                </div>
                            </div>

                        </div>
                    </a>
                @endforeach

                {{-- Newsletter card --}}
                <div style="background:linear-gradient(135deg, #fff8f8 0%, #fff 100%); border:2px solid #ffdad7; border-radius:14px; padding:32px 24px; display:flex; flex-direction:column; justify-content:center;">
                    <div style="width:48px; height:48px; background:#ffdad7; border-radius:50%; display:flex; align-items:center; justify-content:center; margin-bottom:16px;">
                        <span class="material-symbols-outlined" style="font-size:24px; color:#b61722;">mail</span>
                    </div>
                    <h3 style="font-size:18px; font-weight:700; color:#151c27; margin-bottom:8px;">Stay Updated</h3>
                    <p style="font-size:13px; color:#575e70; margin-bottom:16px; line-height:1.6;">
                        Get the latest stories delivered to your inbox every week.
                    </p>
                    <form onsubmit="event.preventDefault();" style="display:flex; flex-direction:column; gap:8px;">
                        <input type="email" placeholder="Your email address"
                               style="width:100%; padding:10px 14px; border:1px solid #e4beba; border-radius:8px; font-size:13px; outline:none; box-sizing:border-box;"
                               onfocus="this.style.borderColor='#b61722'" onblur="this.style.borderColor='#e4beba'"/>
                        <button type="submit"
                                style="width:100%; padding:10px; background:#b61722; color:#fff; border:none; border-radius:8px; font-size:12px; font-weight:700; letter-spacing:0.05em; text-transform:uppercase; cursor:pointer;">
                            Subscribe
                        </button>
                    </form>
                </div>

            </div>
        @endif

    @endif

</div>
</x-app-layout>