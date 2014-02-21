var Phone3D = function( element, settings ){
    this.element = element;
    this.settings = settings;
    this.currentRotationX = 0;
    this.currentRotationY = 0;
    this.currentRotationZ = 0;
    this.newRotationX = 0;
    this.newRotationY = 0;
    this.newRotationZ = 0;

	this.height = 720;
	this.width = 340;

    $phone = $("#phone");
	$reflet = $("#reflet");
	$refletBack = $("#refletBack");
	$iframe = $("#phonescreen");
	$screen = $("#screen");
	
	var that = this;
	$(document).mousemove(function(event){
		if( that.settings.moveMouseEnabled === true ){
			that.newRotationY = ( event.pageX - $(window).width()*0.5 ) * .5;
			that.newRotationX = ( event.pageY - $(window).height()*0.5 ) * 0.15;
		}
	});

	this.update();
};

Phone3D.prototype.limitedValue = function( value, min, max ){
	
	if( value <= min ){
		value += 360;
		if( value < min ){
			value = this.limitedValue( value, min, max );
		}
	}else if( value > max ){
		value -= 360;
		if( value > max ){
			value = this.limitedValue( value, min, max );
		}
	}

	return value;
}

Phone3D.prototype.update = function(){
	requestAnimationFrame( this.update.bind(this) );

	if( this.settings.moveMouseEnabled === true ){
		this.currentRotationY += ( this.newRotationY - this.currentRotationY ) * 0.1;
		this.currentRotationX += ( this.newRotationX - this.currentRotationX ) * 0.1;

		if( parseInt(this.currentRotationY*10) != parseInt(this.newRotationY*10) || parseInt(this.currentRotationX*10) != parseInt(this.newRotationX*10) ){
			this.element.css({perspective:'700px',rotateY:this.currentRotationY+'deg',rotateX:this.currentRotationX+'deg'});
			$reflet.css({backgroundPosition: this.limitedValue( this.currentRotationY, -180, 180 ) * -5 + "px 0px"});
			$refletBack.css({backgroundPosition: ( this.limitedValue( this.currentRotationY, 0, 360 ) - 180 ) * 5 + "px 0px"});
		}
	}
}

Phone3D.prototype.updateView = function( value ){
	if( value != "0" ){
		this.settings.moveMouseEnabled = false;

		switch( value ){
			case "1":
				this.currentRotationX = 0;
				this.currentRotationY = 0;
				break;
			case "2":
				this.currentRotationX = 0;
				this.currentRotationY = 180;
				break;
			case "3":
				this.currentRotationX = 0;
				this.currentRotationY = -90;
				break;
			case "4":
				this.currentRotationX = 0;
				this.currentRotationY = 90;
				break;
			case "5":
				this.currentRotationX = -90;
				this.currentRotationY = 0;
				break;
			case "6":
				this.currentRotationX = 90;
				this.currentRotationY = 0;
				break;
			case "7":
				this.currentRotationX = 0;
				this.currentRotationY = -30;
				break;
			case "8":
				this.currentRotationX = 0;
				this.currentRotationY = -140;
				break;
			case "9":
				this.currentRotationX = 0;
				this.currentRotationY = 0;
				this.current
				break;
			case "10":
				this.currentRotationX = 40;
				this.currentRotationY = 0;
				break;
		}

		this.element.transition({rotateX:this.currentRotationX, rotateY:this.currentRotationY});
		$reflet.transition({backgroundPosition: this.limitedValue( this.currentRotationY, -180, 180 ) * -5 + "px 0px"});
		$refletBack.transition({backgroundPosition: ( this.limitedValue( this.currentRotationY, 0, 360 ) - 180 ) * 5 + "px 0px"});

	}else{
		this.settings.moveMouseEnabled = true;
	}
}

Phone3D.prototype.updateMouseMove = function( value ){
	if( value === true ){
		this.settings.views = 0;
	}
}

Phone3D.prototype.updateMode = function( value ){
	if( value === "0" ){
		$phone.transition({rotate: 0, x:this.width * -.5, y:this.height * -.5 });
		$iframe.css({rotate:0});

		switchClass($screen, "portrait");
		switchClass($("#reflet"), "portrait");
		switchClass($("#refletBack"), "portrait");
	}else{
		$phone.transition({rotate: 90, x:this.width * -.5, y:this.height * -.5});
		$iframe.css({rotate:-90});

		switchClass($screen, "landscape");
		switchClass($("#reflet"), "landscape");
		switchClass($("#refletBack"), "landscape");
	}
}

function switchClass( element, className ){
	element.removeClass("landscape");
	element.removeClass("portrait");
	element.addClass( className );
}