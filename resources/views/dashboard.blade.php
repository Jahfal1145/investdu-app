<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Utama</title>
</head>
<body style="font-family: sans-serif; margin: 30px;">

    <h2>Dashboard Utama</h2>

    @if($errors->any())
        <div style="background-color: #f8d7da; color: #842029; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
            <strong>Error:</strong> {{ $errors->first() }}
        </div>
    @endif

    <p>Halo <b>{{ Auth::user()->name }}</b>, Berhasil Login! Ini adalah halaman aman backend kamu.</p>

    @if(Auth::user()->is_admin == 1)
        <div style="background-color: #fff3cd; border: 1px solid #ffe69c; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
            <p style="margin: 0; color: #664d03;">
                👑 <strong>Status Admin Aktif:</strong> Kamu memiliki akses khusus.
                <br><br>
                <a href="/admin/users" style="background-color: #0d6efd; color: white; padding: 8px 12px; text-decoration: none; border-radius: 4px;">➡️ Buka Panel Kelola User</a>
            </p>
        </div>
    @endif

    <hr style="margin-top: 30px; margin-bottom: 20px;">

    <form action="/logout" method="POST">
        @csrf
        <button type="submit" style="background-color: #dc3545; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">
            Keluar (Logout)
        </button>
    </form>

</body>
</html>