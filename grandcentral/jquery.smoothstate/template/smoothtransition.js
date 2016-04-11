

(function ($)
{
  'use strict';

  $(document).ready(function ()
	{
    // Init here.
    var $body = $('body'),
				$head = $('head'),
        $main = $('#main'),
        $site = $('html, body'),
				transition = {in:'pt-page-moveFromRight', out:'pt-page-moveToLeft'},
        smoothState;

    smoothState = $main.smoothState(
		{
			debug: true,
			cacheLength: 0,
			anchors: 'a[data-transitionIn]',
      onBefore: function($anchor, $container)
			{
				var transitionIn = $anchor.attr('data-transitionIn');
				var transitionOut = $anchor.attr('data-transitionOut');
				transition.in = typeof transitionIn != 'undefined' && transitionIn.length > 0 ? transitionIn : transition.in;
				transition.out = typeof transitionOut != 'undefined' && transitionOut.length > 0 ? transitionOut : transition.out;
				smoothState.restartCSSAnimations();
				$body.addClass('is-exiting');
				// smoothState.cache;
      },
      onStart:
			{
        duration: 300,
        render: function ($container)
				{
          $container.addClass(transition.out);
          $site.animate({scrollTop: 0});
        }
      },
      onReady:
			{
        duration: 600,
        render: function ($container, $newContent)
				{
					addjsandcss(smoothState.cache[smoothState.href].doc);
					// var fullpage = smoothState.cache;
					// console.log(fullpage)
					$container
						.html($newContent)
						.removeClass(transition.out)
						.addClass(transition.in);
        }
      },
			onAfter: function($container, $newContent)
			{
				$body.removeClass('is-exiting');
        $container
          .removeClass(transition.in);
			},
    }).data('smoothState');

  });

	function addjsandcss(html)
	{
		var $content = $(html);
		var $scripts = $content.filter('script');
		var $css = $content.filter('link[rel="stylesheet"]');

		// console.log($css)

		$.each($scripts, function(index, value)
		{
			// console.log(value)
			var $script = $(value);
			console.log($('script[src*="'+$script.attr('src')+'"]'))
			if (typeof $script.attr('src') != 'undefined' && $('script[src*="'+$script.attr('src').split("?")[0]+'"]').length == 0)
			{
				console.log(value)
				$('script').last().after($script);
			}
		});
		$.each($css, function(index, value)
		{
			var $script = $(value);
			// console.log(typeof $script.attr('href'));
			// console.log($script.attr('href').split("?")[0]);
			if (typeof $script.attr('href') != 'undefined' && $('link[href*="'+$script.attr('href').split("?")[0]+'"]').length == 0)
			{
				console.log('ici')
        console.log(value)
				$('link[rel="stylesheet"]').last().after($script);
			}
			// $('head').append(value);
		});
		// console.log($content)
		// console.log($css)
	}

}(jQuery));
