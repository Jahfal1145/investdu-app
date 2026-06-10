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

    .open-popup-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.55rem;
        border-radius: 999px;
        border: none;
        background: #38bdf8;
        color: #0f172a;
        padding: 0.85rem 1.1rem;
        cursor: pointer;
        font-family: 'Space Mono', monospace;
        font-size: 0.8rem;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        transition: background-color 0.2s ease;
    }

    .open-popup-btn:hover {
        background: #0ea5e9;
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
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1rem;
    }

    .category-card {
        display: block;
        background-color: #0d1120;
        border: 3px solid #1a1f2e;
        border-radius: 8px;
        padding: 1rem;
        text-decoration: none;
        color: inherit;
        transition: transform 0.15s ease, border-color 0.15s ease, box-shadow 0.15s ease;
        box-shadow: 3px 3px 0 rgba(5, 8, 16, 1);
        cursor: pointer;
        overflow: hidden;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    .category-card:hover {
        transform: translateY(-2px);
        border-color: #3b82f6;
        box-shadow: 5px 5px 0 rgba(5, 8, 16, 1);
    }

    .category-card .card-top {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin: 0.6rem 0;
    }

    .category-card .card-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 1.8rem;
        height: 1.8rem;
        border-radius: 6px;
        background: rgba(37, 99, 235, 0.12);
        color: #60a5fa;
        font-size: 1rem;
    }

    .category-card .card-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.2rem 0.4rem;
        border-radius: 4px;
        border: 1px solid rgba(212, 175, 55, 0.3);
        background: rgba(212, 175, 55, 0.1);
        color: #D4AF37;
        font-size: 0.5rem;
        font-family: 'Space Mono', monospace;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        line-height: 1;
        white-space: nowrap;
    }

    .category-card h3 {
        font-family: 'Space Mono', monospace;
        font-size: 0.85rem;
        font-weight: 700;
        color: #f8fafc;
        margin: 0;
    }

    .category-card p {
        font-family: 'Space Mono', monospace;
        font-size: 0.7rem;
        color: #94a3b8;
        line-height: 1.5;
        margin: 0 0 1rem 0;
    }

    .category-card .card-actions {
        display: flex;
        gap: 0.5rem;
    }

    .category-card .action-button {
        flex: 1;
        display: inline-block;
        background-color: rgba(37, 99, 235, 0.1);
        border: 1px solid #2563eb;
        color: #60a5fa;
        text-align: center;
        padding: 0.4rem 0;
        border-radius: 6px;
        font-family: 'Space Mono', monospace;
        font-size: 0.7rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.15s ease;
        cursor: pointer;
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

<div class="page-header" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; min-height: 40px;">
    <div>
        <h1 style="font-family: 'Press Start 2P', monospace; font-size: 0.8rem; color: #FFD000; letter-spacing: 1px; margin: 0;">📚 KELOLA LITERASI</h1>
    </div>
    <div style="display: flex; gap: 0.85rem; align-items: center;">
        <div class="page-title-block" style="display: inline-flex; align-items: center; gap: 0.5rem; background-color: #0d1120; padding: 0.4rem 0.8rem; border-radius: 6px; border: 2px solid #1a1f2e; font-family: 'Press Start 2P', monospace; font-size: 0.5rem; color: #94a3b8;">
            <span style="font-size: 0.8rem; color: #94a3b8;">{{ $categories->count() }}</span>
            KATEGORI TERSEDIA
        </div>
    </div>
</div>

<div class="categories-grid">
    @foreach($categories as $category)
        <div class="category-card" onclick="openLiterasiEditPopup({{ $category->id }})">
            <h3>{{ $category->name }}</h3>
            <div class="card-top">
                @php $isLucide = preg_match('/^[a-zA-Z-]+$/', $category->icon); @endphp
                <div class="card-icon">
                    @if($isLucide)
                        <i data-lucide="{{ $category->icon }}" style="width: 1.2rem; height: 1.2rem; color: #60a5fa;"></i>
                    @else
                        {{ $category->icon ?? '📘' }}
                    @endif
                </div>
                @if($category->badge)
                    <div class="card-badge">{{ $category->badge }}</div>
                @endif
            </div>
            <p>{{ \Illuminate\Support\Str::limit($category->description, 120) }}</p>
            <div class="card-actions">
                <button type="button" class="action-button" onclick="event.stopPropagation(); openLiterasiEditPopup({{ $category->id }})">Edit Literasi</button>
            </div>
        </div>
    @endforeach
</div>

@include('admin.edit_literasi_popup')

@endsection
