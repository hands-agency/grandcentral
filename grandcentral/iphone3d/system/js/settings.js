var Settings = function( u ){

    this.moveMouseEnabled = false;
    this.views = 0;
    this.url = u;//"http://m.nytimes.com";
    this.mode = 0;
};

Settings.prototype.init = function( phone ){
	this.phone = phone;

	this.datgui = new dat.GUI();

	var selectorMouseMove = this.datgui.add(this, 'moveMouseEnabled').name("Mouse move enabled").listen();
	var mode = this.datgui.add(this, 'mode', {Portrait:0, Landscape:1});
	var selectorView = this.datgui.add(this, 'views', { Free: 0, Front: 1, Back: 2, AppleFront:7, AppleBack:8, custom:10 }).name("Views").listen();
	var selectorURL = this.url = this.datgui.add(this, 'url');

	var that = this;
	selectorURL.onFinishChange(function(value){
		$("#phonescreen").attr("src", value);
    });

	selectorView.onFinishChange(function(value){
        that.phone.updateView( value );
    });

	selectorMouseMove.onFinishChange(function(value){
        that.phone.updateMouseMove( value );
    });

	mode.onFinishChange(function(value){
        that.phone.updateMode( value );
    });


}