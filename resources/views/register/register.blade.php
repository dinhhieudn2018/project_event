<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style type="text/css">
	body{
    background-color: #525252;
}
.centered-form{
	margin-top: 60px;
}

.centered-form .panel{
	background: rgba(255, 255, 255, 0.8);
	box-shadow: rgba(0, 0, 0, 0.3) 20px 20px 20px;
}
</style>
<div class="container">
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title">Register <small>It's free!</small></h3>
			 			</div>
			 			<div class="panel-body">
			    		<form role="form" action="post-register" method="post">
			    			@csrf
			    			<div class="form-group">
			    				<input type="name" name="name" id="email" class="form-control input-sm" placeholder="Name">
			    				@if($errors->has('name'))
									<div class="alert alert-danger">{{ $errors->first('name') }}</div>
								@endif
			    			</div>

			    			<div class="form-group">
			    				<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address">
			    				@if($errors->has('email'))
								<div class="alert alert-danger">{{ $errors->first('email') }}</div>
								@endif
			    			</div>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password">
			    						@if($errors->has('password'))
										<div class="alert alert-danger">{{ $errors->first('password') }}</div>
										@endif
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-sm" placeholder="Confirm Password">
			    						@if($errors->has('password_confirmation'))
										<div class="alert alert-danger">{{ $errors->first('password_confirmation') }}</div>
										@endif
			    					</div>
			    				</div>
			    			</div>
			    			
			    			<input type="submit" value="Register" class="btn btn-info btn-block">
			    		
			    		</form>
			    		<div>
			    			@if(Session::has('ok'))
			                <div style="color: red;font-weight: bold;text-align: center; font-size: 30px;">
			                    {{ Session::get('ok') }}
			                </div>
			            @endif
        			</div>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>