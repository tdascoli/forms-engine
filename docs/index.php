<?php

require __DIR__ . '/../vendor/autoload.php';

use FormsEngine\Renderer\Renderer as Renderer;
use FormsEngine\Renderer\Element as Element;

$r = new Renderer();
$r->add(new Element\Text('test label','placeholder','helptext'));
$r->add(new Element\Email('new label','','helptext'));
$r->add(new Element\Number('other label'));
$r->add(new Element\Date('test date','placeholder'));
$r->add(new Element\DateTime('test datetime','placeholder'));
$r->add(new Element\Checkbox('custom checkbox label', true));
$r->add(new Element\Radio('Yes (custom)', 'yes', 'yesno'));
$r->add(new Element\Radio('No (custom)', 'no', 'yesno'));
$r->add(new Element\YesNo('yesno2'));
$r->add(new Element\YesNo('yesno3',true));

$options = new Element\Option();
$options->add('first',1);
$options->add('second',2);
$options->add('third',3);
$r->add(new Element\Select('custom select',$options,true,'select helptext to show'));

$r->add(new Element\Button('send',true));
$r->add(new Element\Button('cancel'));

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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daemonite-material@4.1.1/css/material.min.css">
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
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Documentation <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- content -->
<div class="container">
    <h3 class="mt-3">FormsEngine</h3>
    <p>
      <?php
        $r->render();
      ?>
    </p>
</div>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<!-- Then Material JavaScript on top of Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/daemonite-material@4.1.1/js/material.min.js"></script>
</body>
</html>
