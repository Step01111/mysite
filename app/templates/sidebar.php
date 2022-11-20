
<div id="sidebar">
    <ul id="main_menu">
        <li><a href="/">Главная</a></li>
        <?php
        foreach ($categories as $value) {
            echo '<li><a href="/' . $value->getAlias() . '">' .
                $value->getName() . '</a></li>';
        }
        ?>
    </ul>
</div>
