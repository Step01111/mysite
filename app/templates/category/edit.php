<!DOCTYPE html>
<html lang="ru">
<head>
<title>Редактирование раздела</title>

<?php require $_SERVER['DOCUMENT_ROOT'].'/app/templates/head-page.php'; ?>

</head>
<body>
<?php require $_SERVER['DOCUMENT_ROOT'].'/app/templates/header.php'; ?>
<div id="main">

<?php require $_SERVER['DOCUMENT_ROOT'].'/app/templates/sidebar.php'; ?>

<div id="content">
<h1>Редактирование раздела</h1>
<form id="form_category" class="contentform">
    <div>
        <label class="art_name">Название:
        <input type="text" name="category_name" value="<?= $category->getName() ?>">
        </label>
    </div>
    <div>
        <label>Алиас:
        <input type="text" name="alias" value="<?= $category->getAlias() ?>">
        </label>
    </div>
    <div>Метатеги</div>
    <div>
        <label>Title:</label>
        <textarea name="category_title"><?= $category->getTitle() ?></textarea>
    </div>
    <div>
        <label>Description:</label>
        <textarea name="description"><?= $category->getDescription() ?></textarea>
    </div>
    <input type="hidden" name="category_id" value="<?= $category->getId() ?>">
    <div>
        <input type="button" name="send" value="Сохранить">
    </div>
    <div><input type="button" name="delete" value="Удалить раздел">
</form>

<form id="form_delete">
    Удалить раздел?
    <div class="buttons">
        <input type="button" name="delete" value="Удалить">
        <input type="button" name="nodelete" value="Отмена">
    </div>
</form>
</div>
</div>
<script src="/web/js/category-edit.js"></script>
<script src="/web/js/category-delete.js"></script>

<?php require $_SERVER['DOCUMENT_ROOT'].'/app/templates/footer.php'; ?>
