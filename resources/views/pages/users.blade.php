@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <div class="row">
              <div class="col-lg-6">
                  <h6>Tabel Pengguna</h6>
              </div>
              <div class="col-lg-6 d-flex justify-content-end">
                  <button class="btn btn-dark btn-sm mb-3">Tambah Pengguna</button>
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
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td style="padding-left:20px">
                      <p class="text-xs text-secondary mb-0">1.</p>
                  </td>
                    <td>
                      <p class="text-xs text-secondary mb-0">Prasetya Hadi</p>
                    </td>
                    <td>
                      <p class="text-xs text-secondary mb-0">zaenalbanker@gmail.com</p>
                    </td>
                    <td>
                      <p class="text-xs text-secondary mb-0">Pengguna</p>
                    </td>
                    <td class="align-middle">
                      <a style="padding-right: 20px" href="javascript:;" class="text-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                        Delete
                      </a>
                      <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                        Edit
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