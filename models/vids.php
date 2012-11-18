<?php
/**
 * Vids Model for Schedule Component
 * 
 * @package    Vid schedule
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once (dirname( __FILE__ ).DS.'kmodels.php');
/**
 * Vid Model
 *
 * @package    Vid schedule
 * @subpackage Components
 */
class SchedulesModelVids extends Kmodels
{
	/**
	 * Table name
	 * @var string
	 */
        var $_tbl_name = 'schedule_vids';
}