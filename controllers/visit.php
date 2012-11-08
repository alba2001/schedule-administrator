<?php
/**
 * Visit Controller for Schedule Component
 * 
 * @package    Training schedule
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Visit Controller
 *
 * @package    Training schedule
 * @subpackage Components
 */
class SchedulesControllerVisit extends SchedulesController
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
		JRequest::setVar( 'view', 'visit' );
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
		$model = $this->getModel('visit');

		if ($model->store()) {
			$msg = JText::_( 'Visit Saved!' );
		} else {
			$msg = JText::_( 'Error Saving Visit' );
		}

		// Check the table in so it can be edited.... we are done with it anyway
		$link = 'index.php?option=com_schedule&view=visits';
		$this->setRedirect($link, $msg);
	}

	/**
	 * remove record(s)
	 * @return void
	 */
	function remove()
	{
		$model = $this->getModel('visit');
		if(!$model->delete()) {
			$msg = JText::_( 'Error: One or More Visits Could not be Deleted' );
		} else {
			$msg = JText::_( 'Visit(s) Deleted' );
		}

		$this->setRedirect( 'index.php?option=com_schedule&view=visits', $msg );
	}

	/**
	 * cancel editing a record
	 * @return void
	 */
	function cancel()
	{
		$msg = JText::_( 'Operation Cancelled' );
		$this->setRedirect( 'index.php?option=com_schedule&view=visits', $msg );
	}
        /**
         *  Store visited information
         */
        function set_visited()
        {
            $this->store_visit(TRUE);
        }
        /**
         *  Store unvisited information
         */
        function unset_visited()
        {
            $this->store_visit(FALSE);
        }
        /**
         *  Store visited information
         */
        function store_visit($task)
        {
            $model = $this->getModel('visit');
            list($status,$text) = $model->store_visit($task);
            $data['status'] = $status;
            $data['text'] = $text;
            echo json_encode($data);
            exit;
        }
}