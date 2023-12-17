<!DOCTYPE html>
<html lang="en">
@include('includes.head')
<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  @include('includes.sidebar')
  <main class="main-content position-relative border-radius-lg ">
    @include("includes.navbar")
    <div class="container-fluid py-4">
        @yield('content')
      </div>
  </main>
  <!--   Core JS Files   -->
  <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/chartjs.min.js')}}"></script>
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
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="./assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>