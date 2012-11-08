<?php
/**
 * Trainers View for Schedule Component
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
 * Trainers View
 *
 * @package    Training schedule
 * @subpackage Components
 */
class SchedulesViewTrainers extends JView
{
	/**
	 * Trainers view display method
	 * @return void
	 **/
	function display($tpl = null)
	{
		JToolBarHelper::title(   JText::_( 'Trainer Manager' ), 'generic.png' );
		JToolBarHelper::deleteList();
		JToolBarHelper::editListX();
		JToolBarHelper::addNewX();
                global $mainframe;
            // Prepare list array
            $lists = array();
            // Get the user state
            $filter_order = $mainframe->getUserStateFromRequest(
            $option.'filter_order',
            'filter_order', 'fam');
            $filter_order_Dir = $mainframe->getUserStateFromRequest(
            $option.'filter_order_Dir',
            'filter_order_Dir', 'ASC');
            // Number filtering
            $filter_search = $mainframe->getUserStateFromRequest(
                                $option.'filter_search_pfam',
                                'filter_search_pfam','');
            // Is work list filtering
            $filter_search_is_work = $mainframe->getUserStateFromRequest(
                                $option.'filter_search_is_work',
                                'filter_search_is_work','');
            // Build the list array for use in the layout
            $lists['order'] = $filter_order;
            $lists['order_Dir'] = $filter_order_Dir;
            $lists['search'] = $filter_search;
            $lists['filter_search_is_work'] = $filter_search_is_work;

            // Get pagination from the model
            $page =& $this->get('Pagination');
            // Assign references for the layout to use
            $this->assignRef('lists', $lists);
            $this->assignRef('page', $page);

		// Get data from the model
		$items		= & $this->get( 'Data');

		$this->assignRef('items',		$items);

		parent::display($tpl);
	}
}