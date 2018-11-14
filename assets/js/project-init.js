 (function($) {
  // Flickity
  // --------- /
  var $gallery = $('.gallery').flickity({
    imagesLoaded: true,
    percentPosition: false,
    wrapAround: true,
    pageDots: false
  });
  var flkty = $gallery.data('flickity');

  $('.gallery-nav').flickity({
    asNavFor: '.gallery',
    contain: true,
    pageDots: false,
    prevNextButtons: false
  });

  $gallery.on('staticClick.flickity', function(event, pointer, cellElement, cellIndex) {
    if (!cellElement) {
      return;
    }

  });
  
  $('.portfolio-gallery').flickity({
    imagesLoaded: true,
    percentPosition: false,
    wrapAround: true,
    pageDots: true
  });


})(jQuery); // Fully reference jQuery after this point.
