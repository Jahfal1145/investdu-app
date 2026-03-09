<h2>Daftar Akun Baru</h2>

<form action="/register" method="POST">
    @csrf
    
    @if($errors->any())
        <div style="color:red; margin-bottom: 10px;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <label>Nama Lengkap:</label><br>
    <input type="text" name="name" value="{{ old('name') }}" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="{{ old('email') }}" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <label>Konfirmasi Password:</label><br>
    <input type="password" name="password_confirmation" required><br><br>

    <button type="submit">Daftar Sekarang</button>
</form>

<p>Sudah punya akun? <a href="/login">Kembali ke Login</a></p>