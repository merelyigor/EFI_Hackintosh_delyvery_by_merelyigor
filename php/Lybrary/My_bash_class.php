<?php


namespace My_bash_class;


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
        return $text;
    }

    public function bash_escapeshellarg($command)
    {
        $bash_return = system(escapeshellarg($command));
        return $bash_return;
    }
}