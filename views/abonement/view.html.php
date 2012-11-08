<?php
/**
 * Abonement View for Schedule Component
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
 * Abonement View
 *
 * @package    Training schedule
 * @subpackage Components
 */
class SchedulesViewAbonement extends JView
{
	/**
	 * display method of Abonement view
	 * @return void
	 **/
	function display($tpl = null)
	{
		//get the abonement
		$abonement =& $this->get('Data');
		$isNew = ($abonement->id < 1);

		$text = $isNew ? JText::_( 'New' ) : JText::_( 'Edit' );
		JToolBarHelper::title(   JText::_( 'Abonement' ).': <small><small>[ ' . $text.' ]</small></small>' );
		JToolBarHelper::save();
		if ($isNew)  {
			JToolBarHelper::cancel();
		} else {
			// for existing items the button is renamed `close`
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}

		$this->assignRef('abonement', $abonement);

		parent::display($tpl);
	}
}