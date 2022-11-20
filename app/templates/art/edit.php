<?php
foreach ($categories as $value) {
    if ($value->getId() == $art->getCategoryId()) {
        $art->categoryAlias = $value->getAlias();
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<title>Редактирование статьи</title>

<?php require $_SERVER['DOCUMENT_ROOT'].'/app/templates/head-page.php'; ?>
</head>
<body>
<?php require $_SERVER['DOCUMENT_ROOT'].'/app/templates/header.php'; ?>
<div id="main">

<?php require $_SERVER['DOCUMENT_ROOT'].'/app/templates/sidebar.php'; ?>

<div id="content">
<h1>Редактирование статьи</h1>
<form id="form_art" class="contentform">
    <div>
        <label class="art_name">Название:
        <input type="text" name="art_name" value="<?= $art->getName() ?>">
        </label>
    </div>
    <div>
        <label>Алиас:
        <input type="text" name="alias" value="<?= $art->getAlias() ?>">
        </label>
    </div>
    <div>Метатеги</div>
    <div>
        <label>Title:</label>
        <textarea name="art_title"><?= $art->getTitle() ?></textarea>
    </div>
    <div>
        <label>Description:</label>
        <textarea name="description"><?= $art->getDescription() ?></textarea>
    </div>
    <div><textarea name="text"><?= $art->getText() ?></textarea></div>
    <input type="hidden" name="art_id" value="<?= $art->getId() ?>">
    <div>
        <input type="button" name="send" value="Сохранить">
        <a href="<?= '/' . $art->categoryAlias . '/' . $art->getAlias() ?>" id="open">
        Перейти к статье
    </a>
    </div>
    <div><input type="button" name="delete" value="Удалить статью">
</form>

<form id="form_delete">
    Удалить статью?
    <div class="buttons">
        <input type="button" name="delete" value="Удалить">
        <input type="button" name="nodelete" value="Отмена">
    </div>
</form>
</div>
</div>
<script src="/web/js/name-translit.js"></script>
<script src="/web/js/art-edit.js"></script>
<script src="/web/js/art-delete.js"></script>
<?php require $_SERVER['DOCUMENT_ROOT'].'/app/templates/footer.php'; ?>
