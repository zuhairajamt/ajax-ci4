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
                    <input type="hidden" id="alamat">
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
                        <select class="form-control form-select status_vaksin_1" id="status_vaksin_1_edit">
                            <option value="">---Pilih Status Vaksin---</option>
                            <option value="belum">Belum Vaksin</option>
                            <option value="sudah">Sudah Vaksin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status_vaksin_2" class="col-form-label">Status Vaksin 2</label>
                        <select class="form-control form-select status_vaksin_2" id="status_vaksin_2_edit">
                            <option value="">---Pilih Status Vaksin---</option>
                            <option value="belum">Belum Vaksin</option>
                            <option value="sudah">Sudah Vaksin</option>
                        </select>
                    </div>
                    <div class="row">
                      <div class="col-lg-6 mb-2">
                        <div class="form-group">
                            <label for="prov" class="col-form-label">Provinsi</label>
                            <input type="text" class="form-control prov" id="prov_edit" name="prov" readonly >
                          <span id="error_nama" class="text-danger"></span>
                            <span class="text-danger error-text prov_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="kota" class="col-form-label">Kabupaten/Kota</label>
                            <input type="text" class="form-control kota" id="kota_edit" name="kota" readonly >
                            <span id="error_kota" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="kec" class="col-form-label">Kecamatan</label>
                            <input type="text" class="form-control kec" id="kec_edit" name="kec" readonly >
                          <span id="error_nama" class="text-danger"></span>
                            <span class="text-danger error-text kec_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="desa" class="col-form-label">Desa/Kelurahan</label>
                            <input type="text" class="form-control desa" id="desa_edit" name="desa" readonly>
                            <span id="error_desa" class="text-danger"></span>
                        </div>
                      </div>
                      <div class="col-lg-6 mb-2">
                        <div class="form-group">
                            <label for="provinsi" class="col-form-label">&nbsp</label>
                            <select class="form-control form-select" id="sel_prov_edit" name="prov">
                                <option value="">---Pilih provinsi---</option>
                                    <?php foreach($prov as $provinsi){?>
                                <option value="<?php echo $provinsi->id_prov;?>"><?php echo $provinsi->prov;?></option>"
                                    <?php }?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kota" class="col-form-label">&nbsp</label>
                            <select class="form-control form-select" id="sel_kota_edit" name="kota">
                              <option value="">---Pilih Kabupaten/Kota---</option>
                            </select>
                        </div>                        
                        <div class="form-group">
                            <label for="kecamatan" class="col-form-label">&nbsp</label>
                            <select class="form-control form-select" id="sel_kec_edit" name="kec">
                              <option value="">---Pilih Kecamatan---</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="desa" class="col-form-label">&nbsp</label>
                            <select class="form-control form-select" id="sel_desa_edit" name="desa">
                              <option value="">---Pilih Desa/Kelurahan---</option>
                            </select>
                        </div>
                      </div>
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
</body>