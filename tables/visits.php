<?php
/**
 * Visits table class
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
 * Abonements Table class
 *
 * @package    Training schedule
 * @subpackage Components
 */
class TableVisits extends KTable
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
	var $client_id = null;
	/**
	 * @var int
	 */
	var $calendar_id = null;
	/**
	 * @var int
	 */
	var $training_type_id = null;
	/**
	 * @var int
	 */
	var $registered = null;
	/**
	 * @var int
	 */
	var $visited = null;
	/**
	 * @var string
	 */
	var $phone = null;

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableVisits(& $db) {
		parent::__construct('#__schedule_visits', 'id', $db);
	}
        /**
         *
         * @param int - ID календаря
         * @return int - кол-во записей на занятие
         */
        function get_count_visits($calendar_id)
        {
            return count($this->get_rows(array('calendar_id'=>$calendar_id)));
        }
}