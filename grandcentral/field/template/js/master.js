(function($){
	
	$pageSelect = $('.fieldMasterContainer .fieldMasterTypeSelect select');
	$pageSelect.on('change', function()
	{
		$this = $(this);
		$mainContainer = $this.closest('.fieldMasterContainer');
		$templateContainer = $mainContainer.find('.fieldMasterTemplateSelect');
		
		$templateContainer.ajx({
			app: 'field',
			template: 'master.template',
			search: 'template',
			name: $mainContainer.attr('data-name'),
			pagetype: $(this).val(),
			value: $templateContainer.attr('data-value')
		});
	});
	$pageSelect.trigger('change');
	
})(jQuery); 