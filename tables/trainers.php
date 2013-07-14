<?php	                                       			 
/**
 * Trainers table class
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
 * Trainers Table class
 *
 * @package    Training schedule
 * @subpackage Components
 */
class TableTrainers extends KTable
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
	var $im = null;
	/**
	 * @var string
	 */
	var $fam = null;
	/**
	 * @var string
	 */
	var $ot = null;
	/**
	 * @var string
	 */
	var $phone = null;
	/**
	 * @var int
	 */
	var $is_work = null;
	/**
	 * @var string
	 */
	var $trainer_link = null;
	/**
	 * @var date
	 */
	var $trainer_birthday = null;

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableTrainers(& $db) {
		parent::__construct('#__schedule_trainers', 'id', $db);
	}
    /**
     * Method to store a record
     *
     * @access	public
     * @return	boolean	OR ID stored record
     */
    function store_data($data=NULL) 
    {
        if (!isset($data)) {
            $data = JRequest::get('post');
        }
        preg_match("/([0-9]{2}).([0-9]{2}).([0-9]{4})/", $data['trainer_birthday'], $regs);
        $data['trainer_birthday'] = $regs[3] . '-' . $regs[2] . '-' . $regs[1];
        return parent::store_data($data);
    }
        
}