#!/bin/bash
#---------------------------------------------------
#======================== Run scripts PHP =======2.0
#---------------------------------------------------

rm -rf ~/Desktop/test/
mkdir -p ~/Desktop/test/

cp -r ~/GitHub/MY\ HACKINTOS\ EFI-FILES/Script-install-EFI-B360M-A_i3-9100F_RX580/php/Lybrary/ ~/Desktop/test/Lybrary/ || exit
cp -r ~/GitHub/MY\ HACKINTOS\ EFI-FILES/Script-install-EFI-B360M-A_i3-9100F_RX580/php/console.php ~/Desktop/test/console.php || exit

chmod +x ~/Desktop/test/console.php

cd ~/Desktop/test/ || exit

./console.php
