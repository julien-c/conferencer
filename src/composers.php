<?php

//////////////////////////////////////////////////////////////////////
/////////////////////////// ADMINISTRATION ///////////////////////////
//////////////////////////////////////////////////////////////////////

View::composer('conferencer::partials.admin.toolbar', function($view) {

	// Define base schema of the toolbars
	$tools = array(
		array(
			'bold'             => 'Bold',
			'italic'           => 'Italic',
			'underline'        => 'Underline',
			'formatInline.sup' => 'Super',
			'createLink'       => 'Link',
			'insertImage'      => 'Image',
		),
		array(
			'formatBlock.h1' => 'Title 1',
			'formatBlock.h2' => 'Title 2',
			'formatBlock.h3' => 'Title 3',
		),
		array(
			'justifyLeft'   => 'Left',
			'justifyCenter' => 'Center',
			'justifyRight'  => 'Right',
		),
		array(
			'insertOrderedList'   => 'Numbered List',
			'insertUnorderedList' => 'Classic List',
		),
		array(
			'youtube' => 'Youtube',
			'flickr'  => 'Flickr',
		),
	);

	// Define possible modals for those buttons
	$view->modals = array(
		'createLink'  => array('href' => 'http://'),
		'insertImage' => array('src'  => 'http://'),
		'youtube'     => array('href' => 'http://'),
		'flickr'      => array('set'  => 'http://'),
	);

	// Compose toolbars
	foreach ($tools as $group => $buttons) {
		foreach ($buttons as $command => $name) {
			if (Str::contains($command, '.')) {
				list($command, $block) = explode('.', $command);
				$toolbars[$group][$name] = array(
					'data-wysihtml5-command-value' => $block,
					'data-wysihtml5-command'       => $command
				);
			} else {
				$toolbars[$group][$name] = array('data-wysihtml5-command' => $command);
			}
		}
	}

	$view->toolbars = $toolbars;
});
