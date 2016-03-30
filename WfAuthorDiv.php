<?php
# Alert the user that this is not a valid access point to MediaWiki if they try to access the special pages file directly.
if ( !defined( 'MEDIAWIKI' ) ) {
	exit( 1 );
}

$dir = dirname( __FILE__ );
 
$wgExtensionCredits['parserhook'][] = array(
	'path' => __FILE__,
	'name' => 'Wf Sample display',
	'descriptionmsg' => 'wfauthordiv-desc',
	'version' => '1.0',
	'author' => array( 'Pierre Boutet' ),
	'url' => 'https://www.wikifab.org'
);


$wgHooks['ParserFirstCallInit'][] = 'wfAuthorDivFunctions';

# Parser function to insert a link changing a tab.
function wfAuthorDivFunctions( $parser ) {
	$parser->setFunctionHook( 'displayAuthorDiv', array('WfAuthorDiv', 'addParser' ));
	//$parser->setFunctionTagHook('displayTutorialsList', array('WfAuthorDiv', 'addSampleParser' ), array());
	return true;
}
require_once(__DIR__ . "/includes/WfAuthorDiv.php");

$wgAutoloadClasses['WfAuthorDiv'] = __DIR__ . "/includes/WfAuthorDiv.php";
//$wgMessagesDirs['WfAuthorDiv'][] = __DIR__ . "/i18n"; 

// Allow translation of the parser function name
$wgExtensionMessagesFiles['WfAuthorDiv'] = __DIR__ . '/WfAuthorDiv.i18n.php';
