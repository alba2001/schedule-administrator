<?php
/**
 * @package		IP city
 * @copyright	Copyright (C) 2012 Konstantin Ovcharenko All rights reserved.
 * @license		GNU/GPL
 */

defined('_JEXEC') or die();

class KTable extends JTable
{
			
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
        // Initialise the query.
        $query = $this->_db->getQuery(true);
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
    function store_data($data) 
    {
        
        $row = & $this;
        $row->reset();
        if (!$data) {
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
    
}
   