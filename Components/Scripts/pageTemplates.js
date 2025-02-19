const template = document.createElement('template');

template.innerHTML = `
	<div class = "bacckground">
		<img src = "../Assets/background.PNG" alt = "Background" id = "background-desktop">
	</div>
	<div class = "topnav">
		<a href="../index.php"><img src = "../Assets/logo.png" alt="Hotel Logo" id = "logo"></a>
		<div class = "topnavlinks">
			<a href="../index.php">Tropical Byte Hotel</a>
			<a href="">Local Attractions</a>
			<a href="">Dining Options</a>
			<a href="">Shopping Nearby</a>
			<a href="">Book Now!</a>
			<a href="">Check Your Reservation</a>
		</div>
	</div>
`;

template.innerHTML += `
	<button onclick="toTop()" id="topBtn" title="Go to top">&#8593;</button>
	<div class = "bottomnav">
		<a href="" >Contact Us <i class = "fa fa-envelope"></i></a>
		
	</div>
`;

document.body.appendChild(template.content);

let mybutton = document.getElementById("topBtn");
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
	if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
		mybutton.style.display = "block";
		mybutton.style.opacity = 1;
	} else {
		mybutton.style.display = "none";
		mybutton.style.opacity = 0;
	}
}
function toTop() {
	smoothscroll();
}
function smoothscroll(){
	var currentScroll = document.documentElement.scrollTop || document.body.scrollTop;
	if (currentScroll > 0) {
		window.requestAnimationFrame(smoothscroll);
		window.scrollTo (0,currentScroll - (currentScroll/20));
		}
}