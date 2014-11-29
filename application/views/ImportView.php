<div class="container">
    <div>
        <h2>Импорт</h2>
    </div>
    <div class="error">
        <?= $data ?>
    </div>
    <form action="application/core/upload.php" method="post">
        <div id="dropZone">Перетащите файл</div>
    </form>
    <form action="/import/insert" method="post">
        <input type="submit" name="submit" value="Выполнить">
    </form>

</div>