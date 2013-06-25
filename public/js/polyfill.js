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

  	// Loop over the images in the current page
    images = document.getElementsByTagName('img');
    for (_i = 0, _len = images.length; _i < _len; _i++) {
      image = images[_i];

      // If it's an SVG image, replace src attribute
      src = image.getAttribute('src');
      if (src.match('.svg')) {
      	src = src.replace('.svg', '.jpg');
        image.setAttribute('src', src);
      }
    }
  }

}).call(this);
