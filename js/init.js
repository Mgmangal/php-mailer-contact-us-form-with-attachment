$(document).ready(function () {
	var lang = "en";
	localStorage.setItem("language", lang);
	var queryDict = {};
	location.search
	.substr(1)
	.split("&")
	.forEach(function (item) {
		queryDict[item.split("=")[0]] = item.split("=")[1];
	});
	if (queryDict.lang == "jp") {
		$date = $("#select_date");
		$date.datepicker({
			format: "dd MM yyyy",
			language: "jp",
		});
		$(".content-main").css("font-family", "Meiryo");
		$('#languageSource option[value="english"]').attr("selected", "selected");
		$('#languageTarget option[value="japanese"]').attr("selected", "selected");
		$(".japanese").show();
		$(".english").hide();
		$(".fflag-JP").addClass("active");
	} else {
		$date = $("#select_date");
		$date.datepicker({
			format: "dd MM yyyy",
			language: "en",
		});
		$(".content-main").css("font-family", "Calibri");
		$('#languageSource option[value="japanese"].english').attr("selected", "selected");
		$('#languageTarget option[value="english"].english').attr("selected", "selected");
		$(".english").show();
		$(".japanese").hide();
		$(".fflag-GB").addClass("active");
	}
	$date.data("datepicker").hide = function () {};
	$date.datepicker("show");
	$date.datepicker("setDate", new Date());
});