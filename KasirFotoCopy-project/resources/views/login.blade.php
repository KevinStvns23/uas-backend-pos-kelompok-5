<html>
<head>
 <title>Login</title>
</head>
<body>
 <h2>Login</h2>
 @if ($errors->any())
 <div>
 <strong>Error!</strong> {{ $errors->first('username') }}
 </div>
 <br>
 @endif
 <form method="POST" action="/login">
 @csrf
 <label>Username:</label><br>
 <input type="text" name="username"><br><br>
 <label>Password:</label><br>
 <input type="password" name="password"><br><br>
 <button type="submit">Login</button>
 </form>
</body>
</html>