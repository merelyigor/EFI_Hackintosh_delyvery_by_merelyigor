#!/bin/bash
#---------------------------------------------------
#======================== Run scripts PHP =======2.0
#---------------------------------------------------

rm -rf ~/Desktop/test/Lybrary/
rm -rf ~/Desktop/test/console.php

cp -r ~/GitHub/MY\ HACKINTOS\ EFI-FILES/EFI_delyvery_by_merelyigor/php/Lybrary/ ~/Desktop/test/Lybrary/ || exit
cp -r ~/GitHub/MY\ HACKINTOS\ EFI-FILES/EFI_delyvery_by_merelyigor/php/console.php ~/Desktop/test/console.php || exit

chmod +x ~/Desktop/test/console.php

#./console.php
