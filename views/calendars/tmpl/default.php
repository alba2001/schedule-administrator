<?php 
    defined('_JEXEC') or die('Restricted access'); 
    /**
    * Calendar list
    * 
    * @package    Training schedule
    * @subpackage Components
    * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
    * @license    GNU/GPL
    */
$scale_src = JURI::base().'components/com_schedule/assets/img/shkala-%num%.png';    
?>
<script type="text/javascript">
jQuery(document).ready(function($){
   $("#search").mask("99-99-2099");
});
</script>

<form action="index.php" method="post" name="adminForm">
<table>
    <tr>
        <td align="left" width="100%">
            <?php echo JText::_('Filter'); ?>:
            <input type="text" name="filter_search_date" id="search"
            value="<?php echo $this->lists['search'];?>"
            class="text_area">
            <button onclick="this.form.submit();">
            <?php echo JText::_('Search'); ?>
            </button>
            <button onclick="document.adminForm.
            filter_search_date.value='';this.form.submit();">
            <?php echo JText::_('Reset'); ?>
            </button>
        </td>
        <td nowrap="nowrap">
            <?=sh_helper::training_selecting(
                    'filter_training',
                    array('onchange'=>'document.adminForm.submit()'),
                    $this->lists['filter_training'],
                    'training_filter_training')?>
            <?=sh_helper::trainer_selecting(
                    'filter_trainer',
                    array('onchange'=>'document.adminForm.submit()'),
                    $this->lists['filter_trainer'],
                    'training_filter_trainer')?>
            <?=sh_helper::training_status_selecting(
                    'filter_training_status',
                    array('onchange'=>'document.adminForm.submit()'),
                    $this->lists['filter_training_status'],
                    'training_filter_training_status')?>
        </td>
    </tr>
</table>
<div id="editcell">
	<table class="adminlist">
	<thead>
		<tr>
			<th width="5">
                            <?php echo JHTML::_('grid.sort', JText::_('ID'), 'id',
                                $this->lists['order_Dir'],
                                $this->lists['order'] ); ?>
			</th>
			<th width="20">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
			</th>			
			<th>
                            <?=JText::_('COM_SCHEDULE_TRAINING_NAME')?>
			</th>
			<th>
                            <?=JText::_('TRAINER')?>
			</th>
			<th>
                            <?php echo JHTML::_('grid.sort', JText::_('COM_SCHEDULE_CALENDAR_DATE'), 'date',
                                $this->lists['order_Dir'],
                                $this->lists['order'] ); ?>
			</th>
			<th>
                            <?php echo JHTML::_('grid.sort', JText::_('COM_SCHEDULE_TRAINING_STATUS'), 'date_sale',
                                $this->lists['order_Dir'],
                                $this->lists['order'] ); ?>
			</th>
			<th>
                            <?php echo JText::_('COM_SCHEDULE_VISITORS')?>
			</th>
		</tr>
	</thead>
	<?php
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)	{
		$row = &$this->items[$i];
		$checked 	= JHTML::_('grid.id',   $i, $row->id );
		$link 		= JRoute::_( 'index.php?option=com_schedule&controller=calendar&task=edit&cid[]='. $row->id );
		?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
				<?php echo $row->id; ?>
			</td>
			<td>
				<?php echo $checked; ?>
			</td>
			<td>
                            <a href="<?php echo $link; ?>"><?=sh_helper::get_training($row->training_id)?></a>
			</td>
			<td>
				<?=sh_helper::get_trainer($row->trainer_id)?>
			</td>
			<td>
				<?=substr($row->date,8,2).' '?>
				<?=substr($row->date,5,2).' '?>
				<?=substr($row->date,0,4)?>
			</td>
			<td>
				<?=sh_helper::get_training_status($row->training_status_id)?>
			</td>
                        <td style="text-align: right; vertical-align: middle;">
                            <?php $num=ceil($row->visits*7/$row->max_clients) ?>
                            <img src="<?=  str_replace('%num%', $num, $scale_src)?>" border="0" alt=""/>
                        </td>
		</tr>
		<?php
		$k = 1 - $k;
	}
	?>
            <tfoot>
                <tr>
                    <td colspan="6">
                        <?php echo $this->page->getListFooter(); ?>
                    </td>
                </tr>
            </tfoot>
	</table>
</div>

    <input type="hidden" name="option" value="com_schedule" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="view" value="calendars" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="controller" value="calendar" />
    <input type="hidden" name="filter_order"
    value="<?php echo $this->lists['order']; ?>" />
    <input type="hidden" name="filter_order_Dir" value="" />
</form>
