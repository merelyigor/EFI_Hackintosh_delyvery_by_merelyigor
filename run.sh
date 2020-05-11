#!/bin/bash
#---------------------------------------------------
#======================== Run scripts PHP =======2.0
#---------------------------------------------------

rm -rf ~/EFI_Hackintosh_delyvery_by_merelyigor
mkdir -p ~/EFI_Hackintosh_delyvery_by_merelyigor
git clone git@github.com:merelyigor/EFI_Hackintosh_delyvery_by_merelyigor.git ~/EFI_Hackintosh_delyvery_by_merelyigor

chmod +x ~/EFI_Hackintosh_delyvery_by_merelyigor/php/console.php
chmod +x ~/EFI_Hackintosh_delyvery_by_merelyigor/run.console.sh
chmod +x ~/EFI_Hackintosh_delyvery_by_merelyigor/clear.sh

sh ~/EFI_Hackintosh_delyvery_by_merelyigor/run.console.sh