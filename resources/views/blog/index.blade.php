<x-app-layout>
<x-slot name="title">MyBlog - Stories, ideas and insights</x-slot>

<div class="max-w-container-max mx-auto px-gutter py-section-gap">

    {{-- Hero --}}
    <section class="text-center mb-16 flex flex-col items-center justify-center min-h-[200px]">
        <h1 class="font-display-lg text-display-lg text-on-surface mb-stack-md max-w-3xl">
            Stories, ideas and insights
        </h1>
        <p class="font-article-body text-article-body text-secondary max-w-2xl mx-auto">
            Explore thought-provoking articles, practical guides, and deep dives into design, technology, and beyond.
        </p>
    </section>

    {{-- Post Grid --}}
    <section class="grid grid-cols-1 md:grid-cols-12 gap-6 md:gap-8">

        @forelse($posts as $index => $post)

            @if($index === 0)
            {{-- Featured post --}}
            <article class="md:col-span-8 group cursor-pointer flex flex-col bg-surface-container-lowest border border-surface-variant rounded-xl overflow-hidden hover:shadow-lg transition-all duration-300">
                <div class="relative w-full h-64 md:h-80 bg-surface-variant overflow-hidden flex items-center justify-center">
                    <span class="material-symbols-outlined text-6xl text-secondary opacity-30">article</span>
                    <div class="absolute top-4 left-4">
                        @if($post->is_premium)
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-[#fefce8] text-[#854d0e] font-label-caps text-label-caps uppercase border border-[#fef08a]">
                                <span class="material-symbols-outlined filled text-[10px]">star</span> Premium
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-[#f0fdf4] text-[#166534] font-label-caps text-label-caps uppercase border border-[#bbf7d0]">
                                Free
                            </span>
                        @endif
                    </div>
                </div>
                <div class="p-6 md:p-8 flex flex-col flex-grow">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="font-meta-sm text-meta-sm text-secondary">
                            {{ $post->created_at->diffForHumans() }}
                        </span>
                    </div>
                    <h2 class="font-headline-md text-headline-md text-on-surface mb-4 group-hover:text-primary transition-colors">
                        {{ $post->title }}
                    </h2>
                    <p class="font-interface-body text-interface-body text-secondary mb-6 line-clamp-2 flex-grow">
                        {{ Str::limit($post->body, 120) }}
                    </p>
                    <div class="flex items-center justify-between mt-auto">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-surface-variant flex items-center justify-center">
                                <span class="material-symbols-outlined text-secondary text-sm">person</span>
                            </div>
                            <span class="font-meta-sm text-meta-sm font-semibold text-on-surface">
                                {{ $post->author->name ?? 'Unknown' }}
                            </span>
                        </div>
                        <a href="/blog/{{ $post->id }}"
                           class="font-label-caps text-label-caps text-primary flex items-center group-hover:translate-x-1 transition-transform">
                            Read <span class="material-symbols-outlined text-sm ml-1">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </article>

            @else
            {{-- Standard post --}}
            <article class="md:col-span-4 group cursor-pointer flex flex-col bg-surface-container-lowest border border-surface-variant rounded-xl overflow-hidden hover:shadow-lg transition-all duration-300">
                <div class="p-6 flex flex-col flex-grow">
                    <div class="mb-4">
                        @if($post->is_premium)
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-[#fefce8] text-[#854d0e] font-label-caps text-label-caps uppercase border border-[#fef08a]">
                                <span class="material-symbols-outlined filled text-[10px]">star</span> Premium
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-[#f0fdf4] text-[#166534] font-label-caps text-label-caps uppercase border border-[#bbf7d0]">
                                Free
                            </span>
                        @endif
                    </div>
                    <div class="flex items-center gap-3 mb-3">
                        <span class="font-meta-sm text-meta-sm text-secondary">{{ $post->created_at->diffForHumans() }}</span>
                    </div>
                    <h3 class="font-interface-body text-interface-body font-bold text-on-surface mb-3 group-hover:text-primary transition-colors text-xl leading-tight">
                        {{ $post->title }}
                    </h3>
                    <p class="font-meta-sm text-meta-sm text-secondary mb-6 line-clamp-3 flex-grow">
                        {{ Str::limit($post->body, 100) }}
                    </p>
                    <div class="flex items-center justify-between mt-auto pt-4 border-t border-surface-variant">
                        <span class="font-meta-sm text-meta-sm font-semibold text-on-surface">
                            {{ $post->author->name ?? 'Unknown' }}
                        </span>
                        <a href="/blog/{{ $post->id }}"
                           class="font-label-caps text-label-caps text-primary flex items-center group-hover:translate-x-1 transition-transform">
                            Read <span class="material-symbols-outlined text-sm ml-1">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </article>
            @endif

        @empty
            <div class="md:col-span-12 text-center py-20 text-secondary">
                <span class="material-symbols-outlined text-6xl mb-4 block">edit_note</span>
                <p class="font-headline-md text-headline-md">No posts yet.</p>
                <a href="/posts/create" class="text-primary hover:underline mt-2 inline-block font-interface-body text-interface-body">
                    Create the first one!
                </a>
            </div>
        @endforelse

        {{-- Newsletter Signup --}}
        <aside class="md:col-span-4 flex flex-col justify-center bg-surface-container-low border border-surface-variant rounded-xl p-8">
            <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center mb-6">
                <span class="material-symbols-outlined text-primary text-2xl">mail</span>
            </div>
            <h3 class="font-headline-md text-headline-md text-on-surface mb-2 text-2xl">Stay Updated</h3>
            <p class="font-meta-sm text-meta-sm text-secondary mb-6">
                Get the latest stories delivered straight to your inbox every week.
            </p>
            <form class="flex flex-col gap-3" onsubmit="event.preventDefault();">
                <input type="email" placeholder="Email address" required
                       class="w-full bg-surface-container-lowest border border-outline-variant focus:border-primary rounded-DEFAULT px-4 py-3 font-interface-body text-interface-body outline-none transition-colors"/>
                <button type="submit"
                        class="w-full bg-primary text-on-primary font-label-caps text-label-caps py-3 rounded-DEFAULT hover:opacity-90 transition-all">
                    Subscribe
                </button>
            </form>
        </aside>

    </section>
</div>
</x-app-layout>