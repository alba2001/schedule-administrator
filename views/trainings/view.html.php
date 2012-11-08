<?php
/**
 * Trainings View for Schedule Component
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
 * Trainings View
 *
 * @package    Training schedule
 * @subpackage Components
 */
class SchedulesViewTrainings extends JView
{
	/**
	 * Trainings view display method
	 * @return void
	 **/
    function display($tpl = null)
    {
        global $mainframe;
        JToolBarHelper::title(   JText::_( 'Training Manager' ), 'generic.png' );
        JToolBarHelper::custom( 'fill_calendar', 'fill_calendar.png', 'fill_calendar.png', JText::_('FILL_CALENDAR'), TRUE, FALSE );        
        JToolBarHelper::deleteList();
        JToolBarHelper::editListX();
        JToolBarHelper::addNewX();

        // Prepare list array
        $lists = array();
        // Get the user state
        $filter_order = $mainframe->getUserStateFromRequest(
        $option.'filter_order',
        'filter_order', 'name');
        $filter_order_Dir = $mainframe->getUserStateFromRequest(
        $option.'filter_order_Dir',
        'filter_order_Dir', 'ASC');
        // Training name filtering
        $filter_search = $mainframe->getUserStateFromRequest(
                            $option.'filter_search_name',
                            'filter_search_name','');
        // Build the list array for use in the layout
        $lists['order'] = $filter_order;
        $lists['order_Dir'] = $filter_order_Dir;
        $lists['search'] = $filter_search;
        
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