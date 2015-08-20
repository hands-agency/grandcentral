<?php if ($count != 0) : ?>
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
	//	... Search as you type for the list
		$('#refine').show();
		$('#refine input').searchasyoutype(
		{
			app:'content',
			template:'/list/list',
			param:'<?=addslashes(json_encode($_PARAM))?>',
			target:'#adminContent section.active',
		});
	}
	
//	Launch infinitescroll each time
	container.removeData('infinitescroll');
	container.infinitescroll(
	{
		app:'content',
		template:'/list/list.lines',
		param:'<?=addslashes(json_encode($_PARAM))?>',
		limit:<?=$limit?>,
		autoscroll:true
	},
	function()
	{
	
	//	card
		var $container = $('section[data-template="/list/list"][data-pref-display="incard"]>.infiniteScrollContainer>ol');
	//	initialize card after all images have loaded  
		$container.imagesLoaded( function()
		{
			$('ol li .front img').each(function()
			{
				var colorThief = new ColorThief();
			//	Only if it has an image
				color = colorThief.getColor($(this)[0]);
				$(this).closest('.card').find('.front, .back').attr('style', 'background-color:rgb('+color+');');
			});
		});
	
	//	Back flip
		$('.card').hoverIntent(
		{
			timeout: 500,
			over: function() {},
			out: function()
			{
				$(this).removeClass('flipped preview');
			}
		});
	//	
	/*
		$.adaptiveBackground.run(
		{
		//	parent:'.card',
			lumaClasses:
			{
			    light: "ab-light",
			    dark: "ab-dark"
			},
			success: function($img, data)
			{
			//	Some vars
				$card = $img.closest('[data-item]').find('.card');
				$back = $card.find('.back');
				$front = $card.find('.front');
			//	Have the front and back follow the card color
				$back.css('background-color', data.color);
				$front.css('background-color', data.color);
			//	Correct text density
				lumaClass = $img.attr('class').replace('cover ', '');
				$card.addClass(lumaClass);
			}
		});
		*/
	});
});
</script>
<?php endif ?>