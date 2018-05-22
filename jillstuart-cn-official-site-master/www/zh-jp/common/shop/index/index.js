var JILL = JILL ? JILL : {};

JILL.shop = {

  init : function(){
    if(JILL.shop.isSmartphone()){
      JILL.shop.setAccordion();
    } else {
      JILL.shop.setSideMenu();
    }
  },

  setSideMenu : function(){
    var $side = $('#sideMenu'),
        href = location.href.replace(/#.*$/, '');
    if(!$side.length) return false;

    $('li a', $side).each(function(){
      var $this = $(this),
          myHref = new RegExp($this.attr('href').replace(/\../, '') + '$');
      if(href.match(myHref)){
        $this.addClass('current').siblings('.sub').show();
      }
    });
  },

  createMap : function(){
    var $map = $('.map');

    function initMap(elem, latLng) {
      var map = new google.maps.Map(elem, {
        center: latLng,
        zoom: 16
      });
      var marker = new google.maps.Marker({
        position: latLng,
        map: map
      });
    }

    $map.each(function(){
      var $this = $(this);
      initMap(this, {lat:Number($this.attr('data-lat')), lng:Number($this.attr('data-lng'))});
    });
  },

  setAccordion : function(){
    $('#shopList section > div').each(function(){
      var $this = $(this);
      $('.toggleBtn', $this).click(function(){
        var $toggle = $('.toggle', $this);
        if($this.is('.open')){
          $toggle.stop().slideUp();
          $this.removeClass('open');
        } else {
          $this.addClass('open');
          $toggle.stop().slideDown();
        }
      })
    });
  },

  isSmartphone : function(){
    return $('body').is('.smartphone');
  },
}

$(function(){
  JILL.shop.init();
})
