const template = document.createElement('template');
const currentFile = location.pathname.substring(location.pathname.lastIndexOf("/") + 1);

if (currentFile.includes("admin")){
	template.innerHTML = `
		<div class = "navui">
			<ui>
				<li>
					<a href="home.php"><img src = "../Assets/logo.png" alt="Hotel Logo" id = "logo"></a>
				</li>
				<li>
					<a class = "navlinks" href="home.php">Tropical Byte Hotel</a>
				</li>
			</ui>
			<a href="adminLogin.php" class = "adminBtn navlinks">Admin <i class='fas fa-user-alt'></i></a>
		</div>
		<img src = "../Assets/background.PNG" alt = "Background" id = "background-desktop">
		<button onclick="toTop()" id="topBtn" title="Go to top">&#8593;</button>
	`;
} else {
	template.innerHTML = `
		<div class = "navui">
			<ui>
				<li>
					<a href="home.php"><img src = "../Assets/logo.png" alt="Hotel Logo" id = "logo"></a>
				</li>
				<li>
					<a class = "navlinks" href="home.php">Tropical Byte Hotel</a>
				</li>
				<li>
					<a class = "navlinks" href="locations.php">Nearby Locations</a>
				</li>
				<li>
					<a class = "navlinks" href="checkAvailability.php">Book Now!</a>
				</li>
				<li>
					<a class = "navlinks" href="checkReservations.php">Check Your Reservation</a>
				</li>
			</ui>
			<a href="adminLogin.php" class = "adminBtn navlinks">Admin <i class='fas fa-user-alt'></i></a>
		</div>
		<img src = "../Assets/background.PNG" alt = "Background" id = "background-desktop">
		<button onclick="toTop()" id="topBtn" title="Go to top">&#8593;</button>
		<div class = "bottomnav">
			<p>400 Ocean Ave N, Belmar, NJ 07719</p>
			<a href="" >Contact Us <i class = "fa fa-envelope"></i></a>
		</div>
	`;
}

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