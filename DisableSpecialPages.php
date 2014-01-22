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

$wgHooks['SpecialPage_initList'][] = 'DisableSpecialPagesHooks::onSpecialPage_initList';

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

class DisableSpecialPagesHooks {

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

		if( !self::currentUserCanBeSkipped( $wgUser, $wgDisableSpecialPagesIgnoreFor ) ) {
			self::disableSpecialPages( $aSpecialPages, $wgDisableSpecialPages );
		}
	}

	/**
	 * @param User $wgUser
	 * @param array $groupsToIgnore

	 * @return bool
	 */
	private static function currentUserCanBeSkipped( $wgUser, $groupsToIgnore ) {
		foreach( $groupsToIgnore as $group ) {
			if( in_array( $group, $wgUser->getAllGroups() ) ) {
				return true;
			}
		}
		return false;
	}

	private static function disableSpecialPages( &$aSpecialPages, $wgDisableSpecialPages ) {
		if( is_array( $wgDisableSpecialPages ) ){
			self::disableSpecialPagesInArray( $aSpecialPages, $wgDisableSpecialPages );
		} else if( is_string( $wgDisableSpecialPages ) && $wgDisableSpecialPages === '*' ) {
			self::disableAllSpecialPages( $aSpecialPages );
		}
	}

	private static function disableSpecialPagesInArray( &$aSpecialPages, $toDisable ) {
		foreach( $toDisable as $specialPage ) {
			if( array_key_exists( strtolower( $specialPage ), array_change_key_case( $aSpecialPages ) ) ) {
				unset( $aSpecialPages[$specialPage] );
			}
		}
	}

	private static function disableAllSpecialPages( &$aSpecialPages ) {
		$aSpecialPages = array();
	}

}