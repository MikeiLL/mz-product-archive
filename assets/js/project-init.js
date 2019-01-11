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
  
  $gallery.on('click', 'img', function(e) {
     var index = $(e.target).parent().index();

    // Photoswipe functions
    var openPhotoSwipe = function() {
      var pswpElement = document.querySelectorAll('.pswp')[0];

      // build items array
      
      var items = $.map($(".gallery").find("img"), function(el) {
        return {          
          "src": el.getAttribute('data-src'),
          "w":   el.width,
          "h":   el.height
        }
      });
      
      var options = {  
      	history: false,
        index: index
      };
   
      var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
      gallery.init();
    };

    openPhotoSwipe();
  });
  
   var $portfolio_gallery = $('.portfolio-gallery').flickity({
    imagesLoaded: true,
    percentPosition: false,
    wrapAround: true,
    pageDots: true
  });
  
  $portfolio_gallery.on('staticClick.flickity', function(event, pointer, cellElement, cellIndex) {
    if (!cellElement) {
      return;
    }

    // Photoswipe functions
    var openPhotoSwipe = function() {
      var pswpElement = document.querySelectorAll('.pswp')[0];

      // build items array

      var items = $.map($(".portfolio-gallery").find("img"), function(el) {
        return {
          "src": el.getAttribute('data-src'),
          "w":   el.getAttribute('data-width'),
          "h":   el.getAttribute('data-height')
        }
      });

      var options = {
      	history: false,
        index: cellIndex
      };

      var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
      gallery.init();

    };

    openPhotoSwipe();
  });


})(jQuery); // Fully reference jQuery after this point.
