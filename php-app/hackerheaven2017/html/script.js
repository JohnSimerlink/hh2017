$(document).ready(function() {
	$('.signUpLogIn-toggle').click(function() {
        $(".signUpLogIn-menu").toggle();
		document.getElementById("logInEmail").focus();
	});
//TODO: maybe make logout through AJAX as opposed through a redirect?
});


document.onclick = removeDropdown;

//Remove dropdown menus when they're not in focus
function removeDropdown() {
	//Sign Up Dropdown
    if (!(document.getElementById("signUpEmail") === document.activeElement || document.getElementById("signUpUsername") === document.activeElement || document.getElementById("signUpPassword") === document.activeElement || document.getElementById("signUpConfirm") === document.activeElement || document.getElementById("logInEmail") === document.activeElement || document.getElementById("logInPassword") === document.activeElement)) {
		$('.dropdown-menu').hide();
	}
}