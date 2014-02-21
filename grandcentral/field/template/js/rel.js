(function($)
{
//	Some vars
	selector = 'li[data-type="rel"] input[data-associative="rel"]';
//	Bind the key
	$(document).off('input', selector).on('input', selector, function()
	{
	//	Get the value
	//	TODO @sf trouver meilleure manière d'empêcher les clef de contenir des accents, espaces...
		input = $(this);
		key = input.val().replace(/ /g,'').toLowerCase();
		
	//	Have the field names follow the value
	//	TODO @mvd find a best way to catch the second <li> in the tree
		li = input.parent().parent().parent().parent();

	//	Change field names
		li.find('input, select, textarea').each(function()
		{
			input = $(this);
			name = input.attr('name');
			input.attr('name', name.replace(/\[rel\]\[[a-z0-9]*\]/i, "[rel]["+key+"]"));
		});
	});
	
//	Some vars
	selector = 'li[data-type="rel"] label';
//	Expand
	$(document).on('click', selector, function()
	{
		$(this).closest('ol').find('li:not(:first-child)').toggle('fast');
	});
})(jQuery); 