/**
 * Demo for HTML5 Notification API
 * @author Paul
 */
 (function($) {
  	$(document).ready(function() {
  	//	init_document();
  	});

  		/**
  		* Init document
  		*/
  		function init_document()
  		{
  			// Check browser support
  			check_browser_support();

  			// Request permission
  			$('#ask_permission').on("click", request_permission);

  			// Check if we have permission
  			check_permission();

  			// Plain text notification demo
  			$('#text_button').on("click", function(){
  				var notification = plain_text_notification('icon.png', 'Title', 'Descr');
  				notification.show();
  			});

  			// HTML notification demo
  			$('#html_button').on("click", function(){
  				var notification = html_notification( $("#url").val() );
  				notification.show();
  			});
  		}

  		/**
  		* Check browser support and display message if not supported
  		*/
  		function check_browser_support()
  		{
  			if(!window.webkitNotifications){
  			//	console.log("Your browser does not support the Notification API please use Chrome for the demo.");
  			}
  			else 
  			{
  			//	console.log("Your browser supports the Notification API.");
  			}
  		}

  		/**
  		* Check if the browser supports notifications
  		* 
  		* @return true if browser does support notifications
  		*/
  		function browser_support_notification()
  		{
			if (window.webkitNotifications) {
			  return true;
			}
			else {
			  return false;
			}
  		}

  		/**
		* Request notification permissions
  		*/
  		function request_permission()
  		{
  			// 0 means we have permission to display notifications
  			if (window.webkitNotifications.checkPermission() != 0) {
			    window.webkitNotifications.requestPermission(check_permission);
			  }
  		}

  		/**
		* Checks to see if notification has permission
  		*/
  		function check_permission() 
  		{
	      switch(window.webkitNotifications.checkPermission())
			{
				
          // Continue
	        case 0:
	          return true;
	          break;

	        case 2:
	        	console.log("You have denied access to display notifications.");
	        	break;
	        
	        default:
	          // Fail
	          console.log('fail');
	          break;
	      }
	    }

	    /**
	    * Create a plain text notification box
	    */
	    function plain_text_notification(image, title, content)
	    {
	    	if (window.webkitNotifications.checkPermission() == 0) {
	    		return window.webkitNotifications.createNotification(image, title, content);
	    	}
	    }

	    /**
	    * Create a notification box with html inside
	    */
	    function html_notification(url)
	    {
	    	if (window.webkitNotifications.checkPermission() == 0) {
	    		return window.webkitNotifications.createHTMLNotification(url);
	    	}
	    }
})(jQuery);