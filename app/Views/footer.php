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
<script src="<?= base_url('') . '/Assets' ?>/js/tabler.min.js"></script>
<script src="<?= base_url('') . '/Assets' ?>/js/demo.min.js"></script>
<!-- ----- -->

<!-- Specific Page Vendor -->
<script src="<?= base_url('') ?>/Assets/vendor/pnotify/pnotify.custom.js"></script>
<Script src="sweetalert2/sweetalert2.min.js"></SCript>

</body>

<script>
  $(document).ready(function() {
    // $('#tabel').DataTable({
    //     processing: true,
    //     serverSide: true,
    //     order: [], //init datatable not ordering
    //    

    //     "columnDefs": [{
    //         "data": null,
    //         "targets": -1,
    //     }]
    // });

    //ADD NEW EMPLOYEE
    
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
    

    $('#tabel').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": "<?= route_to('get.all.employee'); ?>",
      "dom": "lBfrtip",
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
      }
    });

    $(document).on("click", "#updateEmployeeBtn", function() {
      var employee_id = $(this).data('id');
      //alert('hi');

      $.post("<?= route_to('get.employee.info') ?>", function(data) {
        //   alert(data.results.employee_name);

        $('.editEmployee').find('form').find('input[name="cid"]').val(data.results.id);
        $('.editEmployee').find('form').find('input[name="nama_karyawan"]').val(data.results.nama_karyawan);
        $('.editEmployee').find('form').find('input[name="usia"]').val(data.results.usia);
        $('.editEmployee').find('form').find('input[name="status_vaksin_1"]').val(data.results.status_vaksin_1);
        $('.editEmployee').find('form').find('input[name="status_vaksin_2"]').val(data.results.status_vaksin_2);
        $('.editEmployee').find('form').find('span.error-text').text('');
        $('.editEmployee').modal('show');
      }, 'json');
    });

    function editEmployee() {
      $('#update-employee-form').submit(function(e) {
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
                $('#"update-employee-form"').DataTable().ajax.reload(null, false);
                $('.editEmployee').modal('hide');
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
    }

    $(document).on('click', '#deleteEmployeeBtn', function() {
      var employee_id = $(this).data('id');
      var url = "<?= route_to('delete.employee'); ?>";

      swal.fire({

        title: 'Are you sure?',
        html: 'You want to delete this employee',
        showCloseButton: true,
        showCancelButton: true,
        cancelButtonText: 'Cancel',
        confirmButtonText: 'Yes, delete',
        cancelButtonColor: '#d33',
        confirmButtonColor: '#556eeb',
        width: 300,
        allowOutsideClick: false

      }).then(function(result) {
        if (result.value) {

          $.post(url, {
            employee_id: employee_id
          }, function(data) {
            if (data.code == 1) {
              $('#tabel').DataTable().ajax.reload(null, false);
            } else {
              alert(data.msg);
            }
          }, 'json');
        }
      });
    });



  });
</script>

</html>