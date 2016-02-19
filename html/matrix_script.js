var c = document.getElementById("c");
var ctx = c.getContext("2d");

//making the canvas full screen
c.height = window.innerHeight;
c.width = window.innerWidth;

//chinese characters - taken from the unicode charset
var chinese = "田由甲申甴电甶男甸甹町画甼甽甾甿畀畁畂畃畄畅畆畇畈畉畊畋界畍畎畏畐畑";
//converting the string into an array of single characters
chinese = chinese.split("");

var japanese = "大男竹中虫町天田土二日入年白八百文木本名目立力林六"; japanese = japanese.split("");

var hex = "ABCDEFABCDEFABCDEFABCDEF"; hex = hex.split("");
var numbers = "012345678901234567890123456789"; numbers = numbers.split("");

var matrix_text = japanese.concat(hex).concat(numbers);

var font_size = 10;
var title_font_size = 45;
var columns = c.width/font_size; //number of columns for the rain
//an array of drops - one per column
var drops = [];
//x below is the x coordinate
//1 = y co-ordinate of the drop(same for every drop initially)
for(var x = 0; x < columns; x++)
	drops[x] = 1; 

//drawing the characters
function draw(color)
{
	//Black BG for the canvas
	//translucent BG to show trail
	ctx.fillStyle = "rgba(0, 0, 0, 0.05)";
	ctx.fillRect(0, 0, c.width, c.height);
	
	ctx.fillStyle = "#00ff00"; //purple text = #551a8b
	ctx.font = font_size + "px arial";
	//looping over drops
	for(var i = 0; i < drops.length; i++)
	{
		//a random matrix_text character to print
		var text = matrix_text[Math.floor(Math.random()*matrix_text.length)];
		//x = i*font_size, y = value of drops[i]*font_size
		ctx.fillText(text, i*font_size, drops[i]*font_size);
		
		//sending the drop back to the top randomly after it has crossed the screen
		//adding a randomness to the reset to make the drops scattered on the Y axis
		if(drops[i]*font_size > c.height && Math.random() > 0.975)
			drops[i] = 0;
		
		//incrementing Y coordinate
		drops[i]++;
	}
}

var drawGreenInterval = setInterval(drawGreen, 33);
console.log("draw green intreval is", drawGreenInterval);

function drawGreen(){
	draw("#00ff00");
}

function drawPurple(){
	draw("#551a8b");
}
