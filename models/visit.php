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
		$this->_id	= $id;
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
		return $this->getTable('visits')->store_data();
	}

	/**
	 * Method to delete record(s)
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	function delete()
	{
            return $this->getTable('visits')->delete_rows();
	}
	/**
	 * Имя занятия
	 *
	 * @access	public
	 * @return	string
	 */
	function get_calendar_name($calendar_id=NULL)
	{
            $calendar_name = '';
            if(!isset($calendar_id))
            {
                $calendar_id = JRequest::getInt('filter_calendar', NULL );
            }
            if(isset($calendar_id))
            {
                $calendar = $this->getTable('calendar')
                            ->get_row(array('id'=>$calendar_id));
                preg_match("/([0-9]{4})-([0-9]{2})-([0-9]{2})/", $calendar['date'], $regs);
                $calendar_name = $regs[3].'.'.$regs[2].'.'.$regs[1];
                $calendar_name .= ' ('.substr($calendar['time_start'],0,5);
                $calendar_name .= ') '.sh_helper::get_training($calendar['training_id']);
            }
            return $calendar_name;
	}
        /**
         * Возвращает номер телефона клиента
         * @return string
         */
        public function get_phone($client_id=0)
        {
            $phone = '';
            
            if($client_id)
            {
                $row = $this->getTable('clients')
                        ->get_row(array('id'=>$client_id));
                $phone = $row['phone'];
            }
            return $phone;
        }
}