<form action="/login" method="POST">
    @csrf @if($errors->any())
        <p style="color:red;">{{ $errors->first() }}</p>
    @endif

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>