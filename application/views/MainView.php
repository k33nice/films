<div class="container">
    <h1>Главная</h1>
    <div>
        <div>
            <form action="/main/search" method="post">
                <label for="search">Поиск по названию Фильма</label>
                <input type="text" name="search">
                <input type="submit" name="submit" value="поиск">
            </form>
            <form action="/main/search" method="post">
                <label for="search-actor">Поиск по имени актера</label>
                <input type="text" name="search-actor">
                <input type="submit" name="submit-actor" value="поиск">
            </form>
        </div>
        <?php foreach ($data as $film): ?>
            <table>
                <tr>
                    <td class="name"><?= $film['name'] ?></td>
                    <td>
                        <form action="/info" method="post">
                            <input name="id" value="<?= $film['id'] ?>" type="hidden">
                            <input type="submit" name="submit" value="Информация">
                        </form>
                    </td>
                </tr>
            </table>
        <?php endforeach; ?>
        <div class="pages-nav">
            <a href="/main/index/1">Начало</a>
            <?php
            $i = isset($actionPage) ? $actionPage : 1;
            $iStart = $i-2;
            if ($iStart <= 0) {$iStart = 1;}
            for ($i=$iStart; $i<=$totalPages && $i<=($actionPage+2); $i++) {
                if ($i === $actionPage) { ?>

                    <a class="current-page" href="/main/index/<?= $i ?>"><?= $i ?></a>

                <?php } elseif ($i !== $actionPage) { ?>

                    <a href="/main/index/<?= $i ?>"><?= $i ?></a>
                <?php }} ?>
            <a href="/main/index/<?= $totalPages ?>">Конец</a>
        </div>
    </div>
    <div>
    </div>
</div>