<?php
/**
 * Kmodels Model for Schedule Component
 * 
 * @package    Kmodel schedule
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.model' );

/**
 * Kmodel Model
 *
 * @package    Kmodel schedule
 * @subpackage Components
 */
class Kmodels extends JModel
{
	/**
	 * Kmodels data array
	 *
	 * @var array
	 */
	var $_data;
        /**
         * Total number of kmodels
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
			.' FROM #__'.$this->_tbl_name.' '
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
            if($this->_orderby)
            {
                return $this->_orderby;
            }
            $filter_order = '`name`';
            $this->_orderby = ' ORDER BY '.$filter_order;
            return $this->_orderby;
        }
    /**
    * Builds the WHERE part of a query
    *
    * @return string Part of an SQL query
    */
    function _buildQueryWhere()
    {
        if(!$this->_where)
        {
            $this->_where = array();
            global $mainframe, $option;
            // Get the filter values
            $filter_search = $mainframe->getUserStateFromRequest(
            $option.'filter_search_name','filter_search_name','');
            // Prepare the WHERE clause
            // Determine search terms
            if ($filter_search = trim($filter_search))
            {
                $filter_search = JString::strtolower($filter_search);
                $db =& $this->_db;
                $filter_search = $db->getEscaped($filter_search);
                $this->_where[] = ' LOWER(name) LIKE "'.$filter_search.'%" ';
            }
        }
        // return the WHERE clause
        return count($this->_where)>0 ? ' WHERE '.implode(' AND', $this->_where) : '';
    }        
}