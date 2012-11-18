<?php
/**
 * Vid Model for Schedule Component
 * 
 * @package    Vid schedule
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

require_once (dirname( __FILE__ ).DS.'kmodel.php');
/**
 * Vid Schedule Model
 *
 * @package    Vid schedule
 * @subpackage Components
 */
class SchedulesModelVid extends Kmodel
{

    var $_tbl_name = 'schedule_vids';
    var $_fields = array(
        'id'=>0,
        'name'=>NULL,
        'vid_link'=>NULL
    );
}