<footer class="footer footer-transparent d-print-none">
  <div class="container-xl">
    <div class="row text-center align-items-center flex-row-reverse">
      <div class="col-lg-auto ms-lg-auto">
        <ul class="list-inline list-inline-dots mb-0">
          <li class="list-inline-item"><a href="./license.html" class="link-secondary">License</a></li>
        </ul>
      </div>
      <div class="col-12 col-lg-auto mt-3 mt-lg-0">
        <ul class="list-inline list-inline-dots mb-0">
          <li class="list-inline-item">
            Copyright &copy; 2022
            <a href="." class="link-secondary">-</a>
            All rights reserved.
          </li>
          <li class="list-inline-item">
            <a href="./changelog.html" class="link-secondary" rel="noopener">
              v1.0.0
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</footer>
</div>
</div>



<!-- TABLER ASSET -->
<!-- Libs JS -->
<!-- Tabler Core -->
<script src="Assets/js/tabler.min.js"></script>
<script src="Assets/js/demo.min.js"></script>
<!-- ----- -->

<!-- Specific Page Vendor -->
<!-- <script src="Assets/vendor/pnotify/pnotify.custom.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>


</body>

<script>
  $(document).ready(function() {

    $('#add-employee-form').submit(function(e) {
      e.preventDefault();
      var form = this;
      $.ajax({
        url: $(form).attr('action'),
        method: $(form).attr('method'),
        data: new FormData(form),
        processData: false,
        dataType: 'json',
        contentType: false,
        beforeSend: function() {
          $(form).find('span.error-text').text('');
        },
        success: function(data) {

          if ($.isEmptyObject(data.error)) {
            if (data.code == 1) {
              $(form)[0].reset();
              $('#exampleModal').modal('hide');
              Swal.fire(
                'Berhasil!',
                'Data karyawan berhasil ditambahkan.',
                'success'
              )
              $('#tabel').DataTable().ajax.reload(null, false);
            } else {
              Swal.fire(
                'Gagal',
                'Semua data harus diisi',
                'error'
              );
            }
          } else {
            $.each(data.error, function(prefix, val) {
              $(form).find('span.' + prefix + '_error').text(val);
            });

          }
        }
      });
    });

    //PILIH KOTA, KEC, DESA
    $("#tambah").click(function(){
        // setelah pilih provinsi
        $('#sel_prov').change(function(){
            var prov = $(this).val(); //id prov dari data
        // AJAX request
            $.ajax({
                url:'employee/getKota',
                method: 'post',
                data: {prov: prov},
                dataType: 'json',
                success: function(response){
                // Remove options 
                    $('#sel_kec').find('option').not(':first').remove();
                    $('#sel_kota').find('option').not(':first').remove();
                    $('#sel_desa').find('option').not(':first').remove();
                // Add options
                    $.each(response,function(index,data){
                        $('#sel_kota').append('<option value="'+data['id_kota']+'">'+data['kota']+'</option>');
                    });
                }
            });
        });
        // Setelah pilih kota
        $('#sel_kota').change(function(){
            var kota = $(this).val();
            // AJAX request
            $.ajax({
                url:'employee/getKecamatan',
                method: 'post',
                data: {kota: kota},
                dataType: 'json',
                success: function(response){
                // Remove options
                    $('#sel_kec').find('option').not(':first').remove();
                    $('#sel_desa').find('option').not(':first').remove();
                    // Add options
                    $.each(response,function(index,data){
                        $('#sel_kec').append('<option value="'+data['id_kec']+'">'+data['kec']+'</option>');
                    });
                }
            });
        });

        //Setelah pilih kecamatan
        $('#sel_kec').change(function(){
            var kec = $(this).val();
            // AJAX request
            $.ajax({
                url:'employee/getDesa',
                method: 'post',
                data: {kec: kec},
                dataType: 'json',
                success: function(response){
                // 
                $('#sel_desa').find('option').not(':first').remove();
                    // Add options
                    $.each(response,function(index,data){
                        $('#sel_desa').append('<option value="'+data['id_desa']+'">'+data['desa']+'</option>');
                    });
                }
            });
        });
    });
    //END!!!! PILIH KOTA, KEC, DESA

    $('#tabel thead:nth-child(2) th').each(function(i) {
      var title = $('#tabel thead:nth-child(2) th').eq($(this).index()).text();
      $(this).html('<input type="text" class="form-control input-sm" placeholder="' + title + '" data-index="' + i + '" />');
    });

    var table = $('#tabel').DataTable({
      // orderCellsTop: true,
      fixedHeader: false,
      scrollY: "600px",
      'autoWidth': false,
      'scrollX': true,
      scrollCollapse: true,
      fixedColumns: true,
      "processing": true,
      "serverSide": true,
      "ajax": "<?= route_to('get.all.employee'); ?>",
      "dom": "lBfrtp",
      buttons: [
        // {
          // extend: "collection",
          // text: "Export",
          // buttons: [
            {
              extend: 'csv',
              text: "Export CSV",
              exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9]
              },
            },
            {
              extend: 'excel',
              text: "Export Excel",
              exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8]
              },
            }
          // ]
        // }
      ],
      stateSave: true,
      info: true,
      "iDisplayLength": 5,
      "pageLength": 5,
      "aLengthMenu": [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"]
      ],
      "fnCreatedRow": function(row, data, index) {
        $('td', row).eq(0).html(index + 1);
      },
      "columnDefs": [{
        "width": "10%",
        "targets": 0
      }]
    });
    table.column( 9 ).visible( false );

    // Filter event handler
    $(table.table().container()).on('keyup', 'thead:nth-child(2) input', function() {
      table
        .column($(this).data('index'))
        .search(this.value)
        .draw();
    });

    $(document).on('click', '.btn-edit', function(e) {
      e.preventDefault();
      // var edit_id = $(this).closest('tr').find('.krywn_id').text();
      var edit_id = $(this).attr('data-id');
      $.ajax({
        method: "post",
        url: "employee/edit",
        data: {
          'edit_id': edit_id
        },
        success: function(response) {
          $.each(response, function(key, value) {
            $('#sel_kec_edit').find('option').not(':first').remove();
            $('#sel_kota_edit').find('option').not(':first').remove();
            $('#sel_desa_edit').find('option').not(':first').remove();
            // $('#sel_prov_edit').find('option').not(':first').remove();
            
            $('#edit_id').val(value['id']);
            $('#alamat').val(value['alamat']);
            $('#nama_karyawan_edit').val(value['nama_karyawan']);
            $('#usia_edit').val(value['usia']);
            $('#status_vaksin_1_edit').val(value['status_vaksin_1']);
            $('#status_vaksin_2_edit').val(value['status_vaksin_2']);
            $('#prov_edit').val(value['prov']);
            $('#kota_edit').val(value['kota']);
            $('#kec_edit').val(value['kec']);
            $('#desa_edit').val(value['desa']);
            $('#editModal').modal('show');
          });
        }
      });
      
      // setelah pilih provinsi
      $('#sel_prov_edit').change(function(){
            var prov = $(this).val(); //id prov dari data
        // AJAX request
            $.ajax({
                url:'employee/getKota',
                method: 'post',
                data: {prov: prov},
                dataType: 'json',
                success: function(response){
                // Remove options 
                    $('#sel_kec_edit').find('option').not(':first').remove();
                    $('#sel_kota_edit').find('option').not(':first').remove();
                    $('#sel_desa_edit').find('option').not(':first').remove();
                // Add options
                    $.each(response,function(index,data){
                        $('#sel_kota_edit').append('<option value="'+data['id_kota']+'">'+data['kota']+'</option>');
                    });
                }
            });
        });
        // Setelah pilih kota
        $('#sel_kota_edit').change(function(){
            var kota = $(this).val();
            // AJAX request
            $.ajax({
                url:'employee/getKecamatan',
                method: 'post',
                data: {kota: kota},
                dataType: 'json',
                success: function(response){
                // Remove options
                    $('#sel_kec_edit').find('option').not(':first').remove();
                    $('#sel_desa_edit').find('option').not(':first').remove();
                    // Add options
                    $.each(response,function(index,data){
                        $('#sel_kec_edit').append('<option value="'+data['id_kec']+'">'+data['kec']+'</option>');
                    });
                }
            });
        });

        //Setelah pilih kecamatan
        $('#sel_kec_edit').change(function(){
            var kec = $(this).val();
            // AJAX request
            $.ajax({
                url:'employee/getDesa',
                method: 'post',
                data: {kec: kec},
                dataType: 'json',
                success: function(response){
                // 
                $('#sel_desa_edit').find('option').not(':first').remove();
                    // Add options
                    $.each(response,function(index,data){
                        $('#sel_desa_edit').append('<option value="'+data['id_desa']+'">'+data['desa']+'</option>');
                    });
                }
            });
        });
      e.preventDefault();
    });

    $(document).on('click', '.btn-update', function(e) {
      e.preventDefault();
      // var id = $(this).attr('data-id');
      // var prov = $('#sel_prov_edit').val();
      // if (prov != "") {
        var data1 = {
          'edit_id': $('#edit_id').val(),
          'nama_karyawan': $('#nama_karyawan_edit').val(),
          'usia': $('#usia_edit').val(),
          'status_vaksin_1': $('#status_vaksin_1_edit').val(),
          'status_vaksin_2': $('#status_vaksin_2_edit').val(),
          'alamat' : $('#sel_desa_edit').val()
        };
      // } else {
      //   var data = {
      //     'edit_id': $('#edit_id').val(),
      //     'nama_karyawan': $('#nama_karyawan_edit').val(),
      //     'usia': $('#usia_edit').val(),
      //     'status_vaksin_1': $('#status_vaksin_1_edit').val(),
      //     'status_vaksin_2': $('#status_vaksin_2_edit').val(),
      //     'desa' : $('#desa_edit').val(),
      //   }
      // }
      var data2 = {
        'edit_id': $('#edit_id').val(),
        'nama_karyawan': $('#nama_karyawan_edit').val(),
        'usia': $('#usia_edit').val(),
        'status_vaksin_1': $('#status_vaksin_1_edit').val(),
        'status_vaksin_2': $('#status_vaksin_2_edit').val(),
        'alamat' : $('#alamat').val(),
      };
      var id_kota = $('#sel_desa_edit').val();
      $.ajax({
        method: "post",
        url: "employee/update",
        data: (id_kota != "") ? data1 : data2,
        success: function(response) {
          if (response.status == "Data berhasil diupdate") {
            $('#editModal').modal('hide');
            // $('#tableData').html("");
            // display();
            $('#tabel').DataTable().ajax.reload(null, false);

            swal.fire("Berhasil", response.status, "success");
          } else {
            swal.fire("Gagal", response.status, "error");
          }
        }
      });
      e.preventDefault();
    });

    $(document).on('click', '#deleteEmployeeBtn', function() {
      var employee_id = $(this).data('id');
      var url = "<?= route_to('delete.employee'); ?>";

      swal.fire({

        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'

      }).then(function(result) {
        if (result.value) {

          $.post(url, {
            employee_id: employee_id
          }, function(data) {
            if (data.code == 1) {
              Swal.fire(
                'Deleted!',
                'Data karyawan berhasil dihapus.',
                'success'
              )
              $('#tabel').DataTable().ajax.reload(null, false);
            } else {
              alert(data.msg);
            }
          }, 'json');
        }
      });
    });


    $(document).on('click', '.btn-ubah', function(e) {
      e.preventDefault();
      // var id = $(this).attr('data-id');
      var data = {
        'edit_user': $('#edit_prof').val(),
        'user_name': $('#name').val(),
        'user_password': $('#password1').val(),
        'user_password': $('#password2').val(),
      };
      $.ajax({
        method: "post",
        url: "profile/update",
        data: data,
        success: function(response) {
          if (response.status == "Data berhasil diupdate") {
            // $('#editModal').modal('hide');
            // $('#tableData').html("");
            // display();
            $('#tabel').DataTable().ajax.reload(null, false);

            swal.fire("Berhasil", "profil berhasil diubah", "success");
          } else {
            swal.fire("Gagal", "profil gagal diubah", "error");
          }
        }
      });
      e.preventDefault();
    });

  });
</script>

</html>
