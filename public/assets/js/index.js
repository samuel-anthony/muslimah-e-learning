$(document).ready(function() {
    $("#examDate").datepicker();
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