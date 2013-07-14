<?php
/**
 * Trainings Model for Schedule Component
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
 * Training Model
 *
 * @package    Training schedule
 * @subpackage Components
 */
class SchedulesModelTrainings extends JModel
{
	/**
	 * Trainings data array
	 *
	 * @var array
	 */
	var $_data;
        /**
         * Total number of trainings
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
			.' FROM #__schedule_trainings '
                        .$this->_buildQueryWhere()
                        .$this->_buildQueryOrderBy()
		;
//                var_dump($query);
//                exit;                
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
            $filter_order = '`week_day`, `time_start`';
            $orderby = ' ORDER BY '.$filter_order;
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
        // Get the filter values
        $filter_search = $mainframe->getUserStateFromRequest(
        $option.'filter_search_name','filter_search_name','');
        // Training vid filtering
        $filter_vid = $mainframe->getUserStateFromRequest(
                            $option.'filter_vid',
                            'filter_vid','');
        // Фильтр по дате окончания занятия
        $filter_outdate = $mainframe->getUserStateFromRequest(
        $option.'filter_outdate','filter_outdate',2);
        // Prepare the WHERE clause
        $where = array();
        // Determine search terms
        if ($filter_search = trim($filter_search))
        {
            $filter_search = JString::strtolower($filter_search);
            $db =& $this->_db;
            $filter_search = $db->getEscaped($filter_search);
            $where[] = ' LOWER(name) LIKE "'.$filter_search.'%" ';
        }
        if ($filter_vid)
        {
            $where[] = ' vid_id  = '.$filter_vid;
        }
        if ($filter_outdate)
        {
            $today = date('Y-m-d');
            switch ($filter_outdate) {
                case 1:
            $where[] = '(`date_stop` != "0000-00-00" AND `date_stop` < "'.$today.'")';
                    break;
                case 2:
            $where[] = '(`date_stop` = "0000-00-00" OR `date_stop` >= "'.$today.'")';
                    break;
            }
        }
        // return the WHERE clause
        return count($where)>0 ? ' WHERE '.implode(' AND', $where) : '';
    }        
}