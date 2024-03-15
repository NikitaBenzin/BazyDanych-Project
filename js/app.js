$(document).ready(function () {

	$(".menu").click(function () {
		var plik = $(this).attr("mup");
		$("#strona").load(plik);
	});


}); 