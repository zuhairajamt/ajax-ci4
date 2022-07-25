<style>
      .field-icon {
        float: right;
        height: 15px;
        width: 15px;
        margin-top: 1px;
        position: relative;
        z-index: 2;
      }
    </style>

<form id="form" method="post" autocomplete="off" action="#">
    <div class="page-body"></div>
    <div class="container-xl">
        <div class="row row-cards">

            <div class="col-md-7 col-lg-6">
                <div class="card">
                    <div class="card-header bg-primary-lt">
                        <h3 class="card-title">Profil</h3>
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="edit_prof">
                        <div class="col mb-2">
                            <label class="form-label">Alamat Email</label>
                            <input type="text" class="form-control" name="email" id="email" readonly value="<?= $user_email; ?>">
                        </div>

                        <div class="col mb-2">
                            <label class="form-label">Nama Lengkap<a style="color: red">*</a></label>
                            <input type="text" class="form-control" name="name" id="name" value="<?= $user_name; ?>">
                        </div>

                        <div class="col mb-2">
                            <label class="form-label">Kata Sandi</label>
                            <input type="password" class="form-control " name="password1" id="password1" value="">
                            <span toggle="#password1" class="fa fa-fw fa-eye field-icon toggle toggle-password"></span>
                        </div>

                        <div class="col mb-2">
                            <label class="form-label">Ulangi Kata Sandi</label>
                            <input type="password" class="form-control" name="password2" id="password2">
                            <span toggle="#password2" class="fa fa-fw fa-eye field-icon toggle toggle-password"></span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row align-items-center">
                            <div class="col"></div>
                            <div class="col-auto">
                                <a href="employee" class="btn btn-warning">Kembali</a>
                                <button type="submit" class="btn btn-primary btn-ubah">Ubah</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</form>

<!-- DATATABLES SCRIPT -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/4.6.3/papaparse.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js"></script>
<!-- --- -->

<script>
    $(".toggle-password").click(function() {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
</script>