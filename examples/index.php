<?php include_once "templates/base.php" ?>

<?php if (!isWebRequest()): ?>
    To view this example, run the following command from the root directory of this repository:

    composer run-script serve

    And then browse to "localhost:8181" in your web browser
    <?php return ?>
<?php endif ?>

<?= pageHeader("PHP Library Examples"); ?>

<?php if (isset($_POST['api_key'])): ?>
    <?php setApiKey($_POST['api_key']) ?>
    <span class="warn">
  API Key set!
</span>
<?php endif ?>

    <ul>
        <li><a href="list-notifications.php">Push API - List All Notifications</a></li>
    </ul>

<?= pageFooter(); ?>