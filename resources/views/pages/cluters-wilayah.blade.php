@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row" style="margin-bottom: 20px;">
                        <div class="col-lg-6">
                            <h6>Data Cluster Perwilayah</h6>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-end">
                            <select onchange="fetchData()" id="citySelect" class="form-select form-select-sm"
                                aria-label="Default select example" style="width: 200px;">
                                <option selected>Cluster Wilayah</option>
                                @foreach ($city as $c)
                                    <option selected>{{ $c->city }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nama</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Deskripsi</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Harga</th>
                                    <th class="text-uppercase text-seco ndary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Kota</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Kategori</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Rating</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">

                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function fetchData() {
        // Ambil nilai dari elemen select
        const selectedCity = document.getElementById('citySelect').value;

        // Bangun URL dengan parameter city
        const url = `http://localhost:8000/dashboard/wilayah/get-wilayah?city=${selectedCity}`;

        // Fetch data
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                // Proses data yang diterima
                updateTable(data);
            })
            .catch(error => {
                // Tangani kesalahan fetch
                console.error('Fetch error:', error);
            });
    }

    function truncateText(text, maxLength) {
        return text.length > maxLength ? text.substring(0, maxLength) + '...' : text;
    }

    function updateTable(data) {
        const tableBody = document.getElementById('tableBody');
        // Hapus isi tabel sebelum menambahkan yang baru
        tableBody.innerHTML = "";

        // Loop melalui data dan tambahkan baris baru ke tabel
        data.forEach((item, index) => {
            const row = tableBody.insertRow(index);

            // Kolom-kolom tabel
            const cell1 = row.insertCell(0);
            const cell2 = row.insertCell(1);
            const cell3 = row.insertCell(2);
            const cell4 = row.insertCell(3);
            const cell5 = row.insertCell(4);
            const cell6 = row.insertCell(5);
            const cell7 = row.insertCell(6);

            // Isi kolom dengan data dari respons
            cell1.textContent = index + 1;
            cell1.classList.add("text-xs", "text-secondary", "mb-0");
            cell2.textContent = item.name; // Ganti dengan properti yang sesuai dari respons
            cell2.classList.add("text-xs", "text-secondary", "mb-0");
            cell3.textContent = truncateText(item.description, 50); // Ganti 50 dengan jumlah karakter maksimal yang diinginkan
            cell3.classList.add("text-xs", "text-secondary", "mb-0");
            cell4.textContent = `Rp. ${item.price}`; // Ganti dengan properti yang sesuai dari respons
            cell4.classList.add("text-xs", "text-secondary", "mb-0");
            cell5.textContent = item.city; // Ganti dengan properti yang sesuai dari respons
            cell5.classList.add("text-xs", "text-secondary", "mb-0");
            cell6.textContent = item.category.nama; // Ganti dengan properti yang sesuai dari respons
            cell6.classList.add("text-xs", "text-secondary", "mb-0");
            cell7.textContent = item.ratings_avg_num_of_rating; // Ganti dengan properti yang sesuai dari respons
            cell7.classList.add("text-xs", "text-secondary", "mb-0");
            // cell6.textContent = item.kategori; // Ganti dengan properti yang sesuai dari respons
            // cell7.textContent = item.rating; // Ganti dengan properti yang sesuai dari respons
        });
    }
</script>
