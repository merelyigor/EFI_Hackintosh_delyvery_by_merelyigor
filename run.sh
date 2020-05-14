#!/bin/bash
#---------------------------------------------------
#======================== Run scripts PHP =======2.0
#---------------------------------------------------

rm -rf ~/Desktop/EFI_Hackintosh_delyvery_by_merelyigor
mkdir -p ~/Desktop/EFI_Hackintosh_delyvery_by_merelyigor
git clone git@github.com:merelyigor/EFI_Hackintosh_delyvery_by_merelyigor.git ~/Desktop/EFI_Hackintosh_delyvery_by_merelyigor

chmod +x ~/Desktop/EFI_Hackintosh_delyvery_by_merelyigor/php/console.php
chmod +x ~/Desktop/EFI_Hackintosh_delyvery_by_merelyigor/run.console.sh
chmod +x ~/Desktop/EFI_Hackintosh_delyvery_by_merelyigor/clear.sh

sh ~/Desktop/EFI_Hackintosh_delyvery_by_merelyigor/run.console.sh
