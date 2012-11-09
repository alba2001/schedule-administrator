<?php
/**
 * Freezings table class
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
 * Freezings Table class
 *
 * @package    Training schedule
 * @subpackage Components
 */
class TableFreezings extends KTable
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
	function TableFreezings(& $db) {
		parent::__construct('#__schedule_freezings', 'id', $db);
	}
}