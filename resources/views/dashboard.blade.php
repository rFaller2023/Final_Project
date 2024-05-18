<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <script src="js/sweetalert.min.js"></script>

    <script>
        const token = localStorage.getItem('accessToken');
        if (!token) {
            window.location.href = '/welcome';
        }
    </script>
</head>
<body>
 
    <div class="dashboard">
        <div class="sidebar">
            <h2>Dashboard</h2>
            <ul>
                <li><a href="/home ">Home</a></li>
                <li><a href="/profile">Profile</a></li>
                <li><a href="/post">Post</a></li>
                <li><a href="/user">User</a></li>
                <li><a href="#" onclick="logout()">Logout</a></li>
            </ul>
        </div>
        <div class="content">
            <p><h2>Welcome to the dashboard!</h2></p>
        </div>
    </div>
    @yield('table')

    <script>
        function logout() {
    // Show the confirmation dialog
    swal({
        title: "Are you sure you want to logout?",
        // text: "You will be redirected to the welcome page.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willLogout) => {
        if (willLogout) {
            localStorage.removeItem('accessToken');
            window.location.href = '/welcome';
        } else {
            document.getElementById("demo").innerHTML = "You pressed Cancel!";
        }
    });
}

    </script>
</body>
</html>
