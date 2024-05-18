<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Form</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form id="login-form">
            <div class= "form-group">
                <label for="email">Email :</label>
                <input type="text" name="email" placeholder="Email" required>
            </div>
            <div class= "form-group">
                <label for="password">Password:</label>
            <input type="password" name="password" placeholder="Password" required>
            </div>
            <div id="message" class="text-danger mb-3" style= "display: none">
                Invalid Credentials!
            
            </div>
            <button type="submit">Login</button>
        </form>
    
    <div class="otp-container" id="otp-container" style="display: none;">
        <h2>Enter OTP</h2>
        <form id="otp-form">
            <h3 id="otpmessage"></h3>
            <label for="otp_code" class="form-label">OTP:</label>
            <input type="number" name="otp_code" class="form-control" id="otp_code" placeholder="Enter OTP" required>
            <br>
            <button type="submit">Verify OTP</button>
        </form>
    </div>
</div>
    <script>
        document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch("api/welcome", {
        method: 'POST',
        body: formData,
        headers: {
            Accept: 'application/json',
            Authorization: 'Bearer ' + localStorage.getItem('token'),
        }
    }).then(response => {
        return response.json();
    }).then(data => {
        if (data.token) {
            localStorage.setItem('token', data.token);
            document.getElementById('login-form').style.display = 'none';
            document.querySelector('.otp-container').style.display = 'block'; 
        } else {
            document.getElementById('message').innerText = data.message;
            document.getElementById('message').style.color = "red";
        }
    }).catch(error => {
        console.error("Something went wrong with your fetch", error);
    });
});


document.getElementById('otp-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);
    const token = localStorage.getItem('token'); 

    formData.append('token', token); 

    fetch("api/verifyOTP", {
        method: 'POST',
        body: formData,
        headers: {
            Accept: 'application/json',
            Authorization: 'Bearer ' + token, 
        }
    }).then(response => {
        return response.json();
    }).then(data => {
        if (data.status) {
            localStorage.setItem('accessToken', data.accessToken); 
            window.location.href = '/dashboard'; 
        } else {
            document.getElementById('otpmessage').textContent = data.message;
            document.getElementById('otpmessage').style.color = "red";
        }
    }).catch(error => {
        console.error('Error:', error);
    });
});

           
    </script>
           
    </script>
</body>
</html>

