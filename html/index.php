
<?php 
 require_once 'header.php';
?>

<script id='logic'>

</script>

    <body
	<div
		<div class="input-field col s12 green-text">
                    <input id="password" name = "password" type="password" class="validate">
                    <label for="first_name">Password</label>
                  </div>
                  <button class="btn waves-effect waves-light green" type="submit" name="action">Submit
                    <i class="mdi-content-send right"></i>
                  </button>>
		<input type='text' name ='username' id='username'><br>
		<input type='password' name='password' id='password'><br>
		<input hidden type='text' name='p' id='p'>
	</div>
	<div id='container'>
	<canvas id="c"></canvas>
    	     <div id='message' data-message=0>	
		<?php echo determineWhichQuestionToGoTo($questions); ?>
   	     </div>
	</div>
	<style>
	#message{
    position : absolute;    
    width    : 700px;
    height   : 200px;
    left     : 50%;
    top      : 50%;
    margin-left : -100px; /* half of the width  */
    margin-top  : -100px; /* half of the height */
	}
	</style>
<?php

require_once 'footer.php';?> 
