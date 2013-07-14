<?php	                                       			 
/**
 * Vids View for Schedule Component
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
 * Vids View
 *
 * @package    Vid schedule
 * @subpackage Components
 */
class SchedulesViewVids extends JView
{
	/**
	 * Vids view display method
	 * @return void
	 **/
    function display($tpl = null)
    {
        global $mainframe;
        JToolBarHelper::title(   JText::_( 'Vid Manager' ), 'generic.png' );
        JToolBarHelper::deleteList();
        JToolBarHelper::editListX();
        JToolBarHelper::addNewX();

        // Prepare list array
        $lists = array();
        // Vid name filtering
        $filter_search = $mainframe->getUserStateFromRequest(
                            $option.'filter_search_name',
                            'filter_search_name','');

        // Build the list array for use in the layout
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