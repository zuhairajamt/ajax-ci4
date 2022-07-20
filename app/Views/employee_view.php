<div class="container pt-5">
    <div class="text-right">
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Data</a>
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importModal">Import Data</a>
    </div>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="card-title" style="text-align: center;">Data Vaksinasi Karyawan</h4>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="tabel" class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Karyawan</th>
                            <th>Usia</th>
                            <th>Status Vaksin 1</th>
                            <th>Status Vaksin 2</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Nama Karyawan</th>
                            <th>Usia</th>
                            <th>Status Vaksin 1</th>
                            <th>Status Vaksin 2</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
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
                    <div class="form-group">
                        <label for="nama_karyawan" class="col-form-label">Nama Karyawan</label>
                        <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" placeholder="Masukkan Nama">
                        <span class="text-danger error-text nama_karyawan_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="usia" class="col-form-label">Usia</label>
                        <input type="number" class="form-control" id="usia" name="usia" placeholder="Masukkan Usia">
                        <span class="text-danger error-text usia_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="status_vaksin_1" class="col-form-label">Status Vaksin 1</label>
                        <select class="form-control" name="status_vaksin_1">
                            <option value="">---Pilih Status Vaksin---</option>
                            <option value="Belum">Belum Vaksin</option>
                            <option value="Sudah">Sudah Vaksin</option>
                        </select>
                        <span class="text-danger error-text status_vaksin_1_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="status_vaksin_2" class="col-form-label">Status Vaksin 2</label>
                        <select class="form-control" name="status_vaksin_2">
                            <option value="">---Pilih Status Vaksin---</option>
                            <option value="Belum">Belum Vaksin</option>
                            <option value="Sudah">Sudah Vaksin</option>
                        </select>
                        <span class="text-danger error-text status_vaksin_2_error"></span>
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

<!-- Modal Import Data -->
<div class="modal modal-blur fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" id="upload_csv" enctype="multipart/form-data" action="<?= site_url('Employee/importEmployee') ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Data Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="file" name="csv_file" id="csv_file" accept=".csv" required/>
                        <span class="">*Format file .csv</span>
                    </div>                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-import">Import</button>
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
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/4.6.3/papaparse.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js"></script>
<!-- --- -->