<?php	                                       			 
/**
 * Vid View for Schedule Component
 * 
 * @package    Vid schedule
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );

/**
 * Vid View
 *
 * @package    Vid schedule
 * @subpackage Components
 */
class SchedulesViewVid extends JView
{
	/**
	 * display method of Vid view
	 * @return void
	 **/
	function display($tpl = null)
	{
		//get the Vid
		$vid =& $this->get('Data');
		$isNew = ($Vid->id < 1);

		$text = $isNew ? JText::_( 'New' ) : JText::_( 'Edit' );
		JToolBarHelper::title(   JText::_( 'Vid' ).': <small><small>[ ' . $text.' ]</small></small>' );
		JToolBarHelper::save();
		if ($isNew)  {
			JToolBarHelper::cancel();
		} else {
			// for existing items the button is renamed `close`
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}

		$this->assignRef('vid', $vid);

		parent::display($tpl);
	}
}