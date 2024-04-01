//hamburger
$(document).ready(function() {
	$('.sidebar-toggler').click(function() {
		$('#sidebar').toggleClass('show');
		$('#content').toggleClass('opened');
	});
});
