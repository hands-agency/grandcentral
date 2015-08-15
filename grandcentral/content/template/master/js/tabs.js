/*********************************************************************************************
/**	* Tabs : Open and close content via tabs
 	* @author	@mvdandrieux
**#******************************************************************************************/
$(document).ready(function ()
{
	$(document).on('click', '#tabs > li', function()
	{
	//	Goto
		index = $(this).data('index');
		$('#sectiontray').slick('slickGoTo', index);
		
	//	Set to off all the tabs, and set to on just "the one"
		$(this).siblings('.on').removeClass('on');
		$(this).addClass('on');
	
	//	Shortcut to the data
		link = $(this).find('a');
	//	App, theme and template
		app = link.data('app');
		template = link.data('template');

	//	Target section...
		param = link.attr('data-param'); /* We want the string, not the object */
		$panel = $('#section_'+section);
		
	//	Open the right panel
		if (!$panel.html() || $(this).hasClass('updateMe'))
		{
		//	Start loading
			$panel.loading();
			
		//	Fetch content
			$panel
				.addClass('loading')
				.ajx(
				{
					app:app,
					template:template,
					param:param
				}, {
				//	Done
					done:function()
					{
					//	Say it's loaded
						$panel.removeClass('loading');
					}
				});
		}
			
	//	Say it's updated
		$panel.removeClass('virgin updateMe').addClass('active');
						
	//	Change the main display
		$('#main').attr('class', $panel.data('display'));
	});

/*********************************************************************************************
/**	* Tabs : Open a section from the landing in the hash (or the first one)
	* @author	@mvdandrieux
**#******************************************************************************************/
//	By hash
	if (window.location.hash) pseudo = '[href='+window.location.hash+']';
//	On demand
	else if ($('#tabs[data-default]').length) pseudo = '[href=#'+$('#tabs').data('default')+']';
//	By default
	else pseudo = ':first';
//	WRONG, not here...
	$(window).load( function(){$('#tabs li a'+pseudo).parent().trigger('click');} );
});