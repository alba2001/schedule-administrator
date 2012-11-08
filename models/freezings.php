<?php
/**
 * Freezings Model for Schedule Component
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
 * Freezing Model
 *
 * @package    Training schedule
 * @subpackage Components
 */
class SchedulesModelFreezings extends JModel
{
	/**
	 * Freezings data array
	 *
	 * @var array
	 */
	var $_data;
        /**
         * Total number of freezings 
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
		$query = ' SELECT f.*, a.num, c.fam, c.im, c.ot '
			.' FROM #__schedule_freezings AS f'
			.' INNER JOIN #__schedule_abonements AS a ON a.id = f.abonement_id'
			.' INNER JOIN #__schedule_clients AS c ON c.id = a.client_id'
                        .$this->_buildQueryWhere()
                        .$this->_buildQueryOrderBy()
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
        * Build the ORDER part of a query
        *
        * @return string part of an SQL query
        */        
        function _buildQueryOrderBy()
        {
            global $mainframe, $option;
            // Array of allowable order fields
            $orders = array('num', 'fam', 'date_from', 'date_to', 'id');
            // Get the order field and direction, default order field
            // is 'fam', default direction is ascending
            $filter_order = $mainframe->getUserStateFromRequest(
            $option.'filter_order', 'filter_order', 'num');
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
                $filter_order = 'num';
            }
            $orderby = ' ORDER BY '.$filter_order.' '.$filter_order_Dir;
            if ($filter_order != 'num')
            {
                $orderby .= ' , num ';
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
        $filter_search_fam = $mainframe->getUserStateFromRequest(
            $option.'filter_search_fam','filter_search_fam','');
        $filter_search_num = $mainframe->getUserStateFromRequest(
            $option.'filter_search_num','filter_search_num','');
        // Prepare the WHERE clause
        $where = array();
        // Determine search terms
        if ($filter_search_fam = trim($filter_search_fam))
        {
            $filter_search_fam = JString::strtolower($filter_search_fam);
            $filter_search_fam = $db->getEscaped($filter_search_fam);
            $where[] = ' LOWER(fam) LIKE "'.$filter_search_fam.'%" ';
        }        // return the WHERE clause
        if ($filter_search_num = trim($filter_search_num))
        {
            $filter_search_num = JString::strtolower($filter_search_num);
            $filter_search_num = $db->getEscaped($filter_search_num);
            $where[] = ' num = "'.$filter_search_num.'" ';
        }        // return the WHERE clause
        return ($where) ? ' WHERE '.implode(' AND ',$where) : '';
    }        
}