<?php
/**
 * Visit Model for Schedule Component
 * 
 * @package    Training schedule
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

/**
 * Visit Schedule Model
 *
 * @package    Training schedule
 * @subpackage Components
 */
class SchedulesModelVisit extends JModel
{
	/**
	 * Constructor that visit the ID from the request
	 *
	 * @access	public
	 * @return	void
	 */
	function __construct()
	{
		parent::__construct();

		$array = JRequest::getVar('cid',  0, '', 'array');
		$this->setId((int)$array[0]);
	}

	/**
	 * Method to set the visit identifier
	 *
	 * @access	public
	 * @param	int Visit identifier
	 * @return	void
	 */
	function setId($id)
	{
		// Set id and wipe data
		$this->_id		= $id;
		$this->_data	= null;
	}

	/**
	 * Method to get a visit
	 * @return object with data
	 */
	function &getData()
	{
		// Load the data
		if (empty( $this->_data )) {
			$query = ' SELECT * FROM #__schedule_visit '.
					'  WHERE id = '.$this->_id;
			$this->_db->setQuery( $query );
			$this->_data = $this->_db->loadObject();
		}
		if (!$this->_data) {
			$this->_data = new stdClass();
			$this->_data->id = 0;
			$this->_data->client_id = 0;
			$this->_data->calendar_id = 0;
			$this->_data->training_type_id = 0;
			$this->_data->registered = 0;
			$this->_data->visited = 0;
			$this->_data->phone = null;
			$this->_data->deleted = 0;
		}
		return $this->_data;
	}

	/**
	 * Method to store a record
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	function store()
	{	
		$row =& $this->getTable();

		$data = JRequest::get( 'post' );

		// Bind the form fields to the schedule table
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Make sure the schedule record is valid
		if (!$row->check()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Store the web link table to the database
		if (!$row->store()) {
			$this->setError( $this->_db->getErrorMsg() );
			return false;
		}

		return true;
	}

	/**
	 * Method to delete record(s)
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	function delete()
	{
		$cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );

		$row =& $this->getTable();

		if (count( $cids )) {
			foreach($cids as $cid) {
				if (!$row->delete( $cid )) {
					$this->setError( $row->getErrorMsg() );
					return false;
				}
			}
		}
		return true;
	}

        /**
         * Делаем отметку о визите
         * @param str - visit|unvisit
         */
        function store_visit($task)
        {
            $id = jRequest::getInt('id');
            $visits = &$this->getTable('visits');
            $row = $visits->get_row(array('id'=>$id));
            $row['visited'] = $task?1:0;
            if(!$visits->store_data($row))
            {
                return (array(0,'Id='.$id.'; Task='.$row['visited'] = $task?'visited':'unvisited'));
            }
            return (array(1,'Id='.$id.'; Task='.$row['visited'] = $task?'visited':'unvisited'));
        }
}