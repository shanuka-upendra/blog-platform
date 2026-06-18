<x-app-layout>
<x-slot name="title">Edit Post - MyBlog</x-slot>

<style>
    .ProseMirror {
        min-height: 480px;
        outline: none;
        padding: 2rem;
        font-size: 20px;
        line-height: 32px;
        color: #151c27;
        font-family: 'Inter', sans-serif;
    }
    .ProseMirror > * + * { margin-top: 0.75em; }
    .ProseMirror p { margin-bottom: 1.25rem; }
    .ProseMirror h2 {
        font-size: 1.75rem;
        font-weight: 700;
        margin: 2rem 0 1rem;
        color: #151c27;
        line-height: 1.3;
    }
    .ProseMirror h3 {
        font-size: 1.35rem;
        font-weight: 600;
        margin: 1.5rem 0 0.75rem;
        color: #151c27;
    }
    .ProseMirror ul { list-style: disc; padding-left: 1.75rem; margin-bottom: 1.25rem; }
    .ProseMirror ol { list-style: decimal; padding-left: 1.75rem; margin-bottom: 1.25rem; }
    .ProseMirror li { margin-bottom: 0.4rem; }
    .ProseMirror blockquote {
        border-left: 4px solid #b61722;
        padding: 0.75rem 1.25rem;
        margin: 1.5rem 0;
        color: #575e70;
        font-style: italic;
        background: #f0f3ff;
        border-radius: 0 0.5rem 0.5rem 0;
    }
    .ProseMirror strong { font-weight: 700; color: #151c27; }
    .ProseMirror em { font-style: italic; }
    .ProseMirror p.is-editor-empty:first-child::before {
        color: #9ca3af;
        content: attr(data-placeholder);
        float: left;
        height: 0;
        pointer-events: none;
    }
    .toolbar-btn {
        padding: 0.4rem 0.65rem;
        border-radius: 0.375rem;
        font-size: 12px;
        font-weight: 600;
        color: #575e70;
        background: transparent;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        transition: all 0.15s;
    }
    .toolbar-btn:hover { background: #dce2f3; color: #151c27; }
    .toolbar-btn.active { background: #b61722; color: white; }
    .toolbar-divider { width: 1px; background: #e4beba; margin: 0 4px; align-self: stretch; }
    #image-preview { display: none; }
</style>

<div class="w-full px-gutter py-section-gap">
<div class="max-w-article-max mx-auto">

    <div class="mb-stack-lg">
        <h1 class="font-display-lg text-display-lg text-on-surface">Edit Post</h1>
        <p class="font-interface-body text-interface-body text-secondary mt-stack-sm">
            Update your story and republish.
        </p>
    </div>

    @if($errors->any())
        <div class="bg-error-container text-on-error-container px-4 py-3 rounded-lg mb-6 font-meta-sm text-meta-sm space-y-1">
            @foreach($errors->all() as $error)
                <p>⚠ {{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="/posts/{{ $post->id }}"
          enctype="multipart/form-data" id="post-form" class="flex flex-col gap-stack-lg">
        @csrf
        @method('PUT')

        {{-- TITLE --}}
        <div class="flex flex-col gap-2">
            <label class="font-label-caps text-label-caps text-on-surface-variant uppercase tracking-wider">
                Title
            </label>
            <input
                type="text"
                name="title"
                value="{{ old('title', $post->title) }}"
                placeholder="Enter a captivating title..."
                class="w-full bg-transparent border-0 border-b-2 border-outline-variant focus:border-primary focus:ring-0 px-0 py-3 font-headline-md text-headline-md text-on-surface placeholder:text-secondary transition-colors"
            />
        </div>

        {{-- COVER IMAGE --}}
        <div class="flex flex-col gap-2">
            <label class="font-label-caps text-label-caps text-on-surface-variant uppercase tracking-wider">
                Cover Image
            </label>

            {{-- Existing image --}}
            @if($post->cover_image)
                <div id="existing-image" class="relative rounded-xl overflow-hidden">
                    <img src="{{ Storage::url($post->cover_image) }}"
                         alt="Current cover"
                         class="w-full h-64 object-cover rounded-xl"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-xl"></div>
                    <button type="button" id="remove-existing-btn"
                            class="absolute top-3 right-3 bg-white rounded-full p-1.5 shadow-md hover:bg-red-50 transition-colors">
                        <span class="material-symbols-outlined text-error" style="font-size:18px;">close</span>
                    </button>
                    <p class="absolute bottom-3 left-3 font-meta-sm text-meta-sm text-white font-medium">
                        Current cover · Upload new to replace
                    </p>
                </div>
            @endif

            {{-- Upload zone --}}
            <div id="drop-zone"
                 class="{{ $post->cover_image ? 'hidden' : '' }} border-2 border-dashed border-outline-variant rounded-xl p-10 text-center cursor-pointer hover:border-primary hover:bg-surface-container-low transition-all duration-200">
                <span class="material-symbols-outlined text-5xl text-secondary block mb-3">add_photo_alternate</span>
                <p class="font-interface-body text-interface-body text-secondary font-medium">
                    Click to upload cover image
                </p>
                <p class="font-meta-sm text-meta-sm text-secondary mt-1">
                    JPG, PNG, WEBP — max 2MB
                </p>
            </div>

            <input type="file" name="cover_image" id="cover_image" accept="image/*" class="hidden"/>

            {{-- New image preview --}}
            <div id="image-preview" class="relative rounded-xl overflow-hidden">
                <img id="preview-img" src="" alt="New cover preview"
                     class="w-full h-64 object-cover rounded-xl"/>
                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-xl"></div>
                <button type="button" id="clear-image-btn"
                        class="absolute top-3 right-3 bg-white rounded-full p-1.5 shadow-md hover:bg-red-50 transition-colors">
                    <span class="material-symbols-outlined text-error" style="font-size:18px;">close</span>
                </button>
                <p class="absolute bottom-3 left-3 font-meta-sm text-meta-sm text-white font-medium">
                    New cover image selected ✓
                </p>
            </div>
        </div>

        {{-- RICH TEXT EDITOR --}}
        <div class="flex flex-col gap-0">
            <label class="font-label-caps text-label-caps text-on-surface-variant uppercase tracking-wider mb-2">
                Content
            </label>

            {{-- Toolbar --}}
            <div class="flex flex-wrap items-center gap-1 p-2 bg-surface-container-low border border-outline-variant rounded-t-xl">
                <button type="button" class="toolbar-btn" id="btn-h2">H2</button>
                <button type="button" class="toolbar-btn" id="btn-h3">H3</button>
                <div class="toolbar-divider"></div>
                <button type="button" class="toolbar-btn font-bold" id="btn-bold">B</button>
                <button type="button" class="toolbar-btn italic" id="btn-italic">I</button>
                <button type="button" class="toolbar-btn underline" id="btn-underline">U</button>
                <div class="toolbar-divider"></div>
                <button type="button" class="toolbar-btn" id="btn-bullet">
                    <span class="material-symbols-outlined" style="font-size:18px;">format_list_bulleted</span>
                </button>
                <button type="button" class="toolbar-btn" id="btn-ordered">
                    <span class="material-symbols-outlined" style="font-size:18px;">format_list_numbered</span>
                </button>
                <button type="button" class="toolbar-btn" id="btn-quote">
                    <span class="material-symbols-outlined" style="font-size:18px;">format_quote</span>
                </button>
                <div class="toolbar-divider"></div>
                <button type="button" class="toolbar-btn" id="btn-undo">
                    <span class="material-symbols-outlined" style="font-size:18px;">undo</span>
                </button>
                <button type="button" class="toolbar-btn" id="btn-redo">
                    <span class="material-symbols-outlined" style="font-size:18px;">redo</span>
                </button>
            </div>

            {{-- Editor --}}
            <div id="editor"
                 class="bg-surface-container-lowest border border-outline-variant border-t-0 rounded-b-xl cursor-text">
            </div>

            <textarea name="body" id="body" class="hidden">{{ old('body', $post->body) }}</textarea>

            <div class="flex justify-end mt-1">
                <span id="word-count" class="font-meta-sm text-meta-sm text-secondary">0 words</span>
            </div>
        </div>

        {{-- OPTIONS --}}
        <div class="flex flex-col sm:flex-row gap-6 justify-between items-start sm:items-center p-5 bg-surface-container-low rounded-xl border border-outline-variant">
            <div class="flex flex-col gap-1">
                <label class="font-label-caps text-label-caps text-on-surface-variant uppercase tracking-wider">
                    Status
                </label>
                <select name="status"
                        class="bg-surface-container-lowest border border-outline-variant rounded-lg px-3 py-2 font-interface-body text-interface-body text-on-surface focus:border-primary focus:ring-1 focus:ring-primary">
                    <option value="draft" {{ old('status', $post->status) === 'draft' ? 'selected' : '' }}>
                        📝 Draft
                    </option>
                    <option value="published" {{ old('status', $post->status) === 'published' ? 'selected' : '' }}>
                        🌍 Published
                    </option>
                </select>
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_premium" id="is_premium"
                       {{ old('is_premium', $post->is_premium) ? 'checked' : '' }}
                       class="w-5 h-5 rounded border-outline-variant text-primary focus:ring-primary cursor-pointer"/>
                <div class="flex flex-col">
                    <label for="is_premium"
                           class="font-interface-body text-interface-body text-on-surface font-semibold flex items-center gap-1 cursor-pointer">
                        Premium Content
                        <span class="material-symbols-outlined text-[#854d0e]"
                              style="font-size:16px; font-variation-settings: 'FILL' 1;">star</span>
                    </label>
                    <span class="font-meta-sm text-meta-sm text-secondary">
                        Restrict this post to subscribers only
                    </span>
                </div>
            </div>
        </div>

        {{-- ACTIONS --}}
        <div class="flex justify-end gap-4 pt-stack-md border-t border-outline-variant">
            <a href="/blog"
               class="px-6 py-3 rounded-lg border border-outline text-secondary font-label-caps text-label-caps uppercase tracking-wider hover:bg-surface-container-low transition-colors">
                Cancel
            </a>
            <button type="submit" id="submit-btn"
                    class="px-8 py-3 rounded-lg bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-wider hover:opacity-90 shadow-sm transition-all flex items-center gap-2">
                <span class="material-symbols-outlined" style="font-size:18px;">save</span>
                Update Post
            </button>
        </div>

    </form>
</div>
</div>

<script src="https://unpkg.com/@tiptap/core@2.1.13/dist/index.umd.js"></script>
<script src="https://unpkg.com/@tiptap/starter-kit@2.1.13/dist/index.umd.js"></script>
<script src="https://unpkg.com/@tiptap/extension-placeholder@2.1.13/dist/index.umd.js"></script>
<script src="https://unpkg.com/@tiptap/extension-underline@2.1.13/dist/index.umd.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const bodyTextarea = document.getElementById('body');
    const wordCountEl  = document.getElementById('word-count');

    // Init editor with existing content
    const editor = new tiptap.Editor({
        element: document.getElementById('editor'),
        extensions: [
            tiptapStarterKit.StarterKit,
            tiptapExtensionPlaceholder.Placeholder.configure({
                placeholder: 'Start writing your story here...',
            }),
            tiptapExtensionUnderline.Underline,
        ],
        content: bodyTextarea.value || '',
        onUpdate({ editor }) {
            bodyTextarea.value = editor.getHTML();
            updateToolbar();
            updateWordCount(editor.getText());
        },
        onSelectionUpdate() {
            updateToolbar();
        },
    });

    // Set initial word count from existing content
    updateWordCount(editor.getText());

    function updateToolbar() {
        toggleActive('btn-bold',      editor.isActive('bold'));
        toggleActive('btn-italic',    editor.isActive('italic'));
        toggleActive('btn-underline', editor.isActive('underline'));
        toggleActive('btn-h2',        editor.isActive('heading', { level: 2 }));
        toggleActive('btn-h3',        editor.isActive('heading', { level: 3 }));
        toggleActive('btn-bullet',    editor.isActive('bulletList'));
        toggleActive('btn-ordered',   editor.isActive('orderedList'));
        toggleActive('btn-quote',     editor.isActive('blockquote'));
    }

    function toggleActive(id, condition) {
        document.getElementById(id).classList.toggle('active', condition);
    }

    function updateWordCount(text) {
        const words = text.trim() === '' ? 0 : text.trim().split(/\s+/).length;
        const mins  = Math.max(1, Math.round(words / 200));
        wordCountEl.textContent = `${words} words · ${mins} min read`;
    }

    // Toolbar actions
    const toolbarActions = {
        'btn-h2':        () => editor.chain().focus().toggleHeading({ level: 2 }).run(),
        'btn-h3':        () => editor.chain().focus().toggleHeading({ level: 3 }).run(),
        'btn-bold':      () => editor.chain().focus().toggleBold().run(),
        'btn-italic':    () => editor.chain().focus().toggleItalic().run(),
        'btn-underline': () => editor.chain().focus().toggleUnderline().run(),
        'btn-bullet':    () => editor.chain().focus().toggleBulletList().run(),
        'btn-ordered':   () => editor.chain().focus().toggleOrderedList().run(),
        'btn-quote':     () => editor.chain().focus().toggleBlockquote().run(),
        'btn-undo':      () => editor.chain().focus().undo().run(),
        'btn-redo':      () => editor.chain().focus().redo().run(),
    };

    Object.entries(toolbarActions).forEach(([id, action]) => {
        document.getElementById(id).addEventListener('click', action);
    });

    // ── Image handling ─────────────────────────────────────────
    const dropZone   = document.getElementById('drop-zone');
    const fileInput  = document.getElementById('cover_image');
    const previewBox = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');

    dropZone.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;
        if (file.size > 2 * 1024 * 1024) {
            alert('Image must be under 2MB.');
            this.value = '';
            return;
        }
        const reader = new FileReader();
        reader.onload = (e) => {
            previewImg.src           = e.target.result;
            previewBox.style.display = 'block';
            dropZone.style.display   = 'none';
            // Hide existing image if replacing
            const existing = document.getElementById('existing-image');
            if (existing) existing.style.display = 'none';
        };
        reader.readAsDataURL(file);
    });

    document.getElementById('clear-image-btn').addEventListener('click', function () {
        fileInput.value          = '';
        previewImg.src           = '';
        previewBox.style.display = 'none';
        // Show existing if it's there, else show dropzone
        const existing = document.getElementById('existing-image');
        if (existing) {
            existing.style.display = 'block';
        } else {
            dropZone.style.display = 'block';
        }
    });

    // Remove existing image button
    const removeExistingBtn = document.getElementById('remove-existing-btn');
    if (removeExistingBtn) {
        removeExistingBtn.addEventListener('click', function () {
            document.getElementById('existing-image').style.display = 'none';
            dropZone.style.display = 'block';
        });
    }

    // Drag and drop
    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('border-primary', 'bg-surface-container-low');
    });
    dropZone.addEventListener('dragleave', () => {
        dropZone.classList.remove('border-primary', 'bg-surface-container-low');
    });
    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('border-primary', 'bg-surface-container-low');
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            fileInput.files = e.dataTransfer.files;
            fileInput.dispatchEvent(new Event('change'));
        }
    });

    // ── Form submit ────────────────────────────────────────────
    document.getElementById('post-form').addEventListener('submit', function (e) {
        const html = editor.getHTML();

        if (!html || html === '<p></p>' || editor.getText().trim() === '') {
            e.preventDefault();
            alert('Please write some content before saving.');
            editor.commands.focus();
            return;
        }

        bodyTextarea.value = html;

        const btn = document.getElementById('submit-btn');
        btn.disabled = true;
        btn.innerHTML = `
            <svg class="animate-spin h-4 w-4" viewBox="0 0 24 24" fill="none">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/>
            </svg>
            Saving...
        `;
    });

});
</script>
</x-app-layout>