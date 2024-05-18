@extends('dashboard')
@section('table')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="css/profile.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-sm-8 col-md-6 col-lg-4">
                <h2>User Profile</h2>
                <div class="profile-field">
                    <label for="profilePic"></label>
                    <img id="profilePic" src="img/rosemarie.jpg" alt="Profile Picture">
                </div>
                <div class="profile-field">
                    <label for="Name">Name:</label>
                    <span id="name"></span>
                </div>
                <div class="profile-field">
                    <label for="Email">Email:</label>
                    <span id="email"></span>
                </div>
                <div class="profile-field">
                    <label for="Address">Address:</label>
                    <span id="address"></span>
                </div>
                <div class="button-field">
                    <button id="editUserButton" class="btn btn-primary" data-toggle="modal" data-target="#editUserModal">Edit User</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm">
                        <div class="form-group">
                            <label for="editName">Name</label>
                            <input type="text" class="form-control" id="editName">
                        </div>
                        <div class="form-group">
                            <label for="editEmail">Email</label>
                            <input type="email" class="form-control" id="editEmail">
                        </div>
                        <div class="form-group">
                            <label for="editAddress">Address</label>
                            <input type="text" class="form-control" id="editAddress">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveChangesButton">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        fetch('api/user', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
            document.getElementById('name').innerText = data.name;
            document.getElementById('email').innerText = data.email;
            document.getElementById('address').innerText = data.address;
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });

        document.getElementById('editUserButton').addEventListener('click', function() {
           
            fetch('api/userAll', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token'),
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                document.getElementById('editName').value = data.name;
                document.getElementById('editEmail').value = data.email;
                document.getElementById('editAddress').value = data.address;
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
        });

        document.getElementById('saveChangesButton').addEventListener('click', function() {
            const updatedUser = {
                name: document.getElementById('editName').value,
                email: document.getElementById('editEmail').value,
                address: document.getElementById('editAddress').value,
            };

            fetch('api/user', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token'),
                },
                body: JSON.stringify(updatedUser),
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                document.getElementById('name').innerText = data.name;
                document.getElementById('email').innerText = data.email;
                document.getElementById('address').innerText = data.address;
                $('#editUserModal').modal('hide');
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
        });
    </script>
</body>
</html>
@endsection
