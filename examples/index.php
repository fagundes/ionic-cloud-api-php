<?php include_once "templates/base.php" ?>

<?php if (!isWebRequest()): ?>
    To view this example, run the following command from the root directory of this repository:

    composer run-script serve

    And then browse to "localhost:8181" in your web browser
    <?php return ?>
<?php endif ?>

<?= pageHeader("PHP Library Examples"); ?>

<?php if (isset($_POST['api_token'])): ?>
    <?php setApiToken($_POST['api_token']) ?>
    <span class="warn">
  API Token set!
</span>
<?php endif ?>

<?php if (!getApiToken()): ?>
    <div class="api-key">
        <strong>You have not entered your API Token</strong>
        <form method="post">
            API Key:<input type="text" name="api_token" />
            <input type="submit" />
        </form>
        <em>This can be found in the <a href="https://apps.ionic.io/apps" target="_blank">Ionic Cloud Dashboard</a></em>
    </div>
<?php endif ?>

    <ul>
        <li><a href="list-notifications.php">Push API - List All Notifications</a></li>
    </ul>

<?= pageFooter(); ?>