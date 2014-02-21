(function($){
//	app
	$fieldAppSelect = $('.fieldAppContainer .fieldAppSelect select');
		$fieldContainer = $fieldAppSelect.closest('.fieldAppContainer');
	$fieldAppSelect.change(function()
	{
	//	
		$templateContainer = $fieldContainer.find('.fieldTemplateContainer');
	//	remise à zéro
		$templateContainer.empty();
	//	chargement des templates et paramètres
		var value = $fieldAppSelect.attr('value')
		var params = $templateContainer.attr('data-param');
		if ($templateContainer.data('appkey') != value)
		{
			params = null;
		};
		if (value)
		{
			openContext(
			{
				app: 'field',
				template: 'app.template',
				env: $fieldContainer.attr('data-env'),
				name: $fieldContainer.attr('data-name'),
				appkey: value,
				valueTemplate: $templateContainer.attr('data-template'),
				valueParam: params
			});
		}
	});
	$fieldContainer.on('click', 'button', function()
	{
		$fieldAppSelect.trigger('change');
	});
})(jQuery);  