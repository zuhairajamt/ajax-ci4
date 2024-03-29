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
              alert(data.msg);
            }
          } else {
            $.each(data.error, function(prefix, val) {
              $(form).find('span.' + prefix + '_error').text(val);
            });

          }
        }
      });
    });

    $('#tabel thead:nth-child(2) th').each(function(i) {
      var title = $('#tabel thead:nth-child(2) th').eq($(this).index()).text();
      $(this).html('<input type="text" class="form-control input-sm" placeholder="' + title + '" data-index="' + i + '" />');
    });

    var table = $('#tabel').DataTable({
      // orderCellsTop: true,
      // fixedHeader: false,
      scrollY: "600px",
      // scrollX: true,
      scrollCollapse: true,
      // fixedColumns: true,
      "processing": true,
      "serverSide": true,
      "ajax": "<?= route_to('get.all.employee'); ?>",
      "dom": "lBfrtip",
      buttons: [
        'csv',
        'excel',
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
            $('#edit_id').val(value['id']);
            $('#nama_karyawan_edit').val(value['nama_karyawan']);
            $('#usia_edit').val(value['usia']);
            $('#status_vaksin_1_edit').val(value['status_vaksin_1']);
            $('#status_vaksin_2_edit').val(value['status_vaksin_2']);
            $('#editModal').modal('show');
          });
        }
      });
      e.preventDefault();
    });
    $(document).on('click', '.btn-update', function(e) {
      e.preventDefault();
      // var id = $(this).attr('data-id');
      var data = {
        'edit_id': $('#edit_id').val(),
        'nama_karyawan': $('#nama_karyawan_edit').val(),
        'usia': $('#usia_edit').val(),
        'status_vaksin_1': $('#status_vaksin_1_edit').val(),
        'status_vaksin_2': $('#status_vaksin_2_edit').val(),
      };
      $.ajax({
        method: "post",
        url: "employee/update",
        data: data,
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