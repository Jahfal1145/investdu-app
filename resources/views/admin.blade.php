<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kelola User - Admin</title>
</head>
<body style="font-family: sans-serif; margin: 30px; background-color: #f4f6f9;">

    <div style="display: flex; justify-content: space-between; align-items: center; background-color: #343a40; padding: 15px 20px; color: white; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        
        <div style="font-size: 20px; font-weight: bold;">👥 Kelola User</div>
        
        <form action="/admin/users" method="GET" style="margin: 0; display: flex; gap: 5px;">
            <input type="text" name="search" placeholder="Cari username atau email..." value="{{ request('search') }}" style="padding: 8px; border-radius: 4px; border: none; width: 300px; outline: none;">
            <button type="submit" style="padding: 8px 15px; border-radius: 4px; border: none; background-color: #0d6efd; color: white; cursor: pointer; font-weight: bold;">Cari</button>
        </form>

        <a href="/admin" style="text-decoration: none; color: white; background-color: #6c757d; padding: 8px 15px; border-radius: 4px; font-weight: bold;">⬅️ Kembali</a>
    </div>

    @if(session('success'))
        <p style="background-color: #d1e7dd; color: #0f5132; padding: 15px; border-radius: 5px; font-weight: bold;">✅ {{ session('success') }}</p>
    @endif

    <div style="background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        <table border="1" cellpadding="12" cellspacing="0" style="width: 100%; text-align: left; border-collapse: collapse; border-color: #dee2e6;">
            <thead style="background-color: #f8f9fa;">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td><b>{{ $user->username }}</b></td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->is_admin)
                            <span style="background-color: #ffc107; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: bold; color: black;">Admin</span>
                        @else
                            <span style="background-color: #0dcaf0; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: bold; color: white;">User Biasa</span>
                        @endif
                    </td>
                    <td style="text-align: center;">
                        <div style="display: flex; gap: 10px; justify-content: center;">
                            <a href="/admin/users/{{ $user->id }}/edit" style="background-color: #198754; color: white; text-decoration: none; padding: 6px 12px; border-radius: 4px; font-size: 14px;">Edit</a>
                            
                            <form action="/admin/users/{{ $user->id }}/delete" method="POST" onsubmit="return confirm('Yakin mau hapus user {{ $user->username }}?');" style="margin: 0;">
                                @csrf
                                <button type="submit" style="background-color: #dc3545; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-size: 14px;">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        @if($users->isEmpty())
            <p style="text-align: center; margin-top: 20px; color: #6c757d;">Data tidak ditemukan.</p>
        @endif
    </div>

</body>
</html>