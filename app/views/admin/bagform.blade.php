{{ Form::open(array('url' => 'api/v1/bags', 'files' => true)) }} 
	{{ Form::text('idclient') }}
	{{ Form::text('brand') }}
	{{ Form::text('color') }}
	{{ Form::text('description') }}
	
	{{ Form::file('picture1') }}
	{{ Form::file('picture2') }}
	{{ Form::file('picture3') }}
	{{ Form::submit('Add Card') }}
{{ Form::close() }}