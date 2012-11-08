<?php
/**
 * Client View for Schedule Component
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
 * Client View
 *
 * @package    Training schedule
 * @subpackage Components
 */
class SchedulesViewClient extends JView
{
	/**
	 * display method of Client view
	 * @return void
	 **/
	function display($tpl = null)
	{
		//get the client
		$client =& $this->get('Data');
		$isNew = ($client->id < 1);

		$text = $isNew ? JText::_( 'New' ) : JText::_( 'Edit' );
		JToolBarHelper::title(   JText::_( 'Client' ).': <small><small>[ ' . $text.' ]</small></small>' );
		JToolBarHelper::save();
		if ($isNew)  {
			JToolBarHelper::cancel();
		} else {
			// for existing items the button is renamed `close`
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}

		$this->assignRef('client', $client);

		parent::display($tpl);
	}
}