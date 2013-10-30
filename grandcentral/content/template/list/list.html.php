<? if ($count == 0) : ?>
<div class="nodata">Nope, sorry, nothing. Zero. Zilch.</div>
<? else : ?>
<div class="infiniteScroll"><ol><!-- Welcome Ajax --></ol></div>
<div class="infiniteScrollWantsMore">More <?=$_GET['item']?>! miam miam miam...</div>
<div class="infiniteScrollStopper">It's all I have.</div>
<script type="text/javascript" charset="utf-8">
	$('.infiniteScroll').infinitescroll(
	{
		app:'content',
		template:'list/list.lines',
		param:'<?=addslashes(json_encode($_PARAM))?>',
		limit:<?=$limit?>,
	});
</script>
<? endif ?>