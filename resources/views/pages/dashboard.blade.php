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
      var trace1 = {
      x: [1, 2, 3, 4, 5],
      y: [1, 2, 3, 2, 1],
      z: [1, 2, 3, 2, 1],
      type: 'scatter3d',
      mode: 'markers',
      marker: {
          color: 'rgba(255, 0, 0, 0.6)',
          size: 10
      }
  };
  
  var trace2 = {
      x: [1.5, 2.5, 3.5, 4.5, 5.5],
      y: [1, 2, 3, 2, 1],
      z: [1.5, 2.5, 3.5, 2.5, 1.5],
      type: 'scatter3d',
      mode: 'markers',
      marker: {
          color: 'rgba(0, 255, 0, 0.6)',
          size: 15
      }
  };
  
  var trace3 = {
      x: [2, 3, 4, 5, 6],
      y: [1, 2, 3, 2, 1],
      z: [2, 3, 4, 3, 2],
      type: 'scatter3d',
      mode: 'markers',
      marker: {
          color: 'rgba(0, 0, 255, 0.6)',
          size: 20
      }
  };
  var data = [trace1, trace2, trace3];
    var layout = {
        width: 600,
        height: 600,
        scene: {
          xaxis: {title: 'X Axis'},
          yaxis: {title: 'Y Axis'},
          zaxis: {title: 'Z Axis'}
        }
    };
  
      Plotly.newPlot('scatter-plot', data, layout);  
    </script>
@endsection