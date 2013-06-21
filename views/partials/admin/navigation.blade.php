<nav class="layout-admin-navigation">
	<ul class="inline">
		<li>{{ HTML::linkRoute('admin.talks.index', 'Talks') }}</li>
		<li>{{ HTML::linkRoute('admin.speakers.index', 'Speakers') }}</li>
		<li>{{ HTML::linkRoute('admin.articles.index', 'Articles') }}</li>
		<li>{{ HTML::linkRoute('admin.partners.index', 'Partners') }}</li>
		<li>{{ HTML::linkRoute('admin.tags.index', 'Tags') }}</li>
		<li>{{ HTML::linkAction('Conferencer\Controllers\Admin\AdminController@getLogout', 'Logout') }}</li>
	</ul>
</nav>