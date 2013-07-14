<?php	                                       			 
/**
 * Visits form
 * 
 * @package    Training schedule
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
 * @license    GNU/GPL
 */

defined('_JEXEC') or die('Restricted access'); 
$url = JURI::base().'index.php?option=com_schedule&controller=visit&task=get_phone&client_id=';
$ajax_src = JURI::base().'components/com_schedule/assets/img/ajax-loader.gif';
?>
<script type="text/javascript">
jQuery(document).ready(function($){
    $('#ajax_loader').hide();
    $("#visit_phone").mask("+7(999) 999-99-99")
    $('#visit_client_id').change(function(){
        var client_id = jQuery(this).val();
        var re = /7([0-9]{3})([0-9]{3})([0-9]{2})([0-9]{2})/;
        $.ajaxSetup({
            beforeSend: function (){$('#ajax_loader').show();},
            complete: function (){$('#ajax_loader').hide();}
        });

        jQuery.ajax({
            type: 'GET',
            url: '<?=$url?>'+client_id,
            success: function(data){
                data = data.split(re);
                if(data == '')
                {
                    jQuery('#visit_phone').val('');
                }
                else
                {
                    var phone = '+7('+data[1]+') '+data[2]+'-'+data[3]+'-'+data[4];
                    jQuery('#visit_phone').val(phone);
                }
            }
        });
    });
});

</script>

<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php	                                       			  echo JText::_( 'Details' ); ?></legend>

		<table class="admintable">
<!--Наименование занятия-->
		<tr>
			<td width="100" align="right" class="key">
				<label for="visit_calendar_id">
					<?php	                                       			  echo JText::_( 'COM_SCHEDULE_CALENDAR_NAME' ); ?>:
				</label>
			</td>
			<td>
                            <?=$this->calendar_name?>
                            <input type="hidden" name="calendar_id" value="<?=$this->visit->calendar_id?>">
			</td>
		</tr>
<!--ФИО клиента и его выбор-->
		<tr>
			<td width="100" align="right" class="key">
				<label for="visit_client_id">
					<?php	                                       			  echo JText::_('CLIENT'); ?>:
				</label>
			</td>
			<td>
				<?=sh_helper::client_selecting(
                                        'client_id',
                                        null,
                                        $this->visit->client_id,
                                        'visit_client_id')?>
			</td>
		</tr>
<!--Телефон клиента-->
		<tr>
			<td width="100" align="right" class="key">
				<label for="visit_phone">
					<?php	                                       			  echo JText::_('PHONE'); ?>:
				</label>
			</td>
			<td>
                            <input type="text" name="phone" id="visit_phone" value="<?=$this->visit->phone?>"/>
                            <img id="ajax_loader" src="<?=$ajax_src?>" alt="ajax_loader"/>
			</td>
		</tr>
<!--Тип записи-->
		<tr>
			<td width="100" align="right" class="key">
				<label for="visit_training_type_id">
					<?php	                                       			  echo JText::_('COM_SCHEDULE_TRAINING_TYPE'); ?>:
				</label>
			</td>
			<td>
				<?=sh_helper::training_type_selecting(
                                        'training_type_id',
                                        null,
                                        $this->visit->training_type_id,
                                        'visit_training_type_id')?>
			</td>
		</tr>
<!--Зарегистрировался или нет-->
		<tr>
			<td width="100" align="right" class="key">
				<label for="visit_registered">
					<?php	                                       			  echo JText::_('COM_SCHEDULE_REGISTERED'); ?>:
				</label>
			</td>
			<td>
                            <select id="visit_registered" name="registered">
                                <option value="0" <?=$this->visit->registered?'':'selected="selected"'?>><?=JTEXT::_('NO')?></option>
                                <option value="1" <?=$this->visit->registered?'selected="selected"':''?>><?=JTEXT::_('YES')?></option>
                            </select>
			</td>
		</tr>
<!--Посетил занятие или нет-->
		<tr>
			<td width="100" align="right" class="key">
				<label for="visit_visited">
					<?php	                                       			  echo JText::_('COM_SCHEDULE_VISITED'); ?>:
				</label>
			</td>
			<td>
                            <select id="visit_visited" name="visited">
                                <option value="0" <?=$this->visit->visited?'':'selected="selected"'?>><?=JTEXT::_('NO')?></option>
                                <option value="1" <?=$this->visit->visited?'selected="selected"':''?>><?=JTEXT::_('YES')?></option>
                            </select>
			</td>
		</tr>
	</table>
	</fieldset>
</div>
<div class="clr"></div>

<input type="hidden" name="option" value="com_schedule" />
<input type="hidden" name="id" value="<?php	                                       			  echo $this->visit->id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="view" value="visits" />
<input type="hidden" name="controller" value="visit" />
</form>
