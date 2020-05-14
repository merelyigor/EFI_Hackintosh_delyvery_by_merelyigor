#!/bin/bash
#---------------------------------------------------
#======================== Run scripts PHP =======2.0
#---------------------------------------------------

# trap ctrl-c and call ctrl_c()
trap ctrl_c INT

function ctrl_c() {
        rm -rf ~/Desktop/qwerty
}

cd ~/Downloads/EFI_Hackintosh_delyvery_by_merelyigor/php/ || exit
./console.php