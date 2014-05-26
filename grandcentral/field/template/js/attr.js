(function($)
{
//	Some vars
	$field = $('li[data-type="attr"]');
	attrSelector = 'input[data-associative="attr"]';
	label = 'label';
	
//	Make sortable	
	$field.sortable(
	{
		handle: '> .handle',
		items: 'ol.data li',
	});
	
//	Some binds the key
	$field.off('input', 'input[data-associative="attr"]').on('input', 'input[data-associative="attr"]', function()
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
			input.attr('name', name.replace(/\[attr\]\[[a-z0-9_]*\]/i, "[attr]["+key+"]"));
		});
	});
	
//	Expand
	$field.on('click', label, function()
	{
		$(this).closest('ol').find('li:not(:first-child)').toggle('fast');
	});
})(jQuery); 