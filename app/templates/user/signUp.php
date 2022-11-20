<!DOCTYPE html>
<html lang="ru">
<head>
<title>Регистрация пользователя</title>

<?php require $_SERVER['DOCUMENT_ROOT'].'/app/templates/head-page.php'; ?>

</head>
<body>
<?php require $_SERVER['DOCUMENT_ROOT'].'/app/templates/header.php'; ?>

<div id="main">

<?php require $_SERVER['DOCUMENT_ROOT'].'/app/templates/sidebar.php'; ?>

<div id="content">
<h1>Регистрация пользователя</h1>
<form id="form_reg">
    <div><input type="text" name="mail" placeholder="mail"></div>
    <div><input type="text" name="username" placeholder="имя"></div>
    <div><input type="password" name="pas" placeholder="пароль"></div>
    <div><input type="password" name="rpas" placeholder="повторите пароль"></div>
    <div><input type="button" name="send" value="Зарегистрироваться"></div>
</form>
<div id="isreg" style="display: none"> Вы успешно зарегистрированы. Вы можете войти на
сайт, используя Email и пароль, которые вы указали при регистрации</div>
</div>
</div>
<script src="/web/js/registration.js"></script>

<?php require $_SERVER['DOCUMENT_ROOT'].'/app/templates/footer.php'; ?>
