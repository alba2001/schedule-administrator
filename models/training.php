<?php
/**
 * Training Model for Schedule Component
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
 * Training Schedule Model
 *
 * @package    Training schedule
 * @subpackage Components
 */
class SchedulesModelTraining extends JModel
{
	/**
	 * Constructor that training the ID from the request
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
	 * Method to set the training identifier
	 *
	 * @access	public
	 * @param	int Training identifier
	 * @return	void
	 */
	function setId($id)
	{
		// Set id and wipe data
		$this->_id		= $id;
		$this->_data	= null;
	}

	/**
	 * Method to get a training
	 * @return object with data
	 */
	function &getData()
	{
		// Load the data
		if (empty( $this->_data )) {
			$query = ' SELECT * FROM #__schedule_trainings '.
					'  WHERE id = '.$this->_id;
			$this->_db->setQuery( $query );
			$this->_data = $this->_db->loadObject();
		}
		if (!$this->_data) {
			$this->_data = new stdClass();
			$this->_data->id = 0;
			$this->_data->trainer_id = 0;
			$this->_data->name = null;
			$this->_data->week_day = null;
			$this->_data->time_start = null;
			$this->_data->time_stop = null;
			$this->_data->date_start = null;
			$this->_data->date_stop = null;
			$this->_data->max_clients = null;
			$this->_data->training_link = null;
		}
		return $this->_data;
	}

	/**
	 * Method to save a record with calendar records
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	function store()
	{	
            $table = 'trainings';
            $data = JRequest::get( 'post' );
            if (!$this->_store($table, $data))
            {
                return FALSE;
            }
            return TRUE;
        }
        
	/**
	 * Method to store calendar records
	 *
         * @param       array   of training data
	 * @access	public
	 * @return	boolean	True on success
	 */
        private function _store_calendar($data)
        {
            $table = 'calendar';
            $calendar['training_id'] = $data['training_id'];
            $calendar['trainer_id'] = $data['trainer_id'];
            $calendar['training_status_id'] = '1';
            $calendar['time_start'] = $data['time_start'];
            $calendar['time_stop'] = $data['time_stop'];
            $calendar['max_clients'] = $data['max_clients'];
            $date_stop = date('Y-m-d',  strtotime('+2 week', time())); // расписание формируется не больше, чем на 2-е недели с текущей даты
            if($data['date_stop'])
            {
                $date_stop = $date_stop<$data['date_stop']?$date_stop:$data['date_stop'];
            }
            // Вычисляем ближайший нужный день недели
            // который идет после даты старта
            list($year, $month, $day) = explode('-', $data['date_start']);
            $time_start = mktime(0, 0, 0, $month, $day, $year);
            $week_day_now = date('w', $time_start);
            $shift = $data['week_day']-$week_day_now>=0?$data['week_day']-$week_day_now:$data['week_day']-$week_day_now+7;
            $date = date('Y-m-d',  strtotime('+'.$shift.' day', $time_start));
            while($date <= $date_stop)
            {
                $calendar['date'] = $date;
                // Если еще нет записи о занятиии
                if (!$this->_find_calendar($calendar))
                {
                    // Если если не смогли сохранить запись в календаре
                    if (!$this->_store($table, $calendar))
                    {
                        return FALSE;
                    }
                }
                // интервал занятий - 1-а неделя с даты начала занятий
                list($year, $month, $day) = explode('-', $date);
                $time =  mktime(0, 0, 0, $month, $day, $year);
                $date = date('Y-m-d',  strtotime('+1 week', $time));
            }
            return TRUE;
        }
	/**
	 * Method to find a record in the calendar table
	 *
         * @param       array
	 * @access	public
	 * @return	boolean	True on success
	 */
        private function _find_calendar($calendar)
        {
            $where[] = 'date = "'.$calendar['date'].'"';
            $where[] = 'time_start = "'.$calendar['time_start'].'"';
            $where[] = 'time_stop = "'.$calendar['time_stop'].'"';
            $query = ' SELECT id FROM #__schedule_calendar '.
                            '  WHERE '.implode(' AND ', $where);
//            var_dump($query);exit;
            $this->_db->setQuery( $query );
            return $this->_db->loadResult();
        }

        /**
	 * Method to store a record
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	private function _store($table, $data)
	{	
		$row =& $this->getTable($table);

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
                        var_dump($this->_db->getErrorMsg());exit;
			return false;
		}

		return $row->id;
	}

	/**
	 * Method to store calendar records for form rtaining
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	function auto_store_calendar($all=FALSE)
	{
            $row =& $this->getTable('trainings');
            if($all)
            {
                $cids = $row->get_column(array('published'=>'1'),'id');
            }
            else
            {
		$cids = JRequest::getVar( 'cid', NULL, 'post', 'array' );
                $data = array();
            }

            if (isset($cids)) 
            {
                    foreach($cids as $cid) {
                            if ($row->load( $cid )) 
                            {
                                unset($data);
                                $data['training_id'] = $row->id;
                                $data['trainer_id'] = $row->trainer_id;
                                $data['time_start'] = $row->time_start;
                                $data['time_stop'] = $row->time_stop;
                                $data['date_stop'] = $row->date_stop;
                                $data['max_clients'] = $row->max_clients;
                                $data['week_day'] = $row->week_day;
                                $data['training_status_id'] = '1';
                                // если текущая дата меньше даты начала занятий
                                if (date('Y-m-d')<=$row->date_start)
                                {
                                    $data['date_start'] = $row->date_start;
                                }
                                else
                                {
                                    $data['date_start'] = date('Y-m-d');
                                }
                                if(!$this->_store_calendar($data))
                                {
                                    return FALSE;
                                }
                            }
                            else
                            {
                                    $this->setError( $row->getErrorMsg() );
                                    return false;
                            }
                    }
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

		$row =& $this->getTable('trainings');

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

}