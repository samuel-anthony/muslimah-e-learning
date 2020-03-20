$(document).ready(function() {
    $("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
	$('#examTime').timepicker({
		timeFormat: 'h:mm p',
		interval: 60,
		minTime: '10',
		maxTime: '6:00pm',
		defaultTime: '11',
		startTime: '10:00',
		dynamic: false,
		dropdown: true,
		scrollbar: true
	});
});

function filterText() {  
	var rex = new RegExp($('#filterText').val());
	if(rex =="/all/"){
		clearFilter()
	} else {
		$('.content').hide();
		$('.content').filter(function() {
			return rex.test($(this).text());
		}).show();
	}
}
	
function clearFilter() {
	$('.filterText').val('');
	$('.content').show();
}