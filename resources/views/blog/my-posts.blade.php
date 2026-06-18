<x-app-layout>
<x-slot name="title">My Posts - MyBlog</x-slot>

<div class="max-w-container-max mx-auto px-gutter py-section-gap">

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-stack-lg gap-stack-md">
        <h1 class="font-display-lg text-display-lg text-on-surface">My Posts</h1>
        <a href="/posts/create"
           class="bg-primary text-on-primary font-label-caps text-label-caps uppercase px-6 py-3 rounded-DEFAULT hover:opacity-90 shadow-sm transition-all flex items-center gap-2">
            <span class="material-symbols-outlined filled">add</span> New Post
        </a>
    </div>

    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden">

        {{-- Table header --}}
        <div class="hidden md:flex items-center px-gutter py-stack-md border-b border-outline-variant bg-surface-container-low font-label-caps text-label-caps text-secondary uppercase tracking-wider">
            <div class="flex-1">Title</div>
            <div class="w-32">Status</div>
            <div class="w-32">Type</div>
            <div class="w-24 text-right">Actions</div>
        </div>

        {{-- Rows --}}
        @forelse($posts as $post)
            <div class="flex flex-col md:flex-row md:items-center px-gutter py-stack-md border-b border-outline-variant hover:bg-surface-container transition-colors gap-stack-sm md:gap-0 last:border-b-0">

                <div class="flex-1 font-interface-body text-interface-body text-on-surface font-semibold pr-4">
                    <a href="/blog/{{ $post->id }}" class="hover:text-primary transition-colors">
                        {{ $post->title }}
                    </a>
                </div>

                <div class="w-full md:w-32">
                    @if($post->status === 'published')
                        <span class="inline-flex items-center px-2.5 py-1 rounded-DEFAULT bg-secondary-container text-on-secondary-container font-meta-sm text-meta-sm font-medium">
                            Published
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-1 rounded-DEFAULT bg-surface-variant text-on-surface-variant font-meta-sm text-meta-sm font-medium">
                            Draft
                        </span>
                    @endif
                </div>

                <div class="w-full md:w-32">
                    @if($post->is_premium)
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-DEFAULT bg-tertiary-container text-on-tertiary-container font-meta-sm text-meta-sm font-medium">
                            <span class="material-symbols-outlined text-[14px]">star</span> Premium
                        </span>
                    @else
                        <span class="font-meta-sm text-meta-sm text-secondary">--</span>
                    @endif
                </div>

                <div class="w-full md:w-24 flex md:justify-end items-center gap-4">
                    <a href="/posts/{{ $post->id }}/edit"
                       class="text-secondary hover:text-primary transition-colors flex items-center">
                        <span class="material-symbols-outlined">edit</span>
                    </a>
                    <form method="POST" action="/posts/{{ $post->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('Delete this post?')"
                                class="text-secondary hover:text-error transition-colors flex items-center">
                            <span class="material-symbols-outlined">delete</span>
                        </button>
                    </form>
                </div>

            </div>
        @empty
            <div class="px-gutter py-16 text-center text-secondary">
                <span class="material-symbols-outlined text-5xl block mb-4">edit_note</span>
                <p class="font-interface-body text-interface-body">No posts yet.</p>
                <a href="/posts/create" class="text-primary hover:underline font-meta-sm text-meta-sm mt-2 inline-block">
                    Create your first post
                </a>
            </div>
        @endforelse

    </div>
</div>
</x-app-layout>