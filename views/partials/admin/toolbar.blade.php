{{ Former::group() }}
	<div id="wysihtml5-toolbar" class="controls" style="display: none;">
		@foreach($toolbars as $toolbar)
			<div class="btn-group">
				@foreach ($toolbar as $name => $attributes)
					<a class="btn"{{ HTML::attributes($attributes) }}>{{ $name }}</a>
					@if (isset($modals[$attributes['data-wysihtml5-command']]))
						<div data-wysihtml5-dialog="{{ $attributes['data-wysihtml5-command'] }}" class="modal" style="display: none;">
							@foreach ($modals[$attributes['data-wysihtml5-command']] as $field => $value)
								<label>
									{{ $name }}
									<input data-wysihtml5-dialog-field="{{ $field }}" placeholder="{{ $value }}" class="text">
								</label>
							@endforeach
							<a class="btn btn-primary" data-wysihtml5-dialog-action="save">Ok</a>
							<a class="btn" data-wysihtml5-dialog-action="cancel">Cancel</a>
						</div>
					@endif
				@endforeach
			</div>
		@endforeach
	</div>
{{ Former::closeGroup() }}