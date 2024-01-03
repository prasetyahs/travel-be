@extends('layouts.master') @section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">

                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-6">
                            <h6>Detail Travel</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="card-body">
                        <div class="row">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Nama Travel</label>
                                    <input name="name" readonly value="{{ $travel->name }}" class="form-control"
                                        type="text" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Harga</label>
                                    <input name="price" readonly value="{{ $travel->price }}" class="form-control"
                                        type="text" />
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Provinsi</label>
                                    <select id="select-province" class="form-control form-select"
                                        aria-label="Default select example">
                                        <option selected>Pilih Provinsi</option>
                                        @foreach ($province as $item)
                                            <option value="{{ $item['id'] }}">
                                                {{ $item['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Kota</label>
                                    <input type="text" readonly class="form-control" value="{{ $travel->city }}">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Kategori</label>
                                    <input type="text" readonly class="form-control"
                                        value="{{ $travel->category->nama }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Latitude,Longitude</label>
                                    <input type="text" value="{{ $travel->lat . ',' . $travel->lon }}" name="location"
                                        class="form-control" id="location" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Photos</label>

                                    <div class="row">
                                        @foreach ($travel->photos as $photo)
                                            <div class="col-md-4 mb-3">
                                                <div class="text-center">
                                                    <img src="{{ asset('storage/' . $photo->photo) }}" alt="Travel Photo"
                                                        class="img-fluid"
                                                        style="object-fit: cover; width: 400px; height: 300px; border-radius: 10px;">
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Deskripsi</label>
                                    <textarea name="description" name="description" class="form-control" id="" cols="30" rows="10">{{ $travel->description }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div id="map" style="height: 500px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            var markers = []; // Array to store markers
            function clearMarkers() {
                for (var i = 0; i < markers.length; i++) {
                    map.removeLayer(markers[i]);
                }
                markers = []; // Clear the array
            }
            $("#select-city").prop("disabled", true);
            $("#select-province").change(function() {
                var selectedValue = $(this).val();
                $("#select-city").prop("disabled", false);
                $.get(
                    "https://www.emsifa.com/api-wilayah-indonesia/api/regencies/" +
                    selectedValue +
                    ".json",
                    function(data, status) {
                        var selectElement = $("#select-city");
                        selectElement.empty();
                        $.each(data, function(index, city) {
                            selectElement.append(
                                $("<option>", {
                                    value: city.name,
                                    text: city.name,
                                })
                            );
                        });
                    }
                );
            });
            // Initialize the map with coordinates for the center of Indonesia and zoom level
            var map = L.map('map').setView([{{ $travel->lat }}, {{ $travel->lon }}], 8);

            // Add a tile layer from OpenStreetMap
            L.tileLayer('https://www.google.cn/maps/vt?lyrs=m@207000000&gl=cn&x={x}&y={y}&z={z}', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // Create a marker at the initial coordinates
            var marker = L.marker([{{ $travel->lat }}, {{ $travel->lon }}], {
                draggable: true
            }).addTo(map);
            // Add geocoder control to the map
            var geocoderControl = L.Control.geocoder({
                defaultMarkGeocode: false
            }).addTo(map);

            // map.on('click', function(event) {
            //     var clickedLatLng = event.latlng;
            //     clearMarkers()
            //     var marker = L.marker(clickedLatLng).addTo(map);
            //     markers.push(marker);
            //     $("#location").val(clickedLatLng.lat + "," + clickedLatLng.lng)
            // });

            geocoderControl.on('markgeocode', function(event) {
                var latitude = event.geocode.center.lat;
                var longitude = event.geocode.center.lng;
                $("#location").val(latitude + "," + longitude)
                var marker = L.marker(event.geocode.center).addTo(map);
                markers.push(marker);
                map.setView(event.geocode.center, 12);
                marker.setLatLng(event.geocode
                    .center);
            });
        });
    </script>
@endsection
