(function($)
{
//	Fetch all instances
	var instances = $('[data-type="sirtrevor"] textarea'),
	i = instances.length, instance;
	
//	Override
	var Link = SirTrevor.Formatter.extend(
	{
		title: "link",
		iconName: "link",
		cmd: "CreateLink",
		text : "link",
		
		onClick: function()
		{
		//	Open context
			openContext(
			{
				app:'sirtrevor',
				template:'sirtrevor.link',
			});
		},
		
		isActive: function()
		{
			var selection = window.getSelection(), node;
			if (selection.rangeCount > 0)
			{
				node = selection.getRangeAt(0)
					.startContainer
					.parentNode;
			}
			return (node && node.nodeName == "A");
		}
	});
	SirTrevor.Formatters.Link = new Link();

//	Instanciate all instances
	while (i--)
	{
		instance = $(instances[i]);
	    new SirTrevor.Editor(
		{
			el: instance,
			blockTypes: ["Text", "Heading", "List", "Quote", "Break", "Imagegc", "Video"]
		});
	}
})(jQuery);