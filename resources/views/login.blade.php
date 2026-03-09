<h2>Login Sistem</h2>

@if(session('success'))
    <p style="color:green; font-weight:bold;">{{ session('success') }}</p>
@endif

<form action="/login" method="POST">
    @csrf 
    
    @if($errors->any())
        <p style="color:red;">{{ $errors->first() }}</p>
    @endif

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

<br>
<p>Belum punya akun? <a href="/register">Register di sini</a></p>