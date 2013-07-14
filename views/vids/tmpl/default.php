<?php	                                       			  
    defined('_JEXEC') or die('Restricted access'); 
    /**
    * Vids list
    * 
    * @package    Vid schedule
    * @subpackage Components
    * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
    * @license    GNU/GPL
    */
JHTML::_('stylesheet', 'style.css', 'administrator/components/com_schedule/assets/');
?>
<form action="index.php" method="post" name="adminForm">
<table>
    <tr>
        <td align="left" width="100%">
            <?php	                                       			  echo JText::_('Filter'); ?>:
            <input type="text" name="filter_search_name" id="search"
            value="<?php	                                       			  echo $this->lists['search'];?>"
            class="text_area">
            <button onclick="this.form.submit();">
            <?php	                                       			  echo JText::_('Search'); ?>
            </button>
            <button onclick="document.adminForm.
            filter_search_name.value='';this.form.submit();">
            <?php	                                       			  echo JText::_('Reset'); ?>
            </button>
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
                            <?php	                                       			  echo JText::_('COM_SCHEDULE_TRAINING_NAME')?>
			</th>
			<th>
                            <?=JText::_('COM_SCHEDULE_TRAINING_LINK')?>
                        </th>
		</tr>
	</thead>
	<?php	                                       			 
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)	{
		$row = &$this->items[$i];
		$checked 	= JHTML::_('grid.id',   $i, $row->id );
		$link 		= JRoute::_( 'index.php?option=com_schedule&controller=vid&task=edit&cid[]='. $row->id );
		?>
		<tr class="<?php	                                       			  echo "row$k"; ?>">
			<td>
				<?php	                                       			  echo $row->id; ?>
			</td>
			<td>
				<?php	                                       			  echo $checked; ?>
			</td>
			<td>
				<a href="<?php	                                       			  echo $link; ?>"><?php	                                       			  echo $row->name; ?></a>
			</td>
			<td>
				<?php	                                       			  echo $row->training_link; ?>
			</td>
		</tr>
		<?php	                                       			 
		$k = 1 - $k;
	}
	?>
            <tfoot>
                <tr>
                    <td colspan="10">
                        <?php	                                       			  echo $this->page->getListFooter(); ?>
                    </td>
                </tr>
            </tfoot>
	</table>
</div>

    <input type="hidden" name="option" value="com_schedule" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="view" value="vids" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="controller" value="vid" />
    <input type="hidden" name="filter_order" value="<?php	                                       			  echo $this->lists['order']; ?>" />
    <input type="hidden" name="filter_order_Dir" value="" />
</form>
