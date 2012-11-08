<?php
/**
 * Abonements form
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
   $("#abonement_sale_date").mask("2099-99-99");
   $("#abonement_activate_date").mask("2099-99-99");
});
</script>
<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>

		<table class="admintable">
		<tr>
			<td width="100" align="right" class="key">
				<label for="abonement_num">
					<?php echo JText::_( 'COM_SCHEDULE_ABONEMENT_NUM' ); ?>:
				</label>
			</td>
			<td>
				<input class="text" type="text" name="num" id="abonement_num" size="30" maxlength="50" value="<?php echo $this->abonement->num;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="abonement_client_id">
					<?php echo JText::_('CLIENT'); ?>:
				</label>
			</td>
			<td>
				<?=sh_helper::client_selecting(
                                        'client_id',
                                        null,
                                        $this->abonement->client_id,
                                        'abonement_client_id')?>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="abonement_abonement_type_id">
					<?php echo JText::_('COM_SCHEDULE_ABONEMENT_TYPE'); ?>:
				</label>
			</td>
			<td>
				<?=sh_helper::abonement_type_selecting(
                                        'abonement_type_id',
                                        null,
                                        $this->abonement->abonement_type_id,
                                        'abonement_abonement_type_id')?>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="abonement_sale_date">
					<?php echo JText::_( 'COM_SCHEDULE_SALE_DATE' ); ?>:
				</label>
			</td>
			<td>
                            <?php echo JHTML::_('calendar', 
                                    $value = $this->abonement->sale_date, 
                                    $name='sale_date', 
                                    $id='abonement_sale_date', 
                                    $format = '%Y-%m-%d', 
                                    $attribs = null); ?>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="abonement_activate_period">
					<?php echo JText::_( 'COM_SCHEDULE_ACTIVATE_PERIOD' ); ?>:
				</label>
			</td>
			<td>
				<?=sh_helper::activate_period_selecting(
                                        'activate_period',
                                        null,
                                        $this->abonement->activate_period,
                                        'abonement_activate_period')?>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="abonement_sale_type">
					<?php echo JText::_( 'COM_SCHEDULE_TYPE_SALE' ); ?>:
				</label>
			</td>
			<td>
				<?=sh_helper::sale_type_selecting(
                                        'sale_type',
                                        null,
                                        $this->abonement->sale_type,
                                        'abonement_sale_type')?>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="abonement_cost_num">
					<?php echo JText::_( 'COM_SCHEDULE_COST_NUM' ); ?>:
				</label>
			</td>
			<td>
				<input class="text" type="text" name="cost_num" id="abonement_cost_num" size="30" maxlength="30" value="<?php echo $this->abonement->cost_num;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="abonement_validity_period">
					<?php echo JText::_( 'COM_SCHEDULE_VALIDITY_PERIOD' ); ?>:
				</label>
			</td>
			<td>
				<?=sh_helper::valdity_period_selecting(
                                        'validity_period',
                                        null,
                                        $this->abonement->validity_period,
                                        'abonement_validity_period')?>
			</td>
		</tr>
	</table>
	</fieldset>
</div>
<div class="clr"></div>

<input type="hidden" name="option" value="com_schedule" />
<input type="hidden" name="id" value="<?php echo $this->abonement->id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="view" value="abonements" />
<input type="hidden" name="controller" value="abonement" />
</form>
