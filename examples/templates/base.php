<?php
/* Ad hoc functions to make the examples marginally prettier.*/
function isWebRequest()
{
    return isset($_SERVER['HTTP_USER_AGENT']);
}

function pageHeader($title)
{
    $ret = "<!doctype html>
  <html>
  <head>
    <title>" . $title . "</title>
    <link href='styles/style.css' rel='stylesheet' type='text/css' />
  </head>
  <body>\n";
    if ($_SERVER['PHP_SELF'] != "/index.php") {
        $ret .= "<p><a href='index.php'>Back</a></p>";
    }
    $ret .= "<header><h1>" . $title . "</h1></header>";
    // Start the session (for storing access tokens and things)
    if (!headers_sent()) {
        session_start();
    }
    return $ret;
}

function pageFooter($file = null)
{
    $ret = "";
    if ($file) {
        $ret .= "<h3>Code:</h3>";
        $ret .= "<pre class='code'>";
        $ret .= htmlspecialchars(file_get_contents($file));
        $ret .= "</pre>";
    }
    $ret .= "</html>";
    return $ret;
}

function missingApiTokenWarning()
{
    $ret = "
    <h3 class='warn'>
      Warning: You need to set your API Token
      <a href='https://apps.ionic.io/apps' target='_blank'>Ionic Cloud Dashboard</a>
    </h3>";
    return $ret;
}

function getApiToken()
{
    $file = __DIR__ . '/../../test/.apiToken';
    if (file_exists($file)) {
        return file_get_contents($file);
    }
}

function setApiToken($apiToken)
{
    $file = __DIR__ . '/../../test/.apiToken';
    file_put_contents($file, $apiToken);
}