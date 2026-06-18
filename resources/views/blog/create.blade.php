<x-app-layout>
    <x-slot name="title">Create New Post - MyBlog</x-slot>

    <style>
        #editor-area {
            min-height: 480px;
            padding: 2rem;
            font-size: 18px;
            line-height: 1.8;
            color: #151c27;
            font-family: 'Inter', sans-serif;
            background: #ffffff;
            border: 1px solid #e4beba;
            border-top: none;
            border-radius: 0 0 0.75rem 0.75rem;
            outline: none;
            cursor: text;
            width: 100%;
            box-sizing: border-box;
        }

        #editor-area:empty:before {
            content: 'Start writing your story here...';
            color: #9ca3af;
            pointer-events: none;
        }

        #editor-area h2 {
            font-size: 1.75rem;
            font-weight: 700;
            margin: 1.5rem 0 0.75rem;
            color: #151c27;
        }

        #editor-area h3 {
            font-size: 1.35rem;
            font-weight: 600;
            margin: 1.25rem 0 0.5rem;
            color: #151c27;
        }

        #editor-area p {
            margin-bottom: 1rem;
        }

        #editor-area ul {
            list-style: disc;
            padding-left: 2rem;
            margin-bottom: 1rem;
        }

        #editor-area ol {
            list-style: decimal;
            padding-left: 2rem;
            margin-bottom: 1rem;
        }

        #editor-area li {
            margin-bottom: 0.3rem;
        }

        #editor-area blockquote {
            border-left: 4px solid #b61722;
            padding: 0.5rem 1rem;
            margin: 1rem 0;
            color: #575e70;
            font-style: italic;
            background: #f0f3ff;
            border-radius: 0 0.5rem 0.5rem 0;
        }

        #editor-area strong {
            font-weight: 700;
        }

        #editor-area em {
            font-style: italic;
        }

        #editor-area u {
            text-decoration: underline;
        }

        .tbtn {
            padding: 6px 10px;
            border: none;
            background: transparent;
            border-radius: 6px;
            cursor: pointer;
            color: #575e70;
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            transition: all 0.15s;
        }

        .tbtn:hover {
            background: #dce2f3;
            color: #151c27;
        }

        .tbtn.on {
            background: #b61722;
            color: #fff;
        }

        .tsep {
            width: 1px;
            background: #e4beba;
            margin: 4px 6px;
        }
    </style>

    <div class="w-full px-gutter py-section-gap">
        <div class="max-w-article-max mx-auto">

            <div class="mb-8">
                <h1 class="font-display-lg text-display-lg text-on-surface">Create New Post</h1>
                <p class="font-interface-body text-interface-body text-secondary mt-2">
                    Draft your thoughts and share them with your readers.
                </p>
            </div>

            @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6 text-sm space-y-1">
                @foreach($errors->all() as $error)
                <p>⚠ {{ $error }}</p>
                @endforeach
            </div>
            @endif

            <form method="POST" action="/posts" enctype="multipart/form-data" id="post-form">
                @csrf

                {{-- TITLE --}}
                <div class="mb-8">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Title</label>
                    <input
                        type="text"
                        name="title"
                        value="{{ old('title') }}"
                        placeholder="Enter a captivating title..."
                        class="w-full bg-transparent border-0 border-b-2 border-gray-200 focus:border-red-500 focus:ring-0 px-0 py-2 text-3xl font-bold text-gray-900 placeholder:text-gray-300 placeholder:font-normal transition-colors" />
                </div>

                {{-- COVER IMAGE --}}
                <div class="mb-8">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Cover Image</label>

                    <div id="drop-zone"
                        class="border-2 border-dashed border-gray-300 rounded-xl p-10 text-center cursor-pointer hover:border-red-400 hover:bg-red-50 transition-all duration-200">
                        <span class="material-symbols-outlined text-5xl text-gray-400 block mb-2">add_photo_alternate</span>
                        <p class="text-gray-500 font-medium">Click or drag to upload cover image</p>
                        <p class="text-gray-400 text-sm mt-1">JPG, PNG, WEBP — max 2MB</p>
                    </div>
                    <input type="file" name="cover_image" id="cover_image" accept="image/*" class="hidden" />

                    <div id="image-preview" style="display:none;" class="relative rounded-xl overflow-hidden mt-2">
                        <img id="preview-img" src="" alt="Preview" class="w-full h-64 object-cover rounded-xl" />
                        <button type="button" id="clear-image-btn"
                            class="absolute top-3 right-3 bg-white rounded-full p-1.5 shadow-md hover:bg-red-50">
                            <span class="material-symbols-outlined text-red-500" style="font-size:18px;">close</span>
                        </button>
                    </div>
                </div>

                {{-- RICH TEXT EDITOR --}}
                <div class="mb-8">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Content</label>

                    {{-- Toolbar --}}
                    <div class="flex flex-wrap items-center gap-1 px-3 py-2 bg-gray-50 border border-gray-200 rounded-t-xl" style="border-bottom:none;">
                        <button type="button" class="tbtn" id="btn-h2">H2</button>
                        <button type="button" class="tbtn" id="btn-h3">H3</button>
                        <div class="tsep"></div>
                        <button type="button" class="tbtn" id="btn-bold"><b>B</b></button>
                        <button type="button" class="tbtn" id="btn-italic"><i>I</i></button>
                        <button type="button" class="tbtn" id="btn-underline"><u>U</u></button>
                        <div class="tsep"></div>
                        <button type="button" class="tbtn" id="btn-bullet">
                            <span class="material-symbols-outlined" style="font-size:18px;">format_list_bulleted</span>
                        </button>
                        <button type="button" class="tbtn" id="btn-ordered">
                            <span class="material-symbols-outlined" style="font-size:18px;">format_list_numbered</span>
                        </button>
                        <button type="button" class="tbtn" id="btn-quote">
                            <span class="material-symbols-outlined" style="font-size:18px;">format_quote</span>
                        </button>
                        <div class="tsep"></div>
                        <button type="button" class="tbtn" id="btn-undo">
                            <span class="material-symbols-outlined" style="font-size:18px;">undo</span>
                        </button>
                        <button type="button" class="tbtn" id="btn-redo">
                            <span class="material-symbols-outlined" style="font-size:18px;">redo</span>
                        </button>
                    </div>

                    {{-- The actual editor --}}
                    <div id="editor-area" contenteditable="true"></div>

                    {{-- Hidden textarea for form submission --}}
                    <input type="hidden" name="body" id="body-input" value="{{ old('body') }}" />

                    <div class="flex justify-end mt-1">
                        <span id="word-count" class="text-xs text-gray-400">0 words</span>
                    </div>
                </div>

                {{-- OPTIONS --}}
                <div class="flex flex-col sm:flex-row gap-6 justify-between items-start sm:items-center p-5 bg-gray-50 rounded-xl border border-gray-200 mb-8">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Status</label>
                        <select name="status"
                            class="border border-gray-300 rounded-lg px-3 py-2 text-gray-700 text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500">
                            <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>📝 Draft</option>
                            <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>🌍 Published</option>
                        </select>
                    </div>
                    <div class="flex items-center gap-3">
                        <input type="checkbox" name="is_premium" id="is_premium"
                            {{ old('is_premium') ? 'checked' : '' }}
                            class="w-5 h-5 rounded text-red-600 border-gray-300 focus:ring-red-500 cursor-pointer" />
                        <div>
                            <label for="is_premium" class="font-semibold text-gray-800 flex items-center gap-1 cursor-pointer">
                                Premium Content
                                <span class="material-symbols-outlined text-yellow-600" style="font-size:16px; font-variation-settings:'FILL' 1;">star</span>
                            </label>
                            <span class="text-xs text-gray-500">Restrict to subscribers only</span>
                        </div>
                    </div>
                </div>

                {{-- ACTIONS --}}
                <div class="flex justify-end gap-4 pt-6 border-t border-gray-200">
                    <a href="/blog"
                        class="px-6 py-3 rounded-lg border border-gray-300 text-gray-600 text-sm font-semibold hover:bg-gray-100 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" id="submit-btn"
                        class="px-8 py-3 rounded-lg bg-red-600 text-white text-sm font-semibold hover:bg-red-700 shadow-sm transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined" style="font-size:18px;">publish</span>
                        Save Post
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const editor = document.getElementById('editor-area');
            const bodyInput = document.getElementById('body-input');
            const wordCount = document.getElementById('word-count');
            const form = document.getElementById('post-form');

            // Load old value if validation failed
            if (bodyInput.value) {
                editor.innerHTML = bodyInput.value;
            }

            // Sync editor → hidden input on every keystroke
            editor.addEventListener('input', function() {
                bodyInput.value = editor.innerHTML;
                const words = editor.innerText.trim().split(/\s+/).filter(w => w).length;
                wordCount.textContent = words + ' words · ' + Math.max(1, Math.round(words / 200)) + ' min read';
                updateToolbar();
            });

            editor.addEventListener('keyup', updateToolbar);
            editor.addEventListener('mouseup', updateToolbar);

            // ── Toolbar ────────────────────────────────────────────────
            function cmd(command, value) {
                editor.focus();
                document.execCommand(command, false, value || null);
                bodyInput.value = editor.innerHTML;
                updateToolbar();
            }

            function updateToolbar() {
                setActive('btn-bold', document.queryCommandState('bold'));
                setActive('btn-italic', document.queryCommandState('italic'));
                setActive('btn-underline', document.queryCommandState('underline'));
                setActive('btn-h2', isTag('H2'));
                setActive('btn-h3', isTag('H3'));
                setActive('btn-bullet', document.queryCommandState('insertUnorderedList'));
                setActive('btn-ordered', document.queryCommandState('insertOrderedList'));
                setActive('btn-quote', isTag('BLOCKQUOTE'));
            }

            function setActive(id, on) {
                const el = document.getElementById(id);
                if (el) el.classList.toggle('on', on);
            }

            function isTag(tag) {
                const sel = window.getSelection();
                if (!sel || !sel.rangeCount) return false;
                let node = sel.getRangeAt(0).startContainer;
                while (node && node !== editor) {
                    if (node.nodeType === 1 && node.tagName === tag) return true;
                    node = node.parentNode;
                }
                return false;
            }

            function formatBlock(tag) {
                editor.focus();
                document.execCommand('formatBlock', false, isTag(tag.toUpperCase()) ? 'p' : tag);
                bodyInput.value = editor.innerHTML;
                updateToolbar();
            }

            document.getElementById('btn-h2').onclick = () => formatBlock('h2');
            document.getElementById('btn-h3').onclick = () => formatBlock('h3');
            document.getElementById('btn-bold').onclick = () => cmd('bold');
            document.getElementById('btn-italic').onclick = () => cmd('italic');
            document.getElementById('btn-underline').onclick = () => cmd('underline');
            document.getElementById('btn-bullet').onclick = () => cmd('insertUnorderedList');
            document.getElementById('btn-ordered').onclick = () => cmd('insertOrderedList');
            document.getElementById('btn-quote').onclick = () => formatBlock('blockquote');
            document.getElementById('btn-undo').onclick = () => cmd('undo');
            document.getElementById('btn-redo').onclick = () => cmd('redo');

            // ── Image upload ───────────────────────────────────────────
            const dropZone = document.getElementById('drop-zone');
            const fileInput = document.getElementById('cover_image');
            const previewBox = document.getElementById('image-preview');
            const previewImg = document.getElementById('preview-img');

            dropZone.addEventListener('click', () => fileInput.click());

            fileInput.addEventListener('change', function() {
                const file = this.files[0];
                if (!file) return;
                if (file.size > 2097152) {
                    alert('Max 2MB');
                    this.value = '';
                    return;
                }
                const reader = new FileReader();
                reader.onload = e => {
                    previewImg.src = e.target.result;
                    previewBox.style.display = 'block';
                    dropZone.style.display = 'none';
                };
                reader.readAsDataURL(file);
            });

            document.getElementById('clear-image-btn').addEventListener('click', function() {
                fileInput.value = '';
                previewImg.src = '';
                previewBox.style.display = 'none';
                dropZone.style.display = 'block';
            });

            dropZone.addEventListener('dragover', e => {
                e.preventDefault();
                dropZone.style.borderColor = '#b61722';
            });
            dropZone.addEventListener('dragleave', () => {
                dropZone.style.borderColor = '';
            });
            dropZone.addEventListener('drop', e => {
                e.preventDefault();
                dropZone.style.borderColor = '';
                const file = e.dataTransfer.files[0];
                if (file && file.type.startsWith('image/')) {
                    fileInput.files = e.dataTransfer.files;
                    fileInput.dispatchEvent(new Event('change'));
                }
            });

            // ── Submit ─────────────────────────────────────────────────
            form.addEventListener('submit', function(e) {
                bodyInput.value = editor.innerHTML;

                if (!editor.innerText.trim()) {
                    e.preventDefault();
                    alert('Please write some content.');
                    editor.focus();
                    return;
                }

                const btn = document.getElementById('submit-btn');
                btn.disabled = true;
                btn.textContent = 'Saving...';
            });

        });
    </script>
</x-app-layout>