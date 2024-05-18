<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Sent</title>
    <link rel="stylesheet" href="css/email_success.css">
</head>
<body>
    <div class="container">
        <div class="success-container">
            <div class="card">
                <h3>Email Sent Successfully</h3>
                {{-- <p>Your email has been sent successfully.</p> --}}
            </div>
        </div>
        <footer>
            <p>
                User Created Successfully!
                @foreach ($credentials as $item)
                    <table>
                      <tbody>
                        <tr>
                          <td>{{$item->email}}</td><br>
                          <td>{{$item->password}}</td>
                        </tr>
                      </tbody>
                    </table>
                @endforeach
              </p>        </footer>
    </div>
</body>
</html>
