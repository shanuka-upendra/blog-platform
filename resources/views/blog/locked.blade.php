<x-app-layout>
<x-slot name="title">{{ $post->title }} - MyBlog</x-slot>

<div class="w-full py-section-gap px-gutter">
    <main class="max-w-article-max mx-auto relative">

        <header class="mb-stack-lg text-center">
            <div class="inline-flex items-center gap-2 bg-[#fefce8] text-[#854d0e] px-3 py-1 rounded-full font-label-caps text-label-caps mb-4 border border-[#fef08a]">
                <span class="material-symbols-outlined text-sm">star</span> PREMIUM
            </div>
            <h1 class="font-display-lg text-display-lg text-on-surface mb-stack-md">
                {{ $post->title }}
            </h1>
            <div class="font-meta-sm text-meta-sm text-secondary flex justify-center items-center gap-4">
                <span>By {{ $post->author->name ?? 'Unknown' }}</span>
                <span>•</span>
                <span>{{ max(1, round(str_word_count($post->body) / 200)) }} min read</span>
            </div>
        </header>

        {{-- Blurred preview --}}
        <article class="font-article-body text-article-body text-on-surface relative">
            <p class="mb-stack-md">{{ Str::limit($post->body, 300) }}</p>
            <p class="mb-stack-md blurred-text">
                Upgrade to read the full article and gain access to all premium content on the platform. Subscribe now to continue reading this and many more exclusive posts from expert authors.
            </p>
            <p class="mb-stack-md blurred-text">
                Premium members get unlimited access, early article previews, and a completely ad-free experience tailored for serious readers and learners.
            </p>

            {{-- Paywall overlay --}}
            <div class="absolute inset-0 premium-overlay flex flex-col items-center justify-center pt-32 pb-8">
                <div class="bg-[#fefce8] border-2 border-[#fde047] rounded-xl p-8 max-w-md w-full text-center shadow-lg hover:-translate-y-1 transition-transform duration-300">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm border border-[#fde047]">
                        <span class="material-symbols-outlined text-[#854d0e] text-3xl filled">lock</span>
                    </div>
                    <h2 class="font-headline-md text-headline-md text-on-surface mb-2">This is Premium Content</h2>
                    <p class="font-interface-body text-interface-body text-secondary mb-8">
                        Upgrade to Premium to read the full story and access our entire library of exclusive content.
                    </p>
                    
                    {{-- Authentication-aware dynamic call to action buttons --}}
                    <div class="mb-4">
                        @auth
                            <a href="/checkout"
                               class="w-full py-4 px-6 rounded-lg bg-primary text-on-primary font-label-caps text-label-caps hover:opacity-90 active:translate-y-[2px] transition-all shadow-sm flex items-center justify-center gap-2">
                                Upgrade to Premium
                                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                            </a>
                        @else
                            <a href="/login"
                               class="w-full py-4 px-6 rounded-lg bg-primary text-on-primary font-label-caps text-label-caps hover:opacity-90 transition-all shadow-sm flex items-center justify-center gap-2">
                                Login to Upgrade
                                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                            </a>
                        @endauth
                    </div>

                    <p class="font-meta-sm text-meta-sm text-secondary">Cancel anytime.</p>
                </div>
            </div>
        </article>

    </main>
</div>
</x-app-layout>