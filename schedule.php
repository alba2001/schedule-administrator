<?php
/**
 * @package    Training schedule
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
 * @license    GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// Require the base controller

require_once( JPATH_COMPONENT.DS.'controller.php' );
// Load the helper class
require_once (JPATH_COMPONENT.DS.'helper.php');

// Load jQuery scripts
$document =& JFactory::getDocument();
$document->addScript('https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js');
$document->addScript(JURI::base().'components/com_schedule/assets/jquery.maskedinput-1.3.min.js');

// Require specific controller if requested
if($controller = JRequest::getWord('controller')) {
	$path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
	if (file_exists($path)) {
		require_once $path;
	} else {
		$controller = '';
	}
}

// Create the controller
$classname	= 'SchedulesController'.$controller;
$controller	= new $classname( );

// Perform the Request task
$controller->execute( JRequest::getVar( 'task' ) );

// Redirect if set by the controller
$controller->redirect();