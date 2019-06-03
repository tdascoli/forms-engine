<?php
namespace FormsEngine;

require __DIR__ . '/../vendor/autoload.php';

use ParseCsv\Csv;
use MyCLabs\Enum;

session_start();
Form::open ("login");
    echo "<legend>Login</legend>";
    Form::Hidden ("id");
    Form::Email ("Email Address:", "email", array("required" => 1));
    Form::Password ("Password:", "password", array("required" => 1));
    Form::Checkbox ("", "remember", array("1" => "Remember me"));
    Form::Button ("Login");
    Form::Button ("Cancel", "button", array("onclick" => "history.go(-1);"));
Form::close (false);

?>
