$(document).ready(function () {
/*********************************************************************************************
/**	* Make it a multiple select
* 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	$('[data-type="zoning"]').multipleselect(
	{		
		app:'field',
		theme:'default',
		template:'zoning.available',
		item:'app',
	});

/*********************************************************************************************
/**	* Edit the section on popup
* 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	$(document).on('click', '[data-type="zoning"] .selected li .title', function()
	{
		handled_section = $(this).closest('li').data('item');
	//	Declare popup
		$(this).popup(
		{
			app: 'field',
			theme: 'default',
			template: 'zoning.config',
			width:'60%',
			autoOpen:true,
			handled_section: handled_section,
		});
	//	Catch ok event
		$(document).on('click', '#popup .ok button', function()
		{
			form = $('#popup form');
		//	Ajaxify forms
			$.ajax(
			{
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				success: function(result)
				{
				//	DEBUG
					console.log(result);
				},
			});
		});
	});

/*********************************************************************************************
/**	* Switch between the apps and the existing sections via tabs
* 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	$('[data-type="zoning"] .tabs li').click(function()
	{
	//	The tabs
		tabs = $(this).parent('.tabs');
		panel = tabs.parent().find('.available .choices');

	//	Shortcut to the data
		link = $(this).find('a');
	//	App, theme and template
		app = 'section';
		theme = link.attr('data-theme');
		template = link.attr('data-template');
	//	What are we loading exactly
		item = link.data('available');
		
	//	Set to off all the tabs, and set to on just "the one"
		$(this).siblings('.on').removeClass('on');
		$(this).addClass('on');
		
	//	Open the right panel
		$(panel)
			.show()
			.ajx(
			{
				app:'field',
				theme:'default',
				template:'zoning.available',
				item:item,
			},{
				done:function(){$('[data-type="zoning"]').data('multipleselect').resort()},
			});
	});
});