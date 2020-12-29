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
							<i class="fa fa-database home-icon"></i>
							<a href="#">Data pengembalian</a>
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
									<h3 class="header smaller lighter blue">Data pengembalian</h3>
									<!-- Button Modal -->
									<button class="btn btn-white btn-default btn-round" id="btntambah" data-toggle="modal" data-target="#myModal"><i class="ace-icon fa fa-plus-circle sucess red"></i> Input</button>
									<!-- /Button Modal -->
									<div class="clearfix">
										<div class="pull-right tableTools-container"></div>
									</div>
									
									<!-- Button Modal --> 
									<div class="table-header">
										Hasil untuk "Data pengembalian"
									</div>
									<!-- BATAS HEADER TITLE -->

									<!-- DATAGRID BERDASARKAN DATA YANG AKAN KITA TAMPILKAN -->
									<table id="datatable" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th class="center" width="6%">No</th>
				                				<th class="center">No Booking</th>
				                				<th class="center">Nama Penyewa</th>
				                				<th class="center">Mobil</th>
				                				<th class="center" width="8%">No plat</th>
				                				<th class="center">Tgl pinjam</th>
				                				<th class="center">Tgl kembali</th>
				                				<th class="center">Keterlambatan</th>
				                				<th class="center">Biaya denda</th>
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
					<div id="konfirmasi"></div>
					<form action="" name="frmmcustomer" id="frmmcustomer" method="post">
						<table class="table table-form">
							<tr>
								<td style="width: 25%">No Booking</td>
								<td style="width: 75%">
									<select class="form-control" name="txtbooking" id="txtbooking" class="form-control" >
											<option value="">- - select - -</option>
											<?php
										 	$koneksidb = mysqli_connect("localhost", "root", "", "rental1");

										 	$result=mysqli_query($koneksidb,"SELECT * FROM dt_pemesanan order by no_booking ASC ");
										 		while ($row=mysqli_fetch_assoc($result)) {
										 			echo "<option>$row[no_booking]</option>";
										 		}
										 	?>

										 </select>
								</td>
							</tr>
							<tr>
								<td style="width: 25%">Tanggal kembali </td>
								<td style="width: 75%">
									<input type="date" class="form-control" name="datetglkembali" id="datetglkembali" required value="">
								</td>
							</tr>
							<tr>
								<td style="width: 25%">Keterlambatan</td>
								<td style="width: 75%">
									<input type="text" class="form-control" name="txttelat" id="txttelat" required value="">
								</td>
							</tr>
							<tr>
								<td style="width: 25%"> Biaya denda (Rp)
								</td>
								<td style="width: 75%">
									<input type="text" class="form-control" name="txtharga" id="txtharga" required value="">
								</td>
							</tr>
						</table>
					</form>

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
<script type="text/javascript">
$('#btntambah').click(function(){
	$("#frmmcustomer")[0].reset();
});
var rupiah = document.getElementById('txtharga');
		rupiah.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			rupiah.value = formatRupiah(this.value, 'Rp. ');
		});
 
		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}
  $(document).ready(function() {
		var myTable =$('#datatable').DataTable({
			"ajax": {
				type	: "POST",
				url		: '<?php echo $baseURL; ?>library/api.keyword5.php',
				data 	: function(d) {
					d.type ="97";
				}
			},
			"scrollX":true,
			"bAutoWidth":false,
			"aaSorting":[],
			"columnDefs": [
			{ "orderable": false, "targets": [9]	},
			{ "visible": true, "targets": [1], "searchable": false}],
			select: {
				style: 'multi'
			}
		}); 
	$('#btnSimpan').click(function(){
		$.post( "<?php echo $baseURL; ?>library/api.keyword5.php", 
		{
			type:1,
			txtbooking:$('#txtbooking').val(),
			datetglkembali:$('#datetglkembali').val(),
			txttelat:$('#txttelat').val(),
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

					$('#txtbooking').val('');
					$('#datetglkembali').val('');
					$('#txttelat').val('');
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

			no_booking			= myTable.row( $(this).parents('tr')).data()[1];
			tanggal_kembali 	= myTable.row( $(this).parents('tr')).data()[6];
			keterlambatan 		= myTable.row( $(this).parents('tr')).data()[7];
			Biaya_denda 		= myTable.row( $(this).parents('tr')).data()[8];

			$('#txtbooking').val(no_booking);
			$('#datetglkembali').val(tanggal_kembali);
			$('#txttelat').val(keterlambatan);
			$('#txtharga').val(Biaya_denda);
		});	
		$('#datatable tbody').on('click', '.fa-trash', function(){
		var jawab;
		obj			= $(this).parents('tr');
		id			= myTable.row( $(this).parents('tr') ).data()[1];

		jawab=confirm("Apakah yakin untuk menghapus record ?\n"+ "no_booking: " +myTable.row( $(this).parents('tr') ).data()[1]+"\n"+  "Nama_penyewa: " +myTable.row( $(this).parents('tr') ).data()[2]+"\n" + "Nama_mobil: " +myTable.row( $(this).parents('tr') ).data()[3]+"\n"+ "no plat: " +myTable.row( $(this).parents('tr') ).data()[4]+"\n" + "tanggal pinjam: " +myTable.row( $(this).parents('tr') ).data()[5]+"\n"+ "tanggal kembali: " +myTable.row( $(this).parents('tr') ).data()[6]+"\n"+ "keterlambatan:" +myTable.row( $(this).parents('tr') ).data()[7]+"\n"+ "Biaya_denda:" +myTable.row( $(this).parents('tr') ).data()[8]+"?");

		if (jawab==false){
			exit();
		}
		console.log(id);
		$.post( "<?php echo $baseURL;?>library/api.keyword5.php",{ type: "2", id:id}, function (data){
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