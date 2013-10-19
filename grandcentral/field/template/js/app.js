(function($){
//	app
	$fieldAppSelect = $('.fieldAppContainer .fieldAppSelect select');
	$fieldAppSelect.change(function()
	{
	//	
		$fieldContainer = $fieldAppSelect.closest('.fieldAppContainer');
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
			$templateContainer.ajx({
				app: 'field',
				template: 'app.template',
				env: $fieldContainer.attr('data-env'),
				name: $fieldContainer.attr('data-name'),
				appkey: value,
				valueTemplate: $templateContainer.attr('data-template'),
				valueParam: params
			},{
			//	Callback
				done:function()
				{
					
				},
			},{
			//	Option
				debug:false,
				async:true,
			});
		}
	});
//	trigger à l'ouverture
	if ($fieldAppSelect.attr('value')) {$fieldAppSelect.trigger('change');};
})(jQuery);  