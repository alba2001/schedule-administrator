<?php 
    defined('_JEXEC') or die('Restricted access'); 
    /**
    * Visit list
    * 
    * @package    Training schedule
    * @subpackage Components
    * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
    * @license    GNU/GPL
    */
$scale_src = JURI::base().'components/com_schedule/assets/img/shkala-%num%.png';    
$ajax_src = JURI::base().'components/com_schedule/assets/img/ajax-loader.gif';    
$img_visided = 'images/tick.png';
$img_unvisided ='images/publish_x.png';
?>
<script type="text/javascript">
jQuery(document).ready(function($){
    $('.visited').click(function(e){
        e.preventDefault();
        var img = jQuery(this).children('img').first();
        var src = jQuery(img).attr('src').split('/').pop();
        var id = jQuery(this).attr('rel');
        console.log(src);
        if (src == 'publish_x.png')
        {
            set_visited(id, 'set_visited', img)
        }
        else if (src == 'tick.png')
        {
            set_visited(id, 'unset_visited', img)
        }
        else
        {
            return false;
        }
        
    });
    function set_visited(id,task,img)
    {
        var status = 1;
        var src = task=='set_visited'?'<?=$img_visided?>':'<?=$img_unvisided?>';
        var src_old = $(img).attr('src');
        var src_ajax = '<?=$ajax_src?>';
        $.ajaxSetup({
            beforeSend: function (){$(img).attr('src',src_ajax);},
            complete: function (){}
        });
        $.ajax({
            type: 'POST',
            url: jQuery('#sch_visits').attr('action'),
            data:{'option':'com_schedule','controller':'visit','task':task, 'id':id},
            success: function(data){
                data = $.parseJSON(data);
                if(data.status == 0)
                {
                    $(img).attr('src',src_old);
                    status = 0;
                }
                else
                {
                    $(img).attr('src',src);
                }
            }
        });
        return status;
    };
});    
</script>
<form id="sch_visits" action="index.php" method="post" name="adminForm" id="adminForm">
<table>
    <tr>
        <td align="left" width="100%">
            <?php echo JText::_('Filter'); ?>:
            <input type="text" name="filter_search_client" id="search"
            value="<?php echo $this->lists['search'];?>"
            class="text_area">
            <button onclick="this.form.submit();">
            <?php echo JText::_('Search'); ?>
            </button>
            <button onclick="document.adminForm.
            filter_search_client.value='';this.form.submit();">
            <?php echo JText::_('Reset'); ?>
            </button>
        </td>
        <td nowrap="nowrap">
            <?php echo JHTML::_('calendar', 
                    $this->lists['filter_date'], 
                    'filter_date', 
                    'filter_date', 
                    '%Y-%m-%d', 
                    array('onchange'=>'document.adminForm.filter_calendar.value=0;document.adminForm.submit()')); ?>
            <?=sh_helper::calendar_selecting(
                    'filter_calendar',
                    array('onchange'=>'document.adminForm.submit()'),
                    $this->lists['filter_calendar'],
                    'filter_calendar')?>
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
                            <?=JText::_('CLIENT')?>
			</th>
			<th>
                            <?php echo JText::_('COM_SCHEDULE_TRAINING_TIME_START')?>
			</th>
			<th>
                            <?php echo JText::_('COM_SCHEDULE_TRAINING_TYPE')?>
			</th>
			<th>
                            <?php echo JText::_('COM_SCHEDULE_TRAINING_VISITED')?>
			</th>
		</tr>
	</thead>
	<?php
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)	{
		$row = &$this->items[$i];
		$checked 	= JHTML::_('grid.id',   $i, $row->id );
		$link 		= JRoute::_( 'index.php?option=com_schedule&controller=visit&task=edit&cid[]='. $row->id );
                $img 	= $row->visited ? $img_visided : $img_unvisided;
                $task 	= $row->visited ? 'unvisited' : 'visited';
                $alt 	= $row->visited ? JText::_( 'Visited' ) : JText::_( 'Unvisited' );
		?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
                                <a href="<?php echo $link; ?>"><?=$row->id?></a>
			</td>
			<td>
				<?php echo $checked; ?>
			</td>
			<td>
                            <?php echo $row->name ?>
			</td>
			<td>
                            <?php echo $row->fam.' '.$row->im.' '.$row->ot; ?>
			</td>
			<td>
                            <?php echo $row->time_start ?>
			</td>
			<td>
                            <?php echo sh_helper::get_training_types($row->training_type_id) ?>
			</td>
                        <td align="center">
                            <a href="#" class="visited" rel="<?=$row->id?>">
                                        <img src="<?php echo $img;?>" width="16" height="16" border="0" alt="<?php echo $alt; ?>" /></a>
                        </td>
                            
                            <?php // echo $row->visited ?>
		</tr>
		<?php
		$k = 1 - $k;
	}
	?>
            <tfoot>
                <tr>
                    <td colspan="8">
                        <?php echo $this->page->getListFooter(); ?>
                    </td>
                </tr>
            </tfoot>
	</table>
</div>

    <input type="hidden" name="option" value="com_schedule" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="view" value="visits" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="controller" value="visit" />
    <input type="hidden" name="filter_order"
    value="<?php echo $this->lists['order']; ?>" />
    <input type="hidden" name="filter_order_Dir" value="" />
</form>
