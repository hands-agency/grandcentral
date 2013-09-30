(function($){
//	type de vue
	$pageSelect = $('.fieldPageContainer .fieldPageTypeSelect select');
	$pageSelect.change(function()
	{
		$mainContainer = $pageSelect.closest('.fieldPageContainer');
		$themeContainer = $mainContainer.find('.fieldPageThemeSelect');
		pagetype = $pageSelect.attr('value');
		
		$themeContainer.ajx({
			app: 'field',
			theme: 'default',
			template: 'page.template',
			search: 'theme',
			name: $mainContainer.attr('data-name'),
			pagetype: pagetype,
			value: $themeContainer.attr('data-value')
		}, {'done':function(){
			$mainContainer.find('.fieldPageTtemplateSelect').html('');
			$themeContainer.find('select').trigger('change');}
		});
	});
	$pageSelect.trigger('change');
//	theme
	$(document).on('change', '.fieldPageContainer .fieldPageThemeSelect select', function()
	{
		$this = $(this);
		$mainContainer = $this.closest('.fieldPageContainer');
		$templateContainer = $mainContainer.find('.fieldPageTemplateSelect');
		pagetype = $this.attr('data-type');
		themekey = $this.attr('value');
		
		$templateContainer.ajx({
			app: 'field',
			theme: 'default',
			template: 'page.template',
			search: 'template',
			name: $mainContainer.attr('data-name'),
			pagetype: pagetype,
			themekey: themekey,
			value: $templateContainer.attr('data-value')
		});
	});
})(jQuery); 