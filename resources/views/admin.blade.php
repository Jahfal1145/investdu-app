<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kelola User - Admin</title>
</head>
<body style="font-family: sans-serif; margin: 30px;">

    <h2>👥 Daftar User Investdu</h2>

    @if(session('success'))
        <p style="background-color: #d1e7dd; color: #0f5132; padding: 10px; border-radius: 5px;">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: left; border-collapse: collapse;">
        <thead style="background-color: #f8f9fa;">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if($user->is_admin)
                        <span style="background-color: #ffc107; padding: 3px 8px; border-radius: 10px; font-size: 12px; font-weight: bold;">Admin</span>
                    @else
                        <span style="background-color: #0dcaf0; color: white; padding: 3px 8px; border-radius: 10px; font-size: 12px; font-weight: bold;">User Biasa</span>
                    @endif
                </td>
                <td>
                    <form action="/admin/users/{{ $user->id }}/delete" method="POST" onsubmit="return confirm('Yakin mau hapus user {{ $user->name }}?');">
                        @csrf
                        <button type="submit" style="background-color: #dc3545; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer;">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    <a href="/admin" style="text-decoration: none; color: #0d6efd;">⬅️ Kembali ke Panel Admin</a>

</body>
</html>