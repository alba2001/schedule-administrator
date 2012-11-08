<?php
/**
 * Training Controller for Schedule Component
 * 
 * @package    Training schedule
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Training Controller
 *
 * @package    Training schedule
 * @subpackage Components
 */
class SchedulesControllerTraining extends SchedulesController
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
		JRequest::setVar( 'view', 'training' );
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
		$model = $this->getModel('training');

		if ($model->store()) {
			$msg = JText::_( 'Training Saved!' );
		} else {
			$msg = JText::_( 'Error Saving Training' );
		}

		// Check the table in so it can be edited.... we are done with it anyway
		$link = 'index.php?option=com_schedule&view=trainings';
		$this->setRedirect($link, $msg);
	}

	/**
	 * remove record(s)
	 * @return void
	 */
	function remove()
	{
		$model = $this->getModel('training');
		if(!$model->delete()) {
			$msg = JText::_( 'Error: One or More Trainings Could not be Deleted' );
		} else {
			$msg = JText::_( 'Training(s) Deleted' );
		}

		$this->setRedirect( 'index.php?option=com_schedule&view=trainings', $msg );
	}

	/**
	 * cancel editing a record
	 * @return void
	 */
	function cancel()
	{
		$msg = JText::_( 'Operation Cancelled' );
		$this->setRedirect( 'index.php?option=com_schedule&view=trainings', $msg );
	}
	/**
	 * cancel editing a record
	 * @return void
	 */
	function fill_calendar()
	{
		$model = $this->getModel('training');

		if ($model->auto_store_calendar()) {
			$msg = JText::_( 'Calendar filled!' );
		} else {
			$msg = JText::_( 'Error Filling Calendar' );
		}

		$link = 'index.php?option=com_schedule&view=trainings';
		$this->setRedirect($link, $msg);
	}
}