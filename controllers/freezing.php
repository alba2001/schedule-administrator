<?php
/**
 * Freezing Controller for Schedule Component
 * 
 * @package    Training schedule
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Freezing Controller
 *
 * @package    Training schedule
 * @subpackage Components
 */
class SchedulesControllerFreezing extends SchedulesController
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	function __construct()
	{
		parent::__construct();

		// Register Extra tasks
		$this->registerTask( 'add'  , 	'edit' );
	}

	/**
	 * display the edit form
	 * @return void
	 */
	function edit()
	{
		JRequest::setVar( 'view', 'freezing' );
		JRequest::setVar( 'layout', 'form'  );
		JRequest::setVar('hidemainmenu', 1);

		parent::display();
	}

	/**
	 * save a record (and redirect to main page)
	 * @return void
	 */
	function save()
	{
		$model = $this->getModel('freezing');

		if ($model->store()) {
			$msg = JText::_( 'Freezing Saved!' );
		} else {
			$msg = JText::_( 'Error Saving Freezing' );
		}

		// Check the table in so it can be edited.... we are done with it anyway
		$link = 'index.php?option=com_schedule&view=freezings';
		$this->setRedirect($link, $msg);
	}

	/**
	 * remove record(s)
	 * @return void
	 */
	function remove()
	{
		$model = $this->getModel('freezing');
		if(!$model->delete()) {
			$msg = JText::_( 'Error: One or More Freezings Could not be Deleted' );
		} else {
			$msg = JText::_( 'Freezing(s) Deleted' );
		}

		$this->setRedirect( 'index.php?option=com_schedule&view=freezings', $msg );
	}

	/**
	 * cancel editing a record
	 * @return void
	 */
	function cancel()
	{
		$msg = JText::_( 'Operation Cancelled' );
		$this->setRedirect( 'index.php?option=com_schedule&view=freezings', $msg );
	}
}