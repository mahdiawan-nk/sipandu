<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - {{ $title }}</title>

    @include('_partials.style')
</head>

<body>
    <div id="app">
        @include('_partials.sidebar')
        <div id="main">
            @include('_partials.navbar')

            <div class="main-content container-fluid">
                <div class="page-title">
                    <h3>{{ $title }}</h3>
                </div>
                @yield('content')
                
            </div>

            @include('_partials.footer')
        </div>
    </div>
    @include('_partials.script')
</body>

</html>
