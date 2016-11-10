{{ Form::open(array('url'=>'users/create', 'class'=>'form-signup', 'id'=>'register-form' )) }}
    <h2 class="form-signup-heading">Please Register</h2>
 
    <!--<ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>-->
	@foreach($errors->all() as $error)
           
			<div class="alert alert-danger">
				 {{ $error }}
			</div>
     @endforeach
 
    {{ Form::text('first_name', null, array('class'=>'form-control required', 'placeholder'=>'First Name')) }}
    {{ Form::text('last_name', null, array('class'=>'form-control required', 'placeholder'=>'Last Name')) }}
    {{ Form::text('email', null, array('class'=>'form-control required', 'placeholder'=>'Email Address')) }}
    {{ Form::password('password', array('class'=>'form-control required', 'placeholder'=>'Password')) }}
    {{ Form::password('password_confirmation', array('class'=>'form-control required', 'placeholder'=>'Confirm Password')) }}
	 
    {{ Form::submit('Register', array('class'=>'btn btn-lg btn-primary btn-block'))}}
{{ Form::close() }}


