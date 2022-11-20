<!DOCTYPE html>
<html lang="ru">
<head>
<title><?= $category->getTitle() ?></title>
<meta name="description" content="<?= $category->getDescription() ?>">
<?php require $_SERVER['DOCUMENT_ROOT'].'/app/templates/head-page.php'; ?>
<style>
ul {
    list-style-type: none;
}
</style>
</head>
<body>
<?php require $_SERVER['DOCUMENT_ROOT'].'/app/templates/header.php'; ?>
<div id="main">
<?php require $_SERVER['DOCUMENT_ROOT'].'/app/templates/sidebar.php'; ?>

<div id="content">
<h1><?= $category->getName() ?></h1>
<?php
    if ($user && $user->getAdmin()) {
        echo '<a href="/categories/' . $category->getId() . '/edit">Редактировать</a>';
    }
    ?>
<ul>
    <?php
    foreach($art as $value) {
        echo '<li><a href="/' . $category->getAlias() . '/' . $value->getAlias() .'">' .
            $value->getName() . '</a></li>';
    }
    ?>
</ul>
</div>
</div>

<?php require $_SERVER['DOCUMENT_ROOT'].'/app/templates/footer.php'; ?>
