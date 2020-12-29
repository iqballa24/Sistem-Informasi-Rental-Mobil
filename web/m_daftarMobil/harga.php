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
							<i class="fa fa-car home-icon"></i>
							<a href="#">Data mobil</a>
						</li>

						<li class="active">Tambah harga</li>
					</ul> <!--/.breadcumb -->
				</div>
				<div class="page-content">
					<div class="row">
						<div class="col-xs-12">

							<!-- PAGE CONTENT BEGIN -->
							<div class="row">
								<div class="col-xs-12">
									<h3 class="header smaller lighter blue">Harga mobil</h3>
									<!-- Button Modal -->
									<button class="btn btn-white btn-default btn-round" id="btntambah" data-toggle="modal" data-target="#myModal"><i class="ace-icon fa fa-plus-circle sucess red"></i> Input</button>
									<!-- /Button Modal -->
									<div class="clearfix">
										<div class="pull-right tableTools-container"></div>
									</div>

									<div class="table-header">
										Hasil untuk "Harga mobil"
									</div>
									<!-- BATAS HEADER TITLE -->

									<!-- DATAGRID BERDASARKAN DATA YANG AKAN KITA TAMPILKAN -->
									<table id="datatable" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th class="center" width="6%">No</th>
												<th class="center">Id harga</th>
												<th class="center">Id mobil</th>
		                						<th class="center">nama mobil</th>
		                						<th class="center">no plat</th>
		                						<th class="center">Harga/hari</th>
		                						<th class="center">Harga</th>
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
		<!-- modal -->
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
						<form action="" name="frmharga" id="frmharga" method="post">
							<table class="table table-form">
								<tr>
									<td style="width: 25%">Id harga</td>
									<td style="width: 75%">
										<input type="text" class="form-control" name="txtidharga" id="txtidharga"  value="">
									</td>
								</tr>
								<tr>
									<td style="width: 25%">nama mobil</td>
									<td style="width: 75%">
										<select class="form-control" name="cmbnama" id="cmbnama" value="">
											<option value="">- - select - -</option>
											<?php
										 	$koneksidb = mysqli_connect("localhost", "root", "", "rental1");

										 	$result=mysqli_query($koneksidb,"SELECT * FROM mobil ORDER BY nama_mobil ASC ");
										 		while ($row=mysqli_fetch_assoc($result)) {
										 			echo "<option value='$row[id_mobil]'>$row[nama_mobil] / ($row[no_plat])</option>";
										 		}
										 	?>

										</select>
									</td>
								</tr>
								
								<tr>
									<td style="width: 25%">Harga(Rp)</td>
									<td style="width: 75%">
										<input type="text" class="form-control" name="txtharga" id="txtharga"  value="">
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
		</div>
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
<script>
$('#btntambah').click(function(){
	$("#frmharga")[0].reset();
});	
$(document).ready(function() {
		var myTable =$('#datatable').DataTable({
			"ajax": {
				type	: "POST",
				url		: '<?php echo $baseURL; ?>library/api.keyword3.php',
				data 	: function(d) {
					d.type ="97";
				}
			},
			"scrollX":true,
			"bAutoWidth":false,
			"aaSorting":[],
			"columnDefs": [
			{ "orderable": false, "targets": [6]	},
			{ "visible": false, "targets": [2,6], "searchable": false}],
			select: {
				style: 'multi'
			}
		}); 
	$('#btnSimpan').click(function(){
		$.post( "<?php echo $baseURL; ?>library/api.keyword3.php", 
		{
			type:1,
			txtidharga:$('#txtidharga').val(),
			cmbnama:$('#cmbnama').val(),
			txtharga:$('#txtharga').val()
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

					$('#txtidharga').val('');
					$('#cmbnama').val('');
					$('#txtharga').val('');

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

			Id_harga	= myTable.row( $(this).parents('tr')).data()[1];
			id_mobil   	= myTable.row( $(this).parents('tr')).data()[2];
			harga 		= myTable.row( $(this).parents('tr')).data()[5];
			harga1 		= myTable.row( $(this).parents('tr')).data()[6];

			$('#txtidharga').val(Id_harga);
			$('#cmbnama').val(id_mobil);
			$('#txtharga').val(harga1);
		});	
		$('#datatable tbody').on('click', '.fa-trash', function(){
		var jawab;
		obj			= $(this).parents('tr');
		id			= myTable.row( $(this).parents('tr') ).data()[1];

		jawab=confirm("Apakah yakin untuk menghapus record ?\n"+ "Id_harga: " +myTable.row( $(this).parents('tr') ).data()[1]+"\n"+  "nama mobil: " +myTable.row( $(this).parents('tr') ).data()[3]+"\n"+"no plat: " +myTable.row( $(this).parents('tr') ).data()[4]+"\n" +"harga:" +myTable.row( $(this).parents('tr') ).data()[5]+"?");

		if (jawab==false){
			exit();
		}
		console.log(id);
		$.post( "<?php echo $baseURL;?>library/api.keyword3.php",{ type: "2", id:id}, function (data){
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
