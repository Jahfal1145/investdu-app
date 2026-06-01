@extends('layouts.admin')

@section('title', 'Edit User')
@section('page-title', 'kelola user / edit')

@section('content')

<style>
    /* ===== EDIT USER PAGE STYLES ===== */

    /* Back link */
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

    /* Form card */
    .edit-card {
        background-color: #0d1120;
        border: 4px solid #1a1f2e;
        border-radius: 6px;
        overflow: hidden;
        box-shadow: 6px 6px 0 #050810;
        max-width: 580px;
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

    /* Validation errors */
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

    /* Form groups */
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
    .form-select {
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
    .form-select:focus {
        border-color: #FFD000;
        box-shadow: 0 0 0 2px rgba(255, 208, 0, 0.15);
    }

    .form-input::placeholder {
        color: #484f58;
        font-size: 0.75rem;
    }

    .form-select {
        cursor: pointer;
        appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%236e7681' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        padding-right: 2.5rem;
    }

    .form-select option {
        background-color: #0a0e18;
        color: #c9d1d9;
        font-family: 'Space Mono', monospace;
    }

    .form-hint {
        font-family: 'Space Mono', monospace;
        font-size: 0.65rem;
        color: #484f58;
        margin-top: 0.35rem;
    }

    /* Divider line */
    .form-divider {
        border: none;
        border-top: 2px dashed #1a1f2e;
        margin: 1.5rem 0;
    }

    /* Action buttons row */
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

    .btn-retro:active {
        transform: translateY(3px);
        box-shadow: 0 0 0 #0a0e1a;
    }

    .btn-retro--cancel {
        background-color: #2d333b;
        color: #c9d1d9;
    }

    .btn-retro--save {
        background-color: #FFD000;
        color: #0a0e1a;
    }

    /* Status option indicator */
    .status-indicator {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 0.4rem;
    }

    .status-dot {
        width: 8px;
        height: 8px;
        border: 2px solid #0a0e1a;
    }

    .status-dot--admin {
        background-color: #FFD000;
    }

    .status-dot--user {
        background-color: #58a6ff;
    }

    .status-label {
        font-family: 'Press Start 2P', monospace;
        font-size: 0.35rem;
        letter-spacing: 1px;
    }

    .status-label--admin {
        color: #FFD000;
    }

    .status-label--user {
        color: #58a6ff;
    }

    /* Responsive */
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

{{-- Back navigation --}}
<a href="/admin/users" class="back-link" id="backToUsers">
    ← Kembali ke Kelola User
</a>

{{-- Edit Form Card --}}
<div class="edit-card">

    {{-- Card Header --}}
    <div class="edit-card-header">
        <span class="edit-card-icon">✏️</span>
        <div class="edit-card-title-group">
            <div class="edit-card-title">EDIT DATA USER</div>
            <div class="edit-card-subtitle">Mengedit data untuk: <strong>{{ $user->username }}</strong></div>
        </div>
    </div>

    {{-- Card Body --}}
    <div class="edit-card-body">

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="validation-errors">
                <div class="validation-errors-title">
                    ⚠️ VALIDATION ERROR
                </div>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form action="/admin/users/{{ $user->id }}/update" method="POST" id="formEditUser">
            @csrf
            @method('PUT')

            {{-- Username --}}
            <div class="form-group">
                <label for="inputUsername" class="form-label">
                    <span class="form-label-icon">👤</span>
                    USERNAME
                </label>
                <input
                    type="text"
                    name="username"
                    id="inputUsername"
                    class="form-input"
                    value="{{ old('username', $user->username) }}"
                    required
                    autocomplete="off"
                >
            </div>

            {{-- Email --}}
            <div class="form-group">
                <label for="inputEmail" class="form-label">
                    <span class="form-label-icon">📧</span>
                    EMAIL
                </label>
                <input
                    type="email"
                    name="email"
                    id="inputEmail"
                    class="form-input"
                    value="{{ old('email', $user->email) }}"
                    required
                    autocomplete="off"
                >
            </div>

            <hr class="form-divider">

            {{-- Password --}}
            <div class="form-group">
                <label for="inputPassword" class="form-label">
                    <span class="form-label-icon">🔑</span>
                    GANTI PASSWORD
                </label>
                <input
                    type="text"
                    name="password"
                    id="inputPassword"
                    class="form-input"
                    placeholder="Kosongkan jika tidak ingin ganti..."
                    autocomplete="new-password"
                >
                <div class="form-hint">* Biarkan kosong agar password lama tetap digunakan.</div>
            </div>

            {{-- Status Akun --}}
            <div class="form-group">
                <label for="selectStatus" class="form-label">
                    <span class="form-label-icon">🛡️</span>
                    STATUS AKUN
                </label>
                <select name="is_admin" id="selectStatus" class="form-select">
                    <option value="0" {{ $user->is_admin == 0 ? 'selected' : '' }}>User Biasa</option>
                    <option value="1" {{ $user->is_admin == 1 ? 'selected' : '' }}>Admin</option>
                </select>
                <div class="status-indicator" id="statusIndicator">
                    @if($user->is_admin)
                        <span class="status-dot status-dot--admin"></span>
                        <span class="status-label status-label--admin">ADMIN AKTIF</span>
                    @else
                        <span class="status-dot status-dot--user"></span>
                        <span class="status-label status-label--user">USER BIASA</span>
                    @endif
                </div>
            </div>

            <hr class="form-divider">

            {{-- Action Buttons --}}
            <div class="form-actions">
                <a href="/admin/users" class="btn-retro btn-retro--cancel" id="btnCancel">
                    🚫 BATAL
                </a>
                <button type="submit" class="btn-retro btn-retro--save" id="btnSave">
                    💾 SIMPAN PERUBAHAN
                </button>
            </div>

        </form>
    </div>
</div>

{{-- Dynamic status indicator update --}}
<script>
    document.getElementById('selectStatus').addEventListener('change', function() {
        const indicator = document.getElementById('statusIndicator');
        if (this.value === '1') {
            indicator.innerHTML = '<span class="status-dot status-dot--admin"></span><span class="status-label status-label--admin">ADMIN AKTIF</span>';
        } else {
            indicator.innerHTML = '<span class="status-dot status-dot--user"></span><span class="status-label status-label--user">USER BIASA</span>';
        }
    });
</script>

@endsection