<?php
if(!defined('OFFDIRECT')) include 'error404.php';
?>
<body class="no-skin">
	<?php
		include "base_template_topnav.php";	 //akan memanggil file base_template_topnav.php sebagai header
		echo '<div class="main-container ace-save-state" id="main-container">';
		include "menu.php";	 //akan memanggil file menu.php sebagai pembuatan menu
	?>

		<div class="main-content">
			<div class="main-content-inner">
				<div class="breadcrumbs ace-save-state" id="breadcrumbs">
					<ul class="breadcrumb">
						<li>
							<i class="fa fa-users home-icon"></i>
							<a href="#">Data customer</a>
						</li>

						<li class="active"></li>
					</ul> <!--/.breadcumb -->
				</div>
				<div class="page-content">
					<div class="row">
						<div class="col-xs-12">

							<!-- PAGE CONTENT BEGIN -->
							<div class="row">
								<div class="col-xs-12">
									<h3 class="header smaller lighter blue">Data customer</h3>
									<!-- Button Modal -->
									<button class="btn btn-white btn-default btn-round" id="btntambah" data-toggle="modal" data-target="#myModal"><i class="ace-icon fa fa-plus-circle sucess red"></i> Input</button>
									<!-- /Button Modal -->
									<div class="clearfix">
										<div class="pull-right tableTools-container"></div>
									</div>
									<div class="table-header">
										Hasil untuk "Data customer"
									</div>
									<!-- BATAS HEADER TITLE -->

									<!-- DATAGRID BERDASARKAN DATA YANG AKAN KITA TAMPILKAN -->
									<table id="datatable" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th width="6%">No</th>
			                					<th class="center">Id</th>
			                					<th class="center">Nama</th>
			                					<th class="center">Alamat</th>
			                					<th class="center">Telepon</th>
			                					<th class="center" width="10%">kelamin</th>
			                					<th class="center">No ktp</th>
			                					<th class="center" width="10%">Aksi </th>
											</tr>
										</thead>	
									</table>
									<!-- BATAS DATAGRID BERDASARKAN DATA YANG AKAN KITA TAMPILKAN -->
								</div>
							</div>
							<!-- PAGE CONTENT ENDS -->
						</div>	<!-- /.col-xs-12-->
					</div> <!-- /.row-->
				</div> <!-- /.pagecontent--> 
			</div>
		</div> <!-- /.main-content--> 

		<div class="modal fade" id="myModal" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header no-padding">
						<div class="table-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
								<span class="white">&times;</span>
							</button>
							Input Data
						</div>
					</div>
					<div class="modal-body">
						<div id="konfirmasi"></div>
						<form action="" name="frmmcustomer" id="frmmcustomer" method="post">
							<table class="table table-form">
								<tr>
									<td style="width: 25%"> Id customer</td>
									<td style="width: 75%">
										<input type="text" class="form-control" required name="txtcustomer" id="txtcustomer" value="">

							
									</td>
								</tr>
								<tr>
									<td style="width: 25%"> Nama 
										<p class="red">*sesuai KTP</p></td>
									<td style="width: 75%">
										<input type="text" class="form-control" required name="txtnama" id="txtnama" value="">
					
									</td>
								</tr>
								<tr>
									<td style="width: 25%"> Alamat </td>
									<td style="width: 75%">
										<textarea type="text" class="form-control" required name="txtalamat" id="txtalamat" value=""></textarea>
							
									</td>
								</tr>
								<tr>
									<td style="width: 25%"> Telepon </td>
									<td style="width: 75%">
										<input type="text" class="form-control" required name="txttelepon" id="txttelepon" value="">
									
									</td>
								</tr>
								<tr>
									<td style="width: 25%">Jenis kelamin</td>
									<td style="width: 500%">
										<select class="chosen-select form-control" required name="Cmbsex" id="Cmbsex" value="" >
											<option value="">-- select --</option>
											<option value="L">Laki - Laki </option>
											<option value="P">Perempuan</option>
										</select>
						
									</td>
								</tr>
								<tr>
									<td style="width: 25%"> No ktp </td>
									<td style="width: 75%">
										<input type="text" class="form-control" required name="txtktp" id="txtktp" value="">
									
									</td>
								</tr>
							</table>
						</form>
					</div>				
					<!-- Button Modal -->
					<div class="modal-footer">
						<button class="btn btn-white btn-info btn-bold" type="submit" id="btnSimpan">
							<i class="ace-icon fa fa-floppy-o bigger-120 blue"></i> Simpan
						</button>
						<button class="btn btn-white btn-default btn-round" data-dismiss="modal" aria-hidden="true">
							<i class="fa fa-minus-circle"></i> Tutup
						</button>
					</div>
					<!-- Button Modal -->
				</div> <!-- /.modal content--> 
			</div> <!-- /.modal dialog--> 
		</div> <!--/modal fade -->
		<!-- modal 2 -->
		<div class="modal fade" id="myModal2" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header no-padding">
						<div class="table-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
								<span class="white">&times;</span>
							</button>
							Hapus data 
						</div>
					</div>
					<!-- /.modal-body-->
					<div class="modal-body">
						<div id="konfirmasihapus"></div>
					</div>
				</div> <!-- /.modal content--> 
			</div> <!-- /.modal dialog--> 
		</div>
<?php
	include "base_template_footer.php"; //akan memanggil base_template_footer.php sebagai footer
			
?>
</body>
<!-- js alert dialog -->
<script >
$('#btntambah').click(function(){
	$("#frmmcustomer")[0].reset();
});	
$(document).ready(function() {
		var myTable =$('#datatable').DataTable({
			"ajax": {
				type	: "POST",
				url		: '<?php echo $baseURL; ?>library/api.keyword.php',
				data 	: function(d) {
					d.type ="97";
				}
			},
			"scrollX":true,
			"bAutoWidth":false,
			"aaSorting":[],
			"columnDefs": [
			{ "orderable": false, "targets": [7]	},
			{ "visible": true, "targets": [1], "searchable": false}],
			select: {
				style: 'multi'
			}
		});
   $('#btnSimpan').click(function(){
		$.post( "<?php echo $baseURL; ?>library/api.keyword.php", 
		{
			type:1,
			txtcustomer:$('#txtcustomer').val(),
			txtnama:$('#txtnama').val(),
			txtalamat:$('#txtalamat').val(),
			txttelepon:$('#txttelepon').val(),
			Cmbsex:$('#Cmbsex').val(),
			txtktp:$('#txtktp').val()
		}, function(data) {

			console.log(data);
			obj = $.parseJSON(data);
                  
			if(obj.msg[0]=="ok"){
				$('#konfirmasi').html(
					'<div class="alert alert-success alert-dismissible fade in" role="alert">'+
                    '<button type ="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+'<strong>sukses</strong><br/>'+obj.msg[1]+
                    '</div>');

					setTimeout(function(){
						$('#konfirmasi').html('');
					},2000);

					$('#txtcustomer').val('');
					$('#txtnama').val('');
					$('#txtalamat').val('');
					$('#txttelepon').val('');
					$('#Cmbsex').val('');
					$('#txtktp').val('');

			}else{
				$('#konfirmasi').html(
					'<div class="alert alert-danger alert-dismissible fade in" role="alert">'+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+'<strong>Error</strong><br/>'+obj.msg[1]+
                    '</div>');

				
			}

			myTable.ajax.reload();
		});
	})
   $('#datatable tbody').on('click', '.fa-pencil-square-o', function(){
			$("#myModal").modal('show');

			customer	 = myTable.row( $(this).parents('tr')).data()[1];
			nama 		 = myTable.row( $(this).parents('tr')).data()[2];
			alamat 		 = myTable.row( $(this).parents('tr')).data()[3];
			telepon		 = myTable.row( $(this).parents('tr')).data()[4];
			jenis_kelamin= myTable.row( $(this).parents('tr')).data()[5];
			no_ktp		 = myTable.row( $(this).parents('tr')).data()[6];

			$('#txtcustomer').val(customer);
			$('#txtnama').val(nama);
			$('#txtalamat').val(alamat);
			$('#txttelepon').val(telepon);
			$('#Cmbsex').val(jenis_kelamin);
			$('#txtktp').val(no_ktp);
			
		});	
   $('#datatable tbody').on('click', '.fa-trash', function(){
		var jawab;
		obj			= $(this).parents('tr');
		id			= myTable.row( $(this).parents('tr') ).data()[1];

		jawab=confirm("Apakah yakin untuk menghapus record \n"+ "id_customer: " +myTable.row( $(this).parents('tr') ).data()[1]+"\n"+ "nama:" +myTable.row( $(this).parents('tr') ).data()[2]+"\n"+ "alamat:" +myTable.row( $(this).parents('tr') ).data()[3]+"\n"+ "telepon:" +myTable.row( $(this).parents('tr') ).data()[4]+"\n"+ "kelamin:" +myTable.row( $(this).parents('tr') ).data()[5]+"\n"+ "No ktp:" +myTable.row( $(this).parents('tr') ).data()[6]+"?");

		if (jawab==false){
			exit();
		}
		console.log(id);
		$.post( "<?php echo $baseURL;?>library/api.keyword.php",{ type: "2", id:id}, function (data){
			obj	= $.parseJSON(data);
			if (obj.msg[0]=="hapus"){
				$("#myModal2").modal('show');

				$('#konfirmasihapus').html(
					'<div class="alert alert-success alert-dismissible fade in" role="alert">'+
                    '<button type ="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+'<strong>Hapus Data</strong><br/>'+obj.msg[1]+
                    '</div>');
				setTimeout(function(){
						$('#konfirmasihapus').html('');
						$("#myModal2").modal('hide');
					},2000);

		myTable.ajax.reload()
	 }
		});

});
});


</script>
