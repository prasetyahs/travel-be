@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <div class="row">
              <div class="col-lg-6">
                  <h6>Tabel Wisata</h6>
              </div>
              <div class="col-lg-6 d-flex justify-content-end">
                  <button class="btn btn-dark btn-sm mb-3">Tambah Wisata</button>
              </div>
            </div>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Deskripsi</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Harga</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kota</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kategori</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td style="padding-left:20px">
                        <p class="text-xs text-secondary mb-0">1.</p>
                    </td>
                    <td>
                      <p class="text-xs text-secondary mb-0">Taman Mini Indonesia Indah</p>
                    </td>
                    <td>
                      <p class="text-xs text-secondary mb-0">Lorem, ipsum dolor sit amet consectetur adipisicing elit...</p>
                    </td>
                    <td>
                      <p class="text-xs text-secondary mb-0">Rp. 10.000</p>
                    </td>
                    <td>
                      <p class="text-xs text-secondary mb-0">Jakarta</p>
                    </td>
                    <td>
                      <p class="text-xs text-secondary mb-0">Budaya</p>
                    </td>
                    <td class="align-middle">
                      <a style="padding-right: 20px" href="javascript:;" class="text-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                        Delete
                      </a>
                      <a href="javascript:;"style="padding-right: 20px" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                        Edit
                      </a>
                      <a href="javascript:;" class="text-success font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                        Lihat Lokasi
                      </a>
                    </td>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
</div>

@endsection