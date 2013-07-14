<?php	                                       			 
/**
 * Vids table class
 * 
 * @package    Vid schedule
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once (dirname( __FILE__ ).DS.'ktable.php');

/**
 * Vids Table class
 *
 * @package    Vid schedule
 * @subpackage Components
 */
class TableVids extends KTable
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
	var $name = null;
	/**
	 * @var streeng
	 */
	var $training_link = null;

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableVids(& $db) {
		parent::__construct('#__schedule_vids', 'id', $db);
	}
}