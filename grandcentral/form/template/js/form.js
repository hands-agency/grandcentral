$(document).ready(function ()
{
/*********************************************************************************************
/**	* Never send the form, even when it's sent
 	* @author	@mvdandrieux
**#******************************************************************************************/
	$(document).on('submit', '#adminContent section form', function()
	{
		return false;
	});

/*********************************************************************************************
/**	* Controls
* @author	@mvdandrieux
**#******************************************************************************************/
	controllingClass = 'controlling';
		
	showControl = function(li, param)
	{
	//	Some vars
		control = li.find('[data-control]');
		
	//	Start clean
		li.attr('class', controllingClass).stop(true);
	//	Add control if necessary
		if (control.length == 0)
		{
			code = '<div data-control=""></div>';
			control = $(code).appendTo(li);
		}
		
	//	We are controlling
		li.addClass(param.control);
		
	//	Clear (and maybe add label)
		control.html('');
		if (param.html) control.html(param.html);
	//	Clear (and maybe add icon)
		control.attr('data-feathericon', '');
		if (param.feathericon) control.attr('data-feathericon', param.feathericon);
		
	//	Timeout
		if (param.timeout) li.delay(param.timeout).queue(function()
		{
			hideControl($(this));
			$(this).dequeue();
		});
	}
	hideControl = function(li)
	{
		li.removeAttr('class');
	}

/*********************************************************************************************
/**	* Editable form while unlocked
* @author	@mvdandrieux
**#******************************************************************************************/
	$(document).bind('unlock', function()
	{
	//	Control!
		showControl($('section[data-template="/edit/edit"] form>fieldset>ol>li'),
		{
			html:'edit',
			control:'editable',
		});
		
	//	Start sortable
		$('section[data-template="/edit/edit"] form').sortable(
		{
			items:'li',
			handle:'label',
			axis:'y',
			revert: 100,
		});
	});

/*********************************************************************************************
/**	* Non editable form while locked
* @author	@mvdandrieux
**#******************************************************************************************/
	$(document).bind('lock', function()
	{
	//	Some vars
		form = $('section[data-template="/edit/edit"] form');
		order = form.sortable('toArray', {attribute:'data-key'});
	
	//	Control!
		hideControl($('section[data-template="/edit/edit"] form>fieldset>ol>li'),
		{
			html:'edit',
			control:'editable',
		});

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
				$('section[data-template="/edit/edit"] form').sortable('destroy');
			},
		}, true);
	});
	
/*********************************************************************************************
/**	* Form edit
 	* @author	@mvdandrieux
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
			app: 'field',
			template: 'fieldedit',
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
 	* @author	@mvdandrieux
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
/**	* H1 and title binding
 	* @author	@mvdandrieux
**#******************************************************************************************/
	$('section [name$="[title]"]').on('input', function()
	{
		title = $(this).val();
		maxlength = 55;
		change = $('section>header>h1');
		if (title && title.length<maxlength) change.html(title);
		else if (title) change.html(title.substr(0, maxlength)+'...');
		else change.html($('h1').attr('title'));
	});
	
/*********************************************************************************************
/**	* Focus On the first field of the freshly loaded section
 	* @author	@mvdandrieux
**#******************************************************************************************/
//	$('form input:first').focus(); /* it fucks up with the display... */

/*********************************************************************************************
/**	* Fields help
 	* @author	@mvdandrieux
**#******************************************************************************************/
/*	$(document).on('click', '.locked section label', function()
	{
		$(this).parent().find('.help').toggle('fast');
	});

/*********************************************************************************************
/**	* Fields limit
 	* @author	@mvdandrieux
**#******************************************************************************************/
	$(document).on('input', 'form input', function()
	{
		maxlength = $(this).attr('maxlength');
		if (maxlength)
		{
			li = $(this).closest('li');
	
		//	Display count
			count = $(this).val().length;
			html = maxlength-count;
			
		//	Control!
			showControl(li,
			{
				html:html,
				control:'guiding',
			});
			
		//	Stopper
			if (html == 0) control.effect('bounce', {direction: 'right', distance:'10', times:'1'}, 50);
		};
	});
});


/*********************************************************************************************
/**	* Focus on search engine
 	* @author	@mvdandrieux
**#******************************************************************************************/
	$('#refine input').searchasyoutype(
	{
		app:'content',
		template:'/edit/edit',
		target:'#adminContent section.active',
	});