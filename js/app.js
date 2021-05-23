var styleSets = function styleSets() {
	var vh = window.innerHeight * 0.01;
	var vw = window.innerWidth * 0.01;
	document.documentElement.style.setProperty("--vh", `${vh}px`);
	document.documentElement.style.setProperty("--vw", `${vw}px`);

	if (window.innerWidth > 881.1111111111111) {
		var scpad = (window.innerWidth - 793) / 2;
	} else {
		var scpad = 5 * vw;
	}
	document.documentElement.style.setProperty("--scpad", `${scpad}px`);
	if (window.innerWidth > 1400) {
		var mcpad = (window.innerWidth - 1260) / 2;
	} else {
		var mcpad = 5 * vw;
	}
	document.documentElement.style.setProperty("--mcpad", `${mcpad}px`);
	var lcpad = 5 * vw;
	document.documentElement.style.setProperty("--lcpad", `${lcpad}px`);

	let sup = document.getElementsByClassName("supporter")[0];
	if (sup) {
		let suph = sup.offsetWidth;
		document.documentElement.style.setProperty("--suph", `${suph}px`);
	}
}

window.addEventListener('load', styleSets, false);
window.addEventListener('resize', styleSets, false);

var menuSets = function() {
    if (window.pageYOffset > 50) {
        document.getElementById("scroll-head").classList.add("is-active");
    } else {
        document.getElementById("scroll-head").classList.remove("is-active");
    }
}

window.addEventListener("scroll", menuSets, false);
window.addEventListener("load", menuSets, false);

$('.opensesame').click(function(){
    document.getElementsByTagName("html")[0].classList.toggle("noscroll");
    document.getElementById("menu-overlay").classList.toggle("menushow");
    if (window.pageYOffset < 50) {
		document.getElementById("scroll-head").classList.toggle("is-active");
	}
    document.getElementsByClassName("opensesame")[1].classList.toggle("is-active");
});

$('#menu-container a').click(function(){
    document.getElementsByTagName("html")[0].classList.toggle("noscroll");
    document.getElementById("menu-overlay").classList.toggle("menushow");
	document.getElementsByClassName("opensesame")[1].classList.toggle("is-active");
	if (window.pageYOffset < 50) {
		document.getElementById("scroll-head").classList.remove("is-active");
	}
});

$('#scroll-head-cont a').click(function(){
    document.getElementsByTagName("html")[0].classList.remove("noscroll");
    document.getElementById("menu-overlay").classList.remove("menushow");
	document.getElementsByClassName("opensesame")[1].classList.remove("is-active");
	if (window.pageYOffset < 50) {
		document.getElementById("scroll-head").classList.remove("is-active");
	}
});