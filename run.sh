#!/bin/bash
#---------------------------------------------------
#======================== Run scripts PHP =======2.0
#---------------------------------------------------

# Папка куда падает скрипт и его файлы
export FOLDER_SCRIPT="$HOME/Downloads/EFI_Hackintosh_delyvery_by_merelyigor"


# trap ctrl-c and call ctrl_c() при нажатии на Ctrl+C в терминале вызывается функция ctrl_c()
trap ctrl_c INT

function ctrl_c() {
        rm -rf $FOLDER_SCRIPT
}

rm -rf $FOLDER_SCRIPT
mkdir $FOLDER_SCRIPT
git clone git@github.com:merelyigor/EFI_Hackintosh_delyvery_by_merelyigor.git $FOLDER_SCRIPT

chmod +x $FOLDER_SCRIPT/php/console.php
chmod +x $FOLDER_SCRIPT/run.console.sh
chmod +x $FOLDER_SCRIPT/clear.sh

sh $FOLDER_SCRIPT/run.console.sh
