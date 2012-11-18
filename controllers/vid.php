<?php
/**
 * Vid Controller for Schedule Component
 * 
 * @package    Vid schedule
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Vid Controller
 *
 * @package    Vid schedule
 * @subpackage Components
 */
class SchedulesControllerVid extends SchedulesController
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
		JRequest::setVar( 'view', 'vid' );
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
		$model = $this->getModel('vid');

		if ($model->store()) {
			$msg = JText::_( 'Vid Saved!' );
		} else {
			$msg = JText::_( 'Error Saving Vid' );
		}

		// Check the table in so it can be edited.... we are done with it anyway
		$link = 'index.php?option=com_schedule&view=vids';
		$this->setRedirect($link, $msg);
	}

	/**
	 * remove record(s)
	 * @return void
	 */
	function remove()
	{
		$model = $this->getModel('vid');
		if(!$model->delete()) {
			$msg = JText::_( 'Error: One or More Vids Could not be Deleted' );
		} else {
			$msg = JText::_( 'Vid(s) Deleted' );
		}

		$this->setRedirect( 'index.php?option=com_schedule&view=vids', $msg );
	}

	/**
	 * cancel editing a record
	 * @return void
	 */
	function cancel()
	{
		$msg = JText::_( 'Operation Cancelled' );
		$this->setRedirect( 'index.php?option=com_schedule&view=vids', $msg );
	}
	/**
	 * cancel editing a record
	 * @return void
	 */
	function fill_calendar()
	{
		$model = $this->getModel('vid');

		if ($model->auto_store_calendar()) {
			$msg = JText::_( 'Calendar filled!' );
		} else {
			$msg = JText::_( 'Error Filling Calendar' );
		}

		$link = 'index.php?option=com_schedule&view=vids';
		$this->setRedirect($link, $msg);
	}
}