<!DOCTYPE html>
<html lang="ru">
<head>
<title>Панель администрирования</title>
<?php require $_SERVER['DOCUMENT_ROOT'].'/app/templates/head-page.php'; ?>
</head>
<body>
<?php require $_SERVER['DOCUMENT_ROOT'].'/app/templates/header.php'; ?>
<div id="main">
<?php require $_SERVER['DOCUMENT_ROOT'].'/app/templates/sidebar.php'; ?>
<div id="content">
<h2>Добавление статьи</h2>

<form id="new_art">
    <select name="category">
    <?php
    foreach ($categories as $value) {
        echo '<option value="' . $value->getId() . '">' . $value->getName() .
            '</option>';
    }
    ?>
    </select>
    <input type="text" name="artname" placeholder="название статьи">
    <input type="button" name="send" value="Добавить статью">
</form>

<h2>Добавление раздела</h2>

<form id="new_category">
    <input type="text" name="category_name" placeholder="название раздела">
    <input type="button" name="send" value="Добавить раздел">
</form>
</div>
</div>
<script src="/web/js/art-new.js"></script>
<script src="/web/js/category-new.js"></script>
<script src="/web/js/name-translit.js"></script>
<?php require $_SERVER['DOCUMENT_ROOT'].'/app/templates/footer.php'; ?>
