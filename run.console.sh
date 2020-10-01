#!/bin/bash
#---------------------------------------------------
#======================== Run scripts PHP =======2.0
#---------------------------------------------------

# trap ctrl-c and call ctrl_c() при нажатии на Ctrl+C в терминале вызывается функция ctrl_c()
#trap ctrl_c INT
#
#function ctrl_c() {
#        rm -rf ~/Downloads/EFI_Hackintosh_delyvery_by_merelyigor
#}

cd $FOLDER_SCRIPT/php/ || exit
./console.php