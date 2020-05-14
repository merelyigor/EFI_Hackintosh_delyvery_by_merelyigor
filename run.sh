#!/bin/bash
#---------------------------------------------------
#======================== Run scripts PHP =======2.0
#---------------------------------------------------

rm -rf ~/Downloads/EFI_Hackintosh_delyvery_by_merelyigor
mkdir ~/Downloads/EFI_Hackintosh_delyvery_by_merelyigor
git clone git@github.com:merelyigor/EFI_Hackintosh_delyvery_by_merelyigor.git ~/Downloads/EFI_Hackintosh_delyvery_by_merelyigor

chmod +x ~/Downloads/EFI_Hackintosh_delyvery_by_merelyigor/php/console.php
chmod +x ~/Downloads/EFI_Hackintosh_delyvery_by_merelyigor/run.console.sh
chmod +x ~/Downloads/EFI_Hackintosh_delyvery_by_merelyigor/clear.sh

sh ~/Downloads/EFI_Hackintosh_delyvery_by_merelyigor/run.console.sh
