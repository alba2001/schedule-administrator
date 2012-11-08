<?php defined('_JEXEC') or die('Restricted access'); ?>
<script type="text/javascript">
jQuery(document).ready(function($){
   $("#prolongation_date_from").mask("2099-99-99");
   $("#prolongation_date_to").mask("2099-99-99");
});
</script>

<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>

		<table class="admintable">
		<tr>
			<td width="100" align="right" class="key">
				<label for="prolongation_abonement_id">
					<?php echo JText::_( 'COM_SCHEDULE_ABONEMENT_NUM' ); ?>:
				</label>
			</td>
			<td>
				<?=sh_helper::abonement_selecting(
                                        'abonement_id',
                                        null,
                                        $this->prolongation->abonement_id,
                                        'prolongation_abonement_id')?>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="prolongation_date_from">
					<?php echo JText::_( 'COM_SCHEDULE_FREEZING_DATE_FROM' ); ?>:
				</label>
			</td>
			<td>
                            <?php echo JHTML::_('calendar', 
                                    $value = $this->prolongation->date_from, 
                                    $name='date_from', 
                                    $id='prolongation_date_from', 
                                    $format = '%Y-%m-%d', 
                                    $attribs = null); ?>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="prolongation_date_to">
					<?php echo JText::_( 'COM_SCHEDULE_FREEZING_DATE_TO' ); ?>:
				</label>
			</td>
			<td>
                            <?php echo JHTML::_('calendar', 
                                    $value = $this->prolongation->date_to, 
                                    $name='date_to', 
                                    $id='prolongation_date_to', 
                                    $format = '%Y-%m-%d', 
                                    $attribs = null); ?>
			</td>
		</tr>
	</table>
	</fieldset>
</div>
<div class="clr"></div>

<input type="hidden" name="option" value="com_schedule" />
<input type="hidden" name="id" value="<?php echo $this->prolongation->id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="view" value="prolongations" />
<input type="hidden" name="controller" value="prolongation" />
</form>
