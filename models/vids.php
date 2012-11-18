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

jimport( 'joomla.application.component.model' );

/**
 * Vid Model
 *
 * @package    Vid schedule
 * @subpackage Components
 */
class SchedulesModelVids extends KModels
{
	/**
	 * Table name
	 * @var string
	 */
        var $_tbl_name = 'schedule_vids';
}