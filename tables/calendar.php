<?php
/**
 * Calendars table class
 * 
 * @package    Training schedule
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once (dirname( __FILE__ ).DS.'ktable.php');
/**
 * Calendars Table class
 *
 * @package    Training schedule
 * @subpackage Components
 */
class TableCalendar extends KTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;

	/**
	 * @var int
	 */
	var $training_id = null;
	/**
	 * @var int
	 */
	var $trainer_id = null;
	/**
	 * @var date
	 */
	var $date = null;
	/**
	 * @var time
	 */
	var $time_start = null;
	/**
	 * @var time
	 */
	var $time_stop = null;
	/**
	 * @var int
	 */
	var $max_clients = null;
	/**
	 * @var int
	 */
	var $training_status_id = null;

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableCalendar(& $db) {
		parent::__construct('#__schedule_calendar', 'id', $db);
	}
        /**
         * Проверка максимального кол-ва записей
         * @param int - ID календаря
         * @return bolean
         */
        function out_of_visits($id)
        {
            $row = $this->get_row(array('id'=>$id));
            $count_visits = JTable::getInstance('visits','Table')
                    ->get_count_visits($row['id']);
            return $row['max_clients'] <= (int)$count_visits;
        }
}