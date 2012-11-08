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

/**
 * Calendars Table class
 *
 * @package    Training schedule
 * @subpackage Components
 */
class TableCalendar extends JTable
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
}