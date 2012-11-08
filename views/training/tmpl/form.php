<?php
/**
 * Trainings form
 * 
 * @package    Training schedule
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
 * @license    GNU/GPL
 */

    defined('_JEXEC') or die('Restricted access');
?>
<? JHTML::_('behavior.calendar'); ?>
<script type="text/javascript">
jQuery(document).ready(function($){
   $("#training_time_start").mask("99:99");
   $("#training_time_stop").mask("99:99");
   $("#training_date_start").mask("2099-99-99");
   $("#training_date_stop").mask("2099-99-99");
});
</script>
<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>

		<table class="admintable">
		<tr>
			<td width="100" align="right" class="key">
				<label for="training_name">
					<?php echo JText::_( 'COM_SCHEDULE_TRAINING_NAME' ); ?>:
				</label>
			</td>
			<td>
				<input class="text" type="text" name="name" id="training_name" size="30" maxlength="50" value="<?php echo $this->training->name;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="training_trainer_id">
					<?php echo JText::_('TRAINER'); ?>:
				</label>
			</td>
			<td>
				<?=sh_helper::trainer_selecting(
                                        'trainer_id',
                                        null,
                                        $this->training->trainer_id,
                                        'training_trainer_id')?>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="training_week_day">
					<?php echo JText::_( 'COM_SCHEDULE_WEEK_DAY' ); ?>:
				</label>
			</td>
			<td>
                            <?=sh_helper::week_day_selecting(
                                       'week_day',
                                        null,
                                        $this->training->week_day,
                                        'training_week_day')?>
                        </td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="training_time_start">
					<?php echo JText::_( 'COM_SCHEDULE_TRAINING_TIME_START' ); ?>:
				</label>
			</td>
			<td>
                            <input class="text" type="text" name="time_start"
                                   id="training_time_start" size="10" maxlength="10"
                                   value="<?php echo $this->training->time_start;?>" />
                        </td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="training_time_stop">
					<?php echo JText::_( 'COM_SCHEDULE_TRAINING_TIME_STOP' ); ?>:
				</label>
			</td>
			<td>
                            <input class="text" type="text" name="time_stop"
                                   id="training_time_stop" size="10" maxlength="10"
                                   value="<?php echo $this->training->time_stop;?>" />
                        </td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="training_date_start">
					<?php echo JText::_( 'COM_SCHEDULE_TRAINING_DATE_STATR' ); ?>:
				</label>
			</td>
			<td>
                            <?php echo JHTML::_('calendar',
                                    $value = $this->training->date_start,
                                    $name='date_start',
                                    $id='training_date_start',
                                    $format = '%Y-%m-%d',
                                    $attribs = null); ?>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="training_date_stop">
					<?php echo JText::_( 'COM_SCHEDULE_TRAINING_DATE_STOP' ); ?>:
				</label>
			</td>
			<td>
                            <?php echo JHTML::_('calendar',
                                    $value = $this->training->date_stop,
                                    $name='date_stop',
                                    $id='training_date_stop',
                                    $format = '%Y-%m-%d',
                                    $attribs = null); ?>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="training_max_clients">
					<?php echo JText::_( 'COM_SCHEDULE_TRAINING_MAX_CLIENTS' ); ?>:
				</label>
			</td>
			<td>
				<input class="text"
                                       type="text"
                                       name="max_clients"
                                       id="training_max_clients"
                                       size="10" maxlength="10"
                                       value="<?php echo $this->training->max_clients;?>" />
			</td>
		</tr>
		<tr>
			<td width="500" align="right" class="key">
				<label for="training_link">
					<?php echo JText::_( 'COM_SCHEDULE_TRAINING_LINK' ); ?>:
				</label>
			</td>
			<td>
				<input class="text" type="text" name="training_link" id="training_link" size="100" maxlength="500" value="<?php echo $this->trainer->training_link;?>" />
			</td>
		</tr>
	</table>
	</fieldset>
</div>
<div class="clr"></div>

<input type="hidden" name="option" value="com_schedule" />
<input type="hidden" name="id" value="<?php echo $this->training->id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="view" value="trainings" />
<input type="hidden" name="controller" value="training" />
</form>
