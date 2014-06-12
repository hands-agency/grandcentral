(function($)
{
//	Fetch all instances
	var instances = $("[data-type=\'sirtrevor\'] textarea"),
	i = instances.length, instance;

//	Instanciate all instances
	while (i--)
	{
		instance = $(instances[i]);

	    new SirTrevor.Editor(
		{
			el: instance,
			blockTypes: ["Text", "Heading", "List", "Quote", "HR"],
		});
	}
})(jQuery); 