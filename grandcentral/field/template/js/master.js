(function($){
	
	$('.fieldMasterContainer').on('change', '.fieldMasterTypeSelect select', function()
	{
		
	});
//	type de vue
// 	$pageSelect = $('.fieldMasterContainer .fieldMasterTypeSelect select');
// 	$pageSelect.change(function()
// 	{
// 		$mainContainer = $pageSelect.closest('.fieldMasterContainer');
// 		$themeContainer = $mainContainer.find('.fieldMasterThemeSelect');
// 		pagetype = $pageSelect.attr('value');
// 		
// 		$themeContainer.ajx({
// 			app: 'field',
// 			theme: 'default',
// 			template: 'page.template',
// 			search: 'theme',
// 			name: $mainContainer.attr('data-name'),
// 			pagetype: pagetype,
// 			value: $themeContainer.attr('data-value')
// 		}, {'done':function(){
// 			$mainContainer.find('.fieldMasterTtemplateSelect').html('');
// 			$themeContainer.find('select').trigger('change');}
// 		});
// 	});
// 	$pageSelect.trigger('change');
// //	theme
// 	$('.fieldMasterContainer').on('change', '.fieldMasterContainer .fieldMasterThemeSelect select', function()
// 	{
// 		$this = $(this);
// 		$mainContainer = $this.closest('.fieldMasterContainer');
// 		$templateContainer = $mainContainer.find('.fieldMasterTemplateSelect');
// 		pagetype = $this.attr('data-type');
// 		themekey = $this.attr('value');
// 		
// 		$templateContainer.ajx({
// 			app: 'field',
// 			theme: 'default',
// 			template: 'page.template',
// 			search: 'template',
// 			name: $mainContainer.attr('data-name'),
// 			pagetype: pagetype,
// 			themekey: themekey,
// 			value: $templateContainer.attr('data-value')
// 		});
// 	});
})(jQuery); 