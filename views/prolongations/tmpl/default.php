<?php defined('_JEXEC') or die('Restricted access'); ?>
<form action="index.php" method="post" name="adminForm">
<table>
    <tr>
        <td align="left" width="50%">
            <?php echo JText::_('Filter fam'); ?>:
            <input type="text" name="filter_search_fam" id="search"
            value="<?php echo $this->lists['search_fam'];?>"
            class="text_area">
            <button onclick="this.form.submit();">
            <?php echo JText::_('Search'); ?>
            </button>
            <button onclick="document.adminForm.
            filter_search_fam.value='';this.form.submit();">
            <?php echo JText::_('Reset'); ?>
            </button>
        </td>
        <td align="left" width="50%">
            <?php echo JText::_('Filter num'); ?>:
            <input type="text" name="filter_search_num" id="search"
            value="<?php echo $this->lists['search_num'];?>"
            class="text_area">
            <button onclick="this.form.submit();">
            <?php echo JText::_('Search'); ?>
            </button>
            <button onclick="document.adminForm.
            filter_search_num.value='';this.form.submit();">
            <?php echo JText::_('Reset'); ?>
            </button>
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
                            <?php echo JHTML::_('grid.sort', JText::_('CLIENT'), 'fam',
                                $this->lists['order_Dir'],
                                $this->lists['order'] ); ?>
			</th>
			<th>
                            <?php echo JHTML::_('grid.sort', JText::_('COM_SCHEDULE_ABONEMENT_NUM'), 'num',
                                $this->lists['order_Dir'],
                                $this->lists['order'] ); ?>
			</th>
			<th>
                            <?php echo JHTML::_('grid.sort', JText::_('COM_SCHEDULE_PROLONGATION_DATE_FROM'), 'date_from',
                                $this->lists['order_Dir'],
                                $this->lists['order'] ); ?>
			</th>
			<th>
                            <?php echo JHTML::_('grid.sort', JText::_('COM_SCHEDULE_PROLONGATION_DATE_TO'), 'date_to',
                                $this->lists['order_Dir'],
                                $this->lists['order'] ); ?>
			</th>
		</tr>
	</thead>
	<?php
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)	{
		$row = &$this->items[$i];
		$checked 	= JHTML::_('grid.id',   $i, $row->id );
		$link 		= JRoute::_( 'index.php?option=com_schedule&controller=prolongation&task=edit&cid[]='. $row->id );
		?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
				<?php echo $row->id; ?>
			</td>
			<td>
				<?php echo $checked; ?>
			</td>
			<td>
				<a href="<?php echo $link; ?>">
                                    <?=$row->fam.' '.$row->im.' '.$row->ot; ?>
                                </a>
			</td>
			<td>
				<?php echo $row->num; ?>
			</td>
			<td>
				<?=substr($row->date_from,8,2).'-'
				.substr($row->date_from,5,2).'-'
				.substr($row->date_from,0,4)?>
                            
			</td>
			<td>
				<?=substr($row->date_to,8,2).'-'
				.substr($row->date_to,5,2).'-'
				.substr($row->date_to,0,4)?>
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
    <input type="hidden" name="view" value="prolongations" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="controller" value="prolongation" />
    <input type="hidden" name="filter_order"
    value="<?php echo $this->lists['order']; ?>" />
    <input type="hidden" name="filter_order_Dir" value="" />
</form>
