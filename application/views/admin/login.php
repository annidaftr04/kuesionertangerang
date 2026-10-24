<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome untuk ikon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    /* ==== BACKGROUND LOGIN ==== */
    body {
    background: linear-gradient(135deg, #1abc9c, #2ecc71, #3498db);
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .login-wrapper {
    width: 100%;
    max-width: 550px; /* lebar maksimal */
    height: 700px;
  }

  .card-login {
    padding: 40px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    min-height: 500px;     /* tinggi card */
    border-radius: 15px;
    background-color: #fffffddd; /* sedikit transparan */
  }

  .input-icon {
    position: relative;
  }

  .input-icon i.fa-user,
    .input-icon i.fa-lock {
      position: absolute;
      left: 10px;
      top: 50%;
      transform: translateY(-50%);
      color: #999;
    }

  .input-icon input {
  padding-left: 40px;
  height: 45px; /* tinggi input lebih besar */
  border: 2px solid #ccc; /* border lebih tebal */
  border-radius: 8px;
  font-size: 18px;
}

 label {
  display: block;
  margin-bottom: 2px;
  margin-top: 25px; /* jarak atas biar turun */
  font-weight: 450;
  font-size: 15px; /* atau 22px kalau kamu suka besar */
}
label[for="password"] {
  display: inline-block;
  margin-top: 10px;
}


.input-icon input {
  padding-left: 40px;
  height: 45px; /* tinggi input lebih besar */
  border: 2px solid #ccc; /* border lebih tebal */
  border-radius: 8px;
  font-size: 18px;
}
.btn-login {
  height: 50px;            /* tinggi tombol */
  font-size: 18px;         /* ukuran teks */
  border-radius: 8px;      /* sudut tombol */
  font-weight: 500;
}
.btn-login:hover {
  background-color: #0056b3;
  transition: 0.3s ease;
}



.input-icon input:focus {
  border-color: #007bff;
  box-shadow: 0 0 0 2px rgba(0,123,255,0.25);
}
.toggle-password {
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translateY(-50%);
  cursor: pointer;
  color: #999;
}
@media (max-width: 576px) {
  .login-wrapper {
    padding: 0 20px;
  }

  .card-login {
    padding: 30px 15px !important;
  }
}


  </style>
</head>
<body>
  <div class="login-wrapper">
    <div class="card shadow p-5 card-login">
      <div class="text-center mb-3">
  <img src="<?= base_url('assets/img/logo_Tng.png'); ?>" alt="Logo" width="80">
</div>

      <h3 class="text-center mb-4">LOGIN ADMIN</h3>
      <p class="text-center text-muted mb-4" style="font-size: 15px;">
  Sistem Login Admin untuk Kuesioner Kepuasan Fasilitas
</p>

        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
        <?php endif; ?>
        <form method="post" action="<?php echo site_url('admin/auth'); ?>">

     <!-- Username -->
      <label for="username">USERNAME:</label>
<div class="mb-3 input-icon">
  
  <i class="fa fa-user"></i>
  <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan Username" required>
</div>

<!-- Password -->
 <label for="password">PASSWORD:</label>
<div class="mb-4 input-icon">
  <i class="fa fa-lock"></i>
  <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan Password" required>
   <i class="fa fa-eye toggle-password" id="togglePassword"></i> 
</div>


          <button class="btn btn-primary w-100 btn-login">LOGIN</button>

        </form>
         <!-- Footer -->
      <p class="text-center mt-4 text-muted" style="font-size: 14px;">
        © 2025 Dinas Kebudayaan dan Pariwisata Kota Tangerang
      </p>
      </div>
    </div>
  </div>
</div>
<!-- Script Show/Hide Password -->
  <script>
  const togglePassword = document.getElementById('togglePassword');
  const passwordInput = document.getElementById('password');

  togglePassword.addEventListener('click', function () {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    
    // Ubah ikon
    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
  });
</script>

</body>
</html>