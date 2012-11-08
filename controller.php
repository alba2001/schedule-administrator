<?php
/**
 * Schedule default controller
 * 
 * @package    Training schedule
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

/**
 * Schedule Component Controller
 *
 * @package    Training schedule
 * @subpackage Components
 */
class SchedulesController extends JController
{
	/**
	 * Method to display the view
	 *
	 * @access	public
	 */
	function display($cachable = false) 
	{
		// set default view if not set
		JRequest::setVar('view', JRequest::getCmd('view', 'clients'));
 
		// call parent behavior
		parent::display($cachable);
 
	}
}