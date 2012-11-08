<?php defined('_JEXEC') or die('Restricted access'); ?>

<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>

		<table class="admintable">
		<tr>
			<td width="100" align="right" class="key">
				<label for="trainer_fam">
					<?php echo JText::_( 'COM_SCHEDULE_FAM' ); ?>:
				</label>
			</td>
			<td>
				<input class="text" type="text" name="fam" id="trainer_fam" size="30" maxlength="50" value="<?php echo $this->trainer->fam;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="trainer_im">
					<?php echo JText::_( 'COM_SCHEDULE_IM' ); ?>:
				</label>
			</td>
			<td>
				<input class="text" type="text" name="im" id="trainer_im" size="30" maxlength="50" value="<?php echo $this->trainer->im;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="trainer_ot">
					<?php echo JText::_( 'COM_SCHEDULE_OT' ); ?>:
				</label>
			</td>
			<td>
				<input class="text" type="text" name="ot" id="trainer_ot" size="30" maxlength="50" value="<?php echo $this->trainer->ot;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="trainer_phone">
					<?php echo JText::_( 'COM_SCHEDULE_PHONE' ); ?>:
				</label>
			</td>
			<td>
				<input class="text" type="text" name="phone" id="trainer_phone" size="30" maxlength="50" value="<?php echo $this->trainer->phone;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="trainer_is_work">
					<?php echo JText::_( 'COM_SCHEDULE_IS_WORK' ); ?>:
				</label>
			</td>
			<td>
                            <select name="is_work" id="trainer_is_work">
                                <option value="0" <?=$this->trainer->is_work?'':'selected="selected"'?>><?=JTEXT::_('NO')?></option>
                                <option value="1" <?=$this->trainer->is_work?'selected="selected"':''?>><?=JTEXT::_('YES')?></option>
                            </select>
			</td>
		</tr>
		<tr>
			<td width="500" align="right" class="key">
				<label for="trainer_link">
					<?php echo JText::_( 'COM_SCHEDULE_TRAINER_LINK' ); ?>:
				</label>
			</td>
			<td>
				<input class="text" type="text" name="trainer_link" id="trainer_link" size="100" maxlength="500" value="<?php echo $this->trainer->trainer_link;?>" />
			</td>
		</tr>
            </table>
	</fieldset>
</div>
<div class="clr"></div>

<input type="hidden" name="option" value="com_schedule" />
<input type="hidden" name="id" value="<?php echo $this->trainer->id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="view" value="trainers" />
<input type="hidden" name="controller" value="trainer" />
</form>
