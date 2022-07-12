<!-- Modal Edit Data -->
<div class="modal modal-blur fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="#" method="post" autocomplete="off">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_id">
                    <div class="form-group">
                        <label for="nama_karyawan" class="col-form-label">Nama Karyawan</label>
                        <input type="text" class="form-control nama_karyawan" id="nama_karyawan_edit" name="nama_karyawan" placeholder="Nama harus diisi">
                        <span id="error_nama" class="text-danger"></span>
                        <span class="text-danger error-text nama_karyawan_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="usia" class="col-form-label">Usia</label>
                        <input type="number" class="form-control usia" id="usia_edit" name="usia" placeholder="Usia harus diisi">
                        <span id="error_usia" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="status_vaksin_1" class="col-form-label">Status Vaksin 1</label>
                        <select class="form-control status_vaksin_1" id="status_vaksin_1_edit">
                            <option value="">---Pilih Status Vaksin---</option>
                            <option value="belum">Belum Vaksin</option>
                            <option value="sudah">Sudah Vaksin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status_vaksin_2" class="col-form-label">Status Vaksin 2</label>
                        <select class="form-control status_vaksin_2" id="status_vaksin_2_edit">
                            <option value="">---Pilih Status Vaksin---</option>
                            <option value="belum">Belum Vaksin</option>
                            <option value="sudah">Sudah Vaksin</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-update">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>