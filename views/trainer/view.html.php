<?php
/**
 * Trainer View for Schedule Component
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
 * Trainer View
 *
 * @package    Training schedule
 * @subpackage Components
 */
class SchedulesViewTrainer extends JView
{
	/**
	 * display method of Trainer view
	 * @return void
	 **/
	function display($tpl = null)
	{
		//get the trainer
		$trainer =& $this->get('Data');
		$isNew = ($trainer->id < 1);

		$text = $isNew ? JText::_( 'New' ) : JText::_( 'Edit' );
		JToolBarHelper::title(   JText::_( 'Trainer' ).': <small><small>[ ' . $text.' ]</small></small>' );
		JToolBarHelper::save();
		if ($isNew)  {
			JToolBarHelper::cancel();
		} else {
			// for existing items the button is renamed `close`
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}

		$this->assignRef('trainer', $trainer);

		parent::display($tpl);
	}
}