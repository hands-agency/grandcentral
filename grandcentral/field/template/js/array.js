(function($)
{
//	Some vars
	selector = 'li[data-type="array"] input[data-associative="array"]';
	
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
		li.find('input').each(function()
		{
			input = $(this);
			name = input.attr('name');
			input.attr('name', name.replace(/\[[a-z0-9]*\]$/i, "["+key+"]"));
		});
	});
})(jQuery); 