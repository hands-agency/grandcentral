/*********************************************************************************************
/**	app manager
*********************************************************************************************/
	$appmanager = $('#appmanager');
	$appmanager.find('.action a').on('click', function(){
		// console.log($(this).attr('class'));
		$this = $(this);
		
		$('#debugmanager').ajx({
			app: 'section',
			theme: 'appmanager',
			template: 'appmanager.ajax',
			type: 'routine',
			action: $this.attr('class'),
			key: $this.attr('data-key')
		},
		{'done':function(){
			if ($this.attr('class') == 'install')
			{
				$this.html($appmanager.attr('data-remove'));
				$this.removeClass();
				$this.addClass('remove');
			}
			else
			{
				$this.html($appmanager.attr('data-install'));
				$this.removeClass();
				$this.addClass('install');
			}
		}
		});
		return false
	});