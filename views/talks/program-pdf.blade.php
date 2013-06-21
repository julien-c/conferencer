<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<style>
		body,
		html {
			margin: 0;
			padding: 0;
		}

		body {
			font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			border-spacing: 0;
		}

		th,
		td {
			padding: 14px 6px;
			text-align: left;
			vertical-align: top;
			border-top: 1px solid #DDD;
		}

		th {
			font-weight: bold;
		}

		thead tr th,
		thead tr td {
			border-top: 0;
		}
	</style>
</head>
<body>
	<div style="text-align: center">
		<img src="{{ __DIR__.'/../../public/app/img/logo.jpg' }}" width="400">
		<h1 style="font-weight: 100; font-size: 48px">Program {{ $year }}</h1>
		<hr>
	</div>
	<table>
		<thead>
			<tr>
				<th style="width: 40%">Talk</th>
				<th>Date/Time</th>
				<th>Speakers</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($talks as $talk)
				<tr>
					<td style="width: 40%">
						{{ $talk->name }}<br>
						<em>{{ $talk->subname }}</em>
					</td>
					<td>
						{{ $talk->date }} <em>at {{ $talk->time }}</em>
					</td>
					<td>
						@foreach ($talk->speakers as $speaker)
							&bull; {{ $speaker->name }}<br>
						@endforeach
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>