<?php
session_start();

require __DIR__ . '/../vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use FormsEngine\Config;

$configJson = '{
    "templateDir":"/Session/Templates/",
    "langDir":"/Session/Translations/",
    "form" : {
        "dir":"/docs/forms/",
        "name":"Session",
        "method":"ajax",
        "messageAfterSubmit":true,
        "createAnother":true,
        "addTimestamp":false
    },
    "render" : {
        "load":"COOKIE",
        "config": {
          "cookie":"jsonForm"
        }
    },
    "persistence" : {
        "email": {
            "emailTo":"test@test.test"
        },
        "externalConfigs": []
    }
}';

$_SESSION['configJson'] = $configJson;

$config = unserialize($_SESSION['config']);

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="initial-scale=1, shrink-to-fit=no, width=device-width" name="viewport">

    <title>FormsEngine</title>

    <!-- CSS -->
    <!-- Add Material font (Roboto) and Material icon as needed -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i|Roboto+Mono:300,400,700|Roboto+Slab:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Add Material CSS, replace Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daemonite-material@4.1.1/css/material.min.css">

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <!-- Then Material JavaScript on top of Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/daemonite-material@4.1.1/js/material.min.js"></script>

</head>
<body>

<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <span class="navbar-brand">FormsEngine <small>Config2</small></span>
    </div>
</nav>

<!-- content -->
<div class="container">
    <h5><?= Config::getInstance()->get('templateDir') ?></h5>
    <h5><?= $config->get('templateDir') ?></h5>
    <p>
    <?php
        var_dump(Config::getInstance());
    ?>
    </p>
    <hr />
    <p>
    <?php
        var_dump($config);
    ?>
    </p>
</div>

</body>
</html>