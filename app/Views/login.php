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

    <link href='https://fonts.googleapis.com/css?family=Aclonica' rel='stylesheet'>
    <link rel="stylesheet" href="https://unpkg.com/@tabler/icons@latest/iconfont/tabler-icons.min.css">
  </head>
  <body  class=" border-top-wide border-primary d-flex flex-column">
    <div class="page page-center">
      <div class="container-tight py-4">
      <div class="text-center mb-4">
          <a href="#" style="font-family: Aclonica; font-size: 23px; color: #206bc4; text-decoration: none">
            <i class="ti ti-ghost"></i> B O O O ! !
          </a>
        </div>
        <form class="card card-md" action="/login/auth" method="post" autocomplete="on">
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Login</h2>
            <div class="mb-3">
              <label for="InputForEmail" class="form-label">Email address</label>
              <input type="email" name="email" class="form-control" id="InputForEmail" value="<?= set_value('email') ?> " placeholder="Masukkan Email">
            </div>
            <div class="mb-2">
            <label for="InputForPassword" class="form-label">Password</label>
                        
              <div class="input-group input-group-flat">
              <input type="password" name="password" class="form-control" id="InputForPassword" placeholder="Password">
                <span class="input-group-text">
                  <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="2" /><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" /></svg>
                  </a>
                </span>
              </div>
            </div>
            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100">Masuk</button>
            </div>
          </div>
          <div class="hr-text">or</div>
          
        </form>
        <div class="text-center text-muted mt-3">
          Belum punya akun? <a href="http://localhost:8080/register" tabindex="-1">Daftar</a>
        </div>
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="/Assets/js/tabler.min.js"></script>
    <script src="/Assets/js/demo.min.js"></script>
  </body>
</html>