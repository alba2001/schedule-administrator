<?php
/**
 * Abonements table class
 * 
 * @package    Training schedule
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Abonements Table class
 *
 * @package    Training schedule
 * @subpackage Components
 */
class TableAbonements extends JTable
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
	var $num = null;
	/**
	 * @var int
	 */
	var $client_id = null;
	/**
	 * @var int
	 */
	var $abonement_type_id = null;
	/**
	 * @var date
	 */
	var $sale_date = null;
	/**
	 * @var int
	 */
	var $activate_period = null;
	/**
	 * @var date
	 */
	var $activate_date = null;
	/**
	 * @var int
	 */
	var $validity_period = null;
	/**
	 * @var int
	 */
	var $sale_type = null;
	/**
	 * @var varchar
	 */
	var $cost_num = null;

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableAbonements(& $db) {
		parent::__construct('#__schedule_abonements', 'id', $db);
	}
}