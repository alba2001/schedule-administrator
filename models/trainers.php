<?php
/**
 * Trainers Model for Schedule Component
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
 * Trainer Model
 *
 * @package    Training schedule
 * @subpackage Components
 */
class SchedulesModelTrainers extends JModel
{
	/**
	 * Trainers data array
	 *
	 * @var array
	 */
	var $_data;
        /**
         * Total number of calendars
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
		$query = ' SELECT * '
			. ' FROM #__schedule_trainers '
                        .$this->_buildQueryWhere()
                        .$this->_buildQueryOrderBy()
		;
//var_dump($query);exit;
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
        * Build the ORDER part of a query
        *
        * @return string part of an SQL query
        */
        function _buildQueryOrderBy()
        {
            global $mainframe, $option;
            // Array of allowable order fields
            $orders = array('fam', 'id');
            // Get the order field and direction, default order field
            // is 'fam', default direction is ascending
            $filter_order = $mainframe->getUserStateFromRequest(
            $option.'filter_order', 'filter_order', 'fam');
            $filter_order_Dir = strtoupper(
            $mainframe->getUserStateFromRequest(
            $option.'filter_order_Dir', 'filter_order_Dir', 'ASC'));
            // Validate the order direction, must be ASC or DESC
            if ($filter_order_Dir != 'ASC' && $filter_order_Dir != 'DESC')
            {
                $filter_order_Dir = 'ASC';
            }
            // If order column is unknown use the default
            if (!in_array($filter_order, $orders))
            {
                $filter_order = 'fam';
            }
            $orderby = ' ORDER BY '.$filter_order.' '.$filter_order_Dir;
            if ($filter_order != 'fam')
            {
                $orderby .= ' , fam ';
            }
            // Return the ORDER BY clause
            return $orderby;
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
            $option.'filter_search_pfam','filter_search_pfam','');
        $filter_search_is_work = $mainframe->getUserStateFromRequest(
            $option.'filter_search_is_work','filter_search_is_work','777');
        // Prepare the WHERE clause
        $where = array();
        // Determine search terms
        if ($filter_search = trim($filter_search))
        {
            $filter_search = JString::strtolower($filter_search);
            $filter_search = $db->getEscaped($filter_search);
            $where[] = ' fam  LIKE "'.$filter_search.'%" ';
        }
        if($filter_search_is_work != '777')
        {
            $where[] = ' is_work = "'.$filter_search_is_work.'" ';
        }
        // return the WHERE clause
        return ($where) ? ' WHERE '.implode(' AND', $where) : '';
    }
}