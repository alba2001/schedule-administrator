    <?php
/**
 * Vids form
 * 
 * @package    Vid schedule
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
 * @license    GNU/GPL
 */

    defined('_JEXEC') or die('Restricted access');
?>
<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>

		<table class="admintable">
		<tr>
			<td width="100" align="right" class="key">
				<label for="vid_name">
					<?php echo JText::_( 'COM_SCHEDULE_TRAINING_NAME' ); ?>:
				</label>
			</td>
			<td>
				<input class="text" type="text" name="name" id="vid_name" size="30" maxlength="50" value="<?php echo $this->vid->name;?>" />
			</td>
		</tr>
		<tr>
			<td width="500" align="right" class="key">
				<label for="vid_link">
					<?php echo JText::_( 'COM_SCHEDULE_TRAINING_LINK' ); ?>:
				</label>
			</td>
			<td>
				<input class="text" type="text" name="training_link" id="vid_link" size="100" maxlength="500" value="<?php echo $this->vid->training_link;?>" />
			</td>
		</tr>
	</table>
	</fieldset>
</div>
<div class="clr"></div>

<input type="hidden" name="option" value="com_schedule" />
<input type="hidden" name="id" value="<?php echo $this->vid->id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="view" value="vids" />
<input type="hidden" name="controller" value="vid" />
</form>
