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
            API Key:<input type="text" name="api_token"/>
            <input type="submit"/>
        </form>
        <em>This can be found in the <a href="https://apps.ionic.io/apps" target="_blank">Ionic Cloud Dashboard</a></em>
    </div>
<?php endif ?>

    <h2>Push API</h2>

    <ul>
        <li>
            <h3>Notifications</h3>

            <ul>
                <li><a href="list-notifications.php">List All Notifications</a></li>
                <li><a href="create-notification.php">Create Notification</a></li>
                <li><a href="delete-notification.php">Delete Notification</a></li>
                <li><a href="replace-notification.php">Replace Notification</a></li>
                <li><a href="list-notification-messages.php">List Notification Messages</a></li>
            </ul>
        </li>

        <li>
            <h3>Device Tokens</h3>

            <ul>
                <li><a href="list-tokens.php">List All Device Tokens</a></li>
                <li><a href="delete-token.php">Delete Device Token</a></li>
                <li><a href="list-associated-users.php">List All Associated Users</a></li>
            </ul>
        </li>
    </ul>

<?= pageFooter(); ?>