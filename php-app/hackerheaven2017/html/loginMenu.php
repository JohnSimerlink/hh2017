<div>

	<!--<h3> Sign up </h3>
	<form action=/home/process_login.php method="post" name="login_form"> 
          <li><input id="logInEmail" type="text" placeholder="example@email.com" name="email" maxlength="50" ></li>
          <li><input id="logInPassword" type="password" placeholder="password" name="password" maxlength="20" ></li>
          <li><button type="submit" id ='logInButton' class="btn btn-primary" value="Login >>" onclick="formhash(this.form, this.form.password);">Login</button></li> 
    </form>	-->
    <h3> OR Log in
    </h3>
    <form action="index.php" method="post" name="registration_form">                      t
      <li>
      	<div class="input-field col s4 green-text">
			<input id="signUpEmail" type="email" class="validate" name='email' placeholder="example@email.com" maxlength="50" required>
			<label for="signUpEmail">Email</label>
		</div>
      </li>
      <li>
      	<div class="input-field col s4 green-text">
      		<input id="signUpUsername" name='username' type="text" placeholder="username" maxlength="20" required>
      		<label for="signUpUsername">Username</label>
		</div>	
      </li> 
      <li>
      	<div class="input-field col s4 green-text">
      		<input id="signUpPassword" name='password' type="text" placeholder="password" maxlength="20" required>
      		<label for="signUpPassword">Username</label>
		</div>	
      </li> 
      <li>
      	<div class="input-field col s4 green-text">
      		<input id="signUpConfirm" name='confirmpwd' type="text" placeholder="Confirm Password" minlength="6" maxlength="20" required>
      		<label for="signUpUsername">Username</label>
		</div>	
      </li> 

      <li><input type="button" id ='signUpButton' class="btn btn-primary" value="Sign Up" onclick="return regformhash(this.form,this.form.username, this.form.email, this.form.password, this.form.confirmpwd);"/></li> 
      <li class="divider"></li>
      <li class="nav-header">Note: Please Use Google Chrome for best user experience.</li>

    </form>
</div>