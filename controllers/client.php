<?php
/**
 * Client Controller for Schedule Component
 * 
 * @package    Training schedule
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Client Controller
 *
 * @package    Training schedule
 * @subpackage Components
 */
class SchedulesControllerClient extends SchedulesController
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
		JRequest::setVar( 'view', 'client' );
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
		$model = $this->getModel('client');

		if ($model->store()) {
			$msg = JText::_( 'Client Saved!' );
		} else {
			$msg = JText::_( 'Error Saving Client' );
		}

		// Check the table in so it can be edited.... we are done with it anyway
		$link = 'index.php?option=com_schedule&view=clients';
		$this->setRedirect($link, $msg);
	}

	/**
	 * remove record(s)
	 * @return void
	 */
	function remove()
	{
		$model = $this->getModel('client');
		if(!$model->delete()) {
			$msg = JText::_( 'Error: One or More Clients Could not be Deleted' );
		} else {
			$msg = JText::_( 'Client(s) Deleted' );
		}

		$this->setRedirect( 'index.php?option=com_schedule&view=clients', $msg );
	}

	/**
	 * cancel editing a record
	 * @return void
	 */
	function cancel()
	{
		$msg = JText::_( 'Operation Cancelled' );
		$this->setRedirect( 'index.php?option=com_schedule&view=clients', $msg );
	}
}