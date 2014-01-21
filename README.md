DisableMediawikiStuff
=====================


Mediawiki Extension


Example Use:


 > require_once( "$IP/extensions/DisableMediawikiStuff/DisableMediawikiStuff.php" );
 >
 > $wgDisableSpecialPage = array(
 >      'Newpages',
 >      'Longpages',
 > );