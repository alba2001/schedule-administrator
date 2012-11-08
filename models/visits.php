<?php
/**
 * Visits Model for Schedule Component
 * 
 * @package    Training schedule
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.model' );

/**
 * Visit Model
 *
 * @package    Training schedule
 * @subpackage Components
 */
class SchedulesModelVisits extends JModel
{
	/**
	 * Visits data array
	 *
	 * @var array
	 */
	var $_data;
        /**
         * Total number of visits
         * 
         *  @var int 
         */
        var $_total = null;
        /** 
         * @var JPagination object 
         */
        var $_pagination = null;

        /**
        * Constructor
        */
        function __construct()
        {
            global $mainframe;
            parent::__construct();
            // Get the pagination request variables
            $limit = $mainframe->getUserStateFromRequest(
            'global.list.limit',
            'limit', $mainframe->getCfg('list_limit'));
            $limitstart = $mainframe->getUserStateFromRequest(
            $option.'limitstart', 'limitstart', 0);
            // Set the state pagination variables
            $this->setState('limit', $limit);
            $this->setState('limitstart', $limitstart);
        }

	/**
	 * Returns the query
	 * @return string The query to be used to retrieve the rows from the database
	 */
	function _buildQuery()
	{
            $select[] = 'v.*';
            $select[] = $this->_db->nameQuote('clients.fam');
            $select[] = $this->_db->nameQuote('clients.im');
            $select[] = $this->_db->nameQuote('clients.ot');
            $select[] = $this->_db->nameQuote('trainings.name');
            $select[] = $this->_db->nameQuote('calendar.date');
            $select[] = $this->_db->nameQuote('calendar.time_start');
            $from[] = $this->_db->nameQuote('#__schedule_visits').' AS v';
            $from[] = $this->_db->nameQuote('#__schedule_calendar').' AS calendar';
            $from[] = $this->_db->nameQuote('#__schedule_clients').' AS clients';
            $from[] = $this->_db->nameQuote('#__schedule_trainings').' AS trainings';
            // только не удаленные
            $where[] = 'v.deleted  = 0';
            // соединяем таблицы
            $where[] = 'v.calendar_id  = calendar.id';
            $where[] = 'calendar.training_id  = trainings.id';
            $where[] = 'v.client_id  = clients.id';
            $where = array_merge($where, $this->_buildQueryWhere());
            $query = ' SELECT '.implode(' ,',$select) 
                    .' FROM '.implode(' ,',$from)
                    .' WHERE '.implode(' AND ',$where)
            ;
//                var_dump($query);exit;
		return $query;
	}

	/**
	 * Retrieves the schedule data
	 * @return array Array of objects containing the data from the database
	 */
	function getData()
	{
		// Lets load the data if it doesn't already exist
		if (empty( $this->_data ))
		{
                    $query = $this->_buildQuery();
                    $limitstart = $this->getState('limitstart');
                    $limit = $this->getState('limit');
                    $this->_data = $this->_getList( $query,$limitstart,$limit );
		}

		return $this->_data;
	}
        /**
        * Get a pagination object
        *
        * @access public
        * @return pagination object
        */
        function getPagination()
        {
            if (empty($this->_pagination))
            {
                // Import the pagination library
                jimport('joomla.html.pagination');
                // Prepare the pagination values
                $total = $this->getTotal();
                $limitstart = $this->getState('limitstart');
                $limit = $this->getState('limit');
                // Create the pagination object
                $this->_pagination = new JPagination($total,$limitstart,$limit);
            }
            return $this->_pagination;
        }
        /**
        * Get number of items
        *
        * @access public
        * @return integer
        */
        function getTotal()
        {
            if (empty($this->_total))
            {
                $query = $this->_buildQuery();
                $this->_total = $this->_getListCount($query);
            }
            return $this->_total;
        }
    /**
    * Builds the WHERE part of a query
    *
    * @return string Part of an SQL query
    */
    function _buildQueryWhere()
    {
        global $mainframe, $option;
        $db =& $this->_db;
        // Get the filter values
        $filter_search = $mainframe->getUserStateFromRequest(
            $option.'filter_search_client','filter_search_client','');
        $filter_date = $mainframe->getUserStateFromRequest(
            $option.'filter_date','filter_date', date('Y-m-d'));
        $filter_calendar = $mainframe->getUserStateFromRequest(
            $option.'filter_calendar','filter_calendar','');
        // Prepare the WHERE clause
        $where = array();
        // Determine search terms
        if ($filter_search = trim($filter_search))
        {
            $filter_search = JString::strtolower($filter_search);
            $filter_search = $db->getEscaped($filter_search);
            $where[] = ' clients.fam  LIKE "'.$filter_search.'%" ';
        }
        if ($filter_date)
        {
            $where[] = ' calendar.date  = "'.$filter_date.'"';
        }
        if ($filter_calendar)
        {
            $where[] = ' calendar.id  = '.$filter_calendar;
        }

        // return the WHERE clause
        return $where;
    }        
}