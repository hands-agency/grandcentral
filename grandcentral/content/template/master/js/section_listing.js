/*********************************************************************************************
/**	* Display the archives
 	* @author	@mvdandrieux
**#******************************************************************************************/
	$('section .flag.archive').on('click', function() {
	//	CODE : The archive list
		code='<ul class="archives flat"></ul>';
	//	APPEND : Create the archive list if it doesn't exist, load it and display it.
		obj = $(this).parents('li');
		if (!$(obj).find('.archives').length) {
			$(obj).append(code);
		}
		$(obj).find('.archives').load(ajx('archive.compare'), function() {
			$(obj).find('.archives').toggle('fast');}
		);
		$(this).toggleClass('on off');
	});

/*********************************************************************************************
/**	* Showing the discussion input on a wall
 	* @author	@mvdandrieux
**#******************************************************************************************/
	$('section .discuss').on('click', function() {
	//	CODE : the new comment line
		code='<ul class="comment"><li class="flat"><form action=""><input type="text" placeholder="Post an answer to this note" />	<input type="submit" name="some_name" value="" id="some_name" /></form></li></ul>';
	//	our item
		obj=$(this).parents('li');

	//	Only if the discussion is not on yet, create it. Focus on it anyway.
		if (!$(obj).find('.comment').length) {$(obj).append(code);}
		$(obj).find('input').focus();
	});