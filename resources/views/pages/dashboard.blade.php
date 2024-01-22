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
                    <div id="meanshift-plot"></div>
                </div>
            </div>
        </div>

        <script>
            const labelsText = {!! $clusterLabel !!};
            const groupColors = ['red', 'green', 'blue', 'purple', 'orange', 'pink'];

            function getRandomColor() {
                const letters = '0123456789ABCDEF';
                let color = '#';
                for (let i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }

            const rawData = {!! $clusterResult !!};
            // Process data for Plotly
            const scatterData = [];
            const newLabel = [];
            rawData.forEach((entry, groupIndex) => {
                Object.keys(entry).forEach(key => {
                    const [x, y, z] = entry[key];
                    scatterData.push({
                        x,
                        y,
                        z,
                        text: labelsText[key],
                        group: groupIndex // Assign a unique group index to each group
                    });
                });
            });

            // Define colors for each group

            // Create scatter plot
            const layout = {
                title: 'Kmeans Cluster',
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
                height: 600,
                width: 600
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
            fetch('http://localhost:5000/clusters')
                .then(response => response.json())
                .then(data => {
                    // Extract data for plotting
                    const clusters = data.clusters;
                    // Create a 3D scatter plot using Plotly
                    const trace = {
                        type: 'scatter3d',
                        mode: 'markers',
                        x: [],
                        y: [],
                        z: [],
                        text: [],
                        marker: {
                            size: 5,
                            color: [],
                            opacity: 0.8
                        }
                    };
                    clusters.forEach(cluster => {
                        const clusterData = cluster.data;
                        const clusterId = cluster.cluster_id;
                        // Append cluster data to the trace
                        trace.x = trace.x.concat(clusterData.map(point => point[0]));
                        trace.y = trace.y.concat(clusterData.map(point => point[1]));
                        trace.z = trace.z.concat(clusterData.map(point => point[2]));
                        trace.text = trace.text.concat(Array(clusterData.length).fill(labelsText));
                        const randomColor = getRandomColor();
                        trace.marker.color = trace.marker.color.concat(Array(clusterData.length).fill(randomColor));
                    });

                    const layout = {
                        title: 'Meanshift Cluster',
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
                        height: 600,
                        width: 600
                    };

                    const plotConfig = {
                        responsive: true
                    };
                    Plotly.newPlot('meanshift-plot', [trace], layout, plotConfig);
                })
                .catch(error => console.error('Error fetching data:', error));
        </script>
    @endsection
