<!DOCTYPE html>
<html>
<head>
    <title>Users Module</title>
</head>
<body>
    <h1>Users (Module View)</h1>
    <ul>
        @foreach($users as $user)
            <li>{{ $user->name }} - {{ $user->email }}</li>
        @endforeach
    </ul>
</body>
</html>
