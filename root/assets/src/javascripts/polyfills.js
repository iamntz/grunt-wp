if (!Object.create) { Object.create = function (o) { if (arguments.length > 1) { throw new Error('Object.create implementation only accepts the first parameter.'); } function F() {} F.prototype = o; return new F(); }; }


(function( $, document ){
  var enablePlaceholders = {
    init: function( el ){
      var $this = this;
      $this.el = $(el).data( 'hasplaceholder', true );
      $this.placeholder = $this.el.attr('placeholder');
      $this.addPlaceholder( $this.el );
    } // init

    ,addPlaceholder: function(){
      var $this = this;
      $this.maybeShowPlaceholder();
      $this.el.bind('blur.ntz_placeholder', $.proxy( $this.maybeShowPlaceholder, $this ) );
      $this.el.bind('focus.ntz_placeholder', $.proxy( $this.maybeHidePlaceholder, $this ) );
    } //addPlaceholder

    ,maybeShowPlaceholder: function(){
      var $this = this;
      if( $.trim( $this.el.val() ) !== '' ){ return; }
      $this.el
        .addClass('placeholder')
        .val( $this.placeholder );
    }//maybeShowPlaceholder

    ,maybeHidePlaceholder: function(){
      var $this = this;
      if( $this.el.hasClass('placeholder') && $this.el.val() == $this.placeholder ){
        $this.el.val('');
      }
    }//maybeHidePlaceholder
  };

  $.fn.enablePlaceholders = function() {
    var fakeInput = document.createElement("input");
    var nativePlaceholder = ("placeholder" in fakeInput);

    if (!nativePlaceholder) {
      $('input[placeholder], textarea[placeholder]').filter(function(){
        return !$(this).data('hasplaceholder');
      }).each(function(){
        var obj = Object.create( enablePlaceholders );
        obj.init( this );
      });

      return this;
    }
  };
})( jQuery, document );


// http://paulirish.com/2011/requestanimationframe-for-smart-animating/
// http://my.opera.com/emoller/blog/2011/12/20/requestanimationframe-for-smart-er-animating

// requestAnimationFrame polyfill by Erik Möller
// fixes from Paul Irish and Tino Zijdel

(function() {
  var lastTime = 0;
  var vendors  = [ 'ms', 'moz', 'webkit', 'o' ];

  for( var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x ){
    window.requestAnimationFrame = window[vendors[x] + 'RequestAnimationFrame'];
    window.cancelAnimationFrame  = window[vendors[x] + 'CancelAnimationFrame'] || window[vendors[x] + 'CancelRequestAnimationFrame'];
  }

  if ( !window.requestAnimationFrame ){
    window.requestAnimationFrame = function( callback, element ){
      var currTime = new Date().getTime();
      var timeToCall = Math.max( 0, 16 - ( currTime - lastTime ) );
      var id = window.setTimeout( function(){ callback( currTime + timeToCall ); },
        timeToCall);
      lastTime = currTime + timeToCall;
      return id;
    };
  }

  if ( !window.cancelAnimationFrame ){
    window.cancelAnimationFrame = function( id ) {
      clearTimeout( id );
    };
  }
}());


Array.max = function( array ){return Math.max.apply( Math, array );};
Array.min = function( array ){return Math.min.apply( Math, array );};