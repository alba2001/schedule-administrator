<?php
/**
 * Trainer Controller for Schedule Component
 * 
 * @package    Training schedule
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Trainer Controller
 *
 * @package    Training schedule
 * @subpackage Components
 */
class SchedulesControllerTrainer extends SchedulesController
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
		JRequest::setVar( 'view', 'trainer' );
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
		$model = $this->getModel('trainer');

		if ($model->store()) {
			$msg = JText::_( 'Trainer Saved!' );
		} else {
			$msg = JText::_( 'Error Saving Trainer' );
		}

		// Check the table in so it can be edited.... we are done with it anyway
		$link = 'index.php?option=com_schedule&view=trainers';
		$this->setRedirect($link, $msg);
	}

	/**
	 * remove record(s)
	 * @return void
	 */
	function remove()
	{
		$model = $this->getModel('trainer');
		if(!$model->delete()) {
			$msg = JText::_( 'Error: One or More Trainers Could not be Deleted' );
		} else {
			$msg = JText::_( 'Trainer(s) Deleted' );
		}

		$this->setRedirect( 'index.php?option=com_schedule&view=trainers', $msg );
	}

	/**
	 * cancel editing a record
	 * @return void
	 */
	function cancel()
	{
		$msg = JText::_( 'Operation Cancelled' );
		$this->setRedirect( 'index.php?option=com_schedule&view=trainers', $msg );
	}
}