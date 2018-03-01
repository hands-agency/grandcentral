(function ($) {

    //Create our custom event for handling this
    $.event.trigger({
        type:'typeintent'
    });

    $.fn.typeintent = function (options) {

        var defaults = {
            //Should we trigger the change event each time a new word is entered?
            words: false,
            //How long should we wait without input before we decide that the user is done?
            wait: 1200
        };

        var obj = $.extend({}, defaults, options);

        return this.each(function () {
            var $el = $(this);

            if (obj.eachWord)
            {
                $el.keyup(function(e){
                    var newVal = $(this).val();
                    var oldVal = obj.oldVal;
                    var pattern = /[^\s]\s$/;
                    //They just hit the space bar, so make sure that there is a word before the space and FIRE!
                    if (e.which === 32 && pattern.test(newVal))
                    {
                        if (newVal !== oldVal)
                        {
                            $(this).trigger('typeintent'); 
                            obj.oldVal = newVal;                        
                        }
                    }
                });
            }

            $el.keydown(function(e){
                //Clearly we are still typing, so we should stop the chance of firing the event now
                clearTimeout(obj.timeout);
                if (e.which !== 32)
                {
                    //Now we start waiting for them not to hit any buttons
                    obj.timeout = setTimeout(function($el){
                        var newVal = $el.val();
                        var oldVal = obj.oldVal;
                        if (newVal !== oldVal)
                        {
                            $el.trigger('typeintent');
                            obj.oldVal = $el.val();
                        }
                    },obj.waitTime,$(this));
                }
            });

        });
    }
})(jQuery);
