@extends('layouts.admin')

@section('title', 'Kelola Literasi')
@section('page-title', 'kelola literasi')

@section('content')

<style>
    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 1.25rem;
    }

    .page-title-block {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-family: 'Press Start 2P', monospace;
        color: #c9d1d9;
        font-size: 0.85rem;
    }

    .page-title-block span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 2.2rem;
        height: 2.2rem;
        border-radius: 0.85rem;
        background: #0a0e18;
        color: #58a6ff;
        font-size: 1rem;
    }

    .page-subtitle {
        color: #6e7681;
        font-family: 'Space Mono', monospace;
        font-size: 0.75rem;
        margin-top: 0.4rem;
    }

    .flash-success {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.25rem;
        margin-bottom: 1rem;
        background-color: rgba(63, 185, 80, 0.08);
        border: 3px solid rgba(63, 185, 80, 0.3);
        border-radius: 6px;
        font-family: 'Press Start 2P', monospace;
        font-size: 0.45rem;
        color: #3fb950;
        letter-spacing: 1px;
    }

    .categories-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 1rem;
    }

    .category-card {
        display: block;
        background-color: #0d1120;
        border: 4px solid #1a1f2e;
        border-radius: 10px;
        padding: 1.4rem;
        text-decoration: none;
        color: inherit;
        transition: transform 0.15s ease, border-color 0.15s ease, box-shadow 0.15s ease;
        box-shadow: 4px 4px 0 rgba(5, 8, 16, 1);
    }

    .category-card:hover {
        transform: translateY(-2px);
        border-color: #3b82f6;
        box-shadow: 5px 6px 0 rgba(5, 8, 16, 1);
    }

    .category-card .card-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 0.75rem;
        margin-bottom: 1rem;
    }

    .category-card .card-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 2.3rem;
        height: 2.3rem;
        border-radius: 0.95rem;
        background: rgba(37, 99, 235, 0.12);
        color: #60a5fa;
        font-size: 1.1rem;
    }

    .category-card .card-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.4rem 0.85rem;
        border-radius: 999px;
        border: 2px solid rgba(212, 175, 55, 0.2);
        background: rgba(212, 175, 55, 0.08);
        color: #D4AF37;
        font-size: 0.65rem;
        font-family: 'Space Mono', monospace;
        letter-spacing: 0.1em;
        text-transform: uppercase;
    }

    .category-card h3 {
        margin: 0;
        font-size: 1.1rem;
        font-weight: 700;
        letter-spacing: -0.02em;
        color: #f8fafc;
    }

    .category-card p {
        margin: 0.85rem 0 1.15rem;
        color: #c9d1d9;
        font-family: 'Space Mono', monospace;
        font-size: 0.85rem;
        line-height: 1.7;
    }

    .category-card .cta {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.75rem;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        font-weight: 700;
        color: #58a6ff;
    }

    .category-card .cta svg {
        width: 1rem;
        height: 1rem;
    }

    @media (max-width: 1024px) {
        .categories-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 720px) {
        .categories-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

@if(session('success'))
    <div class="flash-success">✅ {{ session('success') }}</div>
@endif

<div class="page-header">
    <div>
        <div class="page-title-block">
            <span>📚</span>
            KELOLA LITERASI
        </div>
        <div class="page-subtitle">Pilih kategori untuk mengubah teks dan deskripsi literasi.</div>
    </div>
    <div class="page-title-block" style="color:#94a3b8;">
        <span>{{ $categories->count() }}</span>
        KATEGORI TERSEDIA
    </div>
</div>

<div class="categories-grid">
    @foreach($categories as $category)
        <a href="/admin/literasi/{{ $category->id }}/edit" class="category-card">
            <div class="card-top">
                <div class="card-icon">{{ $category->icon ?? '📘' }}</div>
                @if($category->badge)
                    <div class="card-badge">{{ $category->badge }}</div>
                @endif
            </div>
            <h3>{{ $category->name }}</h3>
            <p>{{ \Illuminate\Support\Str::limit($category->description, 120) }}</p>
            <div class="cta">
                Edit literasi
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 8H13M9 4L13 8L9 12"/>
                </svg>
            </div>
        </a>
    @endforeach
</div>

@endsection
