DisableSpecialPages
=====================

Mediawiki Extension to disable special pages!

To Install add the following to the bottom of your LocalSettings.php

 > require_once( "$IP/extensions/DisableSpecialPages/DisableSpecialPages.php" );

Then decide what special pages you wish to disable and add them to the array as below...
To see a list of special pages see .aSpecialPages

 > $wgDisableSpecialPages = array( 'Longpages', 'Recentchanges' );

To allow certain user groups to see all special pages add the groups to $wgDisableSpecialPagesIgnoreFor

 > $wgDisableSpecialPagesIgnoreFor = array( 'sysop' );