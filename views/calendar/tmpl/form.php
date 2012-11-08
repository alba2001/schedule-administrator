<?php
/**
 * Calendars form
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
   $("#calendar_date").mask("2099-99-99");
});
</script>

<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>

		<table class="admintable">
		<tr>
			<td width="100" align="right" class="key">
				<label for="calendar_training_id">
					<?php echo JText::_( 'COM_SCHEDULE_TRAINING_NAME' ); ?>:
				</label>
			</td>
			<td>
				<?=sh_helper::training_selecting(
                                        'training_id',
                                        null,
                                        $this->calendar->training_id,
                                        'calendar_training_id')?>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="calendar_trainer_id">
					<?php echo JText::_('TRAINER'); ?>:
				</label>
			</td>
			<td>
				<?=sh_helper::trainer_selecting(
                                        'trainer_id',
                                        null,
                                        $this->calendar->trainer_id,
                                        'calendar_trainer_id')?>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="calendar_date">
					<?php echo JText::_( 'COM_SCHEDULE_CALENDAR_DATE' ); ?>:
				</label>
			</td>
			<td>
                            <?php echo JHTML::_('calendar', 
                                    $value = $this->calendar->date, 
                                    $name='date', 
                                    $id='calendar_date', 
                                    $format = '%Y-%m-%d', 
                                    $attribs = null); ?>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="calendar_training_status_id">
					<?php echo JText::_('COM_SCHEDULE_TRAINING_STATUS'); ?>:
				</label>
			</td>
			<td>
				<?=sh_helper::training_status_selecting(
                                        'training_status_id',
                                        null,
                                        $this->calendar->training_status_id,
                                        'calendar_training_status_id')?>
			</td>
		</tr>
	</table>
	</fieldset>
</div>
<div class="clr"></div>

<input type="hidden" name="option" value="com_schedule" />
<input type="hidden" name="id" value="<?php echo $this->calendar->id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="view" value="calendars" />
<input type="hidden" name="controller" value="calendar" />
</form>
