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
?>
<? JHTML::_('behavior.visit'); ?>
<script type="text/javascript">
jQuery(document).ready(function($){
   $("#visit_date").mask("2099-99-99");
});
</script>

<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>

		<table class="admintable">
		<tr>
			<td width="100" align="right" class="key">
				<label for="visit_training_id">
					<?php echo JText::_( 'COM_SCHEDULE_TRAINING_NAME' ); ?>:
				</label>
			</td>
			<td>
				<?=sh_helper::training_selecting(
                                        'training_id',
                                        null,
                                        $this->visit->training_id,
                                        'visit_training_id')?>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="visit_trainer_id">
					<?php echo JText::_('TRAINER'); ?>:
				</label>
			</td>
			<td>
				<?=sh_helper::trainer_selecting(
                                        'trainer_id',
                                        null,
                                        $this->visit->trainer_id,
                                        'visit_trainer_id')?>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="visit_date">
					<?php echo JText::_( 'COM_SCHEDULE_CALENDAR_DATE' ); ?>:
				</label>
			</td>
			<td>
                            <?php echo JHTML::_('calendar', 
                                    $value = $this->visit->date, 
                                    $name='date', 
                                    $id='visit_date', 
                                    $format = '%Y-%m-%d', 
                                    $attribs = null); ?>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="visit_training_status_id">
					<?php echo JText::_('COM_SCHEDULE_TRAINING_STATUS'); ?>:
				</label>
			</td>
			<td>
				<?=sh_helper::training_status_selecting(
                                        'training_status_id',
                                        null,
                                        $this->visit->training_status_id,
                                        'visit_training_status_id')?>
			</td>
		</tr>
	</table>
	</fieldset>
</div>
<div class="clr"></div>

<input type="hidden" name="option" value="com_schedule" />
<input type="hidden" name="id" value="<?php echo $this->visit->id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="view" value="visits" />
<input type="hidden" name="controller" value="visit" />
</form>
