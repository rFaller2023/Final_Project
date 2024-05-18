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
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody id = "tableBody">
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
                    <button type = "add">Add User</button>
                </tbody>
            </table>
            <script>
                fetch('api/userAll', {
                    method: 'GET',
                }).then(response => {
                    return response.json();
                }).then(data => {
                    let tableBody = document.getElementById('tableBody');
                    tableBody.innerHTML = '';

                    for(let i=0; i < data.length; i++){
                        let tableRow = ` <tr> 
                            <td>${data[i].id}</td>
                            <td>${data[i].name}</td>
                            <td>${data[i].email}</td>
                            <td>${data[i].address}</td>
                            </tr>`;
                            tableBody.innerHTML += tableRow;
                    }
                })
            </script>
        </div>
    </div>
</body>
</html>
@endsection
