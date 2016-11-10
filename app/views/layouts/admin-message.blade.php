<div style="height:82px;overflow:hidden;">
@if(Session::has('message') && Session::has('success') && Session::get('success') == '1')
					
					<div id="message" class="mws-form-message success"  >
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						{{ Session::get('message') }}
					</div>
@elseif(Session::get('success') == '0')
					<div id="message" class="mws-form-message warning" >
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						{{ Session::get('message') }}
					</div>	
@endif
</div>