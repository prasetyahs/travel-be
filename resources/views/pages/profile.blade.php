@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="row">
                  <div class="col-lg-6">
                      <h6>Edit Pengguna</h6>
                  </div>
                  <div class="col-lg-6 d-flex justify-content-end">
                      <button class="btn btn-dark btn-sm mb-3">Simpan</button>
                  </div>
                </div>
              </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Nama</label>
                      <input class="form-control" type="text" value="lucky.jesse" onfocus="focused(this)" onfocusout="defocused(this)">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Email address</label>
                      <input class="form-control" type="email" value="jesse@example.com" onfocus="focused(this)" onfocusout="defocused(this)">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Password</label>
                      <input class="form-control" type="text" value="Jesse" onfocus="focused(this)" onfocusout="defocused(this)">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Role</label>
                      <select class="form-control form-select" aria-label="Default select example">
                        <option selected>Select Role</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                      </select>
                    </div>
                  </div>
                </div>
          
        </div>
      </div>
</div>

@endsection