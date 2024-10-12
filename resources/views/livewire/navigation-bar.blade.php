<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar Example</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <strong>YEMEN JOBS</strong>
      </a>
      @livewire('searchbar')
      <div class="navbar-icons ms-auto">
        <a href="#" class="nav-link">
          <i class="bi bi-house-door-fill"></i> Home
        </a>
        <a href="#" class="nav-link">
          <i class="bi bi-people-fill"></i> My Network
        </a>
        <a href="#" class="nav-link">
          <i class="bi bi-briefcase-fill"></i> Jobs
        </a>
        <a href="#" class="nav-link">
          <i class="bi bi-chat-dots-fill"></i> Messages
        </a>
        <a href="#" class="nav-link">
          <i class="bi bi-bell-fill"></i> Notifications
        </a>
        <div class="dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle"></i> <span>Profile</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            @livewire('user-profile')
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
