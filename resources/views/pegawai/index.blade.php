@extends('template.main')
@section('container')
<div class="section">
            <div class="section-header">
                <h1>List Pegawai &nbsp;</h1>
                <div class="section-header-back">
               <a href="/petugas/data-pegawai/create" class="btn btn-icon btn-primary" title="Add Data Pegawai"><i class="fa fa-plus"></i></a>
                  </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">
                        <a href="">Pegawai</a>
                    </div>
                    <div class="breadcrumb-item">
                        <a href="">List</a>
                    </div>
                </div>
            </div>
            @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        {{ session('success') }}
                      </div>
                    </div>
                @endif
            @if (session()->has('delete'))
                    <div class="alert alert-danger alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        {{ session('delete') }}
                      </div>
                    </div>
                @endif
            @if (session()->has('edit'))
                    <div class="alert alert-warning alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        {{ session('edit') }}
                      </div>
                    </div>
                @endif
            <div class="section-body">
                <div class="card">
                  <div class="card-header">
                    <h4>Data {{ $title }}</h4>
                    <div class="card-header-action">
                            <form action="/petugas/data-pegawai" method="get">
                            <div class="float-left">
                                <input type="text" name="search" id="search" style="width: 155pt;" value="{{ request('search') }}" placeholder="Keyword Pencarian" class="form-control">
                            </div>
                            <div class="float-right ml-2">
                                <button class="btn btn-primary" type="submit"> <i class="fas fa-search"></i></button>
                            </div>

                        </div>
                    </div>
                    <div class="ml-4">
                                <label for="show_entries" class="form-label">Show :</label>
                                <select name="show_entries" id="show_entries" class="form-actions">
                                    <option value="10" {{ request()->input('show_entries') == '10' ? 'selected' : '' }}>10</option>
                                    <option value="20" {{ request()->input('show_entries') == '20' ? 'selected' : '' }}>20</option>
                                    <option value="50" {{ request()->input('show_entries') == '50' ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ request()->input('show_entries') == '100' ? 'selected' : '' }}>100</option>
                                </select>
                                <label for=""> Entries</label>
                            </div>
                        </form>
                <form action="/petugas/data-pegawai/create" method="get" autocapitalize="off">
                <div class="card-body col-12">
                    <div class="table-responsive"  >
                      <table class="table table-hover table-md ">
                        <thead>
                            <tr>
                          <th scope="col">No</th>
                          <th scope="col">Foto</th>
                          <th scope="col">Nip</th>
                          <th scope="col">Nama</th>
                          <th scope="col">JK/TTL</th>
                          <th scope="col">Agama</th>
                          <th scope="col">Telpon</th>
                          <th scope="col">Status</th>
                          <th scope="col" class="text">Action</th>
                        </tr>
                    </thead>
                        <tbody>
                        @foreach ($pegawai as $key => $p)
                        <tr>
                            <td>{{ $pegawai->firstItem() + $key }}</td>
                            @if ($p->image)
                                 <td><img src="{{asset('storage/'.$p->image) }}" height="35px" alt="Foto Pegawai" class="rounded-circle mr-1"></td>
                            @else
                             <td><img src="/template/assets/img/avatar/avatar-1.png" height="35px" alt="Foto Pegawai" class="rounded-circle mr-1"></td>
                            @endif
                            <td>{{ $p->nip }}</td>
                            <td>{{ $p->gelar_depan == $p->gelar_depan ? "$p->gelar_depan." :  str_replace('.','')}} {{ $p->nama}}{{$p->gelar_belakang == $p->gelar_belakang ? ', '."$p->gelar_belakang" :''  }}</td>
                            <td>{{ $p->gender == 'l' ? 'Laki-Laki':'Perempuan' }} {{ $p->tempat_lahir}} {{$p->tanggal_lahir  }}</td>
                            <td>{{ $p->agama }}</td>
                            <td>{{ $p->telp }}</td>
                            <td>{{ $p->status_kepegawaian}}</td>
                            <td>
                          <a href="/petugas/data-pegawai/{{ $p->nip }}" class="btn btn-primary btn-sm " > <i class="fas fa-eye"></i></a>
                          <a href="/petugas/data-pegawai/{{ $p->nip}}/edit" class="btn btn-warning btn-sm "> <i class="fas fa-edit"></i></a>
                          <form action="/petugas/data-pegawai/{{ $p->nip}}" method="post" class="align-content-center" id="del-{{ $p->nip}}">
                           @csrf
                        @method('delete')
                          <button class="btn btn-danger btn-sm mt-1 ml-3" data-confirm="Hapus Data?|Apakah Anda yakin Ingin Menghapus Data <br> Nama : {{ $p->nama }} <br> Nip : {{ $p->nip }} ?" data-confirm-yes="submitDel({{ $p->nip}})">
                          <i class="fas fa-trash"></i></button>
                          </form>
                          </td>
                          </tr>
                            @endforeach
                      </tbody>
                    </table>
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    <div class="text-left">
                   <i> Showing {{ $pegawai->firstItem() }} to {{ $pegawai->lastItem() }} of {{ $pegawai->total() }} Entires</i>
                  </div>
                  <nav class="pull-right d-lg-inline-block">
    <ul class="pagination mb-0">
        <li class="page-item{{ ($pegawai->onFirstPage()) ? ' disabled' : '' }}">
            <a class="page-link" href="{{ $pegawai->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
        </li>

        @if ($pegawai->lastPage() > 1)
            @for ($i = 1; $i <= $pegawai->lastPage(); $i++)
                <li class="page-item{{ ($pegawai->currentPage() === $i) ? ' active' : '' }}">
                    <a class="page-link" href="{{ $pegawai->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
        @endif

        <li class="page-item{{ ($pegawai->hasMorePages()) ? '' : ' disabled' }}">
            <a class="page-link" href="{{ $pegawai->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
        </li>
    </ul>
  </nav>
                        </div>
                  </div>
                </div>

            </div>
        </div>
          @endsection
