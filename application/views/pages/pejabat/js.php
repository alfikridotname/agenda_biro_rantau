
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		showJabatan();
	});
	// Fungsi untuk menampilkan Jabatan dari tbl_asn
	function showJabatan(){
		$('.pejabat').DataTable({
	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        // "order": [], //Initial no order.
	        "bDestroy": true,
	        "responsive": true,
	 
	        // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": "<?php echo base_url('pejabat/dataTable_pejabat')?>",
	            "type": "POST",
	            "data": {
	            	'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
	            },
	        },
		});
	}
	// Fungsi untuk menampilkan modal tambah pejabat
	function tambahPejabat()
	{
	    $('#modal-pejabat').modal('show'); // show bootstrap modal
	    $('.modal-title').text('Tambah Data Pejabat'); // Set Title to Bootstrap modal title
	    $('#form-pejabat')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error')
						.removeClass('has-success');
		$('.text-danger').remove();
	    $('.help-block').empty(); // clear error string
	    $('#btnSave').text('Save'); //change button text
	    $('#btnSave').attr('disabled',false); //set button enable 
	}
	// Fungsi untuk menyimpan atau mengupdate program apbd
	function savePejabat(){
		$('#btnSave').text('Saving...');
		$('#btnSave').attr('disabled',true);

		$.ajax({
			url: "<?php echo base_url('pejabat/save_pejabat'); ?>",
			type: "POST",
			data: $('#form-pejabat').serialize(),
			dataType: "JSON",
			success: function(data)
			{
				if(data.success == true){
					// Tampilkan pesan sukses
					$('#notifikasi').html('<div class="alert alert-success">' +
					'<span class="glyphicon glyphicon-ok"> </span>' +
					' Data Telah Disimpan');
					$('.form-group').removeClass('has-error')
									.removeClass('has-success');
					$('.text-danger').remove();
					showJabatan();
					$('#modal-pejabat').modal('hide');
					$("#notifikasi").fadeTo(1000,500).slideUp(500, function(){
		              $("#notifikasi").slideUp(500);
		            });
				}else{
					$.each(data.messages, function(key, value){
						var element = $('#' + key);
						element.closest('div.form-group')
						.removeClass('has-error')
						.addClass(value.length > 0 ? 'has-error' : 'has-success')
						.find('.text-danger')
						.remove();
						element.after(value);
					});
				}

				$('#btnSave').text('Save'); //change button text
        		$('#btnSave').attr('disabled',false); //set button enable 
			},
			error: function(jqXHR, textStatus, errorThrown)
			{
				// alert('Error adding / update data');
				$('#btnSave').text('Save');
				$('#btnSave').attr('disabled',false);
			}
		});
	}




	function deletePejabat(id_penjabat)
	{
		Swal.fire({
			  title: 'Warning',
			  text: 'Hapus Penjabat.?',
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Hapus',
			  cancelButtonText: 'Batal'
			}).then((result) => {
			  if (result.isConfirmed) {
			  				$.ajax(
							{
								url: "<?php echo base_url('pejabat/delete_penjabat'); ?>",
								dataType: 'JSON',
								type    : 'POST',
								data    : { id_penjabat : id_penjabat},
								success : function(data)
								{
									console.log(data);
									if(data.success == true)
									{
										window.location.href="<?php echo base_url('pejabat'); ?>";
									}
								}
							});
			  
			  }
			});


	}



	
	function editPejabat(id_penjabat)
	{
	    $('#modal-edit-pejabat').modal('show'); // show bootstrap modal
	    $('.modal-title').text('Tambah Data Pejabat'); // Set Title to Bootstrap modal title
	    $('#form-pejabat')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error')
						.removeClass('has-success');
		$('.text-danger').remove();
	    $('.help-block').empty(); // clear error string
	    $('#btnSaveedit').text('Save Perubahan'); //change button text
	    $('#btnSave').attr('disabled',false); //set button enable 



	    $.ajax(
		{
			url: "<?php echo base_url('pejabat/get_penjabat'); ?>",
			dataType: 'JSON',
			type    : 'POST',
			data    : { id_penjabat : id_penjabat},
			success : function(data)
			{
				console.log(data.data.status);
				if(data.success == true)
				{
					$('#modal-edit-pejabat').find('#nama_asn').val(data.data.nama_asn);
					$('#modal-edit-pejabat').find('#id_asn').val(data.data.id_asn);
					$('#modal-edit-pejabat').find('#nama_asn').val(data.data.nama_asn);
					$('#modal-edit-pejabat').find('#status').val(data.data.status).change();


					$.each(data.pilihan, function(k, v){
                		var sel = 'selected';
                		if(v == data.data.jabatan_asn)
                		{
                			$('#modal-edit-pejabat').find('#jabatan_asn').append('<option value="'+ v+'" '+ sel +'>'+ v +'</option>');
                		}else{
                			$('#modal-edit-pejabat').find('#jabatan_asn').append('<option value="'+ v +'">'+ v+'</option>');
                		}
                	});
					// window.location.href="<?php echo base_url('pejabat'); ?>";
				}
			}
		});
	}



	function saveeditPejabat(){
		$('#btnSave').text('Saving...');
		$('#btnSave').attr('disabled',true);

		$.ajax({
			url: "<?php echo base_url('pejabat/saveedit_pejabat'); ?>",
			type: "POST",
			data: $('#form-edit-pejabat').serialize(),
			dataType: "JSON",
			success: function(data)
			{
				console.log(data);	
				if(data.success == true){
					// Tampilkan pesan sukses
					$('#notifikasi').html('<div class="alert alert-success">' +
					'<span class="glyphicon glyphicon-ok"> </span>' +
					' Data Telah Disimpan');
					$('.form-group').removeClass('has-error')
									.removeClass('has-success');
					$('.text-danger').remove();
					showJabatan();
					$('#modal-edit-pejabat').modal('hide');
					$("#notifikasi").fadeTo(1000,500).slideUp(500, function(){
		              $("#notifikasi").slideUp(500);
		            });
				}else{
					$.each(data.messages, function(key, value){
						var element = $('#' + key);
						element.closest('div.form-group')
						.removeClass('has-error')
						.addClass(value.length > 0 ? 'has-error' : 'has-success')
						.find('.text-danger')
						.remove();
						element.after(value);
					});
				}

				$('#btnSave').text('Save'); //change button text
        		$('#btnSave').attr('disabled',false); //set button enable 
			},
			error: function(jqXHR, textStatus, errorThrown)
			{
				// alert('Error adding / update data');
				$('#btnSave').text('Save');
				$('#btnSave').attr('disabled',false);
			}
		});
	}

</script>