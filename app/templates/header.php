<div id="header">
    <div id="userblock">
    <?php
    if (isset($user)) {
        $templateName = 'authUser.php';
    } else {
        $templateName = 'formLogin.php';
    }
    require $_SERVER['DOCUMENT_ROOT'].'/app/templates/' . $templateName;
    ?>
    </div>
</div>