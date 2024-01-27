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
                    <div class="row">
                        <div class="col-12">
                            <div id="scatter-plot"></div>
                        </div>

                        <img  id="imageDendogram" src="http://localhost:5000/api/dendrogram" alt="">
                        {{-- <div class="col-lg-12">
                            <svg id="verticalDendrogram" width="100%" height="800"></svg>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <script src="https://d3js.org/d3-hierarchy.v1.min.js"></script>
        <script src="https://d3js.org/d3.v7.min.js"></script>
        <style>
            .link {
                stroke: #ccc;
                stroke-width: 1.5;
            }

            .node {
                fill: #fff;
                stroke: #000;
                stroke-width: 1.5;
            }
        </style>
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
            // fetch('http://localhost:5000/clusters')
            //     .then(response => response.json())
            //     .then(data => {


            //     })
            //     .catch(error => console.error('Error fetching data:', error));
            const data = {
                name: "Cluster MeanShift",
                children: [{
                        name: "Cluster 1",
                        children: [

                        ]
                    },
                    {
                        name: "Cluster 2",
                        children: [

                        ]
                    },
                    {
                        name: "Cluster 3",
                        children: [

                        ]
                    },
                    {
                        name: "Cluster 4",
                        children: [

                        ]
                    }
                ]
            };

            const svg = d3.select("#verticalDendrogram")
                // .attr("width", 600)
                .attr("height", 800)
                .append("g")
                .attr("transform", "translate(50,50)");


            const root = d3.hierarchy(data);

            const treeLayout = d3.tree().size([800, 600]);

            const treeData = treeLayout(root);

            svg.selectAll("path.link")
                .data(treeData.links())
                .enter().append("path")
                .attr("class", "link")
                .attr("d", d3.linkHorizontal()
                    .x(d => d.x)
                    .y(d => d.y))
                .style("stroke", "#ccc")
                .style("stroke-width", "1.5px");

            svg.selectAll("g.node")
                .data(treeData.descendants())
                .enter().append("g")
                .attr("class", "node")
                .attr("transform", d => `translate(${d.x},${d.y})`)
                .append("circle")
                .attr("r", 5)
                .style("fill", "#fff")
                .style("stroke", "#000")
                .style("stroke-width", "1.5px");

            svg.selectAll("g.node")
                .append("text")
                .attr("dy", "0.31em")
                .attr("x", d => d.children ? -6 : 6)
                .attr("text-anchor", d => d.children ? "end" : "start")
                .text(d => d.data.name)
                .style("fill", "#000")
                .style("font-size", "10px");

            svg.selectAll("path.link")
                .style("fill", "none")
                .style("stroke-width", "1.5px");

            svg.selectAll("circle.node")
                .style("stroke", "#000")
                .style("stroke-width", "1.5px");
        </script>
    @endsection
