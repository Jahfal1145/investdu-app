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

    <label>Username:</label><br>
    <input type="text" name="username" value="{{ old('name') }}" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="{{ old('email') }}" required><br><br>

<label>Password:</label>
    <input type="password" name="password" id="regPassword" placeholder="Minimal 6 karakter" required>
    <br><br>

    <label>Konfirmasi Password:</label>
    <input type="password" name="password_confirmation" id="regConfirmPassword" required>
    
    <div style="margin-top: 5px; margin-bottom: 15px;">
        <input type="checkbox" onclick="toggleRegPassword()" id="showRegPass">
        <label for="showRegPass" style="font-size: 14px; cursor: pointer;">Tampilkan Password</label>
    </div>

    <script>
        function toggleRegPassword() {
            var pass = document.getElementById("regPassword");
            var confirmPass = document.getElementById("regConfirmPassword");
            
            if (pass.type === "password") {
                pass.type = "text";
                confirmPass.type = "text";
            } else {
                pass.type = "password";
                confirmPass.type = "password";
            }
        }
    </script>

    <label>Konfirmasi Password:</label><br>
    <input type="password" name="password_confirmation" required><br><br>

    <button type="submit">Daftar Sekarang</button>
</form>

<p>Sudah punya akun? <a href="/login">Kembali ke Login</a></p>