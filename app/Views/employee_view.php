<div class="container-fluid pt-5">
    <div class="text-right">
        <a id="tambah" href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Data</a>
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importModal">Import Data</a>

    </div>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="card-title" style="text-align: center;">Data Vaksinasi Karyawan</h4>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="tabel" class="table card-table table-vcenter text-nowrap datatable stripe hover">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Nama Karyawan</th>
                            <th class="text-center">Usia</th>
                            <th class="text-center">Status Vaksin 1</th>
                            <th class="text-center">Status Vaksin 2</th>                            
                            <th class="text-center">Desa</th>
                            <th class="text-center">Kecamatan</th>
                            <th class="text-center">Kota</th>
                            <th class="text-center">Provinsi</th>
                            <th class="text-center">ID Desa</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Karyawan</th>
                            <th>Usia</th>
                            <th>Status Vaksin 1</th>
                            <th>Status Vaksin 2</th>
                            <th>Desa</th>
                            <th>Kecamatan</th>
                            <th>Kota</th>
                            <th>Provinsi</th>
                            <!-- <th>ID Desa</th> -->
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <!-- <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Nama Karyawan</th>
                            <th>Usia</th>
                            <th>Status Vaksin 1</th>
                            <th>Status Vaksin 2</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot> -->
                </table>
            </div>
        </div>
    </div>
</div>

<!--   Modal Import CSV-->
<div class="modal modal-blur fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?= site_url('/employee') ?>">
                    <h5 class="modal-title" id="exampleModalLabel">Import CSV</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="file" class="form-control" accept=".csv" id="file" placeholder="Enter file" name="file" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!--   Modal Tambah Data-->
<div class="modal modal-blur fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="<?= route_to('add.employee'); ?>" method="post" id="add-employee-form" autocomplete="off">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-lg-6 mb-2">
                      <div class="form-group">
                          <label for="nama_karyawan" class="col-form-label">Nama Karyawan</label>
                          <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" placeholder="Masukkan nama" maxlength="50">
                          <span class="text-danger error-text nama_karyawan_error"></span>
                      </div>
                      <div class="form-group">
                          <label for="usia" class="col-form-label">Usia</label>
                          <input type="number" class="form-control" id="usia" name="usia" placeholder="Masukkan usia" min="1" max="100">
                          <span class="text-danger error-text usia_error"></span>
                      </div>
                      <div class="form-group">
                          <label for="status_vaksin_1" class="col-form-label">Status Vaksin 1</label>
                          <select class="form-control form-select" name="status_vaksin_1">
                              <option value="">---Pilih Status Vaksin---</option>
                              <option value="Belum">Belum Vaksin</option>
                              <option value="Sudah">Sudah Vaksin</option>
                          </select>
                          <span class="text-danger error-text status_vaksin_1_error"></span>
                      </div>
                      <div class="form-group">
                          <label for="status_vaksin_2" class="col-form-label">Status Vaksin 2</label>
                          <select class="form-control form-select" name="status_vaksin_2">
                              <option value="">---Pilih Status Vaksin---</option>
                              <option value="Belum">Belum Vaksin</option>
                              <option value="Sudah">Sudah Vaksin</option>
                          </select>
                          <span class="text-danger error-text status_vaksin_2_error"></span>
                      </div>
                    </div>
                    <div class="col-lg-6 mb-2">
                      <div class="form-group">
                          <label for="provinsi" class="col-form-label">Provinsi</label>
                          <select class="form-control form-select" id="sel_prov" name="prov">
                              <option value="">---Pilih provinsi---</option>
                                  <?php foreach($prov as $provinsi){?>
                              <option value="<?php echo $provinsi->id_prov;?>"><?php echo $provinsi->prov;?></option>"
                                  <?php }?>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="kota" class="col-form-label">Kabupaten/Kota</label>
                          <select class="form-control form-select" id="sel_kota" name="kota">
                            <option value="">---Pilih Kabupaten/Kota---</option>
                          </select>
                      </div>                        
                      <div class="form-group">
                          <label for="kecamatan" class="col-form-label">Kecamatan</label>
                          <select class="form-control form-select" id="sel_kec" name="kec">
                            <option value="">---Pilih Kecamatan---</option>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="desa" class="col-form-label">Desa/Kelurahan</label>
                          <select class="form-control form-select" id="sel_desa" name="desa">
                            <option value="">---Pilih Desa/Kelurahan---</option>
                          </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-save">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->include('/edit_view'); ?>
</body>



<!-- DATATABLES SCRIPT -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/4.6.3/papaparse.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js"></script>

<!-- --- -->





<!-- buat simpan aja -->
<!-- <div>
    <form action="base url bala bla bla ?>" method="post" enctype="multipart/form-data">
        <div class="form-group mb-3">
            <div class="mb-3">
                <input type="file" name="file" class="form-control" id="file">
            </div>
        </div>
        <div class="d-grid">
            <input type="submit" name="submit" value="Upload" class="btn btn-dark" />
        </div>
    </form>
</div> -->