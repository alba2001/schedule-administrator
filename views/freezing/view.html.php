<?php
/**
 * Freezing View for Schedule Component
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
 * Freezing View
 *
 * @package    Training schedule
 * @subpackage Components
 */
class SchedulesViewFreezing extends JView
{
	/**
	 * display method of Freezing view
	 * @return void
	 **/
	function display($tpl = null)
	{
		//get the freezing
		$freezing =& $this->get('Data');
		$isNew = ($freezing->id < 1);

		$text = $isNew ? JText::_( 'New' ) : JText::_( 'Edit' );
		JToolBarHelper::title(   JText::_( 'Freezing' ).': <small><small>[ ' . $text.' ]</small></small>' );
		JToolBarHelper::save();
		if ($isNew)  {
			JToolBarHelper::cancel();
		} else {
			// for existing items the button is renamed `close`
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}

		$this->assignRef('freezing', $freezing);

		parent::display($tpl);
	}
}