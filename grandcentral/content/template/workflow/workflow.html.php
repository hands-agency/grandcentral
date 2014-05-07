<? if (!isset($workflowstatuses)): ?>
<div class="nodata">There are no workflows for this item.</div>
<? else: ?>
<h1>Workflow</h1>
	<?
		foreach ($workflowstatuses as $workflowstatus)
		{
	
			$on = (isset($item['workflow']) && $item['workflow'] == $workflowstatus) ? 'on' : null;
			$th .= '<th class="'.$on.'">'.$workflowstatus['title'].'</th>';
	
			$groups = $workflowstatus['group']->unfold();
			$li = null;
			foreach ($groups as $group)
			{
				$li .= '<li>'.$group['title'].'</li>';
			}
			$td .= '<td><ul>'.$li.'</ul></td>';
		}
	?>

	<table>
		<tr><?=$th?></tr>
		<tr><?=$td?></tr>
	</table>
<?php endif ?>
