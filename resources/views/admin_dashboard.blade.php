@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'dashboard')

@section('content')

<style>
    /* ===== DASHBOARD SPECIFIC STYLES ===== */

    /* Welcome banner */
    .welcome-banner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1.25rem 1.5rem;
        background: linear-gradient(135deg, #0d1120 0%, #131830 50%, #0d1120 100%);
        border: 3px solid #1a1f2e;
        margin-bottom: 1.5rem;
        position: relative;
        overflow: hidden;
    }

    .welcome-banner::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #FFD000, #f85149, #a371f7, #3fb950, #FFD000);
        background-size: 200% auto;
        animation: gradient-shift 4s linear infinite;
    }

    @keyframes gradient-shift {
        0% { background-position: 0% center; }
        100% { background-position: 200% center; }
    }

    .welcome-text h1 {
        font-family: 'Press Start 2P', monospace;
        font-size: 0.8rem;
        color: #FFD000;
        margin-bottom: 0.5rem;
        letter-spacing: 1px;
    }

    .welcome-text p {
        font-family: 'Space Mono', monospace;
        font-size: 0.8rem;
        color: #6e7681;
    }

    .welcome-text p strong {
        color: #c9d1d9;
    }

    .welcome-badge {
        font-family: 'Press Start 2P', monospace;
        font-size: 0.45rem;
        color: #0a0e1a;
        background-color: #FFD000;
        padding: 6px 12px;
        border: 2px solid #0a0e1a;
        letter-spacing: 1px;
        white-space: nowrap;
        box-shadow: 3px 3px 0 #0a0e1a;
    }

    /* ===== STAT CARDS GRID ===== */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .stat-card {
        background-color: #0d1120;
        border: 4px solid #1a1f2e;
        border-radius: 6px;
        padding: 1.25rem;
        position: relative;
        overflow: hidden;
        transition: all 0.15s ease;
        box-shadow: 4px 4px 0 #050810;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 4px 6px 0 #050810;
    }

    .stat-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
    }

    .stat-card--yellow::after  { background-color: #FFD000; }
    .stat-card--blue::after    { background-color: #58a6ff; }
    .stat-card--purple::after  { background-color: #a371f7; }
    .stat-card--green::after   { background-color: #3fb950; }

    .stat-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 0.75rem;
    }

    .stat-card-label {
        font-family: 'Press Start 2P', monospace;
        font-size: 0.4rem;
        color: #6e7681;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .stat-card-icon {
        font-size: 1.3rem;
        line-height: 1;
    }

    .stat-card-value {
        font-family: 'Press Start 2P', monospace;
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        line-height: 1;
    }

    .stat-card--yellow .stat-card-value  { color: #FFD000; text-shadow: 2px 2px 0 rgba(255, 208, 0, 0.15); }
    .stat-card--blue   .stat-card-value  { color: #58a6ff; text-shadow: 2px 2px 0 rgba(88, 166, 255, 0.15); }
    .stat-card--purple .stat-card-value  { color: #a371f7; text-shadow: 2px 2px 0 rgba(163, 113, 247, 0.15); }
    .stat-card--green  .stat-card-value  { color: #3fb950; text-shadow: 2px 2px 0 rgba(63, 185, 80, 0.15); }

    .stat-card-desc {
        font-family: 'Space Mono', monospace;
        font-size: 0.65rem;
        color: #484f58;
    }

    /* Status indicator for API card */
    .status-indicator {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        font-family: 'Press Start 2P', monospace;
        font-size: 0.5rem;
        color: #3fb950;
        padding: 4px 10px;
        background-color: rgba(63, 185, 80, 0.08);
        border: 2px solid rgba(63, 185, 80, 0.2);
        letter-spacing: 1px;
    }

    .status-indicator-dot {
        width: 8px;
        height: 8px;
        background-color: #3fb950;
        animation: pulse-indicator 1.5s ease-in-out infinite;
    }

    @keyframes pulse-indicator {
        0%, 100% { opacity: 1; box-shadow: 0 0 0 0 rgba(63, 185, 80, 0.4); }
        50% { opacity: 0.6; box-shadow: 0 0 0 4px rgba(63, 185, 80, 0); }
    }

    /* ===== RETRO TABLE ===== */
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

    .table-title-icon {
        font-size: 1rem;
    }

    .table-action-link {
        font-family: 'Space Mono', monospace;
        font-size: 0.7rem;
        font-weight: 700;
        color: #58a6ff;
        text-decoration: none;
        padding: 0.35rem 0.75rem;
        border: 2px solid #1a1f2e;
        transition: all 0.15s ease;
    }

    .table-action-link:hover {
        background-color: rgba(88, 166, 255, 0.08);
        border-color: #58a6ff;
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

    /* Cell specific styles */
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

    /* Empty state */
    .table-empty {
        text-align: center;
        padding: 2rem;
        color: #484f58;
        font-family: 'Space Mono', monospace;
        font-size: 0.8rem;
    }

    /* ===== SCAN LINE EFFECT (subtle CRT) ===== */
    .scanline-overlay {
        position: fixed;
        inset: 0;
        pointer-events: none;
        z-index: 100;
        background: repeating-linear-gradient(
            0deg,
            rgba(0, 0, 0, 0.03) 0px,
            rgba(0, 0, 0, 0.03) 1px,
            transparent 1px,
            transparent 3px
        );
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 1024px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }

        .welcome-banner {
            flex-direction: column;
            gap: 0.75rem;
            text-align: center;
        }

        .retro-table {
            font-size: 0.7rem;
        }

        .retro-table thead th {
            font-size: 0.35rem;
            padding: 0.5rem 0.75rem;
        }

        .retro-table tbody td {
            font-size: 0.7rem;
            padding: 0.5rem 0.75rem;
        }
    }

    @media (max-width: 640px) {
        .table-header {
            flex-direction: column;
            gap: 0.5rem;
            align-items: flex-start;
        }
    }
</style>

{{-- CRT Scanline overlay for retro feel --}}
<div class="scanline-overlay"></div>

{{-- Welcome Banner --}}
<div class="welcome-banner">
    <div class="welcome-text">
        <h1>👑 GAME MASTER CONSOLE</h1>
        <p>Selamat datang kembali, <strong>{{ Auth::user()->username }}</strong>! Ini panel kontrol platformmu.</p>
    </div>
    <div class="welcome-badge">LVL 99 ADMIN</div>
</div>

{{-- Stat Cards --}}
<div class="stats-grid">

    {{-- Card 1: Total Users --}}
    <div class="stat-card stat-card--yellow" id="cardTotalUsers">
        <div class="stat-card-header">
            <span class="stat-card-label">Total User</span>
            <span class="stat-card-icon">👥</span>
        </div>
        <div class="stat-card-value">{{ $totalUsers }}</div>
        <div class="stat-card-desc">Pengguna terdaftar</div>
    </div>

    {{-- Card 2: Modul Literasi --}}
    <div class="stat-card stat-card--blue" id="cardTotalModul">
        <div class="stat-card-header">
            <span class="stat-card-label">Modul Literasi</span>
            <span class="stat-card-icon">📚</span>
        </div>
        <div class="stat-card-value">5</div>
        <div class="stat-card-desc">Modul tersedia</div>
    </div>

    {{-- Card 3: Rata-rata Skor --}}
    <div class="stat-card stat-card--purple" id="cardAvgScore">
        <div class="stat-card-header">
            <span class="stat-card-label">Rata-rata Skor</span>
            <span class="stat-card-icon">🎯</span>
        </div>
        <div class="stat-card-value">78</div>
        <div class="stat-card-desc">Poin kuis rata-rata</div>
    </div>

    {{-- Card 4: Status API --}}
    <div class="stat-card stat-card--green" id="cardApiStatus">
        <div class="stat-card-header">
            <span class="stat-card-label">API Pasar Saham</span>
            <span class="stat-card-icon">📈</span>
        </div>
        <div style="margin-bottom: 0.5rem;">
            <span class="status-indicator">
                <span class="status-indicator-dot"></span>
                ONLINE
            </span>
        </div>
        <div class="stat-card-desc">Koneksi stabil</div>
    </div>

</div>

{{-- Recent Users Table --}}
<div class="table-container">
    <div class="table-header">
        <div class="table-title">
            <span class="table-title-icon">📋</span>
            DAFTAR PENGGUNA TERBARU
        </div>
        <a href="/admin/users" class="table-action-link" id="linkViewAllUsers">Lihat Semua →</a>
    </div>

    <div style="overflow-x: auto;">
        <table class="retro-table" id="tableRecentUsers">
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
                @forelse($recentUsers as $user)
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
                                <button type="submit" class="btn-retro btn-retro--delete">DEL</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="table-empty">
                        Belum ada data pengguna...
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection