<div class="modal fade editEmployee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= route_to('update.employee'); ?>" method="post" id="update-employee-form">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="cid">
                    <div class="form-group">
                        <label for="">employee name</label>
                        <input type="text" class="form-control" name="nama_karyawan" placeholder="Masukkan Nama">
                        <span class="text-danger error-text employee_name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Capital city</label>
                        <input type="text" class="form-control" name="usia" placeholder="Masukkan Usia">
                        <span class="text-danger error-text employee_usia_error"></span>
                    </div>
                    <div class="col mb-2">
                        <label class="form-label">Status Vaksin 1</label>
                        <select class="form-control" name="status_vaksin_1">
                            <option value="Belum">Belum Vaksin</option>
                            <option value="Sudah">Sudah Vaksin</option>
                        </select>
                    </div>
                    <div class="col mb-2">
                        <label class="form-label">Status Vaksin 2</label>
                        <select class="form-control" name="status_vaksin_2">
                            <option value="Belum">Belum Vaksin</option>
                            <option value="Sudah">Sudah Vaksin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-success">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script></script>
