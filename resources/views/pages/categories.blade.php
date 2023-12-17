@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <div class="row">
              <div class="col-lg-6">
                  <h6>Tabel Kategori</h6>
              </div>
              <div class="col-lg-6 d-flex justify-content-end">
                  <button id="categoriesModal" class="btn btn-dark btn-sm mb-3">Tambah Kategori</button>
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
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($categories as $index => $item)
                  <tr>
                    <td style="padding-left:20px">
                      <p class="text-xs text-secondary mb-0">{{$index+1}}.</p>
                    </td>
                    <td>
                      <p class="text-xs text-secondary mb-0">{{$item->nama}}</p>
                    </td>
                    <td class="align-middle">
                      <form method="POST" action="/dashboard/categories/{{$item->id}}" style="display: inline-block;">
                          @csrf
                          @method("DELETE")
                          <button type="submit" class="text-danger font-weight-bold text-xs btn" data-toggle="tooltip" data-original-title="Delete category">
                              <i class="fas fa-trash-alt"></i>
                          </button>
                      </form>
                      <button href="javascript:;" class="text-secondary font-weight-bold text-xs btn" data-toggle="tooltip" data-original-title="Edit category">
                          <i class="fas fa-edit"></i>
                      </button>
                  </td>                  
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal" id="categoryModal" tabindex="-2" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="categoryModalLabel">Add Category</h5>
                  <button type="button" class="close btn btn-link" id="closeCategories" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form id="categoryForm" method="POST">
                      @csrf
                      <div class="form-group">
                          <label for="categoryName">Category Name:</label>
                          <input name="categoryName" required type="text" class="form-control" id="categoryName" placeholder="Enter category name">
                      </div>
                      <button type="submit" class="btn btn-primary">Add Category</button>
                  </form>
              </div>
          </div>
      </div>
    </div>


@endsection