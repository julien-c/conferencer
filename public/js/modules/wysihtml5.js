(function() {
	var sanitizeUrl;

	/**
	 * Uniformizes an URL
	 *
	 * @param  {string} url The URL
	 *
	 * @return {string} The uniformized URL
	 */
	sanitizeUrl = function(url) {
		url = url.replace('https://', '');
		url = 'http://' + url.replace('http://', '');
		return url;
	};

	////////////////////////////////////////////////////////////////////
	//////////////////////////// PARSING RULES /////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Iframes
	 */
	wysihtml5ParserRules.tags.iframe = {
		check_attributes: {
			src: "url"
		},
		set_attributes: {
			width: 640,
			height: 480,
			frameborder: 0,
			allowfullscreen: ""
		}
	};

	/**
	 * Flash Objects
	 */
	wysihtml5ParserRules.tags.object = {
		set_attributes: {
			width: 700,
			height: 525
		}
	};

	wysihtml5ParserRules.tags.param = {
		allow_attributes: ["value"],
		check_attributes: {
			name: "alt"
		}
	};

	wysihtml5ParserRules.tags.embed = {
		allow_attributes: ["flashvars"],
		check_attributes: {
			src: "url"
		},
		set_attributes: {
			type: "application/x-shockwave-flash",
			allowFullScreen: "true"
		}
	};

	////////////////////////////////////////////////////////////////////
	//////////////////////////// EMBED BUTTONS /////////////////////////
	////////////////////////////////////////////////////////////////////

	// Youtube ------------------------------------------------------- /

	wysihtml5.commands.youtube = {
		exec: function(composer, command, value) {
			var embed, url;

			url = sanitizeUrl(value.href);
			url = url.replace('watch?v=', 'embed/');
			embed = $("<iframe width='640' height='360' src='" + url + "' frameborder='0' allowfullscreen></iframe>");
			return composer.selection.insertNode(embed[0]);
		}
	};

	// Flickr -------------------------------------------------------- /

	wysihtml5.commands.flickr = {
		exec: function(composer, command, value) {
			var embed, set;

			set = sanitizeUrl(value.set);
			set = set.replace('http://www.flickr.com/photos/anahkiasen/sets/', '');
			if (!set) {
				return false;
			}

			embed = $("<object width='700' height='525'>
				<param
					name='flashvars'
					value='offsite=true&lang=en-us&page_show_url=%2Fphotos%2Fanahkiasen%2Fsets%2F" +set+ "%2Fshow%2Fwith%2F6930229569%2F&page_show_back_url=%2Fphotos%2Fanahkiasen%2Fsets%2F" +set+ "%2Fwith%2F6930229569%2F&set_id=" +set+ "&jump_to=6930229569'></param>
				<param
					name='movie'
					value='http://www.flickr.com/apps/slideshow/show.swf?v=124984'></param>
				<param
					name='allowFullScreen'
					value='true'></param>
				<embed
					type='application/x-shockwave-flash'
					src='http://www.flickr.com/apps/slideshow/show.swf?v=124984'
					allowFullScreen='true'
					flashvars='offsite=true&lang=en-us&page_show_url=%2Fphotos%2Fanahkiasen%2Fsets%2F" +set+ "%2Fshow%2Fwith%2F6930229569%2F&page_show_back_url=%2Fphotos%2Fanahkiasen%2Fsets%2F" +set+ "%2Fwith%2F6930229569%2F&set_id=" +set+ "&jump_to=6930229569' width='700' height='525'></embed>
			</object>");

			return composer.selection.insertNode(embed[0]);
		}
	};

	////////////////////////////////////////////////////////////////////
	///////////////////////////// EDITOR SETUP /////////////////////////
	////////////////////////////////////////////////////////////////////

	new wysihtml5.Editor("wysihtml5-textarea", {
		toolbar: "wysihtml5-toolbar",
		parserRules: wysihtml5ParserRules,
		stylesheets: ["http://monaco.dev/components/wysihtml5/examples/css/stylesheet.css"]
	});

}).call(this);
