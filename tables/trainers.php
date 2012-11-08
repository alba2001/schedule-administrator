<?php
/**
 * Trainers table class
 * 
 * @package    Training schedule
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Trainers Table class
 *
 * @package    Training schedule
 * @subpackage Components
 */
class TableTrainers extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;

	/**
	 * @var string
	 */
	var $im = null;
	/**
	 * @var string
	 */
	var $fam = null;
	/**
	 * @var string
	 */
	var $ot = null;
	/**
	 * @var string
	 */
	var $phone = null;
	/**
	 * @var int
	 */
	var $is_work = null;
	/**
	 * @var string
	 */
	var $trainer_link = null;

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableTrainers(& $db) {
		parent::__construct('#__schedule_trainers', 'id', $db);
	}
}