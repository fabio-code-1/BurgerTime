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
        <h1>Estamos localizado aqui!</h1>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d384.6302269231132!2d-46.89683137029912!3d-23.487862731346166!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94cf03824a3fd709%3A0x8573aba15feee823!2sR.%20Otaviano%20Piza%2C%20186%20-%20Vila%20Engenho%20Novo%2C%20Barueri%20-%20SP%2C%2006416-080!5e0!3m2!1spt-BR!2sbr!4v1679355697710!5m2!1spt-BR!2sbr" width="350" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </footer>
</body>

</html>