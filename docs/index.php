<?php
require __DIR__ . '/../vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use FormsEngine\FormsEngine;
use FormsEngine\Questions\Element;
use FormsEngine\Questions\Pagination\Page;

$engine = new FormsEngine();

$r = $engine->renderer();
// Page 1
$r->add(new Element\Title(L::title));
$r->add(new Element\Email('new label 2','','helptext'));
$cb = new Element\Option();
$cb->add('first',1);
$cb->add('second',2);
$cb->add('third',3);
$r->add(new Element\CheckboxGroup('Checkbox Group',$cb));
$cb2 = new Element\Option();
$cb2->add('first2',1);
$cb2->add('second2',2);
$cb2->add('third2',3);
$r->add(new Element\RadioGroup('Radio Group',$cb2));
$r->add(new Element\Typeahead('typeahead',array('first','second','third','fourth'),'placeholder','helptext to show'));


$serializedString = $r->serialize();
$serializedObject = \json_decode($serializedString);

// Page 2
$p = new Page();
$p->add(new Element\Paragraph('test title2','Description'));
$p->addRequired(new Element\Textarea('new label','','helptext'));
$p->add(new Element\YesNo('yesno'));
$options = new Element\Option();
$options->add('first',1);
$options->add('second',2);
$options->add('third',3);
$p->add(new Element\Select('custom select',$options,true,'select helptext to show'));
// add Page 2
$r->addPage($p);

setcookie("jsonForm", $serializedString, time()+300);

$_SESSION["sessionForm"] = $serializedString;
?>
<!DOCTYPE html>
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

    <!-- FormsEngine JS + deps -->
    <script src="js/formsEngine.pagination.js"></script>
    <script src="js/ajax.js"></script>
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
                <li class="nav-item">
                    <a class="nav-link" href="form.php?form=test">Form (API)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="form.php">Form</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- content -->
<div class="container">
    <h3 class="mt-3">FormsEngine</h3>
    <p>
      <pre><?= $serializedString ?></pre>
      <ul>
        <li>$serializedString isString <?= is_string($serializedString) ?></li>
        <li>$serializedObject isObject <?= is_object($serializedObject) ?></li>
      </ul>
    </p>
    <?php
      $r->render();
    ?>
</div>

</body>
</html>
