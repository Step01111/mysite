<!DOCTYPE html>
<html lang="ru">
<head>
<title><?= $art->getTitle() ?></title>
<meta name="description" content="<?= $art->getDescription() ?>">
<?php require $_SERVER['DOCUMENT_ROOT'].'/app/templates/head-page.php'; ?>
</head>
<body>
<?php require $_SERVER['DOCUMENT_ROOT'].'/app/templates/header.php'; ?>
<div id="main">
<?php require $_SERVER['DOCUMENT_ROOT'].'/app/templates/sidebar.php'; ?>

<div id="content">
    <h1><?= $art->getName() ?></h1>
    <?php
    if ($user && $user->getAdmin()) {
        echo '<a href="/art/' . $art->getId() . '/edit">Редактировать</a>';
    }
    ?>
    <div><?= $art->getText() ?></div>
</div>
</div>
<?php require $_SERVER['DOCUMENT_ROOT'].'/app/templates/footer.php'; ?>
