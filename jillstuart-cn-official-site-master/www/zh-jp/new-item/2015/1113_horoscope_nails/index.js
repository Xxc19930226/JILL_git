/*
 * jQuery Easing Compatibility v1 - http://gsgd.co.uk/sandbox/jquery.easing.php
 *
 * Adds compatibility for applications that use the pre 1.2 easing names
 *
 * Copyright (c) 2007 George Smith
 * Licensed under the MIT License:
 *   http://www.opensource.org/licenses/mit-license.php
 */

jQuery.extend( jQuery.easing,
{
	easeIn: function (x, t, b, c, d) {
		return jQuery.easing.easeInQuad(x, t, b, c, d);
	},
	easeOut: function (x, t, b, c, d) {
		return jQuery.easing.easeOutQuad(x, t, b, c, d);
	},
	easeInOut: function (x, t, b, c, d) {
		return jQuery.easing.easeInOutQuad(x, t, b, c, d);
	},
	expoin: function(x, t, b, c, d) {
		return jQuery.easing.easeInExpo(x, t, b, c, d);
	},
	expoout: function(x, t, b, c, d) {
		return jQuery.easing.easeOutExpo(x, t, b, c, d);
	},
	expoinout: function(x, t, b, c, d) {
		return jQuery.easing.easeInOutExpo(x, t, b, c, d);
	},
	bouncein: function(x, t, b, c, d) {
		return jQuery.easing.easeInBounce(x, t, b, c, d);
	},
	bounceout: function(x, t, b, c, d) {
		return jQuery.easing.easeOutBounce(x, t, b, c, d);
	},
	bounceinout: function(x, t, b, c, d) {
		return jQuery.easing.easeInOutBounce(x, t, b, c, d);
	},
	elasin: function(x, t, b, c, d) {
		return jQuery.easing.easeInElastic(x, t, b, c, d);
	},
	elasout: function(x, t, b, c, d) {
		return jQuery.easing.easeOutElastic(x, t, b, c, d);
	},
	elasinout: function(x, t, b, c, d) {
		return jQuery.easing.easeInOutElastic(x, t, b, c, d);
	},
	backin: function(x, t, b, c, d) {
		return jQuery.easing.easeInBack(x, t, b, c, d);
	},
	backout: function(x, t, b, c, d) {
		return jQuery.easing.easeOutBack(x, t, b, c, d);
	},
	backinout: function(x, t, b, c, d) {
		return jQuery.easing.easeInOutBack(x, t, b, c, d);
	}
});

var HRSC = {

  init : function(){
    $(function(){
      new HRSC.Slide('#slide');
    });
  }
}

HRSC.Slide = function(elem){
  this.elem = elem;
  this.btns = '#slideBtns';
  this.index = 0;
  this.total = 0;
  this.speed = 600;
  this.eaing = 'easeInOut';
  this.init();
}

HRSC.Slide.prototype = {

  init : function(){
    var self = this,
        $this = $(self.elem);
    self.total = $('.slide-item', $this).length;
    self.setEvent();
		self.resize();
    self.disableBtns(self.index);
  },

  setEvent : function(){
    var self = this,
        $this = $(self.elem),
        $btns = $(self.btns);

		$(window).resize(function(){
			self.resize(self);
		});

    $('.prev a', $btns).off('click').click(function(){
      if(0 < self.index){
        self.index--;
        self.move(self.index);
      }
      return false;
    });

    $('.next a', $btns).off('click').click(function(){
      if(self.index < self.total-1){
        self.index++;
        self.move(self.index);
      }
      return false;
    });
  },

	resize : function(self){
		var self = self ? self : this,
				$this = $(self.elem),
				$items = $('.slide-item', $this);
		$items.css({'width':$('.slide-body', $this).width()});
	},

  move : function(index){
    var self = this,
        $this = $(self.elem),
        $scroller = $('.slide-scroller', $this),
        $target = $('.slide-item', $scroller).eq(index),
        left = -($target.position().left);
    $scroller.stop().animate({'left':left}, self.speed, self.easing, function(){
      self.changeFooter(index);
    });
    self.disableBtns(index);
  },

  changeFooter : function(index){
    var self = this,
        $this = $(self.elem),
        items = ['charm', 'package'],
        id = $('.slide-item', $this).eq(index).attr('data-id');
        img = new Image(),
        loaded = 0;

    function imgLoaded(){
      loaded++;
      if(loaded == items.length) init();
    }

    function init(){
      for(var i=0; i<items.length; i++){
        $('.' + items[i] + ' .thumb span', $this).css({'background-image':'url(images/slide_' + items[i] + id + '.png)'});
      }
    }

    for(var i=0; i<items.length; i++){
      var img = new Image(),
          src = 'images/slide_' + items[i] + id + '.png';
      (img.complete) ? imgLoaded() : $(img).load(imgLoaded);
    }
  },

  disableBtns : function(index){
    var self = this,
        $btns = $(self.btns),
        $prev = $('.prev', $btns),
        $next = $('.next', $btns);
    (index <= 0) ? $prev.addClass('disable') : $prev.removeClass('disable');
    (self.total-1 <= index) ? $next.addClass('disable') : $next.removeClass('disable');
  }
}

HRSC.init();
