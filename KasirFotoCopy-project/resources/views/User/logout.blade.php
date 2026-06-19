<html>
<head>
    <title>Logout</title>
</head>
<body>
    <h2>Logout</h2>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>