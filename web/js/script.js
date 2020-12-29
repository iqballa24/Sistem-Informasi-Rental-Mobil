$(document).ready(function(){
	displayData();
	
	$('#save').on('click', function(){
		var firstname = $('#firstname').val();
		var lastname = $('#lastname').val();
		var age = $('#age').val();
		var address = $('#address').val();
		
		if($('#firstname').val() == "" || $('#lastname').val() == "" || $('age').val() == "" || $('address').val()){
			alert("Please complete the required field");
		}else{
			$.ajax({
				type: 'POST',
				url: 'save_member.php',
				data: {
					firstname: firstname,
					lastname: lastname,
					age: age,
					address: address
				},
				success: function(data){
					$("#form_modal").modal('hide');
					$('#firstname').val('');
					$('#lastname').val('');
					$('#age').val('');
					$('#address').val('');
					displayData();
				}
			})
		}
	});
	
	function displayData(){
		$.ajax({
			type: 'POST',
			url: 'datamember.php',
			data: {res: 1},
			success: function(data){
				$('#data').html(data)
			}
		});
	}
	
	
	$('#btn_yes').on('click', function(){		
		var id = $(this).attr('name');
		$.ajax({
			type: "POST",
			url: "delete_member.php",
			data:{
				mem_id: id
			},
			success: function(){
				$("#modal_confirm").modal('hide');
				$(".del_mem" + id).empty();
				$(".del_mem" + id).html("<td colspan='6'><center>Deleting...</center></td>");
				setTimeout(function(){
					$(".del_mem" + id).fadeOut('slow');
				}, 1000);
			}
		});
	});
});

function cekData(id){	
	var mem_id = id;
	$("#modal_confirm").modal('show');
	$('#btn_yes').attr('name', mem_id);
}