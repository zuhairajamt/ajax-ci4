
<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta5
* @link https://tabler.io
* Copyright 2018-2022 The Tabler Authors
* Copyright 2018-2022 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>ICONNET</title>
    <!-- CSS files -->
    <link href="/Assets/css/tabler.min.css" rel="stylesheet"/>
    <link href="/Assets/css/tabler-flags.min.css" rel="stylesheet"/>
    <link href="/Assets/css/tabler-payments.min.css" rel="stylesheet"/>
    <link href="/Assets/css/tabler-vendors.min.css" rel="stylesheet"/>
    <link href="/Assets/css/demo.min.css" rel="stylesheet"/>
  </head>
  <body  class=" border-top-wide border-primary d-flex flex-column">
    <div class="page page-center">
      <div class="container-tight py-4">
        <div class="text-center mb-4">
          <a href="#" style="font-family: Aclonica; font-size: 23px; color: #206bc4; text-decoration: none">
            <i class="ti ti-ghost"></i> B O O O ! !
          </a>
        </div>
        <?php if(isset($validation)):?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif;?>
        <form class="card card-md" action="/register/save" method="post">
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Buat Akun Baru</h2>
            <div class="mb-3">
              <label for="InputForName" class="form-label">Nama</label>
              <input type="text" name="name" class="form-control" id="InputForName" value="<?= set_value('name') ?>" placeholder="Masukkan Nama">
            </div>
            <div class="mb-3">
              <label for="InputForEmail" class="form-label">Email</label>
              <input type="email" name="email" class="form-control" id="InputForEmail" value="<?= set_value('email') ?>" placeholder="Masukkan Email">
            </div>
            <div class="mb-3">
              <label for="InputForPassword" class="form-label">Password</label>
              <div class="input-group input-group-flat">
                <input type="password" name="password" class="form-control"  placeholder="Password"  autocomplete="off">
                <span class="input-group-text">
                  <a href="#" class="link-secondary toggle-password" title="Show password" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="2" /><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" /></svg>
                  </a>
                </span>
              </div>
              <div class="mb-3">
              <label for="InputForConfPassword" class="form-label">Konfirmasi Password</label>
              <div class="input-group input-group-flat">
                <input  type="password" name="confpassword" class="form-control" id="InputForConfPassword" placeholder="Konfirmasi Password"  autocomplete="off">
                <span class="input-group-text">
                  <a href="#" class="link-secondary toggle-password" title="Show password" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="2" /><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" /></svg>
                  </a>
                </span>
              </div>
            </div>
      
            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100">Create new account</button>
            </div>
          </div>
        </form>
        <div class="text-center text-muted mt-3">
          Already have account? <a href="http://localhost:8080/login" tabindex="-1">Sign in</a>
        </div>
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Toggle Pass -->
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
    <!-- Tabler Core -->
    <script src="/Assets/js/tabler.min.js"></script>
    <script src="/Assets/js/demo.min.js"></script>
  </body>
</html>