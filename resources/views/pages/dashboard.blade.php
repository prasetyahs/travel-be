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
                                    {{ $count['totalTravel'] }}
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
                                    {{ $count['totalUser'] }}
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
                                    {{ $count['totalRating'] }}
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
                                    {{ $count['totalCategory'] }}
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
            const rawData = {!! $clusterResult !!};
            const labels = {!! $clusterLabel !!};
            // Process data for Plotly
            const scatterData = [];
            rawData.forEach((entry, groupIndex) => {
                Object.keys(entry).forEach(key => {
                    const [x, y, z] = entry[key];
                    scatterData.push({
                        x,
                        y,
                        z,
                        text: labels[key],
                        group: groupIndex // Assign a unique group index to each group
                    });
                });
            });

            // Define colors for each group
            const groupColors = ['red', 'green', 'blue', 'purple', 'orange', 'pink'];

            // Create scatter plot
            const layout = {
                title: 'Overview Cluster',
                scene: {
                    xaxis: {
                        title: 'Price'
                    },
                    yaxis: {
                        title: 'Category'
                    },
                    zaxis: {
                        title: 'Rating'
                    }
                },
                autosize: true,
                height: 700,
                width : 700
            };

            const trace = scatterData.map(point => ({
                type: 'scatter3d',
                mode: 'markers',
                x: [point.x],
                y: [point.y],
                z: [point.z],
                text: [point.text],
                marker: {
                    size: 4,
                    color: groupColors[point.group % groupColors.length] || 'gray' // Use a color or default to gray
                },
                showlegend: false
            }));

            Plotly.newPlot('scatter-plot', trace, layout);
        </script>
    @endsection
