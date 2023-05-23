@extends('template.main')
@section('container')
<div class="section">
            <div class="section-header">
                <h1>List Users &nbsp;</h1>
                <div class="section-header-back">
               <a href="/petugas/users/create" class="btn btn-icon btn-primary" title="Add Data Users"><i class="fa fa-plus"></i></a>
                  </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">
                        <a href="">Users</a>
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
                            <form action="/petugas/users" method="get">
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
                <form action="/petugas/users/create" method="get" autocapitalize="off">
                <div class="card-body col-12">
                    <div class="table-responsive"  >
                      <table class="table table-hover table-md ">
                        <thead>
                            <tr>
                          <th scope="col">No</th>
                          <th scope="col">Nama</th>
                          <th scope="col">Username</th>
                          <th scope="col">Email</th>
                          <th scope="col">Level</th>
                          <th scope="col" class="text">Action</th>
                        </tr>
                    </thead>
                        <tbody>
                        @foreach ($users as $key => $user)
                        <tr>
                            <td>{{ $users->firstItem() + $key }}</td>
                            <td>{{ $user->pegawai->nama }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->level}}</td>
                            <td>
                          <a href="/petugas/users/{{ $user->username }}" class="btn btn-primary btn-sm " > <i class="fas fa-eye"></i></a>
                          <a href="/petugas/users/{{ $user->username}}/edit" class="btn btn-warning btn-sm "> <i class="fas fa-edit"></i></a>
                          <form action="/petugas/users/{{ $user->username}}" method="post" class="align-content-center" id="del-{{ $user->username}}">
                           @csrf
                        @method('delete')
                          <button class="btn btn-danger btn-sm mt-1 ml-3" data-confirm="Hapus Data?|Apakah Anda yakin Ingin Menghapus Data <br> Nama : {{ $user->pegawai->nama }} <br> Nip : {{ $user->username }} ?" data-confirm-yes="submitDel({{ $user->username}})">
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
                   <i> Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} Entires</i>
                  </div>
                  <nav class="pull-right d-lg-inline-block">
                   <ul class="pagination mb-0">
                       <li class="page-item{{ ($users->onFirstPage()) ? ' disabled' : '' }}">
                           <a class="page-link" href="{{ $users->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
                       </li>

                       @if ($users->lastPage() > 1)
                           @for ($i = 1; $i <= $users->lastPage(); $i++)
                               <li class="page-item{{ ($users->currentPage() === $i) ? ' active' : '' }}">
                                   <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                               </li>
                           @endfor
                       @endif

                       <li class="page-item{{ ($users->hasMorePages()) ? '' : ' disabled' }}">
                           <a class="page-link" href="{{ $users->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
                       </li>
                   </ul>
                 </nav>
                        </div>
                  </div>
                </div>

            </div>
        </div>

@endsection
