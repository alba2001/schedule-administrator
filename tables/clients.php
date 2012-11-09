<?php
/**
 * Clients table class
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
 * Clients Table class
 *
 * @package    Training schedule
 * @subpackage Components
 */
class TableClients extends KTable
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
	 * @var string
	 */
	var $email = null;

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableClients(& $db) {
		parent::__construct('#__schedule_clients', 'id', $db);
	}
}