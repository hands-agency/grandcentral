$(document).ready(function ()
{
/*********************************************************************************************
/**	* Editable form while unlocked
* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	$(document).bind('unlock', function()
	{
	//	Add data-control bubbles
		var bubble = '<div data-control=""></div>';
		$('section[data-template="edit/edit"] form>fieldset>ol>li').addClass('editable').each(function()
		{
			control = $(this).find('data-control');
			if (control.length == 0) $(bubble).appendTo($(this)).show('slide', { direction: 'left' }, 100).attr('class', 'icon-pencil');
			else control.show("slide", { direction: 'left' }, 100);
		});
	//	Start sortable
		$('section[data-template="edit/edit"] form').sortable(
		{
			items:'li',
			handle:'label',
			axis:'y',
			revert: 100,
		});
	});

/*********************************************************************************************
/**	* Non editable form while locked
* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	$(document).bind('lock', function()
	{
	//	Some vars
		form = $('section[data-template="edit/edit"] form');
		order = form.sortable('toArray', {attribute:'data-key'});
	
	//	destroy all the data-control bubbles
		$('section[data-template="edit/edit"] form>fieldset>ol>li').removeClass('editable').find('[data-control]').hide('slide', { direction: 'left' }, 100);

	//	Kill sortable and store new order		
		$.ajx(
		{
			app: 'form',
			template: 'order.routine',
			form:form.data('key'),
			order: order,
		},{
			done:function()
			{
			//	Kill sortable
				$('section[data-template="edit/edit"] form').sortable('destroy');
			},
		}, true);
	});
	
/*********************************************************************************************
/**	* Form edit
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	$(document).on('click', 'form .editable [data-control]', function()
	{
		var $li = $(this).closest('li');
		var form = $li.closest('form').data('key');
		var $field = $li.find('[name^="' + form + '"]');
		var value = new Array();
		$field.each(function(index)
		{
			value[index] = $(this).val();
		})
		// ajxShowEdit($li, $field, value);
		console.log($field)
		console.log(value)
		
	//	Add edit wrapper once
		if ($li.find('.editWrapper').length == 0) $li.append('<div class="editWrapper"></div>');
		
	//	Load form
		$li.find('.editWrapper').ajx(
		{
			app: 'form',
			template: 'field.edit',
			form: form,
			field: $li.data('key'),
			value: value,
		},{
			done:function()
			{
			//	Say we are editing
				$li.toggleClass('editable editing');
			//	Keep readbility
				$('body').addClass('subEditing');
			},
		}, true);
	});
	
/*********************************************************************************************
/**	* Validate a field form
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	$(document).on('submit', '.editing form', function()
	{
	//	Id & status
		form = $(this).closest('form');
		field = $(this).closest('.editing');
		console.log(form);
		
	//	Prevent propagation
		return false;
	
	//	Ajaxify forms
		$.ajax(
		{
			url: form.attr('action'),
			type: form.attr('method'),
			data: form.serialize(),
			success: function(result)
			{
			//	DEBUG
				console.log(result);
			//	Write the new field
				field.html(result);
			},
		});
	});

/*********************************************************************************************
/**	* Handling H1 and title binding
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	$('section input[name$="[title]"]').live('input', function()
	{
		title = $(this).val();
		maxlength = 55;
		change = $('h1 .item');
		if (title && title.length<maxlength) change.html(title);
		else if (title) change.html(title.substr(0, maxlength)+'...');
		else change.html($('h1').attr('title'));
	});
	
/*********************************************************************************************
/**	* Focus On the first field of the freshly loaded section
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	// $('form input:first').focus();

/*********************************************************************************************
/**	* Fields help
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
/*	$(document).on('click', '.locked section label', function()
	{
		$(this).parent().find('.help').toggle('fast');
	});

/*********************************************************************************************
/**	* Fields limit
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	$(document).on('input', 'form input', function()
	{
		maxlength = $(this).attr('maxlength');
		if (maxlength)
		{
			li = $(this).parents('li:first');
			control = li.find('[data-control]');
		//	Start clean on guiding mode
			li.removeClass('ok ko').addClass('guiding');
		//	Add control if necessary
			if (control.length == 0)
			{
			//	CODE : of the drop down menu
				code = '<div data-control=""></div>';
				li.append(code);
			}	

		//	Display count
			count = $(this).val().length;
			html = maxlength-count;
			control.show();
			control.stop().html(html).attr('class', '');
			
		//	Stopper
			if (html == 0) control.effect('bounce', {direction: 'right', distance:'10', times:'1'}, 50);
		};
	});
});