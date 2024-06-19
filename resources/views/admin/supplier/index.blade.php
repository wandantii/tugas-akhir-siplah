@extends('admin.layout')
@section('content')

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Data Supplier</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('admin') }}"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item">Data Master</li>
        <li class="breadcrumb-item active">Supplier</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      @if(session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row" style="padding-top:25px;">
              <div class="col-sm">
                <a href="{{ url('admin/supplier/baru') }}" type="button" style="float:right;" class="btn btn-dark">
                  <i class="bi bi-plus-circle"></i>
                  <span>Buat Baru</span>
                </a>
              </div>
            </div>
            <div class="row" style="padding-top:25px;">
              <table class="col-sm table datatable addon-table">
                <thead>
                  <tr>
                    <th style="width:5%">No.</th>
                    <th>Nama</th>
                    <th>Rating</th>
                    <th>Jumlah Pesanan Selesai</th>
                    <th>Telp</th>
                    <th>Alamat</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($data as $key=>$value)
                  <tr>
                    <td style="width:5%">{{ ($key+1)."." }}</td>
                    <td>{{ $value->nama ?? '' }}</td>
                    <td>{{ $value->rating ?? '' }} / 5.00</td>
                    <td>{{ $value->jumlah_pesanan_selesai ?? ''}}</td>
                    <td>{{ $value->nomor_telepon ?? ''}}</td>
                    <td>{{ $value->alamat ?? ''}}, Kecamatan {{ $value->kecamatan->kecamatan ?? ''}}, {{ $value->kota->kota ?? ''}} {{ $value->kode_pos ?? ''}}</td>
                    <td>
                      <a href="{{ url('admin/supplier/edit/'.$value->supplier_id) }}" type="button" class="btn btn-warning mx-1" style="float:left;"><i class="bi bi-pencil-square"></i></a>
                      <form action="{{ url('admin/supplier/delete/'.$value->supplier_id.'/') }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data ini?')" style="float:left;" class="mx-1">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger">
                          &nbsp;<i class="bi bi-trash-fill"></i>&nbsp;
                        </button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->

@endsection