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
 <div style="position: relative; display: inline-block;">
     <input type="password" name="password" id="pass" style="padding-right: 40px;">
     <span onclick="lihat()" style="position: absolute; right: 5px; top: 50%; transform: translateY(-50%); cursor: pointer; font-size: 12px; font-weight: bold;">Lihat</span>
 </div><br><br>
 
 <button type="submit">Login</button>
 </form>

 <script>
     function lihat() {
         var x = document.getElementById("pass");
         if (x.type === "password") {
             x.type = "text";
         } else {
             x.type = "password";
         }
     }
 </script>
</body>
</html>