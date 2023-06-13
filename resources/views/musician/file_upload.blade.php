<!DOCTYPE html>
<html>
<head>
    <title>Music Upload</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .error-message, .alert-error {
            color: red;
        }

        .alert-success {
            color: green;
        }
    </style>
</head>
<body>

<div class="container">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif
    <h1>Music Upload</h1>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Something went wrong.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('audio.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="audio" class="form-label">Audio:</label>
            <input type="file" name="audio" id="audio" class="form-control">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success">Upload Audio</button>
            <a href="{{ url('/musician/logout') }}" class="btn btn-danger">Logout</a>
        </div>
    </form>
</div>

</body>
</html>