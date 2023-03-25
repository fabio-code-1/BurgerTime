<html>

<head>
    <title>BurgerTime</title>
    
</head>

<body>
    <header>
        @include('includes.navbar')
    </header>

    <main>
        @yield('content')
    </main>

    <footer style="margin-top: 20%;">
    @include('includes.footer')
    </footer>
</body>

</html>