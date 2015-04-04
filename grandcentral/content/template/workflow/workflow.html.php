<?php if (isset($workflowstatuses)): ?>

	<?php
		foreach ($workflowstatuses as $workflowstatus)
		{
	
			$on = (isset($item['workflow']) && $item['workflow'] == $workflowstatus) ? 'on' : null;
			$htmlStatus = '<div class="status '.$on.'">'.$workflowstatus['title'].'</div>';
	
			$groups = $workflowstatus['group']->unfold();
			$li = null;
			foreach ($groups as $group)
			{
				$li .= '<li>'.$group['title'].'</li>';
			}
			$htmlGroup = '<div class="group"><ul>'.$li.'</ul></div>';
			
		//	Add to the flow
			$flow .= '<li>'.$htmlStatus.$htmlGroup.'</li>';
		}
	?>
	<ul class="flow"><?=$flow?></ul>
<?php endif ?>