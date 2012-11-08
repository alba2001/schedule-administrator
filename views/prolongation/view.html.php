<?php
/**
 * Prolongation View for Schedule Component
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
 * Prolongation View
 *
 * @package    Training schedule
 * @subpackage Components
 */
class SchedulesViewProlongation extends JView
{
	/**
	 * display method of Prolongation view
	 * @return void
	 **/
	function display($tpl = null)
	{
		//get the prolongation
		$prolongation =& $this->get('Data');
		$isNew = ($prolongation->id < 1);

		$text = $isNew ? JText::_( 'New' ) : JText::_( 'Edit' );
		JToolBarHelper::title(   JText::_( 'Prolongation' ).': <small><small>[ ' . $text.' ]</small></small>' );
		JToolBarHelper::save();
		if ($isNew)  {
			JToolBarHelper::cancel();
		} else {
			// for existing items the button is renamed `close`
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}

		$this->assignRef('prolongation', $prolongation);

		parent::display($tpl);
	}
}