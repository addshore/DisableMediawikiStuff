<?php
/**
 * @author Adam Shorland
 * @license GPL v2 or later
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'This file is a MediaWiki extension, it is not a valid entry point' );
}

$wgExtensionCredits['other'][] = array(
	'path'           => __FILE__,
	'name'           => 'Disable Mediawiki Stuff',
	'version'        => 'dev',
	'author'         => 'Adam Shorland',
	'descriptionmsg' => 'Allows easy disabling of various mediawiki stuff',
	'url'            => 'https://www.github.com/addshore/DisableMediawikiStuff',
);

$wgDisableSpecialPage = array();

$wgHooks['SpecialPage_initList'][] = 'DisableMediawikiStuff::onSpecialPage_initList';

class DisableMediawikiStuff {

	/**
	 * @param array $aSpecialPages
	 */
	public static function onSpecialPage_initList( &$aSpecialPages ) {
		global $wgDisableSpecialPage;
		foreach( $wgDisableSpecialPage as $page ) {
			if( array_key_exists( $page, $aSpecialPages ) ) {
				unset( $aSpecialPages[$page] );
			}
		}
	}

}