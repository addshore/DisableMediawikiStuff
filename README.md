DisableSpecialPages
=====================

Mediawiki Extension to disable special pages!

To Install add the following to the bottom of your LocalSettings.php

 > require_once( "$IP/extensions/DisableSpecialPages/DisableSpecialPages.php" );

Then decide what special pages you wish to disable and add them to the array as below...

 > $wgDisableSpecialPages = array( 'Longpages', 'Recentchanges' );

To see a list of special pages see .aSpecialPages