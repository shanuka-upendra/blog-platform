<x-app-layout>
<x-slot name="title">{{ $post->title }} - MyBlog</x-slot>

<style>
    .article-body h2 {
        font-size: 1.75rem;
        font-weight: 700;
        margin: 2rem 0 1rem;
        color: #151c27;
        line-height: 1.3;
    }
    .article-body h3 {
        font-size: 1.35rem;
        font-weight: 600;
        margin: 1.5rem 0 0.75rem;
        color: #151c27;
    }
    .article-body p {
        margin-bottom: 1.25rem;
        font-size: 20px;
        line-height: 32px;
        color: #151c27;
    }
    .article-body ul {
        list-style: disc;
        padding-left: 1.75rem;
        margin-bottom: 1.25rem;
    }
    .article-body ol {
        list-style: decimal;
        padding-left: 1.75rem;
        margin-bottom: 1.25rem;
    }
    .article-body li {
        margin-bottom: 0.4rem;
        font-size: 18px;
        line-height: 1.7;
        color: #151c27;
    }
    .article-body blockquote {
        border-left: 4px solid #b61722;
        padding: 0.75rem 1.25rem;
        margin: 1.5rem 0;
        color: #575e70;
        font-style: italic;
        background: #f0f3ff;
        border-radius: 0 0.5rem 0.5rem 0;
    }
    .article-body strong { font-weight: 700; color: #151c27; }
    .article-body em     { font-style: italic; }
    .article-body u      { text-decoration: underline; }
</style>

<div class="w-full py-section-gap px-gutter">
<article class="max-w-article-max mx-auto">

    {{-- Header --}}
    <header class="mb-stack-lg text-center flex flex-col items-center">
        @if($post->is_premium)
            <div class="inline-flex items-center gap-1 bg-[#fefce8] text-[#854d0e] px-3 py-1 rounded-full font-label-caps text-label-caps uppercase mb-stack-md border border-[#fef08a]">
                <span class="material-symbols-outlined text-sm filled">star</span> Premium
            </div>
        @endif

        <h1 class="font-display-lg text-display-lg text-on-surface mb-stack-md leading-tight">
            {{ $post->title }}
        </h1>

        <div class="flex items-center justify-center gap-4 font-meta-sm text-meta-sm text-secondary">
            <span>{{ $post->author->name ?? 'Unknown' }}</span>
            <span class="w-1 h-1 rounded-full bg-outline-variant"></span>
            <span>{{ $post->created_at->format('M d, Y') }}</span>
            <span class="w-1 h-1 rounded-full bg-outline-variant"></span>
            <span>{{ max(1, round(str_word_count(strip_tags($post->body)) / 200)) }} min read</span>
        </div>

        @if(Auth::id() === $post->user_id)
            <div class="mt-stack-md flex gap-4">
                <a href="/posts/{{ $post->id }}/edit"
                   class="px-4 py-2 border border-outline text-secondary rounded hover:bg-surface-variant transition-colors font-interface-body text-interface-body flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">edit</span> Edit
                </a>
                <form method="POST" action="/posts/{{ $post->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Delete this post?')"
                            class="px-4 py-2 bg-error text-on-error rounded hover:opacity-90 transition-colors font-interface-body text-interface-body flex items-center gap-2">
                        <span class="material-symbols-outlined text-base">delete</span> Delete
                    </button>
                </form>
            </div>
        @endif
    </header>

    {{-- Cover image --}}
    @if($post->cover_image)
        <figure class="mb-stack-lg w-full rounded-xl overflow-hidden border border-surface-variant shadow-sm">
            <img src="{{ Storage::url($post->cover_image) }}"
                 alt="{{ $post->title }}"
                 class="w-full h-72 md:h-96 object-cover"/>
        </figure>
    @endif

    {{-- Article body --}}
    <div class="article-body font-article-body text-article-body text-on-surface">
        {!! $post->body !!}
    </div>

    {{-- Footer --}}
    <div class="mt-stack-lg pt-stack-md border-t border-outline-variant flex items-center justify-between">
        <a href="/blog" class="font-meta-sm text-meta-sm text-secondary hover:text-primary transition-colors flex items-center gap-1">
            <span class="material-symbols-outlined text-sm">arrow_back</span> Back to Blog
        </a>
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-full bg-surface-variant flex items-center justify-center">
                <span class="material-symbols-outlined text-secondary text-sm">person</span>
            </div>
            <span class="font-meta-sm text-meta-sm text-secondary">{{ $post->author->name ?? 'Unknown' }}</span>
        </div>
    </div>

</article>
</div>
</x-app-layout>