@extends('dashboard')
@section('table')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Table</title>
    <link rel="stylesheet" href="css/user.css">
</head>
<body>
    <div class="container">
        <div class="user-table">
            <center><h4>USER TABLE</h4></center>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        {{-- <td>1</td>
                        <td>Rosemarie Faller</td>
                        <td>rosemariefaller@gmail.com</td>
                        <td>Admin</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jane Smith</td>
                        <td>jane@example.com</td>
                        <td>User</td> --}}
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
@endsection
