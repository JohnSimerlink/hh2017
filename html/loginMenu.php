<div>

	<h3> Sign up </h3>
	<form action=/home/process_login.php method="post" name="login_form"> 
          <li><input id="logInEmail" type="text" placeholder="example@email.com" name="email" maxlength="50" ></li>
          <li><input id="logInPassword" type="password" placeholder="password" name="password" maxlength="20" ></li>
          <li><button type="submit" id ='logInButton' class="btn btn-primary" value="Login >>" onclick="formhash(this.form, this.form.password);">Login</button></li> 
          <!--TODO: Use JQuery to instead of having a form where i need an input type button, to instead have it send the data went there is a click on the id logInButton>
          <!--TODO: edit the css to make the buttons have a better dynamic width when their is a mobile viewport. -->
    </form>	
    <h3> OR Log in
    </h3>
    <form action="index.php" method="post" name="registration_form">                       
      <li> </li>
      <li>
      	<div class="input-field col s12 green-text">
			<input id="signUpEmail" type="email" class="validate" name='email' placeholder="example@email.com" maxlength="50" required>
			<label for="signUpEmail">Email</label>
		</div>
      	<input >
      </li>
      <li><input id="signUpUsername" name='username' type="text" placeholder="username" maxlength="20" required></li> 
      <li><input id="signUpPassword" name= 'password' type="password" placeholder="password" maxlength="20" required></li>
      <li><input id="signUpConfirm" name = 'confirmpwd' type="password" placeholder="confirm password" minlength="6" maxlength="20" required></li>
      <li><input type="button" id ='signUpButton' class="btn btn-primary" value="Sign Up" onclick="return regformhash(this.form,this.form.username, this.form.email, this.form.password, this.form.confirmpwd);"/></li> 
      <li class="divider"></li>
      <li class="nav-header">Note: Please Use Google Chrome for best user experience.</li>


		<div class="input-field col s12 green-text">
			<input id="password" name = "password" type="password" class="validate">
			<label for="first_name">Password</label>
		</div>





    </form>
</div>