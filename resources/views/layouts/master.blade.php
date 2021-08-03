<!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=na, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>@yield('title')</title>

            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="{{ mix('css/app.css') }}">
            <link rel="dns-prefetch" href="//fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
            <link rel="stylesheet" href="{{ mix('css/app.css') }}">
            <script src="{{ mix('js/app.js') }}" defer></script>

            <link href="{{ asset('css/app.css') }}" rel="stylesheet">
            @stack('styles')
            <script scr="{{mix('js/app.js')}}" defer></script>

            <style></style>
        </head>

        <body>
            <div id="app">
                <header>
                    @include('partials.nav')
                </header>
                <main class="py-4">
                    <div class="container-fluid">
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
                        @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
                    </div>
                    @yield('content')
                </main>
                <footer class="bg-white text-center text-black-50 py shadow">
                    {{ config('app.name') }} | copyright @ {{ date('Y-m-d') }}
                </footer>
            </div>
            @yield('js')
        </body>
</html>
