<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User - Admin</title>
</head>
<body style="font-family: sans-serif; margin: 30px; background-color: #f4f6f9;">

    <div style="background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); max-width: 500px; margin: auto;">
        <h2 style="margin-top: 0;">✏️ Edit Data User</h2>
        <p>Mengedit data untuk: <b>{{ $user->username }}</b></p>
        
        @if($errors->any())
            <div style="background-color: #f8d7da; color: #842029; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/admin/users/{{ $user->id }}/update" method="POST">
            @csrf
            @method('PUT') <div style="margin-bottom: 15px;">
                <label style="font-weight: bold; display: block; margin-bottom: 5px;">Username:</label>
                <input type="text" name="username" value="{{ old('username', $user->username) }}" required style="width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: bold; display: block; margin-bottom: 5px;">Email:</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required style="width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: bold; display: block; margin-bottom: 5px;">Ganti Password (Opsional):</label>
                <input type="text" name="password" placeholder="Kosongkan jika tidak ingin ganti password" style="width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div style="margin-bottom: 25px;">
                <label style="font-weight: bold; display: block; margin-bottom: 5px;">Status Akun:</label>
                <select name="is_admin" style="width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="0" {{ $user->is_admin == 0 ? 'selected' : '' }}>User Biasa</option>
                    <option value="1" {{ $user->is_admin == 1 ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <div style="display: flex; justify-content: space-between;">
                <a href="/admin/users" style="text-decoration: none; background-color: #6c757d; color: white; padding: 10px 15px; border-radius: 4px; font-weight: bold;">Batal</a>
                <button type="submit" style="background-color: #0d6efd; color: white; border: none; padding: 10px 20px; border-radius: 4px; font-weight: bold; cursor: pointer;">Simpan Perubahan</button>
            </div>
        </form>
    </div>

</body>
</html>