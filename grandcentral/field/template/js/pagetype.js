(function($)
{
//	Some vars
	$li = $('[data-type="pagetype"]');
	$field = $li.find('.field');
	$fieldKey = $field.find('input[name$="[key]"]:radio');
	$fieldKeySelected = $field.find('input[name$="[key]"]:checked');
	
	$liHttpstatus = $field.find('[data-key="http-status"]');
	$fieldHttpstatus = $field.find('[data-key="http-status"] select');
	$liContenttype = $field.find('[data-key="content-type"]');
	$liUrl = $field.find('[data-key="url"]');
	$liMaster = $field.find('[data-key="master"]');
	$fieldMaster = $field.find('[data-key="master"] select');
	
//	Change options based on page type
	$fieldKey.change(function()
	{
	//	Some vars
		type = $(this).val();
		
	//	Close contest
	//	closeContext('/app.context'); /* Buggy : it keeps triggering when page loads... */
	//	Display options based on page type
		switch(type)
		{
		//	Content pages
			case 'content':
			//	Show app configuration (master template) & set to content app
				$liMaster.show('fast');
				if (!$fieldMaster.val()) $fieldMaster.val('content');
			//	Show content-type
				$liContenttype.show('fast');
			//	Hide link
				$liUrl.hide('fast');
			//	Set status to 200 OK
				$fieldHttpstatus.val('200 OK');
				break;
		//	Headers
			case 'header':
			//	Hide app configuration (master template)
				$liMaster.hide('fast');
			//	Hide content-type
				$liContenttype.hide('fast');
			//	Hide link
				$liUrl.hide('fast');
			//	Set status to 200 OK
				$fieldHttpstatus.val('200 OK');
				break;
		//	Links
			case 'link':
			//	Hide app configuration (master template)
				$liMaster.hide('fast');
			//	Hide content-type
				$liContenttype.hide('fast');
			//	Show link
				$liUrl.show('fast');
			//	Set status to 302 Moved Temporarily
				$fieldHttpstatus.val('302 Moved Temporarily');
				break;
		}
	});
	
//	Apply these rules to currently selected
	$fieldKeySelected.trigger('change');
	
})(jQuery);  