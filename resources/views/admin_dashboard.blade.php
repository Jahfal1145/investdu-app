<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Investdu</title>
</head>
<body style="font-family: sans-serif; margin: 30px; background-color: #f4f6f9;">

    <div style="background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <h2 style="margin-top: 0;">👑 Panel Admin Investdu</h2>
        <p>Selamat datang, Komandan <b>{{ Auth::user()->name }}</b>! Mau ngurusin apa hari ini?</p>

        <hr style="margin: 20px 0;">

        <div style="display: flex; gap: 15px;">
            <a href="/admin/users" style="background-color: #0d6efd; color: white; padding: 15px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">
                👥 Kelola Data User
            </a>
            
            <a href="#" style="background-color: #6c757d; color: white; padding: 15px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; cursor: not-allowed;">
                📈 Kelola Investasi (Coming Soon)
            </a>
        </div>

        <hr style="margin: 20px 0;">

        <form action="/logout" method="POST">
            @csrf
            <button type="submit" style="background-color: #dc3545; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer;">
                Keluar (Logout)
            </button>
        </form>
    </div>

</body>
</html>