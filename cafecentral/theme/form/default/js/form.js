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
		$('section.edit form>fieldset>ol>li').addClass('editable').each(function()
		{
			control = $(this).find('data-control');
			if (control.length == 0) $(bubble).appendTo($(this)).show('slide', { direction: 'left' }, 100).attr('class', 'icon-pencil');
			else control.show("slide", { direction: 'left' }, 100);
		});
	//	Start sortable
		$('section.edit form').sortable(
		{
			items:'>fieldset>ol>li',
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
		form = $('section.edit form');
		order = form.sortable('toArray', {attribute:'data-key'});
	
	//	destroy all the data-control bubbles
		$('section.edit form>fieldset>ol>li').removeClass('editable').find('[data-control]').hide('slide', { direction: 'left' }, 100);

	//	Kill sortable and store new order		
		$.ajx(
		{
			app: 'form',
			theme: 'default',
			template: 'order.routine',
			form:form.data('key'),
			order: order,
		},{
			done:function(html)
			{
				console.log(html);
			//	Kill sortable
				$('section.edit form').sortable('destroy');
			},
		}, true);
	});
	
/*********************************************************************************************
/**	* Edit a field in a form
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	$(document).on('click', 'form .editable [data-control]', function()
	{
	//	Some vars
		li = $(this).closest('li');
		form = li.closest('form').data('key');
		field = li.find('[name^="' + form + '"]');
		value = new Array();
		field.each(function(index)
		{
			value[index] = $(this).val();
		});
		
	//	Add edit wrapper once
		if (li.find('.editWrapper').length == 0) li.append('<div class="editWrapper"></div>');
		
	//	Load form
		li.find('.editWrapper').ajx(
		{
			app: 'form',
			theme: 'default',
			template: 'field.edit',
			form: form,
			field: li.data('key'),
			value: value,
		},{
			done:function()
			{
			//	Say we are editing
				li.toggleClass('editable editing');
			//	Keep readbility
				$('body').addClass('subEditing');
			},
		}, true);
	});

/*********************************************************************************************
/**	* Update the properties of a field straight from a form
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	$(document).on('click', 'form .editing [data-control]', function()
	{
	//	Some vars
		control = $(this);
		field = control.closest('li[data-type]');
		form = field.closest('form').data('key');
		fields = field.find('.editWrapper [name]');
		properties = fields.serialize();
		value = field.find('>.wrapper [name]').serialize();
		currentType = field.data('type');
		
	//	Update the properties
		$.ajx(
		{
			app: 'form',
			theme: 'default',
			template: 'field.edit.routine',
			currentType: currentType,
			properties: properties,
			value: value,
		},{
			done:function(html)
			{
			//	Replace the whole field with the new field
				field.replaceWith(html);
			//	Keep readbility
				$('body').removeClass('subEditing');
			},
		});
	});
	
/*********************************************************************************************
/**	* Validate a field form
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
/*	$(document).on('submit', '.editing form', function()
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
		maxlength = 40;
		change = $('header h1 .item');
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
/**	* Open, close the collapsed fields
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	$(document).on('click', '.collapse', function()
	{
		$(this).removeClass('collapse', 200);
	});

/*********************************************************************************************
/**	* Display fields limit
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