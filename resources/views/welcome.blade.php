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
            <div id="message" class="text-danger mb-3">
            
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
    <script>
        document.getElementById('login-form').addEventListener('submit', function(event){
            event.preventDefault();
            
            const formData = new FormData(this);

                fetch('api/welcome',{
                    method: 'POST',
                    body: formData,
                    headers: {
                        Accept: 'application/json',
                        Authorization: 'Bearer' + localStorage.getItem('token'),

                    }  
                              
                }).then(res =>{
                    console.log(res);
                    return res.json();

                }).then(res => {
                    console.log(res);
                    if(res.token) {
                    localStorage.setItem('accessToken', res.token);
                    window.location.href = '/dashboard';                              
                } else{
                    let messageDiv = document.getElementById('message');
                    messageDiv.innerHtml = res.message;
                    messageDiv.style = 'display:block';

                }
            });
            
        });
        // document.addEventListener('DOMContentLoaded', function(){
        //     document.querySelector('.login-form').addEventListener('submit',function(event){
        //         event.preventDefault();

        //         const formData = new FormData(this);

        //         fetch('api/login',{
        //             method: 'POST',
        //             Body: formData,
        //             headers: {
        //                 Acceppt: 'application/json',

        //             }  
                              
        //         }).then(res =>{
        //             console.log(res);
        //             return res.json();

        //         }).then(res => {
        //             console.log(res);
        //             if(res.access_token) {
        //             localStorage.setItem('accessToken', res.access_Token);
        //             window.location.href = '/users';                              
        //         } else{
        //             let messageDiv = document.getElementId('message');
        //             messageDiv.innerHtml = res.message;
        //             messageDiv.style = 'display:block';

        //         }
        //         })
        //     });
        // })
    </script>
</body>
</html>

