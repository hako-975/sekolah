<?php 
  require_once 'koneksi.php';

  if (isset($_POST['btnLogin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $data = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
    if ($dataUser = mysqli_fetch_assoc($data)) {
      if (password_verify($password, $dataUser['password'])) {
        $_SESSION['id_user'] = $dataUser['id_user'];
        $_SESSION['username'] = $dataUser['username'];
        header("Location:dashboard.php");
        exit;
      }
      else
      {
        setAlert("Perhatian!", "Username atau password yang anda masukkan salah!", "error");
        header("Location: login.php");
        exit;
      }
    }
    else
    {
      setAlert("Perhatian!", "Username atau password yang anda masukkan salah!", "error");
      header("Location: login.php");
      exit;
    }
  }

  if (isset($_SESSION['id_user'])) {
    header("Location: dashboard.php");
    exit;
  }
?>

<!doctype html>
<html lang="en">
<head>
  <?php include_once 'head.php'; ?>
  <title>Form Login Sekolah</title>
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-lg-4 border rounded p-4">
        <h2 class="text-center">Form Login Sekolah</h2>
        <form method="post">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <div class="text-end">
            <button type="submit" class="btn btn-primary" name="btnLogin">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php include_once 'script.php'; ?>
</body>
</html>