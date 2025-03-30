<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Better Time Manager</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <?php include 'navbar.php'; ?>
  <!-- Background Image -->
  <div class="bg-image"></div>

  <!-- Login Form -->
  <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card p-4 shadow-lg bg-dark text-white" style="max-width: 400px; width: 100%; border-radius: 12px;">
      <h2 class="text-center text-warning fw-bold">Welcome Back</h2>
      <p class="text-center text-light">Log in to continue</p>
      <form>
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control form-control-lg" id="username" placeholder="Enter your username">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control form-control-lg" id="password" placeholder="Enter your password">
        </div>
        <div class="mb-3 text-end">
          <a href="#" class="text-warning small">Forgot Password?</a>
        </div>
        <button type="submit" class="btn btn-warning w-100 fw-bold py-2">LOG IN</button>
      </form>
      <p class="text-center mt-3">Don't have an account? <a href="#" class="text-warning">Sign Up</a></p>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>