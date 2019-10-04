
<?php
 require_once 'header.php';
?>

<script id='logic'>
function resize() {
  document.querySelector('#c').style.width = '100%';
  document.querySelector('#c').style.height = '100%';
}
window.resize = resize

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
      width    : 400px;
      /* height   : 200px;
      left     : 50%;
      top      : 50%;
      margin-left : -100px;       margin-top  : -100px; half of the height */
    }
	#container {
    width: 100%;
    height: 100%;
    position: fixed;
    display: flex;
    justify-content: center;
    align-items: center;
	}
	#c {
		width: 100%;
		height: 100%;
	}
    </style>
<?php

require_once 'footer.php';?>
