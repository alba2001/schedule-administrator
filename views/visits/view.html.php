<?php
/**
 * Visits View for Schedule Component
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
 * Visits View
 *
 * @package    Training schedule
 * @subpackage Components
 */
class SchedulesViewVisits extends JView
{
	/**
	 * Visits view display method
	 * @return void
	 **/
    function display($tpl = null)
    {
        global $mainframe;
        JToolBarHelper::title(   JText::_( 'Zapis Manager' ), 'generic.png' );

        // Prepare list array
        $lists = array();
        // Get the user state
        // Data filtering
        $filter_search = $mainframe->getUserStateFromRequest(
                            $option.'filter_search_client',
                            'filter_search_client','');
        // Date filtering
        $filter_date = $mainframe->getUserStateFromRequest(
                            $option.'filter_date',
                            'filter_date',date('Y-m-d'));
        // Trainer filtering
        $filter_calendar = $mainframe->getUserStateFromRequest(
                            $option.'filter_calendar',
                            'filter_calendar','');
        
        // Build the list array for use in the layout
        $lists['order'] = $filter_order;
        $lists['order_Dir'] = $filter_order_Dir;
        $lists['search'] = $filter_search;
        $lists['filter_date'] = $filter_date;
        $lists['filter_calendar'] = $filter_calendar;

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