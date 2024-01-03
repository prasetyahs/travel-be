@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <form action="{{route('users.store')}}" method="post">
                @csrf
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-lg-6">
                                <h6>Tambah Pengguna</h6>
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
                                        <input class="form-control" name='nama' type="text" onfocus="focused(this)"
                                            onfocusout="defocused(this)">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Email
                                            address</label>
                                        <input class="form-control" name="email" type="email"
                                            onfocus="focused(this)"
                                            onfocusout="defocused(this)">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" type='password'
                                            class="form-control-label">Password</label>
                                        <input class="form-control" name="password" type="password" value=""
                                            onfocus="focused(this)" onfocusout="defocused(this)">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Role</label>
                                        <select name='role' class="form-control form-select"
                                            aria-label="Default select example">
                                            <option>Select Role</option>
                                            <option selected value="admin">Admin</option>
                                            <option value="user">User</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        @endsection
