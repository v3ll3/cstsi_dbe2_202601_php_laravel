<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users</title>
</head>
<body>
<h1>Users</h1>
    @if ($userList->count()>0)
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Sobrenome</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($userList as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->surname}}</td>
                <td>{{$user->email}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>Usuários não encontrados! </p>
    @endif
</body>
</html>
