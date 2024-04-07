<main class="main" id="main">
  <div class="pagetitle">
    <h1 class="text-dark">Dashboard</h1>
    <nav class="my-2">
      <ol class="breadcrumb">
        <li class="breadcrumb-item text-dark"><a href="<?= base_url('dashboard') ?>"
            class="text-decoration-none">Home</a></li>
        <li class="breadcrumb-item active text-dark">Dashboard</li>
      </ol>
    </nav>
  </div>

  <div class="col-lg-12">

    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Sales Per Month</h5>

          <canvas id="barChart" style="max-height: 400px;"></canvas>
        </div>
      </div>
    </div>
  </div>




</main>
