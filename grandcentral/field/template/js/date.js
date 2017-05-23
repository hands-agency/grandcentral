$(function()
{
	$('[data-type="date"] input.date').datepicker(
	{
		dateFormat: 'yy-mm-dd',
		firstDay: 1,
		// onSelect:function()
		// {
		// //	Current date time
		// 	$field = $(this).parent().find('.datetime');
		// 	time = $field.val().substr(11, 16);
		// //	New date
		// 	val = $(this).val();
		// 	date = val.substr(0, 10);
		// 	console.log('cii');
		// //	Add new date to datetime
		// 	$field.val(date+' '+time);
		// },
		onClose:function()
		{
		//	Current date time
			$field = $(this).parent().find('.datetime');
			time = $field.val().substr(11, 16);
		//	New date
			val = $(this).val();
			date = val.substr(0, 10);
		//	Add new date to datetime
			$field.val(date+' '+time);
		}
	});

	$('[data-type="date"] input.time').clockpicker(
	{
		placement: 'bottom',
		align: 'left',
		autoclose: true
	})
	.change(function()
	{
		$field = $(this).parent().find('.datetime');
		date = $field.val().substr(0, 10);
	//	New date
		// val = $(this).val();
	//	Add new date to datetime
		$field.val(date+' '+this.value+':00');
	});

});
