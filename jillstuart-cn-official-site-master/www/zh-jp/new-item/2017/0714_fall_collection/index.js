$(function() {
  var $toggle = $('#js-toggle'),
      $button = $('#js-toggle-button')
  $button.click(function() {
    $toggle.toggleClass('is-open');
    $(this).find('>div').toggleClass('is-active');
    if(!$toggle.is('.is-open')) {
      $(window).scrollTop($toggle.offset().top);
    }
    return false;
  });
})
