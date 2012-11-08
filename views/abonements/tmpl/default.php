<?php 
    defined('_JEXEC') or die('Restricted access'); 
    /**
    * Abonements list
    * 
    * @package    Training schedule
    * @subpackage Components
    * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
    * @license    GNU/GPL
    */
$snowflake_img = JURI::base().'components/com_schedule/assets/img/snowflake_16.gif';
$prolongation_img = JURI::base().'components/com_schedule/assets/img/prolongation.png';
?>

<form action="index.php" method="post" name="adminForm">
<table>
    <tr>
        <td align="left" width="100%">
            <?php echo JText::_('Filter'); ?>:
            <input type="text" name="filter_search_num" id="search"
            value="<?php echo $this->lists['search'];?>"
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
                            <?php echo JHTML::_('grid.sort', JText::_('COM_SCHEDULE_ABONEMENT_NUM'), 'num',
                                $this->lists['order_Dir'],
                                $this->lists['order'] ); ?>
			</th>
			<th>
                            <?=JText::_('CLIENT')?>
			</th>
			<th>
                            <?=JText::_('COM_SCHEDULE_ABONEMENT_TYPE')?>
			</th>
			<th>
                            <?php echo JHTML::_('grid.sort', JText::_('COM_SCHEDULE_SALE_DATE'), 'date_sale',
                                $this->lists['order_Dir'],
                                $this->lists['order'] ); ?>
			</th>
			<th>
                            <?=JText::_('COM_SCHEDULE_ACTIVATE_PERIOD')?>
                        </th>
			<th>
                            <?=JText::_('COM_SCHEDULE_VALIDITY_PERIOD')?>
                        </th>
			<th>
                            <?php echo JHTML::_('grid.sort', JText::_('COM_SCHEDULE_TYPE_SALE'), 'sale_date',
                                $this->lists['order_Dir'],
                                $this->lists['order'] ); ?>
			</th>
			<th>
                            <?=JText::_('FREEZING')?>
                        </th>
		</tr>
	</thead>
	<?php
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)	{
		$row = &$this->items[$i];
		$checked 	= JHTML::_('grid.id',   $i, $row->id );
		$link 		= JRoute::_( 'index.php?option=com_schedule&controller=abonement&task=edit&cid[]='. $row->id );
		?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
				<?php echo $row->id; ?>
			</td>
			<td>
				<?php echo $checked; ?>
			</td>
			<td>
				<a href="<?php echo $link; ?>"><?php echo $row->num; ?></a>
			</td>
			<td>
				<?=sh_helper::get_client($row->client_id)?>
			</td>
			<td>
				<?=sh_helper::get_abonement_type($row->abonement_type_id)?>
			</td>
			<td>
				<?=sh_helper::to_german_date($row->sale_date)?>
			</td>
			<td>
                                <?=sh_helper::get_activate_period($row->activate_period)?>
			</td>
			<td>
                                <?=sh_helper::get_validity_period($row->validity_period)?>
			</td>
			<td>
                                <span title="<?=$row->cost_num?>"><?=sh_helper::get_sale_type($row->sale_type)?></span>
			</td>
			<td>
                            <?php if($row->f_date_to) :?>
				<?php if($row->f_date_to > date('Y-m-d')) :?>
                                <?php $date_from_to = sh_helper::to_german_date($row->f_date_from)?>
                                <?php $date_from_to .= ' - '?>
                                <?php $date_from_to .= sh_helper::to_german_date($row->f_date_to)?>
				<img title="<?=$date_from_to?>" src="<?=$snowflake_img?>" alt="<?=JText::_('FREEZING')?>">
                                <?php endif;?>
                            <?php elseif($row->p_date_to) :?>
				<?php if($row->p_date_to > date('Y-m-d')) :?>
                                <?php $date_from_to = sh_helper::to_german_date($row->p_date_from)?>
                                <?php $date_from_to .= ' - '?>
                                <?php $date_from_to .= sh_helper::to_german_date($row->p_date_to)?>
				<img title="<?=$date_from_to?>" src="<?=$prolongation_img?>" alt="<?=JText::_('PROLONGATION')?>">
                                <?php endif;?>
                            <?php endif;?>
			</td>
		</tr>
		<?php
		$k = 1 - $k;
	}
	?>
            <tfoot>
                <tr>
                    <td colspan="10">
                        <?php echo $this->page->getListFooter(); ?>
                    </td>
                </tr>
            </tfoot>
	</table>
</div>

    <input type="hidden" name="option" value="com_schedule" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="view" value="abonements" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="controller" value="abonement" />
    <input type="hidden" name="filter_order"
    value="<?php echo $this->lists['order']; ?>" />
    <input type="hidden" name="filter_order_Dir" value="" />
</form>
