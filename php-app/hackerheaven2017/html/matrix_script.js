let ctx
let font_size
let drops = []
let matrix_test
initMatrixBackground()
window.initMatrixBackground = initMatrixBackground

function initMatrixBackground() {
	var c = document.getElementById("c");
	console.log('c is ', c)
	ctx = c.getContext("2d");
	console.log('ctx is ', ctx)
	if (!ctx) {
		return
	}

	//making the canvas full screen
	c.height = window.innerHeight;
	c.width = window.innerWidth;


	//chinese characters - taken from the unicode charset
	var chinese = "田由甲申甴电甶男甸甹町画甼甽甾甿畀畁畂畃畄畅畆畇畈畉畊畋界畍畎畏畐畑";
	//converting the string into an array of single characters
	chinese = chinese.split("");

	var japanese = "大男竹中虫町天田土二日入年白八百文木本名目立力林六";
	japanese = japanese.split("");

	var hex = "ABCDEFABCDEFABCDEFABCDEF";
	hex = hex.split("");
	var numbers = "012345678901234567890123456789";
	numbers = numbers.split("");

	matrix_text = japanese.concat(hex).concat(numbers);

	font_size = 10;
	// var title_font_size = 45;
	var columns = c.width / font_size; //number of columns for the rain
	//an array of drops - one per column
	drops = [];
	//x below is the x coordinate
	//1 = y co-ordinate of the drop(same for every drop initially)
	for (var x = 0; x < columns; x++) {
		drops[x] = 1;
	}

	setColor('green')
}

//drawing the characters
function draw(ctx, color, font_size, drops) {
	//Black BG for the canvas
	//translucent BG to show trail
	ctx.fillStyle = "rgba(0, 0, 0, 0.05)";
	ctx.fillRect(0, 0, c.width, c.height);

	ctx.fillStyle = color; //purple text = #551a8b
	ctx.font = font_size + "px arial";
	//looping over drops
	for (var i = 0; i < drops.length; i++) {
		//a random matrix_text character to print
		var text = matrix_text[Math.floor(Math.random() * matrix_text.length)];
		//x = i*font_size, y = value of drops[i]*font_size
		ctx.fillText(text, i * font_size, drops[i] * font_size);

		//sending the drop back to the top randomly after it has crossed the screen
		//adding a randomness to the reset to make the drops scattered on the Y axis
		if (drops[i] * font_size > c.height && Math.random() > 0.975)
			drops[i] = 0;

		//incrementing Y coordinate
		drops[i]++;
	}
}


function drawgreen() {
	draw(ctx, "#00ff00", font_size, drops);
}

function drawpurple() {
	draw(ctx, "#551a8b", font_size, drops);
}

function drawwhite() {
	draw(ctx, "white", font_size, drops);
}

function drawred() {
	draw(ctx, "red", font_size, drops);
}

function draworange() {
	draw(ctx, "orange", font_size, drops);
}

function drawyellow() {
	draw(ctx, "yellow", font_size, drops);
}

function drawtomato() {
	draw(ctx, 'tomato', font_size, drops)
}

function drawdeeppink() {
	draw(ctx, "deeppink", font_size, drops)
}

function drawblue() {
	draw(ctx, "navy", font_size, drops)
}

function drawmagenta() {
	draw(ctx, "magenta", font_size, drops)
}

function drawinvisible() {
	draw(ctx, "#131313", font_size, drops)
}

function setColor(color) {
	clearInterval(setColor.intervalId);
	setColor.intervalId = setInterval(window["draw" + color], 33);
}

//green red yellow white blue magenta invisible
