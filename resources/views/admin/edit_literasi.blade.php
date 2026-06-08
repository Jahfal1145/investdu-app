@extends('layouts.admin')

@section('title', 'Edit Literasi')
@section('page-title', 'kelola literasi / edit')

@section('content')

<style>
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-family: 'Space Mono', monospace;
        font-size: 0.8rem;
        font-weight: 700;
        color: #6e7681;
        text-decoration: none;
        margin-bottom: 1.25rem;
        transition: color 0.15s ease;
    }

    .back-link:hover {
        color: #c9d1d9;
    }

    .edit-card {
        background-color: #0d1120;
        border: 4px solid #1a1f2e;
        border-radius: 6px;
        overflow: hidden;
        box-shadow: 6px 6px 0 #050810;
        max-width: 700px;
    }

    .edit-card-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1.25rem 1.5rem;
        background-color: #0a0e18;
        border-bottom: 3px solid #1a1f2e;
    }

    .edit-card-icon {
        font-size: 1.2rem;
    }

    .edit-card-title-group {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .edit-card-title {
        font-family: 'Press Start 2P', monospace;
        font-size: 0.6rem;
        color: #c9d1d9;
        letter-spacing: 1px;
    }

    .edit-card-subtitle {
        font-family: 'Space Mono', monospace;
        font-size: 0.75rem;
        color: #484f58;
    }

    .edit-card-subtitle strong {
        color: #FFD000;
    }

    .edit-card-body {
        padding: 1.5rem;
    }

    .validation-errors {
        padding: 1rem 1.25rem;
        margin-bottom: 1.25rem;
        background-color: rgba(248, 81, 73, 0.06);
        border: 3px solid rgba(248, 81, 73, 0.25);
        border-radius: 4px;
    }

    .validation-errors-title {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-family: 'Press Start 2P', monospace;
        font-size: 0.4rem;
        color: #f85149;
        letter-spacing: 1px;
        margin-bottom: 0.6rem;
    }

    .validation-errors ul {
        margin: 0;
        padding-left: 1.25rem;
        list-style: none;
    }

    .validation-errors ul li {
        font-family: 'Space Mono', monospace;
        font-size: 0.75rem;
        color: #f85149;
        padding: 0.2rem 0;
        position: relative;
    }

    .validation-errors ul li::before {
        content: '>';
        position: absolute;
        left: -1rem;
        color: #f85149;
        font-weight: 700;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-label {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-family: 'Press Start 2P', monospace;
        font-size: 0.45rem;
        color: #6e7681;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        margin-bottom: 0.5rem;
    }

    .form-label-icon {
        font-size: 0.85rem;
    }

    .form-input,
    .form-textarea {
        width: 100%;
        font-family: 'Space Mono', monospace;
        font-size: 0.85rem;
        color: #c9d1d9;
        background-color: #0a0e18;
        border: 3px solid #1a1f2e;
        border-radius: 4px;
        padding: 0.65rem 0.85rem;
        outline: none;
        transition: border-color 0.15s ease, box-shadow 0.15s ease;
        box-sizing: border-box;
    }

    .form-input:focus,
    .form-textarea:focus {
        border-color: #FFD000;
        box-shadow: 0 0 0 2px rgba(255, 208, 0, 0.15);
    }

    .form-input::placeholder {
        color: #484f58;
        font-size: 0.75rem;
    }

    .form-textarea {
        min-height: 140px;
        resize: vertical;
    }

    .form-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        margin-top: 1.75rem;
    }

    .btn-retro {
        font-family: 'Press Start 2P', monospace;
        font-size: 0.4rem;
        padding: 8px 16px;
        border: 3px solid #0a0e1a;
        cursor: pointer;
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.1s ease;
        box-shadow: 3px 3px 0 #0a0e1a;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }

    .btn-retro:hover {
        transform: translateY(2px);
        box-shadow: 1px 1px 0 #0a0e1a;
    }

    .btn-retro--cancel {
        background-color: #2d333b;
        color: #c9d1d9;
    }

    .btn-retro--save {
        background-color: #FFD000;
        color: #0a0e1a;
    }

    @media (max-width: 640px) {
        .edit-card {
            max-width: 100%;
        }

        .form-actions {
            flex-direction: column-reverse;
        }

        .btn-retro {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<a href="/admin/literasi" class="back-link">← Kembali ke Kelola Literasi</a>

<div class="edit-card">
    <div class="edit-card-header">
        <span class="edit-card-icon">✏️</span>
        <div class="edit-card-title-group">
            <div class="edit-card-title">EDIT KATEGORI LITERASI</div>
            <div class="edit-card-subtitle">Mengubah konten untuk: <strong>{{ $category->name }}</strong></div>
        </div>
    </div>

    <div class="edit-card-body">
        @if($errors->any())
            <div class="validation-errors">
                <div class="validation-errors-title">⚠️ VALIDATION ERROR</div>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/admin/literasi/{{ $category->id }}/update" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="inputName" class="form-label">
                    <span class="form-label-icon">📌</span>
                    Nama Kategori
                </label>
                <input type="text" name="name" id="inputName" class="form-input" value="{{ old('name', $category->name) }}" required>
            </div>

            <div class="form-group">
                <label for="inputDescription" class="form-label">
                    <span class="form-label-icon">📝</span>
                    Deskripsi Literasi
                </label>
                <textarea name="description" id="inputDescription" class="form-textarea" required>{{ old('description', $category->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="inputBadge" class="form-label">
                    <span class="form-label-icon">🏷️</span>
                    Badge
                </label>
                <input type="text" name="badge" id="inputBadge" class="form-input" value="{{ old('badge', $category->badge) }}" placeholder="Contoh: Populer, Stabil, Risiko Rendah">
            </div>

            <div class="form-group">
                <label for="inputIcon" class="form-label">
                    <span class="form-label-icon">📎</span>
                    Nama Ikon
                </label>
                <input type="text" name="icon" id="inputIcon" class="form-input" value="{{ old('icon', $category->icon) }}" placeholder="Contoh: trending-up, piggy-bank">
                <div class="form-hint">Nama ikon hanya untuk label internal dan tampilan kecil.</div>
            </div>

            <div class="form-actions">
                <a href="/admin/literasi" class="btn-retro btn-retro--cancel">🚫 Batal</a>
                <button type="submit" class="btn-retro btn-retro--save">💾 Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

@endsection
