<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <title>Фильмы</title>
    <link rel="stylesheet" href="../../public/css/style.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="icon" href="../images/favicon.ico">
</head>
<body>
<header>
    <nav>
        <a href="/">Главная</a>
        <a href="/add">Добавить</a>
        <a href="/delete">Удалить</a>
        <a href="/import">Импорт</a>
    </nav>
</header>
<div id="wrapper">
    <?php include APPPATH . '/application/views/' . $view ?>
</div>
<footer>
</footer>
<script src="/public/js/app.js"></script>
</body>
</html>