<?php
/**
 * Abonements table class
 * 
 * @package    Training schedule
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once (dirname( __FILE__ ).DS.'ktable.php');
/**
 * Abonements Table class
 *
 * @package    Training schedule
 * @subpackage Components
 */
class TableAbonements extends KTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;

	/**
	 * @var string
	 */
	var $num = null;
	/**
	 * @var int
	 */
	var $client_id = null;
	/**
	 * @var int
	 */
	var $abonement_type_id = null;
	/**
	 * @var date
	 */
	var $sale_date = null;
	/**
	 * @var int
	 */
	var $activate_period = null;
	/**
	 * @var date
	 */
	var $activate_date = null;
	/**
	 * @var int
	 */
	var $validity_period = null;
	/**
	 * @var int
	 */
	var $sale_type = null;
	/**
	 * @var varchar
	 */
	var $cost_num = null;

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableAbonements(& $db) {
		parent::__construct('#__schedule_abonements', 'id', $db);
	}
        /**
         * Проверяем активирован или нет абонемент.
         * @return bolean 
         */
        function is_active()
        {
            $pattern = "/(\d{4})-(\d{2})-(\d{2})/";
            $replace = "\\1\\2\\3";
            $is_active = (int)preg_replace($pattern,$replace,$this->activate_date);
            return $is_active;

        }
        /**
         * Проверяем не прошел ли срок активации
         * @return bolean 
         */
        function is_out_of_activate()
        {
            $date = new DateTime($this->sale_date);
            $date->modify('+'.(int)$this->activate_period.' month');
            $expiration_date = $date->format('Y-m-d');
            return $expiration_date < date('Y-m-d');
            
        }
        /**
         * Проверяем не просрочен ли абонемент
         * @return bolean 
         */
        function is_out_of_date()
        {
            $date = new DateTime($this->activate_date);
            $date->modify('+'.(int)$this->validity_period.' month');
            $expiration_date = $date->format('Y-m-d');
            return $expiration_date < date('Y-m-d');
            
        }
        /**
         * Проверяем не заморожен ли абонемент
         * @return bolean 
         */
        function is_freezing()
        {
            $freezings = & JTable::getInstance('freezings','Table')
                    ->get_rows(array('abonement_id'=>$this->id));
            $date = date('Y-m-d');
            foreach($freezings as $freezing)
            {
                if($date>$freezing['date_from'] AND  $date<=$freezing['date_to'])
                {
                    return TRUE;
                }
            }
            return FALSE;
            
        }
}