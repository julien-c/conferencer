<?php
use Basset\Facade as Basset;

//////////////////////////////////////////////////////////////////////
//////////////////////// ADMINISTRATION ASSETS ///////////////////////
//////////////////////////////////////////////////////////////////////

Basset::collection('admin', function($collection) {
	$collection->stylesheet('//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css');
	$collection->stylesheet('packages/anahkiasen/conferencer/css/admin.css');

	$collection->javascript('//cdnjs.cloudflare.com/ajax/libs/jquery/1.10.1/jquery.min.js');
	$collection->javascript('//cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.9.1/jquery.tablesorter.min.js');
	$collection->javascript('packages/anahkiasen/conferencer/js/admin.js')->apply('JsMin');
})
->rawOnEnvironment('local')
->apply('CssMin')
->apply('UriRewriteFilter');

Basset::collection('wysihtml5', function($collection) {
	$collection->javascript('packages/anahkiasen/conferencer/js/vendor/advanced.js');
	$collection->javascript('packages/anahkiasen/conferencer/js/vendor/wysihtml5-0.4.0pre.min.js');
	$collection->javascript('packages/anahkiasen/conferencer/js/modules/wysihtml5.js');
})
->rawOnEnvironment('local')
->apply('JsMin');
