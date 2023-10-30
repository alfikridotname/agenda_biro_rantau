<!-- DataTables Example -->
<div class="card mb-3">
  <!-- Card Header Title -->
  <div class="card-header">
    <i class="fas fa-table"></i>
    Data Agenda
  </div>
  <!-- End Card Header Title -->
  <!-- Card Body Table Agenda -->
  <div class="card-body">
  	<button class="btn btn-primary" onclick="tambahAgenda()">Tambah Data</button>
  	<hr>
    <div class="table-responsive">
      <table class="table table-bordered agenda" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
          	<th width="1%">No</th>
            <th width="1%">No Agenda</th>
            <th>Pejabat</th>
            <th>Agenda</th>
            <th>Tgl Mulai</th>
            <th>Tgl Selesai</th>
            <th>Jam Mulai</th>
            <th>Tempat</th>
            <th>Action</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
  <!-- End Card BOdy Table Agenda -->
  <!-- Modal Tambah Agenda -->
  <div class="modal" id="modal-agenda" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form action="#" id="form-agenda">
            <div class="form-group">
              <input type="text" id="no_agenda" name="no_agenda" class="form-control" placeholder="No Agenda">
            </div>
            <div class="form-group">
              <select id="id_asn" name="id_asn" class="form-control" style="width: 100%;" autofocus="on">
                  <?php foreach ($pejabat as $key) { ?>
                    <option value="<?php echo $key->id_asn; ?>"><?php echo $key->nama_asn; ?></option>
                  <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <textarea name="agenda" id="agenda" class="form-control" cols="30" rows="5" placeholder="Agenda"></textarea>
            </div>
            <div class="form-group">
              <label for="tanggal">Tanggal Mulai</label>
              <input type="date" id="tanggal" name="tanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="form-group">
              <label for="tanggal">Tanggal Selesai</label>
              <input type="date" id="tanggal_selesai" name="tanggal_selesai" class="form-control" value="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="form-group">
              <input type="time" id="jam_mulai" name="jam_mulai" class="form-control">
            </div>
            <div class="form-group">
              <input type="text" id="tempat" name="tempat" class="form-control" placeholder="Tempat" ">
            </div>
        </form>     
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="btnSave" onclick="saveAgenda()">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- Modal Edit Agenda -->
  <div class="modal" id="modal-edit-agenda" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form action="#" id="form-edit-agenda">
            <div class="form-group">
              <input type="hidden" id="h_eid_agenda" name="h_eid_agenda">
              <input type="text" id="eno_agenda" name="eno_agenda" class="form-control" placeholder="No Agenda">
            </div>
            <div class="form-group">
              <textarea name="eagenda" id="eagenda" class="form-control" cols="30" rows="5" placeholder="Agenda"></textarea>
            </div>
            <div class="form-group">
              <label for="etanggal">Tanggal Mulai</label>
              <input type="date" id="etanggal" name="etanggal" class="form-control">
            </div>
            <div class="form-group">
              <label for="etanggal_selesai">Tanggal Selesai</label>
              <input type="date" id="etanggal_selesai" name="etanggal_selesai" class="form-control">
            </div>
            <div class="form-group">
              <input type="time" id="ejam_mulai" name="ejam_mulai" class="form-control">
            </div>
            <div class="form-group">
              <input type="text" id="etempat" name="etempat" class="form-control" placeholder="Tempat" ">
            </div>
        </form>     
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="btnUpdate" onclick="updateAgenda()">Update changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- End Modal Edit Agenda -->
  <!-- Modal Tambah Pejabat -->
  <div class="modal" id="modal-agenda-detail" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form action="#" id="form-agenda-detail">
            <div class="form-group">
              <input type="hidden" id="hid_agenda" name="hid_agenda" class="form-control">
            </div>
            <div class="form-group">
              <select id="id_asn" name="id_asn" class="form-control" style="width: 100%;" autofocus="on">
                  <?php foreach ($pejabat as $key) { ?>
                    <option value="<?php echo $key->id_asn; ?>"><?php echo $key->nama_asn; ?></option>
                  <?php } ?>
              </select>
            </div>
          </form>
          <div class="table-responsive">
            <table class="table table-bordered agenda-detail" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th width="1%">No</th>
                  <th>Pejabat</th>
                  <th width="1%">Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="btnSave" onclick="saveAgendaDetail()">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- End Modal Tambah Pejabat -->
</div>