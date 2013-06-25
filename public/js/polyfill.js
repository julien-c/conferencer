(function() {

	// Load Respond and Selectivizr polyfills if necessary
  Modernizr.load([
    {
      test: Modernizr.mediaqueries,
      nope: '//cdnjs.cloudflare.com/ajax/libs/respond.js/1.1.0/respond.min.js'
    }, {
      test: Modernizr.lastchild,
      nope: '//cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js'
    }
  ]);

  // Replace SVG images with JPG if unsupported
  if (!Modernizr.svg) {
    var _i, images = document.getElementsByTagName('img');

  	// Loop over the images in the current page
    for (_i = 0, _len = images.length; _i < _len; _i++) {
      var image = images[_i],
      		src = image.getAttribute('src');

      // If it's an SVG image, replace src attribute
      if (src.match('.svg')) {
      	src = src.replace('.svg', '.jpg');
        image.setAttribute('src', src);
      }
    }
  }

}).call(this);
