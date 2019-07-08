<?php

require __DIR__ . '/../vendor/autoload.php';

session_start();

// here session -> formsengine!!
if (isset($_SESSION['formsengine'])){
    $formsengine = unserialize($_SESSION['formsengine']);

    // if ....??
    // only answers??
    //$formsengine->save();

    echo json_encode('ok');
}
else {
    echo json_encode('nok');
}
?>