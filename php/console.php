#!/usr/bin/php
<?php
include_once "Lybrary/My_bash_class.php";
include_once "Lybrary/exit_program.php";
include_once "Lybrary/error-input.php";
include_once "Lybrary/start-language.php";
include_once "Lybrary/ru/main.php";
include_once "Lybrary/ru/start.php";
use My_bash_class\My_bash_class;
$bash = new My_bash_class();

start_choice_language();

end_program("Программа завершила работу успешно. ");

