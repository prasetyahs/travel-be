
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
                  <a href="travel/create" class="btn btn-dark btn-sm mb-3">Tambah Wisata</a>
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
                  @foreach ($travel as $index=> $item)
                  <tr>
                    <td style="padding-left:20px">
                      <p class="text-xs text-secondary mb-0">{{$index+1}}.</p>
                    </td>
                    <td>
                      <p class="text-xs text-secondary mb-0">{{$item->name}}</p>
                    </td>
                    <td>
                      <p class="text-xs text-secondary mb-0" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 250px;">{{$item->description}}</p>
                    </td>
                    <td>
                      <p class="text-xs text-secondary mb-0">Rp. {{ number_format($item->price, 0, ',', '.') }}</p>
                    </td>
                    <td>
                      <p class="text-xs text-secondary mb-0">{{$item->city}}</p>
                    </td>
                    <td>
                      <p class="text-xs text-secondary mb-0">{{ $item->category->nama }}</p>
                    </td>
                    <td class="align-middle">
                      <a href="{{route("travel.show",['travel'=>$item->id])}}" class="text-secondary font-weight-bold text-xs btn" data-toggle="tooltip" data-original-title="Edit category">
                        <i class="fas fa-info-circle"></i>
                      </a>
                      <a href="https://www.google.com/maps?q={{$item->lat}},{{$item->lon}}" target="_blank" class="text-success font-weight-bold text-xs btn" data-toggle="tooltip" data-original-title="Edit user">
                        <i class="fas fa-map-marker-alt"></i>
                      </a>
                      <a href="{{ route('travel.edit', ['travel' => $item->id]) }}" class="text-secondary font-weight-bold text-xs btn" data-toggle="tooltip" data-original-title="Edit category">
                        <i class="fas fa-edit"></i>
                      </a>
                      <form method="POST" action="/dashboard/travel/{{$item->id}}" style="display: inline-block;">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="text-danger font-weight-bold text-xs btn" data-toggle="tooltip" data-original-title="Delete category">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                      </form>
                    </td>
                    @endforeach
                  </tr>
                  </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
</div>

@endsection