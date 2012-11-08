<?php defined('_JEXEC') or die('Restricted access'); ?>

<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>

		<table class="admintable">
		<tr>
			<td width="100" align="right" class="key">
				<label for="client_fam">
					<?php echo JText::_( 'COM_SCHEDULE_FAM' ); ?>:
				</label>
			</td>
			<td>
				<input class="text" type="text" name="fam" id="client_fam" size="30" maxlength="50" value="<?php echo $this->client->fam;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="client_im">
					<?php echo JText::_( 'COM_SCHEDULE_IM' ); ?>:
				</label>
			</td>
			<td>
				<input class="text" type="text" name="im" id="client_im" size="30" maxlength="50" value="<?php echo $this->client->im;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="client_ot">
					<?php echo JText::_( 'COM_SCHEDULE_OT' ); ?>:
				</label>
			</td>
			<td>
				<input class="text" type="text" name="ot" id="client_ot" size="30" maxlength="50" value="<?php echo $this->client->ot;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="client_phone">
					<?php echo JText::_( 'COM_SCHEDULE_PHONE' ); ?>:
				</label>
			</td>
			<td>
				<input class="text" type="text" name="phone" id="client_phone" size="30" maxlength="50" value="<?php echo $this->client->phone;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="client_email">
					<?php echo JText::_( 'COM_SCHEDULE_EMAIL' ); ?>:
				</label>
			</td>
			<td>
				<input class="text" type="text" name="email" id="client_email" size="30" maxlength="50" value="<?php echo $this->client->email;?>" />
			</td>
		</tr>
	</table>
	</fieldset>
</div>
<div class="clr"></div>

<input type="hidden" name="option" value="com_schedule" />
<input type="hidden" name="id" value="<?php echo $this->client->id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="view" value="clients" />
<input type="hidden" name="controller" value="client" />
</form>
