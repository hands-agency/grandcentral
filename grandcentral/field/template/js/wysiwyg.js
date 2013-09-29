/*********************************************************************************************
/**	* Popup
* 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
//	Launch
	var editor = new wysihtml5.Editor('wysihtml5-textarea', {
		toolbar: 'wysihtml5-toolbar',
		parserRules: wysihtml5ParserRules,
		autoLink: true,
		useLineBreaks: false,
		placeholderText: 'Go',
	});
//	Add link
	$('.toolbar .link').popup({
		app:'field',
		theme:'default',
		template:'wysiwyg.popup.link',
	});
//	Add media
	$('.toolbar .media').popup({
		app:'media',
		theme:'admin',
		template:'admin',
		width:'98%',
		top:10,
	});
//	Add table
	$('.toolbar li').click(function()
	{
		$(this).find('ul').toggle('fast').ajx({
			app:'field',
			theme:'default',
			template:'wysiwyg.drop.table',
		});
	});
	
	