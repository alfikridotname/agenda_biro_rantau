

<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		showAgenda();
		showAgendaHistory();
	});
	// Fungsi untuk menampilkan Jabatan dari v_agenda


	 // new MultiSelectTag('id_asn')  // id


	 
	function showAgenda()
	{
		$('.agenda').DataTable({
	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        // "order": [], //Initial no order.
	        "bDestroy": true,
	        "responsive": true,
	 
	        // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": "<?php echo base_url('agenda/dt_agenda_aktif')?>",
	            "type": "POST",
	            "data": {
	            	'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
	            },
	        },
		});
	}




	function showAgendaHistory()
	{
		$('.agenda_history').DataTable({
	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        // "order": [], //Initial no order.
	        "bDestroy": true,
	        "responsive": true,
	 
	        // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": "<?php echo base_url('agenda/dataTable_agenda_history')?>",
	            "type": "POST",
	            "data": {
	            	'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
	            },
	        },
		});
	}
	// Fungsi untuk menampilkan Agenda Detail dari v_agenda_detail
	function showAgendaDetail(id_agenda='')
	{
		// $('.agenda-detail').html('');
		$('.agenda-detail').DataTable({
	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        // "order": [], //Initial no order.
	        "bDestroy": true,
	        "responsive": true,
	 
	        // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": "<?php echo base_url('agenda/dataTable_agenda_detail/')?>"+id_agenda,
	            "type": "POST",
	            "data": {
	            	'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
	            },
	        },
		});
	}
	// Fungsi untuk menampilkan modal tambah agenda
	function tambahAgenda()
	{
	    $('#modal-agenda').modal('show'); // show bootstrap modal
	    $('.modal-title').text('Tambah Data Agenda'); // Set Title to Bootstrap modal title
	    $('#form-agenda')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error')
						.removeClass('has-success');
		$('.text-danger').remove();
	    $('.help-block').empty(); // clear error string

	     $('#form-agenda').find('#id_asn').val('').change();
	    $('#form-agenda').find('#id_asn').prop("selected",function() {
                            return this.defaultSelected;
                        });

	    $('#btnSave').text('Save'); //change button text
	    $('#btnSave').attr('disabled',false); //set button enable 
	}
	// Fungsi untuk menampilkan modal tambah pejabat
	function tambahAgendaDetail(id_agenda)
	{
	    $('#modal-agenda-detail').modal('show'); // show bootstrap modal
	    $('.modal-title').text('Tambah Data Pejabat'); // Set Title to Bootstrap modal title
	    $('#form-agenda-detail')[0].reset(); // reset form on modals
	    $('#hid_agenda').val(id_agenda);
	    $('.form-group').removeClass('has-error')
						.removeClass('has-success');
		$('.text-danger').remove();
	    $('.help-block').empty(); // clear error string
	    $('#btnSave').text('Save'); //change button text
	    $('#btnSave').attr('disabled',false); //set button enable
	    showAgendaDetail(id_agenda); 
	}
	// Fungsi untuk menampilkan modal edit agenda
	function editAgenda(id_agenda)
	{
	    $('#modal-edit-agenda').modal('show'); // show bootstrap modal
	    $('.modal-title').text('Edit Data Agenda'); // Set Title to Bootstrap modal title
	    $('#form-edit-agenda')[0].reset(); // reset form on modals
	    $('#h_eid_agenda').val(id_agenda);
	    $('.form-group').removeClass('has-error')
						.removeClass('has-success');
		$('.text-danger').remove();
	    $('.help-block').empty(); // clear error string
	    $('#btnUpdate').text('Update'); //change button text
	    $('#btnUpdate').attr('disabled',false); //set button enable

	    //Ajax Load data from ajax
	    $.ajax({
	        url : "<?php echo base_url('agenda/edit_agenda')?>",
	        type: "GET",
	        dataType: "JSON",
	        data: { id_agenda: id_agenda},
	        success: function(data)
	        {
	        	$('#eno_agenda').val(data.no_agenda);
	        	$('#eagenda').val(data.agenda);
	        	$('#etanggal').val(data.tanggal);
	        	$('#etanggal_selesai').val(data.tanggal_selesai);
	        	$('#ejam_mulai').val(data.jam_mulai);
	        	$('#etempat').val(data.tempat);
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            // alert('Error get data from ajax');
	        }
	    });
	}
	// Fungsi untuk menyimpan atau mengupdate agenda
	function saveAgenda(){
		// // $('#btnSave').text('Saving...');
		// // $('#btnSave').attr('disabled',true);
		// var asn_mengikuti = $('#form-agenda').find('#id_asn').val();

		// console.log(asn_mengikuti.length);
		// if (asn_mengikuti.length==0) {
		// 	$('#form-agenda').find('#warning_asn').html('Pilih ASN Dulu');

		// }
		// else{


			$.ajax({
				url: "<?php echo base_url('agenda/save_agenda'); ?>",
				type: "POST",
				data: $('#form-agenda').serialize(),
				dataType: "JSON",
				success: function(data)
				{
					// console.log(data);
					if(data.success == true){
						// Tampilkan pesan sukses
						$('#notifikasi').html('<div class="alert alert-success">' +
						'<span class="glyphicon glyphicon-ok"> </span>' +
						' Data Telah Disimpan');
						$('.form-group').removeClass('has-error')
										.removeClass('has-success');
						$('.text-danger').remove();
						showAgenda();
						$('#modal-agenda').modal('hide');
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

					// $('#btnSave').text('Save'); //change button text
	    //     		$('#btnSave').attr('disabled',false); //set button enable 
				},
				error: function(jqXHR, textStatus, errorThrown)
				{
					// alert('Error adding / update data');
					$('#btnSave').text('Save');
					$('#btnSave').attr('disabled',false);
				}
			});
		// }
	}
	// Fungsi untuk mengupdate agenda
	function updateAgenda(){
		$('#btnUpdate').text('Update...');
		$('#btnUpdate').attr('disabled',true);

		$.ajax({
			url: "<?php echo base_url('agenda/update_agenda'); ?>",
			type: "POST",
			data: $('#form-edit-agenda').serialize(),
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
					showAgenda();
					$('#modal-edit-agenda').modal('hide');
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

				$('#btnUpdate').text('Update'); //change button text
        		$('#btnUpdate').attr('disabled',false); //set button enable 
			},
			error: function(jqXHR, textStatus, errorThrown)
			{
				// alert('Error adding / update data');
				$('#btnUpdate').text('Update');
				$('#btnUpdate').attr('disabled',false);
			}
		});
	}
	// Fungsi Untuk Delete Agenda dan Agenda Detail
	function deleteAgenda(id_agenda)
	{
	    if(confirm('Apakah anda yakin ingin menghapus Agenda ini !'))
	    {
	        // ajax delete data to database
	        $.ajax({
	            url : "<?php echo base_url('agenda/delete_agenda/')?>" + id_agenda,
	            type: "POST",
	            dataType: "JSON",
	            data: {
	            	'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
	            },
	            success: function(data)
	            {
	                // showAgenda();
        		$('#agenda_aktif').DataTable().ajax.reload(null, false);
	                
	            },
	            error: function (jqXHR, textStatus, errorThrown)
	            {
	                // alert('Error deleting data');
	            }
	        });
	 
	    }
	}
	// Fungsi Untuk Delete Agenda dan Agenda Detail
	function deleteAgendaDetail(id_agenda,id_agenda_detail)
	{
	    if(confirm('Apakah anda yakin ingin menghapus Pejabat ini !'))
	    {
	        // ajax delete data to database
	        $.ajax({
	            url : "<?php echo base_url('agenda/delete_agenda_detail/')?>" + id_agenda_detail,
	            type: "POST",
	            dataType: "JSON",
	            data: {
	            	'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
	            },
	            success: function(data)
	            {
	            	showAgendaDetail(id_agenda);
	        		$('#agenda_aktif').DataTable().ajax.reload(null, false);

	            },
	            error: function (jqXHR, textStatus, errorThrown)
	            {
	                // alert('Error deleting data');
	            }
	        });
	 
	    }
	}
	// Fungsi untuk menyimpan atau mengupdate agenda detail
	function saveAgendaDetail(){

		$.ajax({
			url: "<?php echo base_url('agenda/save_agenda_detail'); ?>",
			type: "POST",
			data: $('#form-agenda-detail').serialize(),
			dataType: "JSON",
			success: function(data)
			{
				var id_agenda = $('#hid_agenda').val();
				if(data.success == true){
					// Tampilkan pesan sukses
					$('.form-group').removeClass('has-error')
									.removeClass('has-success');
					$('.text-danger').remove();
					showAgendaDetail(id_agenda);
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

        		$('#agenda_aktif').DataTable().ajax.reload(null, false);
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