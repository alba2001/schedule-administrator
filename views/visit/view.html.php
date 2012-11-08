<?php
/**
 * Visit View for Schedule Component
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
 * Visit View
 *
 * @package    Training schedule
 * @subpackage Components
 */
class SchedulesViewVisit extends JView
{
	/**
	 * display method of Visit view
	 * @return void
	 **/
	function display($tpl = null)
	{
		//get the visit
		$visit =& $this->get('Data');
		$isNew = ($visit->id < 1);

		$text = $isNew ? JText::_( 'New' ) : JText::_( 'Edit' );
		JToolBarHelper::title(   JText::_( 'Visit' ).': <small><small>[ ' . $text.' ]</small></small>' );
		JToolBarHelper::save();
		if ($isNew)  {
			JToolBarHelper::cancel();
		} else {
			// for existing items the button is renamed `close`
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}

		$this->assignRef('visit', $visit);

		parent::display($tpl);
	}
}