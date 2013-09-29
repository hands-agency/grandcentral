(function($)
{
//	Some vars
	selector = 'li[data-type="attr"] input[data-associative="attr"]';
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
			input.attr('name', name.replace(/\[attr\]\[[a-z0-9]*\]/i, "[attr]["+key+"]"));
		});
	});
	
//	Some vars
	selector = 'li[data-type="attr"] label';
//	Expand
	$(document).on('click', selector, function()
	{
		$(this).closest('ol').find('li:not(:first-child)').toggle('fast');
	});
})(jQuery); 