<?php
/**
 * Trainings table class
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
 * Trainings Table class
 *
 * @package    Training schedule
 * @subpackage Components
 */
class TableTrainings extends KTable
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
	var $trainer_id = null;
	/**
	 * @var string
	 */
	var $name = null;
	/**
	 * @var int
	 */
	var $week_day = null;
	/**
	 * @var time
	 */
	var $time_start = null;
	/**
	 * @var time
	 */
	var $time_stop = null;
	/**
	 * @var date
	 */
	var $date_start = null;
	/**
	 * @var date
	 */
	var $date_stop = null;
	/**
	 * @var int
	 */
	var $max_clients = null;
	/**
	 * @var streeng
	 */
	var $training_link = null;

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableTrainings(& $db) {
		parent::__construct('#__schedule_trainings', 'id', $db);
	}
}