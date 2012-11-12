<?php
/**
 * @package		IP city
 * @copyright	Copyright (C) 2012 Konstantin Ovcharenko All rights reserved.
 * @license		GNU/GPL
 */

defined('_JEXEC') or die();

class KTable extends JTable
{
    // Строка списка полей для селекта из таблицы
    private $_select;
    // Строка условий для селекта из таблицы
    private $_where;
    // Строка порядка сортировки для селекта из таблицы
    private $_order_by;
    
    public function __construct($table, $id, $db) 
    {
        parent::__construct($table, $id, $db);
        $this->select(array('*'));
        $this->where(array('1'));
        $this->order_by(array('id ASC'));
    }
    /**
     * Формирование строки запроса
     * @return string
     */
    private function build_query()
    {
        $query = 'SELECT '.  $this->_select;
        $query .= ' FROM '.$this->_tbl;
        $query .= ' WHERE '.$this->_where;
        $query .= ' ORDER BY '.$this->_order_by;
        return $query;
    }

    /**
     * Набор полей для селекта из таблицы
     * @param array $select
     * @return string 
     */
    public function select($select)
    {
        $this->_select = implode(',', $select);
    }

    /**
     * Порядок сортировки для селекта из таблицы
     * @param array $order_by
     * @return string 
     */
    public function order_by($order_by)
    {
        $this->_order_by = implode(',', $order_by);
    }

    /**
     * Набор условий для селекта из таблицы
     * @param array $where
     * @return string 
     */
    public function where($where)
    {
        $this->_where = implode(' AND ', $where);
    }

    /**
     * Набор выполнение селекта
     * @param array $select
     * @return string 
     */
    public function execute($execute = 'loadAssocList')
    {
        $query = $this->build_query();
        $this->_db->setQuery($query);
        return $this->_db->$execute();
    }

    /**
     * Присваиваем значения полей найденной строки объекту таблицы
     * @param array
     * @return noting
     */
    public function bind_row($keys)
    {
        if($row = $this->get_row($keys))
        {
            $this->bind($row);
        }
    }
    /*
     * Выбор строки по ее ID
     *
     *  @param int or array 
     *  @return array or table - Строка таблицы
     */
    public function get_row($keys)
    {
        $row = $this->_get_data($keys, 'loadAssoc');
        return $row;
    }
    /*
     * Выбор массива строк по значению поля
     *
     *  @param int or array
     *  @return array - Строка таблицы
     */

    public function get_rows($keys)
    {
        return $this->_get_data($keys, 'loadAssocList',$select);
    }
    /*
     * Выбор массива значний одного поля по всем строкам
     *
     *  @param int or array
     *  @return array - Строка таблицы
     */

    public function get_column($keys,$column_nm)
    {
        return $this->_get_data($keys, 'loadResultArray',$column_nm);
    }
    /*
     * Выбор данных из таблицы
     *
     *  @param int or array
     *  @return array - Строка таблицы
     */
    private function _get_data($keys, $function, $select='*')
    {
        if (!is_array($keys))
        {
            return FALSE;;
        }
        $from = $this->_tbl;
        $fields = array_keys($this->getProperties());
        foreach ($keys as $field => $value)
        {
                // Check that $field is in the table.
                if (in_array($field, $fields))
                {
                    // Add the search tuple to the query.
                    $where[] = $this->_db->NameQuote($field) . ' = ' . $this->_db->quote($value);
                }
        }

        $query = 'SELECT '.$select;
        $query .= ' FROM '.$from;
        $query .= isset($where)?' WHERE '.implode(' AND ',$where):'';
        $this->_db->setQuery($query);

        try
        {
                $row = $this->_db->$function();
        }
        catch (RuntimeException $e)
        {
                $je = new JException($e->getMessage());
                $this->setError($je);
                return false;
        }
        return $row;
    }
    /*
     * Вставка строки в таблицу
     *
     *  @param array
     *  @return bolean
     */
    public function insert_data($keys)
    {
        if (!is_array($keys))
        {
            return FALSE;;
        }
        // Initialise the query.
        $query = 'INSERT INTO '.$this->_db->NameQuote($this->_tbl);
        $fields = array_keys($this->getProperties());
        // Оставляем только те поля, которые есть в таблице
        unset($list, $values);
        $list = $values = array();
        foreach ($keys as $field => $value)
        {
                // Check that $field is in the table.
                if (!in_array($field, $fields))
                {
                    unset($keys[$field]);
                }
                else
                {
                    $list[] = $this->_db->NameQuote($field);
                    $values[] = '"'.$value.'"';
                }
        }
        if (count($list > 0))
        {
            $query .= ' ('.implode(',',$list).') ';
            $query .= ' VALUES ('.implode(',',$values).') ';
        }

        $this->_db->setQuery($query);
        try
        {
                $row = $this->_db->query($query);
        }
        catch (RuntimeException $e)
        {
                $je = new JException($e->getMessage());
                $this->setError($je);
                return false;
        }
        return $row;
    }
    /**
     * Method to store a record
     *
     * @access	public
     * @return	boolean	OR ID stored record
     */
    function store_data($data=NULL) 
    {
        
        $row = & $this;
        $row->reset();
        if (!isset($data)) {
            $data = JRequest::get('post');
        }
        // Bind the form fields to the deplist table
        if (!$row->bind($data)) {
            $this->setError($this->_db->getErrorMsg());
            JError::raiseWarning('SOME_ERROR_CODE', $this->_db->getErrorMsg());
            return false;
        }
        // Make sure the data record is valid
        if (!$row->check()) {
            $this->setError($this->_db->getErrorMsg());
            JError::raiseWarning('SOME_ERROR_CODE', $this->_db->getErrorMsg());
            return FALSE;
        }

        // Store the web link table to the database
        if (!$row->store()) {
            $this->setError($this->_db->getErrorMsg());
            JError::raiseWarning('SOME_ERROR_CODE', $this->_db->getErrorMsg());
            return FALSE;
        }

        return $row->id;
    }
	/**
	 * Method to delete record(s)
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	function delete_rows($cids = NULL)
	{
		
            if(!isset($cids))
            {
                $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
            }
            if (count( $cids )) {
                    foreach($cids as $cid) {
                            if (!$this->delete( $cid )) {
                                    $this->setError( $this->getErrorMsg() );
                                    return false;
                            }
                    }
            }
            return true;
	}
    
}
   