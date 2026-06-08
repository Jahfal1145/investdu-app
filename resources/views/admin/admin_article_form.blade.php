@extends('layouts.admin')

@section('title', isset($article) ? 'Edit Artikel' : 'Tambah Artikel')
@section('page-title', isset($article) ? 'edit artikel' : 'tambah artikel')

@section('content')

<style>
    .form-container {
        background-color: #0d1120;
        border: 4px solid #1a1f2e;
        border-radius: 6px;
        box-shadow: 4px 4px 0 #050810;
        overflow: hidden;
        max-width: 800px;
    }

    .form-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 1.25rem;
        background-color: #0a0e18;
        border-bottom: 3px solid #1a1f2e;
    }

    .form-header-title {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-family: 'Press Start 2P', monospace;
        font-size: 0.55rem;
        color: #c9d1d9;
        letter-spacing: 1px;
    }

    .form-header-title-icon {
        font-size: 1rem;
    }

    .form-back-link {
        font-family: 'Space Mono', monospace;
        font-size: 0.7rem;
        font-weight: 700;
        color: #58a6ff;
        text-decoration: none;
        padding: 0.35rem 0.75rem;
        border: 2px solid #1a1f2e;
        transition: all 0.15s ease;
    }

    .form-back-link:hover {
        background-color: rgba(88, 166, 255, 0.08);
        border-color: #58a6ff;
    }

    .form-body {
        padding: 1.5rem 1.25rem;
    }

    .form-category-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        font-family: 'Press Start 2P', monospace;
        font-size: 0.35rem;
        color: #FFD000;
        background-color: rgba(255, 208, 0, 0.08);
        padding: 5px 10px;
        border: 2px solid rgba(255, 208, 0, 0.2);
        margin-bottom: 1.5rem;
        letter-spacing: 1px;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-label {
        display: block;
        font-family: 'Press Start 2P', monospace;
        font-size: 0.4rem;
        color: #6e7681;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 0.5rem;
    }

    .form-input,
    .form-textarea {
        width: 100%;
        padding: 0.65rem 0.9rem;
        background-color: #0a0e18;
        border: 2px solid #1a1f2e;
        color: #c9d1d9;
        font-family: 'Space Mono', monospace;
        font-size: 0.8rem;
        transition: all 0.15s ease;
        outline: none;
    }

    .form-input:focus,
    .form-textarea:focus {
        border-color: #58a6ff;
        box-shadow: 0 0 0 2px rgba(88, 166, 255, 0.1);
    }

    .form-input::placeholder,
    .form-textarea::placeholder {
        color: #484f58;
    }

    .form-textarea {
        min-height: 300px;
        resize: vertical;
        line-height: 1.7;
    }

    .form-textarea-small {
        min-height: 80px;
    }

    .form-help {
        font-family: 'Space Mono', monospace;
        font-size: 0.65rem;
        color: #484f58;
        margin-top: 0.35rem;
    }

    /* File upload */
    .form-file-wrap {
        position: relative;
    }

    .form-file-input {
        width: 100%;
        padding: 0.65rem 0.9rem;
        background-color: #0a0e18;
        border: 2px dashed #1a1f2e;
        color: #c9d1d9;
        font-family: 'Space Mono', monospace;
        font-size: 0.75rem;
        cursor: pointer;
        transition: all 0.15s ease;
    }

    .form-file-input:hover {
        border-color: #58a6ff;
    }

    .current-thumb {
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .current-thumb img {
        width: 80px;
        height: 45px;
        object-fit: cover;
        border: 2px solid #1a1f2e;
    }

    .current-thumb span {
        font-family: 'Space Mono', monospace;
        font-size: 0.7rem;
        color: #6e7681;
    }

    /* Checkbox toggle */
    .form-toggle {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .form-toggle input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: #3fb950;
        cursor: pointer;
    }

    .form-toggle-label {
        font-family: 'Space Mono', monospace;
        font-size: 0.8rem;
        color: #c9d1d9;
        cursor: pointer;
    }

    /* Submit button */
    .form-actions {
        display: flex;
        gap: 0.75rem;
        margin-top: 1.5rem;
        padding-top: 1.25rem;
        border-top: 2px solid #1a1f2e;
    }

    .btn-submit {
        font-family: 'Press Start 2P', monospace;
        font-size: 0.4rem;
        padding: 8px 18px;
        background-color: #3fb950;
        color: #0a0e1a;
        border: 3px solid #0a0e1a;
        cursor: pointer;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.1s ease;
        box-shadow: 3px 3px 0 #0a0e1a;
    }

    .btn-submit:hover {
        transform: translateY(2px);
        box-shadow: 1px 1px 0 #0a0e1a;
    }

    .btn-cancel {
        font-family: 'Press Start 2P', monospace;
        font-size: 0.4rem;
        padding: 8px 18px;
        background-color: #484f58;
        color: #c9d1d9;
        border: 3px solid #0a0e1a;
        cursor: pointer;
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.1s ease;
        box-shadow: 3px 3px 0 #0a0e1a;
        display: inline-flex;
        align-items: center;
    }

    .btn-cancel:hover {
        transform: translateY(2px);
        box-shadow: 1px 1px 0 #0a0e1a;
    }

    /* Validation errors */
    .form-errors {
        padding: 0.75rem 1rem;
        background-color: rgba(248, 81, 73, 0.1);
        border: 2px solid rgba(248, 81, 73, 0.3);
        margin-bottom: 1.25rem;
    }

    .form-errors ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .form-errors li {
        font-family: 'Space Mono', monospace;
        font-size: 0.75rem;
        color: #f85149;
        padding: 0.2rem 0;
    }
</style>

<div class="form-container">
    <div class="form-header">
        <div class="form-header-title">
            <span class="form-header-title-icon">{{ isset($article) ? '✏️' : '➕' }}</span>
            {{ isset($article) ? 'EDIT ARTIKEL' : 'TAMBAH ARTIKEL BARU' }}
        </div>
        <a href="/admin/articles" class="form-back-link">← Kembali</a>
    </div>

    <div class="form-body">
        <div class="form-category-badge">
            📂 KATEGORI: {{ strtoupper($category->name) }}
        </div>

        {{-- Validation errors --}}
        @if($errors->any())
            <div class="form-errors">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>⚠️ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ isset($article) ? '/admin/articles/' . $article->id . '/update' : '/admin/articles/' . $category->id }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @if(isset($article))
                @method('PUT')
            @endif

            <div class="form-group">
                <label class="form-label" for="title">Judul Artikel</label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    class="form-input"
                    placeholder="Masukkan judul artikel..."
                    value="{{ old('title', $article->title ?? '') }}"
                    required
                >
            </div>

            <div class="form-group">
                <label class="form-label" for="excerpt">Excerpt / Ringkasan</label>
                <textarea
                    id="excerpt"
                    name="excerpt"
                    class="form-textarea form-textarea-small"
                    placeholder="Ringkasan singkat untuk ditampilkan di daftar artikel..."
                >{{ old('excerpt', $article->excerpt ?? '') }}</textarea>
                <div class="form-help">Opsional. Jika kosong, akan diambil dari awal body artikel.</div>
            </div>

            <div class="form-group">
                <label class="form-label" for="body">Isi Artikel (HTML)</label>
                <textarea
                    id="body"
                    name="body"
                    class="form-textarea"
                    placeholder="Tulis isi artikel di sini. Mendukung tag HTML seperti <h2>, <p>, <ul>, <strong>, <blockquote>, dll..."
                    required
                >{{ old('body', $article->body ?? '') }}</textarea>
                <div class="form-help">Mendukung HTML: &lt;h2&gt;, &lt;h3&gt;, &lt;p&gt;, &lt;ul&gt;, &lt;ol&gt;, &lt;li&gt;, &lt;strong&gt;, &lt;em&gt;, &lt;blockquote&gt;, &lt;img&gt;</div>
            </div>

            <div class="form-group">
                <label class="form-label" for="thumbnail">Thumbnail</label>
                <div class="form-file-wrap">
                    <input
                        type="file"
                        id="thumbnail"
                        name="thumbnail"
                        class="form-file-input"
                        accept="image/jpeg,image/png,image/webp"
                    >
                </div>
                <div class="form-help">Format: JPG, PNG, WEBP. Maks. 2MB.</div>

                @if(isset($article) && $article->thumbnail)
                    <div class="current-thumb">
                        <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="Current thumbnail">
                        <span>Thumbnail saat ini</span>
                    </div>
                @endif
            </div>

            <div class="form-group">
                <div class="form-toggle">
                    <input
                        type="checkbox"
                        id="is_published"
                        name="is_published"
                        value="1"
                        {{ old('is_published', isset($article) ? $article->is_published : true) ? 'checked' : '' }}
                    >
                    <label for="is_published" class="form-toggle-label">
                        Publikasikan artikel (tampil ke pengguna)
                    </label>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    {{ isset($article) ? '💾 UPDATE ARTIKEL' : '💾 SIMPAN ARTIKEL' }}
                </button>
                <a href="/admin/articles" class="btn-cancel">BATAL</a>
            </div>
        </form>
    </div>
</div>

@endsection
