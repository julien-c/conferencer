(function() {

	/*
		Tablesorter
	*/

	$('.table').tablesorter();

	/*
		Models deleting
	*/

	$('[data-action=delete] a').click(function(event) {
		var
			endpoint = $(this).attr('href'),
			prompt   = $(this).parent().data('confirm'),
			_this    = this;

		event.preventDefault();
		if (confirm(prompt)) {
			if (confirm('Are you really sure ? This is a destructive operation')) {
				return $.ajax({
					type: 'DELETE',
					url: endpoint,
					success: function() {
						return $(_this).closest('tr').fadeOut();
					}
				});
			}
		}
	});

	/*
		Relations AJAX adding
	*/

	$('.has-many__add').click(function(event) {
		var
			model    = $(this).siblings('select').val(),
			endpoint = $(this).data('url').replace('/0', "/" + model),
			_this    = this;

		event.preventDefault();
		return $.get(endpoint, function(results) {
			if (results.status !== 200) {
				return false;
			}
			model = "<li class='tag'>" + results.model.name + "</li>";
			return $(_this).siblings('.has-many').append(model);
		});
	});

	/*
		AJAX removing of models
	*/

	$('.has-many a').click(function(event) {
		var
			endpoint = $(this).attr('href'),
			question = $(this).closest('ul').data('confirm'),
			_this    = this;

		event.preventDefault();
		if (confirm(question)) {
			return $.ajax({
				type: 'DELETE',
				url: endpoint,
				success: function() {
					return $(_this).parent().fadeOut();
				}
			});
		}
	});

}).call(this);
