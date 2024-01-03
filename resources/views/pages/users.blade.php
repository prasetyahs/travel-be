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
                            <a href="{{ route('users.create') }}" class="btn btn-dark btn-sm mb-3">Tambah Pengguna</a>
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
                                        Email</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Role</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $index => $item)
                                    <tr>
                                        <td style="padding-left:20px">
                                            <p class="text-xs text-secondary mb-0">{{ $index + 1 }}.</p>
                                        </td>
                                        <td>
                                            <p class="text-xs text-secondary mb-0">{{ $item->nama }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs text-secondary mb-0">{{ $item->email }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs text-secondary mb-0">{{ $item->role }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <form method="POST" action="{{ route('users.destroy', ['user' => $item]) }}"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-danger font-weight-bold text-xs btn"
                                                    data-toggle="tooltip" data-original-title="Delete category">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                            <a href="{{ route('users.edit', ['user' => $item]) }}"
                                                class="text-secondary font-weight-bold text-xs btn" data-toggle="tooltip"
                                                data-original-title="Edit category">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
