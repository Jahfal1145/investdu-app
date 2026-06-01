@extends('layouts.admin')

@section('title', 'Kelola User')
@section('page-title', 'kelola user')

@section('content')

<style>
    /* ===== KELOLA USER PAGE STYLES ===== */

    /* Search bar */
    .search-bar {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
        padding: 1rem 1.25rem;
        background-color: #0d1120;
        border: 3px solid #1a1f2e;
        border-radius: 6px;
        box-shadow: 4px 4px 0 #050810;
    }

    .search-bar-icon {
        font-size: 1rem;
        flex-shrink: 0;
    }

    .search-input {
        flex: 1;
        font-family: 'Space Mono', monospace;
        font-size: 0.85rem;
        color: #c9d1d9;
        background: transparent;
        border: none;
        outline: none;
        padding: 0.4rem;
    }

    .search-input::placeholder {
        color: #484f58;
    }

    .search-btn {
        font-family: 'Press Start 2P', monospace;
        font-size: 0.4rem;
        color: #0a0e1a;
        background-color: #FFD000;
        border: 3px solid #0a0e1a;
        padding: 6px 14px;
        cursor: pointer;
        letter-spacing: 1px;
        transition: all 0.1s ease;
        box-shadow: 2px 2px 0 #0a0e1a;
    }

    .search-btn:hover {
        transform: translateY(2px);
        box-shadow: 0 0 0 #0a0e1a;
    }

    /* Flash messages */
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

    /* Table styles (reusing from dashboard) */
    .table-container {
        background-color: #0d1120;
        border: 4px solid #1a1f2e;
        border-radius: 6px;
        overflow: hidden;
        box-shadow: 4px 4px 0 #050810;
    }

    .table-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 1.25rem;
        background-color: #0a0e18;
        border-bottom: 3px solid #1a1f2e;
    }

    .table-title {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-family: 'Press Start 2P', monospace;
        font-size: 0.55rem;
        color: #c9d1d9;
        letter-spacing: 1px;
    }

    .retro-table {
        width: 100%;
        border-collapse: collapse;
        font-family: 'Space Mono', monospace;
    }

    .retro-table thead th {
        font-family: 'Press Start 2P', monospace;
        font-size: 0.4rem;
        color: #6e7681;
        text-transform: uppercase;
        letter-spacing: 2px;
        padding: 0.75rem 1rem;
        background-color: #111628;
        border-bottom: 3px solid #1a1f2e;
        text-align: left;
    }

    .retro-table tbody td {
        font-size: 0.8rem;
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #141a2a;
        color: #c9d1d9;
        vertical-align: middle;
    }

    .retro-table tbody tr {
        transition: background-color 0.1s ease;
    }

    .retro-table tbody tr:hover {
        background-color: rgba(255, 255, 255, 0.02);
    }

    .retro-table tbody tr:last-child td {
        border-bottom: none;
    }

    .cell-id {
        font-family: 'Press Start 2P', monospace;
        font-size: 0.5rem;
        color: #484f58;
    }

    .cell-username {
        font-weight: 700;
        color: #c9d1d9;
    }

    .cell-email {
        color: #6e7681;
        font-size: 0.75rem;
    }

    .badge-admin {
        display: inline-block;
        font-family: 'Press Start 2P', monospace;
        font-size: 0.35rem;
        color: #0a0e1a;
        background-color: #FFD000;
        padding: 3px 8px;
        border: 2px solid #0a0e1a;
        letter-spacing: 1px;
    }

    .badge-user {
        display: inline-block;
        font-family: 'Press Start 2P', monospace;
        font-size: 0.35rem;
        color: #58a6ff;
        background-color: rgba(88, 166, 255, 0.1);
        padding: 3px 8px;
        border: 2px solid rgba(88, 166, 255, 0.3);
        letter-spacing: 1px;
    }

    .cell-actions {
        display: flex;
        gap: 0.5rem;
    }

    .btn-retro {
        font-family: 'Press Start 2P', monospace;
        font-size: 0.35rem;
        padding: 5px 10px;
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

    .table-empty {
        text-align: center;
        padding: 2rem;
        color: #484f58;
        font-family: 'Space Mono', monospace;
        font-size: 0.8rem;
    }

    .user-count-label {
        font-family: 'Space Mono', monospace;
        font-size: 0.7rem;
        color: #484f58;
    }

    .user-count-num {
        font-family: 'Press Start 2P', monospace;
        font-size: 0.5rem;
        color: #FFD000;
    }
</style>

{{-- Flash Success --}}
@if(session('success'))
    <div class="flash-success">✅ {{ session('success') }}</div>
@endif

{{-- Search Bar --}}
<form action="/admin/users" method="GET" class="search-bar">
    <span class="search-bar-icon">🔍</span>
    <input type="text" name="search" class="search-input" placeholder="Cari username atau email..." value="{{ request('search') }}" id="searchInput">
    <button type="submit" class="search-btn">CARI</button>
</form>

{{-- User Table --}}
<div class="table-container">
    <div class="table-header">
        <div class="table-title">
            <span>👥</span>
            SEMUA PENGGUNA
        </div>
        <div>
            <span class="user-count-label">Total: </span>
            <span class="user-count-num">{{ $users->count() }}</span>
        </div>
    </div>

    <div style="overflow-x: auto;">
        <table class="retro-table" id="tableAllUsers">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td class="cell-id">#{{ $user->id }}</td>
                    <td class="cell-username">{{ $user->username }}</td>
                    <td class="cell-email">{{ $user->email }}</td>
                    <td>
                        @if($user->is_admin)
                            <span class="badge-admin">ADMIN</span>
                        @else
                            <span class="badge-user">USER</span>
                        @endif
                    </td>
                    <td>
                        <div class="cell-actions">
                            <a href="/admin/users/{{ $user->id }}/edit" class="btn-retro btn-retro--edit">EDIT</a>
                            <form action="/admin/users/{{ $user->id }}/delete" method="POST" style="margin:0;" onsubmit="return confirm('Yakin mau hapus user {{ $user->username }}?');">
                                @csrf
                                <button type="submit" class="btn-retro btn-retro--delete">HAPUS</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="table-empty">
                        Data tidak ditemukan...
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
