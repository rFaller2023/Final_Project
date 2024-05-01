@extends('dashboard')
@section('table')
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Table</title>
    <link rel="stylesheet" href="css/post.css">
</head>
<body>
    <div class="post-table">
        <h2>Post Table</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Content</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>First Post</td>
                    <td>This is the content of the first post.</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Second Post</td>
                    <td>This is the content of the second post.</td>
                </tr>
                
            </tbody>
        </table>
    </div>
</body>
</html>
@endsection
