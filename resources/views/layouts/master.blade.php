<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if(session()->has('success'))
        <div class="aler alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    @if(isset($errors) && $errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $errors)
                    <li>{{ $errors }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')


</html>
