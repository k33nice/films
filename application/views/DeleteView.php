<div class="container">
    <div class="text">
        <form action="/delete/delete" method="post">
            <table>
                <?php foreach ($data as $name): ?>
                    <tr>
                        <td>
                            <input value="<?= $name['id'] ?>" type="checkbox" name="checkbox[]">
                            <?= $name['name']?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <input name="submit" type="submit" value="Удалить">
        </form>
        <div>
            <div class="pages-nav">
                <a href="/delete/index/1">Начало</a>
                <?php
                $i = isset($actionPage) ? $actionPage : 1;
                $iStart = $i-2;
                if ($iStart <= 0) {$iStart = 1;}
                for ($i=$iStart; $i<=($actionPage+2) and $i<=$totalPages; $i++) {
                    if ($i === $actionPage) { ?>

                        <a class="current-page" href="/delete/index/<?= $i ?>"><?= $i ?></a>

                    <?php } elseif ($i !== $actionPage) { ?>

                        <a href="/delete/index/<?= $i ?>"><?= $i ?></a>
                    <?php }} ?>
                <a href="/delete/index/<?= $totalPages ?>">Конец</a>
            </div>
        </div>
    </div>
    <div>
    </div>
</div>