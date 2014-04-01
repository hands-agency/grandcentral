<? if ($count == 0) : ?>
<div class="nodata">Nope, sorry, nothing. Zero. Zilch.</div>
<? else : ?>
<div class="infiniteScrollContainer"><ol><!-- Welcome Ajax --></ol></div>
<div class="infiniteScrollWantsMore">More <?=$_GET['item']?>! Miam miam miam...</div>
<div class="infiniteScrollStopper">It's all I have.</div>

<script type="text/javascript" charset="utf-8">
$(document).ready(function()
{
//	Some vars
	container = $('#content section:visible');

//	The first time only...
	if (container.data('infinitescroll') == undefined)
	{
	//	... Search as you type for the list
		$('#refine').show();
		$('#refine input').searchasyoutype(
		{
			app:'content',
			template:'list/list',
			param:'<?=addslashes(json_encode($_PARAM))?>',
			target:'#content section:visible',
		});
	}
	
//	Launch infinitescroll each time
	container.removeData('infinitescroll');
	container.infinitescroll(
	{
		app:'content',
		template:'list/list.lines',
		param:'<?=addslashes(json_encode($_PARAM))?>',
		limit:<?=$limit?>,
		autoscroll:true,
	});
});
</script>
<? endif ?>