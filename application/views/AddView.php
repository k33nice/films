<div class="container">
    <form method="post" action="/add/add">
        <table>
            <tr>
                <td><label for="name">Название фильма</label></td>
                <td><input name="name" type="text"></td>
            </tr>
            <tr>
                <td><label for="year">Год выпуска</label></td>
                <td><input name="year" type="text"></td>
            </tr>
            <tr>
                <td><label for="format">Формат</label></td>
                <td><input name="format" type="text" ></td>
            </tr>
            <tr>
                <td><label for="actors">Актеры</label></td>
                <td><input name="actors" type="text"></td>
            </tr>
        </table>
        <input name="submit" type="submit" value="Добавить">
    </form>
</div>