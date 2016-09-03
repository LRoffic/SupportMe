var lang = $("#lang").text();
lang = JSON.parse(lang);

$("table").tablesorter({
	cancelSelection: false
});