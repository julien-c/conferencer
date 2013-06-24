(function() {
  Modernizr.load([
    {
      test: Modernizr.mediaqueries,
      nope: '//cdnjs.cloudflare.com/ajax/libs/respond.js/1.1.0/respond.min.js'
    }, {
      test: Modernizr.lastchild,
      nope: '//cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js'
    }
  ]);

}).call(this);
