SirTrevor.Blocks.Iframe = (function() {

	return SirTrevor.Block.extend({

        type : 'iframe',

		icon_name : 'iframe',

		title : function() {
			return "iFrame";
		},

		toolbarEnabled : true,

		droppable : false,

		pastable : true,

		paste_options : {
			html : '<input type="text" placeholder="<iframe>" class="st-block__paste-input st-paste-block">'
		},

		onContentPasted : function(event) {
			this.loading();

			obj = {};

			val = $(event.target).val();

            iframeObj = $.parseHTML(val);

            $.each(iframeObj, function(i, el)
            {
                if(el.nodeName=='IFRAME')
                {
                    if(el.attributes.src.value){

                        ["src", "width", "height", "style", "sandbox", "lang", "title", "frameborder"].forEach(function(attribute){
                            console.log("outer; "+attribute);
                            if(el.attributes[attribute]) {
                                console.log("inner; "+attribute)
                                if(typeof el.attributes[attribute].value != undefined){
                                    obj[attribute] = el.attributes[attribute].value;
                                }else
                                {
                                    obj[attribute] = el.attributes[attribute];
                                }

                            }
                        });
                    }
                }
			});

            if(obj)
            {
                this.setAndLoadData(obj);
            }
		},

		uploadable : false,

		formattable : false,

		loadData : function(data) {
			data.width = (typeof data.width == undefined || !data.width) ? '100%' : data.width;
			data.height = (typeof data.height == undefined || !data.height) ? '100%' : data.height;
            data.style = (typeof data.style == undefined || !data.style) ? 'pointer-events:none' : 'pointer-events:none;'+data.style;
            data.frameborder = (typeof data.frameborder == undefined || !data.frameborder) ? '0' : data.frameborder;

			this.$inner.prepend(
				$('<iframe>')
					.attr('src', data.src)
					.attr('class', 'st-block-embed')
					.attr('width', data.width)
					.attr('height', data.height)
                    .attr('frameborder', data.frameborder)
			);
            if(typeof data.style != undefined){
                $('<iframe>')
					.attr('style', data.style)
            }
            if(typeof data.sandbox != undefined)
            {
                $('<iframe>')
                    .attr('sandbox', data.sandbox)
            }
            if(typeof data.lang != undefined)
            {
                $('<iframe>')
                    .attr('lang', data.lang)
            }
            if(typeof data.title != undefined)
            {
                $('<iframe>')
                    .attr('title', data.title)
            }


            this.$inner.addClass('text-center');

			this.ready();
		},
	});

})();
