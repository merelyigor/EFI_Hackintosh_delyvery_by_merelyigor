<?php
/**
 * клас для создания bash команд и их выполнения или обработки
 *
 * @param string $command = команда на bash
 *
 * @return string $bash_return = результат выполнения bash команды
 * @return string $shell_return = результат выполнения bash команды
 */
class My_bash_class
{
    public function bash($command)
    {
        $shell_return = system($command);
        return $shell_return;
    }

    public function EEF($text)
    {
        echo "{$text}" . PHP_EOL;
    }

    public function bash_escapeshellarg($command)
    {
        $bash_return = system(escapeshellarg($command));
        return $bash_return;
    }
}

$bash = new My_bash_class();
$bash->bash("clear");
$bash->EEF("

           ▄████████ ▀████    ▐████▀  ▄█      ███     
          ███    ███   ███▌   ████▀  ███  ▀█████████▄ 
          ███    █▀     ███  ▐███    ███▌    ▀███▀▀██ 
         ▄███▄▄▄        ▀███▄███▀    ███▌     ███   ▀ 
        ▀▀███▀▀▀        ████▀██▄     ███▌     ███     
          ███    █▄    ▐███  ▀███    ███      ███     
          ███    ███  ▄███     ███▄  ███      ███     
          ██████████ ████       ███▄ █▀      ▄████▀   
                                              

");