<?php

require __DIR__ . '/../vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use FormsEngine\FormsEngine;
use FormsEngine\Questions\Element;
use FormsEngine\Questions\Pagination\Page;

$config = array(
  'key' => 'configFile',
  'value' => __DIR__ . '/config.json'
);

$engine = new FormsEngine($config);

$r = $engine->renderer();
// Page 1
$r->add(new Element\Title('test title'));
$r->add(new Element\Text('new label','','helptext'));
$cb = new Element\Option();
$cb->add('first',1);
$cb->add('second',2);
$r->add(new Element\CheckboxGroup('Checkbox Group',$cb));
$cb2 = new Element\Option();
$cb2->add('first2',1);
$cb2->add('second2',2);
$r->add(new Element\RadioGroup('Radio Group',$cb2));
?>
<!doctype html>
<html lang="de">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FormsEngine</title>

    <meta name="theme-color" content="#ffffff">
    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="icon.png">

    <!-- CSS -->
    <!-- Add Material font (Roboto) and Material icon as needed -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i|Roboto+Mono:300,400,700|Roboto+Slab:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Add Material CSS, replace Bootstrap CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daemonite-material@4.1.1/css/material.min.css">

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
      src="https://code.jquery.com/jquery-3.4.1.min.js"
      integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
      crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <!-- Then Material JavaScript on top of Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/daemonite-material@4.1.1/js/material.min.js"></script>

    <!-- validation -->
    <script src="https://cdn.jsdelivr.net/npm/parsleyjs@2.9.1/dist/parsley.min.js"></script>

    <!-- FormsEngine CSS -->
    <!-- styles:css -->
    <link rel="stylesheet" href="css/formsEngine.typeahead.css">
    <!-- endinject -->
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="index.php">FormsEngine</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Documentation</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- content -->
<div class="container">
    <?php
        $r->render();
    ?>
    <button type="button" onclick="test()">test</button>
</div>

<!-- FormsEngine JS -->
<!-- inject:js -->
<script src="js/formsEngine.pagination.min.js"></script>
<!-- endinject -->
</body>
</html>
