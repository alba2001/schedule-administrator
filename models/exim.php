<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelform library
jimport('joomla.application.component.model');
 
/**
 * Shedule Model
 */
class SchedulesModelExim extends JModel
{
    
    private $_ar_log = array();



    /**
     * Запись лога импорта
     * @param string $msg 
     */
    private function _log($msg)
    {
        $this->_ar_log[] = $msg;
    }

    /**
     * По дате и ФИО тренера - вичисляем занятие из расписания занятий. 
     * @param type $date
     * @param type $trainer_fio
     * @return int ID расписания
     */
    private function _get_calendar_id($_date, $trainer_fio)
    {
        $trainer_id = $this->_get_trainer_id($trainer_fio);
        if(!preg_replace('/^(\d+{2})\.(\d+{2})\.(\d+{4})$/', $_date, $regs))
        {
            $this->_log('Не правильный тип даты: '.$date);
            return 0;
        }
        $date = $regs[3].'-'.$regs[2].'-'.$regs[1];
        $query = 'SELECT id FROM #__schedule_calendar';
        $query .= ' WHERE trainer_id = '.$trainer_id;
        $query .= ' AND date = '.$date;
        
        $total = $this->_getListCount($query);
        if($total != 1)
        {
            $this->_log('Не возможео определить занятие'.$_date.' '.$trainer_fio);
            return 0;
        }
        $this->_db->setQuery($query);
        return $this->_db->loadResult();
        
    }

    /**
	 * Method to import CSV data from table virtuemart_product_custom_plg_param
	 *
	 * @param	noting
	 * @return	bool and error string.
	 * @since	0.0.1
         * @author	Konstantin Ovcharenko
	 */

        function import_csv()
        {
            $msg = 'OK';
            $path = JPATH_ROOT.DS.'tmp'.DS.'com_shedule_visits.csv';
            if (!$this->_get_file_import($path))
            {
                return array(FALSE, JTEXT::_('COM_SHEDULE_ERROR_UPLOAD_IMPORT_CSV_FILE'));
            }
//            $_data = array();  
            if ($fp = fopen($path, "r"))
            {
                $first_row = TRUE;
                while (($data = fgetcsv($fp, 1000, ';', '"')) !== FALSE) 
                {
                    if($first_row)
                    {
                       $first_row = FALSE; 
                    }
                    else
                    {
                        $date = $data[0];
                        $fam = iconv('windows-1251','utf-8',$data[1]);
                        $im = iconv('windows-1251','utf-8',$data[2]);
                        $trainer_fio = iconv('windows-1251','utf-8',$data[3]);
                        $abonement_num = $data[4];
                        $training_type_4 = $data[6];
                        
                        // 1. По дате и ФИО тренера - вичисляем занятие из расписания занятий. 
                        // Если не находим - игнорируем запись.
                        $calendar_id = $this->_get_calendar_id($date, $trainer_fio);
                        if(!$calendar_id)
                        {
                            continue;
                        }
                        
                        // 2. По ФИО клиента - вычисляем клиента. 
                        // Если не находим клиента - создаем его.
                        // $abonement_num - на всякий случай, если найдутся две одинаковые записи
                        // то хоть это поможет
                        $client_id = $this->_get_client_id($fam, $im, $abonement_num);
                        if(!$client_id)
                        {
                            $client_id = $this->_create_client($fam, $im);
                        }
                        
                        $abonement_id = 0;
                        $training_type_id = 0;
                        if($abonement_num)
                        {
                            
                            // 3. По № абонемента - находим абонемент. 
                            // Если у клиента п.2. еще нет абонемента с таким № - 
                            // вставляем новую запись в таблицу абонементов.
                            $abonement_id = $this->_get_abonement_id($abonement_num);
                            if(!$abonement_id)
                            {
                                $abonement_id = $this->_create_abonement($abonement_num, $client_id);
                            }

                            // Проверяем соответствие $client_id и $abonement_id
                            if(!$this->_check_abonement_num($client_id, $abonement_id))
                            {
                                $this->_log('Номер абонемента: '.$abonement_num.' не соответствует клиенту: '.$fam.' '.$im);
                                continue;
                            }
                            
                            // Определяем, что тип посещения - абонемент
                            $training_type_id = '1';
                        }
                        
                        //4. Если заполнено поле "разовое", то определяем, что тип посещения - "разовое"
                        if($training_type_4)
                        {
                            
                            $training_type_id = '4';
                        }
                        
                    }
                }
                fclose($fp);
            }
            else
            {
                return array(FALSE, JTEXT::_('COM_SHEDULE_ERROR_OPEN_TO_IMPORT'));
            }
            return array(TRUE,$msg);
        }
        

        /**
	 * Method to load CSV file from $_FILE variable
	 *
	 * @param	string - path to dest
	 * @return	bool
	 * @since	0.0.1
         * @author	Konstantin Ovcharenko
	 */
        private function _get_file_import($tmp_dest)
        {
           
            $jFileInput = new JInput($_FILES);
            $theFile = $jFileInput->get('file_upload',array(),'array');


            // If there is no uploaded file, we have a problem...
            if (!is_array($theFile)) {
                JError::raiseWarning('', 'No file was selected.');
                return false;
            }
            // Build the paths for our file to move to the components 'upload' directory
            $tmp_src    = $theFile['tmp_name'];

            // Move uploaded file
            jimport('joomla.filesystem.file');
            return JFile::upload($tmp_src, $tmp_dest);
        }
        
}
