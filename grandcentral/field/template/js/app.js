// (function($){
// //	app
// 	$appSelect = $('.fieldAppContainer .fieldAppSelect select');
// 	$appSelect.change(function()
// 	{
// 		$mainContainer = $appSelect.closest('.fieldAppContainer');
// 		$themeContainer = $mainContainer.find('.fieldAppThemeSelect');
// 		appkey = $appSelect.attr('value');
// 		
// 		if (!appkey)
// 		{
// 			$themeContainer.html('');
// 			$mainContainer.find('.fieldAppTemplateSelect').html('');
// 			return false;
// 		}
// 		
// 		$themeContainer.ajx({
// 			app: 'field',
// 			theme: 'default',
// 			template: 'app.template',
// 			search: 'theme',
// 			name: $mainContainer.attr('data-name'),
// 			appkey: appkey,
// 			value: $themeContainer.attr('data-value')
// 		}, {'done':function(){
// 			$mainContainer.find('.fieldAppTemplateSelect').html('');
// 			$themeContainer.find('select').trigger('change');}
// 		});
// 		
// 		$mainContainer.find('.fieldAppParamArray').ajx({
// 			app: 'field',
// 			theme: 'default',
// 			template: 'app.param',
// 			name: $mainContainer.attr('data-name'),
// 			appkey: appkey,
// 			value: $mainContainer.find('.fieldAppParamArray').attr('data-value')
// 		});
// 	});
// 	
// 	if ($appSelect.attr('value')) {$appSelect.trigger('change');};
// //	theme 
// 	$(document).on('change', '.fieldAppContainer .fieldAppThemeSelect select', function()
// 	{
// 		$this = $(this);
// 		$mainContainer = $this.closest('.fieldAppContainer');
// 		$templateContainer = $mainContainer.find('.fieldAppTemplateSelect');
// 		appkey = $this.attr('data-app');
// 		themekey = $this.attr('value');
// 		// console.log('theme : '+$this.attr('value'))
// 		
// 		$templateContainer.ajx({
// 			app: 'field',
// 			theme: 'default',
// 			template: 'app.template',
// 			search: 'template',
// 			name: $mainContainer.attr('data-name'),
// 			appkey: appkey,
// 			themekey: themekey,
// 			value: $templateContainer.attr('data-value')
// 		});
// 	});
// })(jQuery);

(function($){
//	app
	$appSelect = $('.fieldAppContainer .fieldAppSelect select');
	$appSelect.change(function()
	{
		$mainContainer = $appSelect.closest('.fieldAppContainer');
		appkey = $appSelect.attr('value');
		
		if (!appkey)
		{
			$themeContainer.html('');
			$mainContainer.find('.fieldAppTemplateSelect').html('');
			return false;
		}
		
		$themeContainer.ajx({
			app: 'field',
			template: 'app.template',
			name: $mainContainer.attr('data-name'),
			appkey: appkey,
			value: $mainContainer.find('.fieldAppThemeSelect').attr('data-value')
		}, {'done':function(){
			$mainContainer.find('.fieldAppTemplateSelect').html('');
			$themeContainer.find('select').trigger('change');}
		});
		
		$mainContainer.find('.fieldAppParamArray').ajx({
			app: 'field',
			theme: 'default',
			template: 'app.param',
			name: $mainContainer.attr('data-name'),
			appkey: appkey,
			value: $mainContainer.find('.fieldAppParamArray').attr('data-value')
		});
	});
	
	if ($appSelect.attr('value')) {$appSelect.trigger('change');};
//	theme 
	$(document).on('change', '.fieldAppContainer .fieldAppThemeSelect select', function()
	{
		$this = $(this);
		$mainContainer = $this.closest('.fieldAppContainer');
		$templateContainer = $mainContainer.find('.fieldAppTemplateSelect');
		appkey = $this.attr('data-app');
		themekey = $this.attr('value');
		// console.log('theme : '+$this.attr('value'))
		
		$templateContainer.ajx({
			app: 'field',
			theme: 'default',
			template: 'app.template',
			search: 'template',
			name: $mainContainer.attr('data-name'),
			appkey: appkey,
			themekey: themekey,
			value: $templateContainer.attr('data-value')
		});
	});
})(jQuery);  