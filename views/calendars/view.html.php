<?php
/**
 * Calendars View for Schedule Component
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
 * Calendars View
 *
 * @package    Training schedule
 * @subpackage Components
 */
class SchedulesViewCalendars extends JView
{
	/**
	 * Calendars view display method
	 * @return void
	 **/
    function display($tpl = null)
    {
        global $mainframe;
        JToolBarHelper::title(   JText::_( 'Calendar Manager' ), 'generic.png' );
        JToolBarHelper::deleteList();
        JToolBarHelper::editListX();
        JToolBarHelper::addNewX();

        // Prepare list array
        $lists = array();
        // Get the user state
        $filter_order = $mainframe->getUserStateFromRequest(
        $option.'filter_order',
        'filter_order', 'date');
        $filter_order_Dir = $mainframe->getUserStateFromRequest(
        $option.'filter_order_Dir',
        'filter_order_Dir', 'ASC');
        // Date filtering
        $filter_search = $mainframe->getUserStateFromRequest(
                            $option.'filter_search_date',
                            'filter_search_date','');
        // Training filtering
        $filter_training = $mainframe->getUserStateFromRequest(
                            $option.'filter_training',
                            'filter_training','');
        // Trainer filtering
        $filter_trainer = $mainframe->getUserStateFromRequest(
                            $option.'filter_trainer',
                            'filter_trainer','');
        // Training state filtering
        $filter_training_status = $mainframe->getUserStateFromRequest(
                            $option.'filter_training_status',
                            'filter_training_status','');
        
        // Build the list array for use in the layout
        $lists['order'] = $filter_order;
        $lists['order_Dir'] = $filter_order_Dir;
        $lists['search'] = $filter_search;
        $lists['filter_trainer'] = $filter_trainer;
        $lists['filter_training'] = $filter_training;
        $lists['filter_trainings'] = $filter_trainings;
        $lists['filter_training_status'] = $filter_training_status;
        
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