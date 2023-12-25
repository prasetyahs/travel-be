@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Wisata</p>
                <h5 class="font-weight-bolder">
                  30
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                <i class="fas fa-map-marked-alt text-success text-lg text-white opacity-10"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Pengguna</p>
                <h5 class="font-weight-bolder">
                  2,300
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                <i class="fas fa-users text-success text-lg text-white opacity-10"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Rating</p>
                <h5 class="font-weight-bolder">
                  2,000
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                <i class="fas fa-star text-success text-lg text-white opacity-10"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Categories</p>
                <h5 class="font-weight-bolder">
                  2,000
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                <i class="fas fa-globe text-success text-lg text-white opacity-10"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-lg-12 mb-lg-0 mb-4">
      <div class="card z-index-2 h-100">
        <div class="card-header pb-0 pt-3 bg-transparent">
          <h6 class="text-capitalize">Ringkasan Pengelompokan</h6>
        </div>
        <div class="card-body p-3 d-flex justify-content-center align-items-center">
          <div id="scatter-plot"></div>
        </div>      
      </div>
    </div>

    <script>
       
        var clusterResult =  {!! $clusterResult !!};
        var traceData = [];

    // Iterasi melalui setiap cluster
    clusterResult.forEach(function (cluster, clusterIndex) {
        // Iterasi melalui setiap data di dalam cluster
        Object.entries(cluster).forEach(function ([key, dataPoint]) {
            // Tambahkan data point ke array traceData
            traceData.push({
                x: dataPoint[0],  // Price
                y: dataPoint[2],  // Average Rating
                mode: 'markers',
                type: 'scatter',
                name: 'Cluster ' + key,  // Nama cluster
                marker: { size: 12 },
                text: 'Destination ' + key,  // Teks ketika mouse hover
            });
        });
    });

    // Konfigurasi layout plot
    var layout = {
        title: 'Scatter Plot of Clusters',
        xaxis: { title: 'Price' },
        yaxis: { title: 'Average Rating' }
    };

    // Pemanggilan Plotly
    Plotly.newPlot('scatter-plot', traceData, layout);
    </script>
@endsection