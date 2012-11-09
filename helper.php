<?php
/**
 * @package    Training schedule
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
 * @license    GNU/GPL
 */
	
	// No direct access
	defined('_JEXEC') or die('Restricted access');
	
	
    /**
     * Helper for com_shedule
     *
     * @package    Training schedule
     * @subpackage Components
     *
     */
    class sh_helper
    {
        /*
         * Selecting clients method
         * 
         * @var $name - name of HTML's tag "select"
         * @var $attribs - attributes of HTML's tag "select"
         * @var $selected - value of selected element
         * @var $idtag - id HTML's tag "select"
         * 
         * @return HTML teg "select"

         */
        function client_selecting($name, $attribs = null, $selected = NULL, $idtag = false)
        {
            $db =& JFactory::getDBO();
            $table = $db->NameQuote('#__schedule_clients');
            $fields[] = $db->NameQuote('fam');
            $fields[] = $db->NameQuote('im');
            $fields[] = $db->NameQuote('ot');
            $fields[] = $db->NameQuote('id');
            $query = 'SELECT '.implode(',',$fields);
            $query .= ' FROM '.$table;
            $query .= ' ORDER BY '.implode(',',$fields);
            
            $db->setQuery($query);
            if ($clients = $db->LoadObjectList())
            {
                $state = array();
                $state[] = JHTML::_('select.option'
                        , 0
                        , JText::_('SELECT_CLIENT')
                );
                foreach ($clients as $client)
                {
                    $state[] = JHTML::_('select.option'
                            , $client->id
                            , JText::_($client->fam.' '.$client->im.' '.$client->ot)
                    );
                }
                return JHTML::_('select.genericlist'
                                , $state
                                , $name
                                , $attribs
                                , 'value'
                                , 'text'
                                , $selected
                                , $idtag
                                , false );
            }
         }
        /*
         * Selecting abonement types method
         * 
         * @var $name - name of HTML's tag "select"
         * @var $attribs - attributes of HTML's tag "select"
         * @var $selected - value of selected element
         * @var $idtag - id HTML's tag "select"
         * 
         * @return HTML teg "select"

         */
        function abonement_type_selecting($name, $attribs = null, $selected = 0, $idtag = false)
        {
            $db =& JFactory::getDBO();
            $table = $db->NameQuote('#__schedule_abonement_types');
            $fields[] = $db->NameQuote('name');
            $fields[] = $db->NameQuote('id');
            $query = 'SELECT '.implode(',',$fields);
            $query .= ' FROM '.$table;
            $query .= ' ORDER BY '.implode(',',$fields);
            $db->setQuery($query);
            if ($abonement_types = $db->LoadObjectList())
            {
                $state = array();
                $state[] = JHTML::_('select.option'
                        , 0
                        , JText::_('SELECT_ABONEMENT_TYPE')
                );
                foreach ($abonement_types as $abonement_type)
                {
                    $state[] = JHTML::_('select.option'
                            , $abonement_type->id
                            , JText::_($abonement_type->name)
                    );
                }
                return JHTML::_('select.genericlist'
                                , $state
                                , $name
                                , $attribs
                                , 'value'
                                , 'text'
                                , $selected
                                , $idtag
                                , false );
            }
         }
        /*
         * Selecting abonement method
         * 
         * @var $name - name of HTML's tag "select"
         * @var $attribs - attributes of HTML's tag "select"
         * @var $selected - value of selected element
         * @var $idtag - id HTML's tag "select"
         * 
         * @return HTML teg "select"

         */
        function club_cart_selecting($name, $attribs = null, $selected = 0, $idtag = false)
        {
            return sh_helper::_abonement_selecting(2, $name, $attribs, $selected, $idtag);
        }
        /*
         * Selecting abonement method
         * 
         * @var $name - name of HTML's tag "select"
         * @var $attribs - attributes of HTML's tag "select"
         * @var $selected - value of selected element
         * @var $idtag - id HTML's tag "select"
         * 
         * @return HTML teg "select"

         */
        function abonement_selecting($name, $attribs = null, $selected = 0, $idtag = false)
        {
            return sh_helper::_abonement_selecting(1, $name, $attribs, $selected, $idtag);
        }
        /*
         * Selecting abonement method
         * 
         * @var $name - name of HTML's tag "select"
         * @var $attribs - attributes of HTML's tag "select"
         * @var $selected - value of selected element
         * @var $idtag - id HTML's tag "select"
         * 
         * @return HTML teg "select"

         */
        private function _abonement_selecting($type, $name, $attribs = null, $selected = 0, $idtag = false)
        {
            $db =& JFactory::getDBO();
            $table = $db->NameQuote('#__schedule_abonements');
            $fields[] = $db->NameQuote('num');
            $fields[] = $db->NameQuote('id');
            $query = 'SELECT '.implode(',',$fields);
            $query .= ' FROM '.$table;
            $query .= ' WHERE abonement_type_id = '.$type;
            $query .= ' ORDER BY '.implode(',',$fields);
            $db->setQuery($query);
            if ($abonements = $db->LoadObjectList())
            {
                $state = array();
                $state[] = JHTML::_('select.option'
                        , 0
                        , JText::_('SELECT_ABONEMENT')
                );
                foreach ($abonements as $abonement)
                {
                    $state[] = JHTML::_('select.option'
                            , $abonement->id
                            , JText::_($abonement->num)
                    );
                }
                return JHTML::_('select.genericlist'
                                , $state
                                , $name
                                , $attribs
                                , 'value'
                                , 'text'
                                , $selected
                                , $idtag
                                , false );
            }
         }
        /*
         * Geting week day array method
         *
         * @return array

         */
         private function _get_week_days_array()
         {
             return array(
                '1'=>'понедельник',
                '2'=>'вторник',
                '3'=>'среда',
                '4'=>'черверг',
                '5'=>'пятница',
                '6'=>'суббота',
                '7'=>'воскресенье',
            );

         }
        /*
         * Selecting week day method
         *
         * @var $name - name of HTML's tag "select"
         * @var $attribs - attributes of HTML's tag "select"
         * @var $selected - value of selected element
         * @var $idtag - id HTML's tag "select"
         *
         * @return HTML teg "select"

         */
        function week_day_selecting($name, $attribs = null, $selected = 0, $idtag = false)
        {
            $week_days = sh_helper::_get_week_days_array();
            $state = array();
            $state[] = JHTML::_('select.option'
                    , 0
                    , JText::_('SELECT_WEEK_DAY')
            );
            foreach ($week_days as $key=>$value)
            {
                $state[] = JHTML::_('select.option'
                        , $key
                        , JText::_($value)
                );
            }
            return JHTML::_('select.genericlist'
                            , $state
                            , $name
                            , $attribs
                            , 'value'
                            , 'text'
                            , $selected
                            , $idtag
                            , false );
         }
        /*
         * Selecting activate termin method
         *
         * @var $name - name of HTML's tag "select"
         * @var $attribs - attributes of HTML's tag "select"
         * @var $selected - value of selected element
         * @var $idtag - id HTML's tag "select"
         *
         * @return HTML teg "select"

         */
        function activate_period_selecting($name, $attribs = null, $selected = 0, $idtag = false)
        {
            $activate_periods = sh_helper::_get_activate_period_array();
            $state = array();
            $state[] = JHTML::_('select.option'
                    , 0
                    , JText::_('SELECT_ACTIVATE_TERM')
            );
            foreach ($activate_periods as $key=>$value)
            {
                $state[] = JHTML::_('select.option'
                        , $key
                        , JText::_($value)
                );
            }
            return JHTML::_('select.genericlist'
                            , $state
                            , $name
                            , $attribs
                            , 'value'
                            , 'text'
                            , $selected
                            , $idtag
                            , false );
         }
        /*
         * Selecting valdity termin method
         *
         * @var $name - name of HTML's tag "select"
         * @var $attribs - attributes of HTML's tag "select"
         * @var $selected - value of selected element
         * @var $idtag - id HTML's tag "select"
         *
         * @return HTML teg "select"

         */
        function valdity_period_selecting($name, $attribs = null, $selected = 0, $idtag = false)
        {
            $activate_periods = sh_helper::_get_validity_period_array();
            $state = array();
            $state[] = JHTML::_('select.option'
                    , 0
                    , JText::_('SELECT_VALIDITY_PERIOD')
            );
            foreach ($activate_periods as $key=>$value)
            {
                $state[] = JHTML::_('select.option'
                        , $key
                        , JText::_($value)
                );
            }
            return JHTML::_('select.genericlist'
                            , $state
                            , $name
                            , $attribs
                            , 'value'
                            , 'text'
                            , $selected
                            , $idtag
                            , false );
         }
        /*
         * Selecting sale type method
         *
         * @var $name - name of HTML's tag "select"
         * @var $attribs - attributes of HTML's tag "select"
         * @var $selected - value of selected element
         * @var $idtag - id HTML's tag "select"
         *
         * @return HTML teg "select"

         */
        function sale_type_selecting($name, $attribs = null, $selected = 0, $idtag = false)
        {
            $sale_types = sh_helper::_get_sale_type_array();
            $state = array();
            $state[] = JHTML::_('select.option'
                    , 0
                    , JText::_('SELECT_SALE_TYPE')
            );
            foreach ($sale_types as $key=>$value)
            {
                $state[] = JHTML::_('select.option'
                        , $key
                        , JText::_($value)
                );
            }
            return JHTML::_('select.genericlist'
                            , $state
                            , $name
                            , $attribs
                            , 'value'
                            , 'text'
                            , $selected
                            , $idtag
                            , false );
         }
        /*
         * Selecting worked trainer method
         *
         * @var $name - name of HTML's tag "select"
         * @var $attribs - attributes of HTML's tag "select"
         * @var $selected - value of selected element
         * @var $idtag - id HTML's tag "select"
         *
         * @return HTML teg "select"

         */
        function is_work_selecting($name, $attribs = null, $selected = 0, $idtag = false)
        {
            $state = array();
            $state[] = JHTML::_('select.option'
                    , 777
                    , JText::_('SELECT_IS_WORKED')
            );
            $state[] = JHTML::_('select.option'
                    , 1
                    , JText::_('WORKED')
            );
            $state[] = JHTML::_('select.option'
                    , 0
                    , JText::_('NOT_WORKED')
            );
            return JHTML::_('select.genericlist'
                            , $state
                            , $name
                            , $attribs
                            , 'value'
                            , 'text'
                            , $selected
                            , $idtag
                            , false );
         }
        /*
         * Selecting training status method
         * 
         * @var $name - name of HTML's tag "select"
         * @var $attribs - attributes of HTML's tag "select"
         * @var $selected - value of selected element
         * @var $idtag - id HTML's tag "select"
         * 
         * @return HTML teg "select"

         */
        function training_status_selecting($name, $attribs = null, $selected = 0, $idtag = false)
        {
            $db =& JFactory::getDBO();
            $table = $db->NameQuote('#__schedule_training_statuses');
            $fields[] = $db->NameQuote('name');
            $fields[] = $db->NameQuote('id');
            $query = 'SELECT '.implode(',',$fields);
            $query .= ' FROM '.$table;
            $query .= ' ORDER BY '.implode(',',$fields);
            $db->setQuery($query);
            if ($training_statuses = $db->LoadObjectList())
            {
                $state = array();
                $state[] = JHTML::_('select.option'
                        , 0
                        , JText::_('SELECT_TRAINING_STATUS')
                );
                foreach ($training_statuses as $training_status)
                {
                    $state[] = JHTML::_('select.option'
                            , $training_status->id
                            , JText::_($training_status->name)
                    );
                }
                return JHTML::_('select.genericlist'
                                , $state
                                , $name
                                , $attribs
                                , 'value'
                                , 'text'
                                , $selected
                                , $idtag
                                , false );
            }
         }
        /*
         * Selecting training method
         * 
         * @var $name - name of HTML's tag "select"
         * @var $attribs - attributes of HTML's tag "select"
         * @var $selected - value of selected element
         * @var $idtag - id HTML's tag "select"
         * 
         * @return HTML teg "select"

         */
        function training_selecting($name, $attribs = null, $selected = 0, $idtag = false)
        {
            $db =& JFactory::getDBO();
            $table = $db->NameQuote('#__schedule_trainings');
            $fields[] = $db->NameQuote('name');
            $fields[] = $db->NameQuote('id');
            $query = 'SELECT '.implode(',',$fields);
            $query .= ' FROM '.$table;
            $query .= ' ORDER BY '.implode(',',$fields);
            $db->setQuery($query);
            if ($trainings = $db->LoadObjectList())
            {
                $state = array();
                $state[] = JHTML::_('select.option'
                        , 0
                        , JText::_('SELECT_TRAINING')
                );
                foreach ($trainings as $training)
                {
                    $state[] = JHTML::_('select.option'
                            , $training->id
                            , JText::_($training->name)
                    );
                }
                return JHTML::_('select.genericlist'
                                , $state
                                , $name
                                , $attribs
                                , 'value'
                                , 'text'
                                , $selected
                                , $idtag
                                , false );
            }
         }
        /*
         * Selecting calendar method
         * 
         * @var $name - name of HTML's tag "select"
         * @var $attribs - attributes of HTML's tag "select"
         * @var $selected - value of selected element
         * @var $idtag - id HTML's tag "select"
         * 
         * @return HTML teg "select"

         */
        function calendar_selecting($name, $attribs = null, $selected = 0, $idtag = false)
        {
            global $mainframe;
            // Date filtering
            $filter_date = $mainframe->getUserStateFromRequest(
                            $option.'filter_date',
                            'filter_date',date('Y-m-d'));
            $db =& JFactory::getDBO();
            $tables[] = $db->NameQuote('#__schedule_calendar').' AS calendar';
            $tables[] = $db->NameQuote('#__schedule_trainings').' AS trainings';
            $fields[] = $db->NameQuote('trainings').'.'.$db->NameQuote('name');
            $fields[] = $db->NameQuote('calendar').'.'.$db->NameQuote('id');
            $fields[] = $db->NameQuote('calendar').'.'.$db->NameQuote('date');
            $fields[] = $db->NameQuote('calendar').'.'.$db->NameQuote('time_start');
            $where[] = $db->NameQuote('calendar').'.'.$db->NameQuote('date').' = "'.$filter_date.'"';
            $where[] = $db->NameQuote('trainings').'.'.$db->NameQuote('id')
                    .' = '.$db->NameQuote('calendar').'.'.$db->NameQuote('training_id');
            $query = 'SELECT '.implode(',',$fields);
            $query .= ' FROM '.implode(',',$tables);
            $query .= ' WHERE '.implode(' AND ',$where);
            $query .= ' ORDER BY '.implode(',',$fields);
            $db->setQuery($query);
            $state = array();
            $state[] = JHTML::_('select.option'
                    , 0
                    , JText::_('SELECT_TRAINING')
            );
            if ($calendars = $db->LoadObjectList())
            {
                foreach ($calendars as $calendar)
                {
                    $state[] = JHTML::_('select.option'
                            , $calendar->id
                            , JText::_($calendar->date.' '.$calendar->time_start.' '.$calendar->name)
                    );
                }
            }
                return JHTML::_('select.genericlist'
                                , $state
                                , $name
                                , $attribs
                                , 'value'
                                , 'text'
                                , $selected
                                , $idtag
                                , false );
         }
        /*
         * Selecting trainer method
         *
         * @var $name - name of HTML's tag "select"
         * @var $attribs - attributes of HTML's tag "select"
         * @var $selected - value of selected element
         * @var $idtag - id HTML's tag "select"
         *
         * @return HTML teg "select"

         */
        function trainer_selecting($name, $attribs = null, $selected = 0, $idtag = false)
        {
            $db =& JFactory::getDBO();
            $table = $db->NameQuote('#__schedule_trainers');
            $fields[] = $db->NameQuote('fam');
            $fields[] = $db->NameQuote('im');
            $fields[] = $db->NameQuote('ot');
            $fields[] = $db->NameQuote('id');
            $where[] = $db->NameQuote('is_work').' = 1';
            $query = 'SELECT '.implode(',',$fields);
            $query .= ' FROM '.$table;
            $query .= ' WHERE '.implode(' AND ',$where);
            $query .= ' ORDER BY '.implode(',',$fields);
            $db->setQuery($query);
            if ($trainers = $db->LoadObjectList())
            {
                $state = array();
                $state[] = JHTML::_('select.option'
                        , 0
                        , JText::_('SELECT_TRAINER')
                );
                foreach ($trainers as $trainer)
                {
                    $state[] = JHTML::_('select.option'
                            , $trainer->id
                            , JText::_($trainer->fam.' '.$trainer->im.' '.$trainer->ot)
                    );
                }
                return JHTML::_('select.genericlist'
                                , $state
                                , $name
                                , $attribs
                                , 'value'
                                , 'text'
                                , $selected
                                , $idtag
                                , false );
            }
         }
        /*
         * Get client method
         * 
         * @var $id - client's ID from schedule_clients table
         * 
         * @return string 

         */
        function get_client($id)
        {
            $db =& JFactory::getDBO();
            $table = $db->NameQuote('#__schedule_clients');
            $fields[] = $db->NameQuote('fam');
            $fields[] = $db->NameQuote('im');
            $fields[] = $db->NameQuote('ot');
            $where[] = $db->NameQuote('id').' = '.$id;
            $query = 'SELECT '.implode(',',$fields);
            $query .= ' FROM '.$table;
            $query .= ' WHERE '.implode(' AND ',$where);
            $db->setQuery($query);
            $client = $db->LoadRow();
            if ($client)
            {
                return implode(' ', $client);
            }
            else
            {
                return '';
            }
         }
        /*
         * Get abonement type method
         * 
         * @var $id - abonement type's ID from schedule_abonement_type table
         * 
         * @return string 

         */
        function get_abonement_type($id)
        {
            $db =& JFactory::getDBO();
            $table = $db->NameQuote('#__schedule_abonement_types');
            $fields[] = $db->NameQuote('name');
            $where[] = $db->NameQuote('id').' = '.$id;
            $query = 'SELECT '.implode(',',$fields);
            $query .= ' FROM '.$table;
            $query .= ' WHERE '.implode(' AND ',$where);
            
            $db->setQuery($query);
            $abonement_type = $db->LoadResult();
            
            if ($abonement_type)
            {
                return $abonement_type;
            }
            else
            {
                return '';
            }
         }
        /*
         * Get abonement method
         * 
         * @var $id - abonement's ID from schedule_abonement table
         * 
         * @return string 

         */
        function get_abonement($id)
        {
            $db =& JFactory::getDBO();
            $table = $db->NameQuote('#__schedule_abonements');
            $fields[] = $db->NameQuote('num');
            $where[] = $db->NameQuote('id').' = '.$id;
            $query = 'SELECT '.implode(',',$fields);
            $query .= ' FROM '.$table;
            $query .= ' WHERE '.implode(' AND ',$where);
            
            $db->setQuery($query);
            $abonement = $db->LoadResult();
            
            if ($abonement)
            {
                return $abonement;
            }
            else
            {
                return '';
            }
         }
        /*
         * Get training status method
         * 
         * @var $id - training statuse's ID from schedule_training_status table
         * 
         * @return string 

         */
        function get_training_status($id)
        {
            $db =& JFactory::getDBO();
            $table = $db->NameQuote('#__schedule_training_statuses');
            $fields[] = $db->NameQuote('name');
            $where[] = $db->NameQuote('id').' = '.$id;
            $query = 'SELECT '.implode(',',$fields);
            $query .= ' FROM '.$table;
            $query .= ' WHERE '.implode(' AND ',$where);
            
            $db->setQuery($query);
            $training_status = $db->LoadResult();
            
            if ($training_status)
            {
                return $training_status;
            }
            else
            {
                return '';
            }
         }
        /*
         * Get training type method
         * 
         * @var $id - training type's ID from schedule_training_status table
         * 
         * @return string 

         */
        function get_training_types($id)
        {
            $db =& JFactory::getDBO();
            $table = $db->NameQuote('#__schedule_training_types');
            $fields[] = $db->NameQuote('name');
            $where[] = $db->NameQuote('id').' = '.$id;
            $query = 'SELECT '.implode(',',$fields);
            $query .= ' FROM '.$table;
            $query .= ' WHERE '.implode(' AND ',$where);
            
            $db->setQuery($query);
            $training_types = $db->LoadResult();
            
            if ($training_types)
            {
                return $training_types;
            }
            else
            {
                return '';
            }
         }
        /*
         * Get training method
         * 
         * @var $id - trainins's ID from schedule_training table
         * 
         * @return string 

         */
        function get_training($id)
        {
            $db =& JFactory::getDBO();
            $table = $db->NameQuote('#__schedule_trainings');
            $fields[] = $db->NameQuote('name');
            $where[] = $db->NameQuote('id').' = '.$id;
            $query = 'SELECT '.implode(',',$fields);
            $query .= ' FROM '.$table;
            $query .= ' WHERE '.implode(' AND ',$where);
            
            $db->setQuery($query);
            $training = $db->LoadResult();
            
            if ($training)
            {
                return $training;
            }
            else
            {
                return '';
            }
         }
        /*
         * Get trainer method
         *
         * @var $id - client's ID from schedule_abonement_type table
         *
         * @return string

         */
        function get_trainer($id)
        {
            $db =& JFactory::getDBO();
            $table = $db->NameQuote('#__schedule_trainers');
            $fields[] = $db->NameQuote('fam');
            $fields[] = $db->NameQuote('im');
            $fields[] = $db->NameQuote('ot');
            $where[] = $db->NameQuote('id').' = '.$id;
            $query = 'SELECT '.implode(',',$fields);
            $query .= ' FROM '.$table;
            $query .= ' WHERE '.implode(' AND ',$where);

            $db->setQuery($query);
            
            $trainer = $db->LoadRow();

            if ($trainer)
            {
                return implode(' ',$trainer);
            }
            else
            {
                return '';
            }
         }
        /*
         * Get week day method
         *
         * @var $id - week day's key
         *
         * @return string

         */
        function get_week_day($id)
        {
            $week_days = sh_helper::_get_week_days_array();
            return $week_days[$id];
         }
        /*
         * Get activate period method
         *
         * @var $id - week day's key
         *
         * @return string

         */
        function get_activate_period($id)
        {
            $activate_periods = sh_helper::_get_activate_period_array();
            return $activate_periods[$id];
        }
        private function _get_activate_period_array()
        {
            return array(
                1 => JTEXT::_('ONE_MONTH'),
                3 => JTEXT::_('THREE_MONTHES')
            );
        }
        /*
         * Get activate period method
         *
         * @var $id - week day's key
         *
         * @return string

         */
        function get_validity_period($id)
        {
            $activate_periods = sh_helper::_get_validity_period_array();
            return $activate_periods[$id];
        }
        private function _get_validity_period_array()
        {
            return array(
                1 => JTEXT::_('ONE_MONTH'),
                3 => JTEXT::_('THREE_MONTHES'),
                6 => JTEXT::_('SIX_MONTHES'),
                12 => JTEXT::_('TWELV_MONTHES')
            );
        }
        /*
         * Get activate period method
         *
         * @var $id - week day's key
         *
         * @return string

         */
        function get_sale_type($id)
        {
            $sale_types = sh_helper::_get_sale_type_array();
            return $sale_types[$id];
        }
        private function _get_sale_type_array()
        {
            return array(
                JTEXT::_('CASH'),
                JTEXT::_('GIFT_CERT')
            );
        }
        /*
         * Convert to german format date
         *
         * @var $date - date by Y-m-d format
         *
         * @return string

         */
        function to_german_date($date)
        {
            return substr($date,8,2).'-'
				.substr($date,5,2).'-'
				.substr($date,0,4);
        }

    }
