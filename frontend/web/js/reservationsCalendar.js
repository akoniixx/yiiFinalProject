$(document).ready(function() {

    $(document).on("click",".fc-day",function() {
    	var date = $(this).attr('data-date');
    	var id = "<?= $id ?>";
		// $.get('index.php?r=reservations/create', {'date':date, 'id':2}, function(data, id) {
		// 	$('#modal').modal('show')
		// 	.find('#modalContent')
		// 	.html(data);
		// });
		alert(date);
    });

});