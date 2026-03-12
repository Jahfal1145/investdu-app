<h2>Login Sistem</h2>

@if(session('success'))
    <p style="color:green; font-weight:bold;">{{ session('success') }}</p>
@endif

<form action="/login" method="POST">
    @csrf 
    
    @if($errors->any())
        <p style="color:red;">{{ $errors->first() }}</p>
    @endif

    <label>Email atau Username:</label><br>
    <input type="text" name="login" required><br><br>

<label>Password:</label>
    <input type="password" name="password" id="loginPassword" placeholder="Masukkan Password" required>
    
    <div style="margin-top: 5px; margin-bottom: 15px;">
        <input type="checkbox" onclick="toggleLoginPassword()" id="showLoginPass">
        <label for="showLoginPass" style="font-size: 14px; cursor: pointer;">Tampilkan Password</label>
    </div>

    <script>
        function toggleLoginPassword() {
            var x = document.getElementById("loginPassword");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>

    <button type="submit">Login</button>

<a href="/auth/google" style="text-decoration: none;">
    <img src="link_gambar_tombolmu.png" alt="Continue with Google">
</a>

</form>

<br>
<p>Belum punya akun? <a href="/register">Register di sini</a></p>