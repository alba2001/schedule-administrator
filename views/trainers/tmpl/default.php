<?php	                                       			  defined('_JEXEC') or die('Restricted access'); ?>
<style type="text/css">
    td.crossed{text-decoration:line-through}
</style>

<form action="index.php" method="post" name="adminForm">
<table>
    <tr>
        <td align="left" width="100%">
            <?php	                                       			  echo JText::_('Filter'); ?>:
            <input type="text" name="filter_search_pfam" id="search"
            value="<?php	                                       			  echo $this->lists['search'];?>"
            class="text_area">
            <button onclick="this.form.submit();">
            <?php	                                       			  echo JText::_('Search'); ?>
            </button>
            <button onclick="document.adminForm.
            filter_search_pfam.value='';this.form.submit();">
            <?php	                                       			  echo JText::_('Reset'); ?>
            </button>
        </td>
        <td nowrap="nowrap">
            <?=sh_helper::is_work_selecting(
                    'filter_search_is_work',
                    array('onchange'=>'document.adminForm.submit()'),
                    $this->lists['filter_search_is_work'],
                    'filter_search_is_work')?>
        </td>
    </tr>
</table>

<div id="editcell">
	<table class="adminlist">
	<thead>
		<tr>
			<th width="5">
                            <?php	                                       			  echo JHTML::_('grid.sort', JText::_('ID'), 'id',
                                $this->lists['order_Dir'],
                                $this->lists['order'] ); ?>
			</th>
			<th width="20">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php	                                       			  echo count( $this->items ); ?>);" />
			</th>			
			<th>
                            <?php	                                       			  echo JHTML::_('grid.sort', JText::_('COM_SCHEDULE_FAM'), 'fam',
                                $this->lists['order_Dir'],
                                $this->lists['order'] ); ?>
			</th>
			<th>
				<?php	                                       			  echo JText::_( 'COM_SCHEDULE_IM' ); ?>
			</th>
			<th>
				<?php	                                       			  echo JText::_( 'COM_SCHEDULE_OT' ); ?>
			</th>
			<th>
				<?php	                                       			  echo JText::_( 'COM_SCHEDULE_PHONE' ); ?>
			</th>
			<th>
				<?php	                                       			  echo JText::_( 'COM_SCHEDULE_BIRTHDAY' ); ?>
			</th>
		</tr>
	</thead>
	<?php	                                       			 
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)	{
		$row = &$this->items[$i];
		$checked 	= JHTML::_('grid.id',   $i, $row->id );
		$link 		= JRoute::_( 'index.php?option=com_schedule&controller=trainer&task=edit&cid[]='. $row->id );
		?>
		<tr class="<?php	                                       			  echo "row$k"; ?>">
			<td>
				<?php	                                       			  echo $row->id; ?>
			</td>
			<td>
				<?php	                                       			  echo $checked; ?>
			</td>
			<td <?=$row->is_work?'':'class="crossed"'?>>
				<a href="<?php	                                       			  echo $link; ?>"><?php	                                       			  echo $row->fam; ?></a>
			</td>
			<td <?=$row->is_work?'':'class="crossed"'?>>
				<?php	                                       			  echo $row->im; ?>
			</td>
			<td <?=$row->is_work?'':'class="crossed"'?>>
				<?php	                                       			  echo $row->ot; ?>
			</td>
			<td>
				<?php	                                       			  echo $row->phone; ?>
			</td>
			<td>
                            <?php	                                       			 
                            preg_match("/([0-9]{4})-([0-9]{2})-([0-9]{2})/", $row->trainer_birthday, $regs);
                            $date = $regs[3].'.'.$regs[2].'.'.$regs[1];
                            ?>
				<?php	                                       			  echo $date; ?>
			</td>
		</tr>
		<?php	                                       			 
		$k = 1 - $k;
	}
	?>
        <tfoot>
            <tr>
                <td colspan="7">
                    <?php	                                       			  echo $this->page->getListFooter(); ?>
                </td>
            </tr>
        </tfoot>
	</table>
</div>

<input type="hidden" name="option" value="com_schedule" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="view" value="trainers" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="controller" value="trainer" />
</form>
