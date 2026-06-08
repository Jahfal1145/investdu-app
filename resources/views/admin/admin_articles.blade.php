@extends('layouts.admin')

@section('title', 'Kelola Artikel')
@section('page-title', 'kelola artikel')

@section('content')

<style>
    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
    }

    .page-header h1 {
        font-family: 'Press Start 2P', monospace;
        font-size: 0.8rem;
        color: #FFD000;
        letter-spacing: 1px;
    }

    .page-header p {
        font-family: 'Space Mono', monospace;
        font-size: 0.8rem;
        color: #6e7681;
        margin-top: 0.35rem;
    }

    /* Success/Error messages */
    .alert-success {
        padding: 0.75rem 1rem;
        background-color: rgba(63, 185, 80, 0.1);
        border: 2px solid rgba(63, 185, 80, 0.3);
        color: #3fb950;
        font-family: 'Space Mono', monospace;
        font-size: 0.8rem;
        margin-bottom: 1.5rem;
    }

    /* Category Accordion */
    .category-block {
        background-color: #0d1120;
        border: 4px solid #1a1f2e;
        border-radius: 6px;
        margin-bottom: 1rem;
        box-shadow: 4px 4px 0 #050810;
        overflow: hidden;
    }

    .category-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 1.25rem;
        background-color: #0a0e18;
        border-bottom: 3px solid #1a1f2e;
        cursor: pointer;
        transition: background-color 0.15s ease;
    }

    .category-header:hover {
        background-color: #0f1424;
    }

    .category-header-left {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .category-header-icon {
        font-size: 1.2rem;
    }

    .category-header-title {
        font-family: 'Press Start 2P', monospace;
        font-size: 0.5rem;
        color: #c9d1d9;
        letter-spacing: 1px;
    }

    .category-header-count {
        font-family: 'Press Start 2P', monospace;
        font-size: 0.4rem;
        color: #0a0e1a;
        background-color: #58a6ff;
        padding: 3px 8px;
        border: 2px solid #0a0e1a;
        letter-spacing: 1px;
    }

    .category-header-right {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .category-header-arrow {
        color: #6e7681;
        font-size: 0.8rem;
        transition: transform 0.2s ease;
    }

    .category-block.open .category-header-arrow {
        transform: rotate(180deg);
    }

    .category-body {
        display: none;
        padding: 1rem 1.25rem;
    }

    .category-block.open .category-body {
        display: block;
    }

    /* Add article button */
    .btn-add-article {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-family: 'Press Start 2P', monospace;
        font-size: 0.35rem;
        padding: 6px 12px;
        background-color: #3fb950;
        color: #0a0e1a;
        border: 3px solid #0a0e1a;
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.1s ease;
        box-shadow: 2px 2px 0 #0a0e1a;
    }

    .btn-add-article:hover {
        transform: translateY(2px);
        box-shadow: 0 0 0 #0a0e1a;
    }

    /* Article table */
    .article-table {
        width: 100%;
        border-collapse: collapse;
        font-family: 'Space Mono', monospace;
        margin-top: 1rem;
    }

    .article-table thead th {
        font-family: 'Press Start 2P', monospace;
        font-size: 0.35rem;
        color: #6e7681;
        text-transform: uppercase;
        letter-spacing: 2px;
        padding: 0.6rem 0.75rem;
        background-color: #111628;
        border-bottom: 2px solid #1a1f2e;
        text-align: left;
    }

    .article-table tbody td {
        font-size: 0.78rem;
        padding: 0.65rem 0.75rem;
        border-bottom: 1px solid #141a2a;
        color: #c9d1d9;
        vertical-align: middle;
    }

    .article-table tbody tr:hover {
        background-color: rgba(255, 255, 255, 0.02);
    }

    .article-table tbody tr:last-child td {
        border-bottom: none;
    }

    .article-title-cell {
        font-weight: 700;
        color: #c9d1d9;
        max-width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .article-excerpt-cell {
        color: #6e7681;
        font-size: 0.72rem;
        max-width: 250px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .article-date-cell {
        color: #484f58;
        font-size: 0.72rem;
        white-space: nowrap;
    }

    .badge-published {
        display: inline-block;
        font-family: 'Press Start 2P', monospace;
        font-size: 0.3rem;
        color: #0a0e1a;
        background-color: #3fb950;
        padding: 3px 7px;
        border: 2px solid #0a0e1a;
        letter-spacing: 1px;
    }

    .badge-draft {
        display: inline-block;
        font-family: 'Press Start 2P', monospace;
        font-size: 0.3rem;
        color: #f0883e;
        background-color: rgba(240, 136, 62, 0.15);
        padding: 3px 7px;
        border: 2px solid rgba(240, 136, 62, 0.3);
        letter-spacing: 1px;
    }

    .cell-actions {
        display: flex;
        gap: 0.5rem;
    }

    .btn-retro {
        font-family: 'Press Start 2P', monospace;
        font-size: 0.3rem;
        padding: 4px 8px;
        border: 3px solid #0a0e1a;
        cursor: pointer;
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.1s ease;
        box-shadow: 2px 2px 0 #0a0e1a;
        display: inline-block;
    }

    .btn-retro:hover {
        transform: translateY(2px);
        box-shadow: 0 0 0 #0a0e1a;
    }

    .btn-retro--edit {
        background-color: #3fb950;
        color: #0a0e1a;
    }

    .btn-retro--delete {
        background-color: #f85149;
        color: #ffffff;
    }

    .btn-retro--view {
        background-color: #58a6ff;
        color: #0a0e1a;
    }

    .empty-articles {
        text-align: center;
        padding: 1.5rem;
        color: #484f58;
        font-family: 'Space Mono', monospace;
        font-size: 0.8rem;
    }
</style>

{{-- Success message --}}
@if(session('success'))
    <div class="alert-success">✅ {{ session('success') }}</div>
@endif

{{-- Page header --}}
<div class="page-header">
    <div>
        <h1>📝 KELOLA ARTIKEL</h1>
        <p>Tambah, edit, dan kelola artikel edukasi per kategori investasi.</p>
    </div>
</div>

{{-- Category Accordions --}}
@foreach($categories as $category)
    <div class="category-block {{ $loop->first ? 'open' : '' }}" id="cat-block-{{ $category->id }}">
        <div class="category-header" onclick="toggleCategory({{ $category->id }})">
            <div class="category-header-left">
                <span class="category-header-icon">📂</span>
                <span class="category-header-title">{{ strtoupper($category->name) }}</span>
                <span class="category-header-count">{{ $category->articles->count() }} ARTIKEL</span>
            </div>
            <div class="category-header-right">
                <a href="/admin/articles/{{ $category->id }}/create" class="btn-add-article" onclick="event.stopPropagation();">
                    ➕ TAMBAH ARTIKEL
                </a>
                <span class="category-header-arrow">▼</span>
            </div>
        </div>
        <div class="category-body">
            @if($category->articles->count() > 0)
                <table class="article-table">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Excerpt</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($category->articles as $article)
                            <tr>
                                <td class="article-title-cell">{{ $article->title }}</td>
                                <td class="article-excerpt-cell">{{ $article->excerpt ?? Str::limit(strip_tags($article->body), 60) }}</td>
                                <td>
                                    @if($article->is_published)
                                        <span class="badge-published">PUBLISHED</span>
                                    @else
                                        <span class="badge-draft">DRAFT</span>
                                    @endif
                                </td>
                                <td class="article-date-cell">{{ $article->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="cell-actions">
                                        <a href="/belajar/{{ $category->slug }}/{{ $article->slug }}" class="btn-retro btn-retro--view" target="_blank">VIEW</a>
                                        <a href="/admin/articles/{{ $article->id }}/edit" class="btn-retro btn-retro--edit">EDIT</a>
                                        <form action="/admin/articles/{{ $article->id }}/delete" method="POST" style="margin:0;" onsubmit="return confirm('Yakin mau hapus artikel \'{{ addslashes($article->title) }}\'?');">
                                            @csrf
                                            <button type="submit" class="btn-retro btn-retro--delete">DEL</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-articles">
                    Belum ada artikel untuk kategori ini. Klik "Tambah Artikel" untuk memulai.
                </div>
            @endif
        </div>
    </div>
@endforeach

<script>
    function toggleCategory(id) {
        const block = document.getElementById('cat-block-' + id);
        block.classList.toggle('open');
    }
</script>

@endsection
