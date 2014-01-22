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
	'name'           => 'Disable Special Pages',
	'version'        => '0.1.0',
	'author'         => 'Adam Shorland',
	'descriptionmsg' => 'Allows easy disabling of special pages',
	'url'            => 'https://www.github.com/addshore/DisableSpecialPages',
);

$wgHooks['SpecialPage_initList'][] = 'DisableSpecialPages::onSpecialPage_initList';

/**
 * Either an array of special pages or a string of value '*' to disable all
 * @var string[]|string $wgDisableSpecialPages
 */
$wgDisableSpecialPages = array();
/**
 * Array of groups to ignore disabled special pages for
 * @var string[] $wgDisableSpecialPagesIgnoreFor
 */
$wgDisableSpecialPagesIgnoreFor = array();

class DisableSpecialPages {

	/**
	 * @param array $aSpecialPages
	 */
	public static function onSpecialPage_initList( &$aSpecialPages ) {
		/** @var array $wgDisableSpecialPages */
		global $wgDisableSpecialPages;
		/** @var array $wgDisableSpecialPagesIgnoreFor */
		global $wgDisableSpecialPagesIgnoreFor;
		/** @var User $wgUser */
		global $wgUser;

		foreach( $wgDisableSpecialPagesIgnoreFor as $group ) {
			if( in_array( $group, $wgUser->getAllGroups() ) ) {
				return;
			}
		}

		if( is_array( $wgDisableSpecialPages ) ){
			foreach( $wgDisableSpecialPages as $specialPage ) {
				if( array_key_exists( strtolower( $specialPage ), array_change_key_case( $aSpecialPages ) ) ) {
					unset( $aSpecialPages[$specialPage] );
				}
			}
		} else if( is_string( $wgDisableSpecialPages ) && $wgDisableSpecialPages === '*' ) {
			$aSpecialPages = array();
		}

	}

}