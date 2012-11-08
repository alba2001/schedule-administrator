<?php
/**
 * Prolongations table class
 * 
 * @package    Training schedule
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Prolongations Table class
 *
 * @package    Training schedule
 * @subpackage Components
 */
class TableProlongations extends JTable
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
	var $abonement_id = null;
	/**
	 * @var date
	 */
	var $date_from = null;
	/**
	 * @var date
	 */
	var $date_to = null;

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableProlongations(& $db) {
		parent::__construct('#__schedule_prolongations', 'id', $db);
	}
}