
<?php 
 require_once 'header.php';
?>

<script id='logic'>

</script>

    <body>
      <? /*require_once 'loginMenu.php'*/ ?>
      <div id='container'>
      <canvas id="c"></canvas>
               <div id='message' data-message=0>  
        <?php echo $questions[0]; ?>
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
	#container {
		width: 100%;
		height: 100%;
	}
	canvas {
		width: 100%;
		height: 100%;
	}
    </style>
<?php

require_once 'footer.php';?> 
