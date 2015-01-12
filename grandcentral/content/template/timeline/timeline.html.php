<div class="infiniteScrollContainer"></div>
<div class="infiniteScrollWantsMore" data-feathericon="&#xe129"></div>
<div class="infiniteScrollStopper"><?=cst('stopper')?></div>

<script type="text/javascript" charset="utf-8">
$(document).ready(function()
{
//	Some vars
	container = $('#adminContent section.active');

//	The first time only...
	if (container.data('infinitescroll') == undefined)
	{
	//	... Search as you type for the timeline
		$('#refine').show();
		$('#refine input').searchasyoutype(
		{
			app:'content',
			template:'/timeline/timeline',
			param:'<?=addslashes(json_encode($_PARAM))?>',
			target:'#adminContent section.active',
		});
	}
	
//	Launch infinitescroll each time
	container.removeData('infinitescroll');
	container.infinitescroll(
	{
		app:'content',
		template:'/timeline/timeline.lines',
		param:'<?=addslashes(json_encode($_PARAM))?>',
		limit:<?=$limit?>,
		item:'<?=$handled_item?>',
		id:'<?=$handled_id?>',
		autoscroll:true,
	});
});
</script>