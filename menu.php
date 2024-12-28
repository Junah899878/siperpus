<!-- Modern Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">SI Perpus</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a href="#" class="nav-link active scrolling-text">Buku adalah Kunci untuk Hidup Seperti Seratus Tahun Penuh Pengetahuan</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Include Bootstrap CSS and JS -->

<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<style>
  .navbar-nav .nav-link {
    margin-right: 1rem;
    transition: color 0.3s;
  }
  .navbar-nav .nav-link:hover {
    color: #ff66b2;
  }
  .navbar-brand {
    font-weight: bold;
    color: #ff66b2;
  }
  
  /* CSS untuk animasi berjalan */
  .scrolling-text {
      display: inline-block;
      white-space: nowrap;
      animation: scroll-left 15s linear infinite; /* Durasi dan animasi berjalan */
      font-size: 1rem;
      color: #fff; /* Ganti sesuai dengan warna teks yang diinginkan */
  }

  /* Keyframes untuk animasi */
  @keyframes scroll-left {
      from {
          transform: translateX(100%); /* Mulai dari kanan layar */
      }
      to {
          transform: translateX(-100%); /* Berhenti di sebelah kiri layar */
      }
  }
</style>
