<style>
	#header .logo {
    max-width: 20%;
	}
	.form-inputs p {
    overflow: hidden;
    height: auto;
		}
		.form-submit {
    overflow: hidden;
    height: auto;
		}
		.page-content {
    overflow: hidden;
    height: auto;
}
	</style>
	@if(!Auth::check())
	<div class="login-panel">
			<section class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="page-content">
							<h2>Login</h2>
							<div class="form-style form-style-3">
							<form method="POST" action="{{ route('login') }}">
									@csrf
									<div class="form-inputs clearfix">
										<p class="login-text">
											<input type="text" name="email" value="Username" >
											<i class="icon-user"></i>
											@if ($errors->has('email'))
												<span class="invalid-feedback">
													<strong>{{ $errors->first('email') }}</strong>
												</span>
											@endif
										</p>
										<p class="login-password">
											<input type="password" name="password" value="Password">
											<i class="icon-lock"></i>
											@if ($errors->has('password'))
												<span class="invalid-feedback">
													<strong>{{ $errors->first('password') }}</strong>
												</span>
											@endif
											{{-- <a href="#">Forget</a> --}}
										</p>
									</div>
									<p class="form-submit login-submit">
										<input type="submit" value="Log in" class="button color small login-submit submit">
									</p>
									{{-- <div class="rememberme">
										<label><input type="checkbox" checked="checked"> Remember Me</label>
									</div> --}}
								</form>
							</div>
						</div><!-- End page-content -->
					</div><!-- End col-md-6 -->
					<div class="col-md-6">
						<div class="page-content Register">
							<h2>Register Now</h2>
							<p>You can ask your question from the experts here at skoogle forum. Typically answer is posted around 1hour.</p>
							<a class="button color small signup">Create an account</a>
						</div><!-- End page-content -->
					</div><!-- End col-md-6 -->
				</div>
			</section>
		</div><!-- End login-panel -->
		
		<div class="panel-pop" id="signup">
			<h2>Register Now<i class="icon-remove"></i></h2>
			<div class="form-style form-style-3">
				<form>
					<div class="form-inputs clearfix">
						<p>
							<label class="required">Username<span>*</span></label>
							<input type="text">
						</p>
						<p>
							<label class="required">E-Mail<span>*</span></label>
							<input type="email">
						</p>
						<p>
							<label class="required">Password<span>*</span></label>
							<input type="password" value="">
						</p>
						<p>
							<label class="required">Confirm Password<span>*</span></label>
							<input type="password" value="">
						</p>
					</div>
					<p class="form-submit">
						<input type="submit" value="Signup" class="button color small submit">
					</p>
				</form>
			</div>
		</div><!-- End signup -->
		
		<div class="panel-pop" id="lost-password">
			<h2>Lost Password<i class="icon-remove"></i></h2>
			<div class="form-style form-style-3">
				<p>Lost your password? Please enter your username and email address. You will receive a link to create a new password via email.</p>
				<form>
					<div class="form-inputs clearfix">
						<p>
							<label class="required">Username<span>*</span></label>
							<input type="text">
						</p>
						<p>
							<label class="required">E-Mail<span>*</span></label>
							<input type="email">
						</p>
					</div>
					<p class="form-submit">
						<input type="submit" value="Reset" class="button color small submit">
					</p>
				</form>
				<div class="clearfix"></div>
			</div>
		</div>
		
<div id="header-top">
	<section class="container clearfix">
		<nav class="header-top-nav">
			<ul>
				{{-- <li><a href="contact_us.html"><i class="icon-envelope"></i>Contact</a></li> --}}
				{{-- <li><a href="#"><i class="icon-headphones"></i>Support</a></li> --}}
				<li><a href="" id="login-panel"><i class="icon-user"></i>Login Area</a></li>
			</ul>
		</nav>
		<div class="header-search">
			<form>
				<input type="text" value="Search here ..." onfocus="if(this.value=='Search here ...')this.value='';" onblur="if(this.value=='')this.value='Search here ...';">
				<button type="submit" class="search-submit"></button>
			</form>
		</div>
	</section>
</div>
@endif
<header id="header">
	<section class="container clearfix">
		<div class="logo"><a href="{{ route('ForumAll')}}"><img alt="" src="{{ asset('public/askme/images/logo.png')}}"></a></div>
		<nav class="navigation">
			<ul>
				
			<li class="ask_question"><a href="{{ route('ForumCreate')}}">Ask Question</a></li>
			@if(Auth::user())
			<li><a href="shortcodes.html">Profile</a></li>
			<li><a href="{{ route('LogOutSystem')}}">Logout</a></li>
			@endif
				{{-- <li><a href="contact_us.html">Contact Us</a></li> --}}
			</ul>
		</nav>
	</section><!-- End container -->
</header>