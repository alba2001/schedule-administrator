<?php
/**
 * Schedules View for Schedule Component
 * 
 * @package    Training schedule
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );

/**
 * Schedules View
 *
 * @package    Training schedule
 * @subpackage Components
 */
class SchedulesViewSchedules extends JView
{
	/**
	 * Trainers view display method
	 * @return void
	 **/
	function display($tpl = null)
	{
            
		JToolBarHelper::title(   JText::_( 'Trainings schedule' ), 'generic.png' );
		parent::display($tpl);
	}
}