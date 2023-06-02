@extends('admin.layout.main')

@section('title', 'Data Pengeluaran')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Data Pengeluaran Ayam</h2>
                <p class="card-text">DataTables is a plug-in for the jQuery Javascript library. It is a highly flexible tool,
                    built upon the foundations of progressive enhancement, that adds all of these advanced features to any
                    HTML table. </p>
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">×</span>
                                        </button>


                                        <?php
                                        
                                        $nomer = 1;
                                        
                                        ?>

                                        @foreach ($errors->all() as $error)
                                            <li>{{ $nomer++ }}. {{ $error }}</li>
                                        @endforeach
                                    </div>
                                @endif <!-- table -->
                                <table class="table datatables" id="dataTable-1">
                                    <div class="align-right text-right mb-3">
                                        <button class="btn btn-success btn-sm" data-toggle="modal"
                                            data-target="#addModalIdAyam">Add</button>
                                    </div>

                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Jumlah Ayam</th>
                                            <th>Total Biaya</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($dataayam as $data)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $data->ayam->tanggal_masuk }}</td>
                                                <td>{{ $data->ayam->total_ayam }}</td>
                                                <td>Rp. {{ number_format($data->ayam->total_harga) }}</td>
                                                <td>
                                                    {{-- <a class="btn btn-primary btn-sm"
                                                        href="/detail-pengeluaran/{{ $data->id }}">Detail</a> --}}
                                                    {{--
                                                    <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                        data-target="#editModalIdAyam{{ $data->id }}">Edit</button> --}}

                                                    <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#deleteModalIdAyam{{ $data->id }}">Delete</button>

                                                </td>
                                            </tr>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModalIdAyam{{ $data->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="defaultModalLabel">Delete Modal</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Yakin Ingin Menghapus Data?
                                                        </div>
                                                        <form action="/deleteidayam/{{ $data->ayam->id }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn mb-2 btn-success"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn mb-2 btn-danger">Delete</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Edit Modal -->
                                            {{-- <div class="modal fade" id="editModalIdAyam{{ $data->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="defaultModalLabel">Edit Modal</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="/updateidayam/{{ $data->ayam->id }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">


                                                                <div hidden class="form-group">
                                                                    <label for="recipient-name" class="col-form-label">Id
                                                                        Pengeluaran
                                                                    </label>
                                                                    <input type="text"
                                                                        value="{{ $data->id_pengeluaran }}"
                                                                        name="id_pengeluaran" class="form-control"
                                                                        id="recipient-name">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="simple-select2">Data Ayam</label>
                                                                    <select name="id_ayam" class="form-control">
                                                                        <option selected value="{{ $data->id_ayam }}">
                                                                            {{ $data->ayam->tanggal_masuk }} -
                                                                            {{ $data->ayam->total_ayam }} -
                                                                            {{ number_format($data->ayam->total_harga) }}
                                                                        </option>
                                                                        @foreach ($tampildataayam as $ayam)
                                                                            <option value="{{ $ayam->id }}">
                                                                                {{ $ayam->tanggal_masuk }} -
                                                                                {{ $ayam->total_ayam }}
                                                                                Ayam -
                                                                                {{ number_format($ayam->total_harga) }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>



                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn mb-2 btn-danger"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn mb-2 btn-success">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Add Modal -->
                                <div class="modal fade" id="addModalIdAyam" tabindex="-1" role="dialog"
                                    aria-labelledby="defaultModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="defaultModalLabel">Add Modal</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="/addidayam" method="POST">
                                                @csrf
                                                @method('POST')
                                                <div class="modal-body">

                                                    <div hidden class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Id Pengeluaran
                                                        </label>
                                                        <input type="text" value="{{ $pengeluaran->id }}"
                                                            name="id_pengeluaran" class="form-control" id="recipient-name">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="simple-select2">Data Ayam</label>
                                                        <select name="id_ayam" class="form-control">
                                                            <option selected disabled>Pilih Data Ayam</option>
                                                            @foreach ($tampildataayam as $ayam)
                                                                <option value="{{ $ayam->id }}">
                                                                    {{ $ayam->tanggal_masuk }} - {{ $ayam->total_ayam }}
                                                                    Ayam - Rp. {{ number_format($ayam->total_harga) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>



                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn mb-2 btn-danger"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn mb-2 btn-success">Save
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Data Pengeluaran Pakan</h2>
                <p class="card-text">DataTables is a plug-in for the jQuery Javascript library. It is a highly flexible
                    tool,
                    built upon the foundations of progressive enhancement, that adds all of these advanced features to any
                    HTML table. </p>
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-label="Close"><span aria-hidden="true">×</span>
                                        </button>


                                        <?php
                                        
                                        $nomer = 1;
                                        
                                        ?>

                                        @foreach ($errors->all() as $error)
                                            <li>{{ $nomer++ }}. {{ $error }}</li>
                                        @endforeach
                                    </div>
                                @endif <!-- table -->
                                <table class="table datatables" id="dataTable-2">
                                    <div class="align-right text-right mb-3">
                                        <button class="btn btn-success btn-sm" data-toggle="modal"
                                            data-target="#addModalIdPakan">Add</button>
                                    </div>

                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Jenis Pakan</th>
                                            <th>Total Biaya</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($datapakan as $data)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $data->pakan->pembelian }}</td>
                                                <td>{{ $data->pakan->jenis_pakan }}</td>
                                                <td>Rp. {{ number_format($data->pakan->total_harga) }}</td>
                                                <td>
                                                    {{-- <a class="btn btn-primary btn-sm"
                                                        href="/detail-pengeluaran/{{ $data->id }}">Detail</a> --}}

                                                    {{-- <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                        data-target="#editModalIdPakan{{ $data->id }}">Edit</button> --}}

                                                    <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#deleteModalIdPakan{{ $data->id }}">Delete</button>

                                                </td>
                                            </tr>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModalIdPakan{{ $data->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="defaultModalLabel">Delete Modal
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Yakin Ingin Menghapus Data?
                                                        </div>
                                                        <form action="/deleteidpakan/{{ $data->pakan->id }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn mb-2 btn-success"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn mb-2 btn-danger">Delete</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Edit Modal -->
                                            {{-- <div class="modal fade" id="editModalIdPakan{{ $data->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="defaultModalLabel">Edit Modal</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="/updateidpakan/{{ $data->id }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">


                                                                <div hidden class="form-group">
                                                                    <label for="recipient-name" class="col-form-label">Id
                                                                        Pengeluaran
                                                                    </label>
                                                                    <input type="text"
                                                                        value="{{ $data->id_pengeluaran }}"
                                                                        name="id_pengeluaran" class="form-control"
                                                                        id="recipient-name">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="simple-select2">Data Pakan</label>
                                                                    <select name="id_pakan" class="form-control">
                                                                        <option selected value="{{ $data->id_pakan }}">
                                                                            {{ $data->pakan->pembelian }} -
                                                                            {{ $data->pakan->jenis_pakan }} -
                                                                            {{ number_format($data->pakan->total_harga) }}
                                                                        </option>
                                                                        @foreach ($tampildatapakan as $pakan)
                                                                            <option value="{{ $pakan->id }}">
                                                                                {{ $pakan->pembelian }} -
                                                                                {{ $pakan->jenis_pakan }}
                                                                                -
                                                                                {{ number_format($pakan->total_harga) }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>


                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn mb-2 btn-danger"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn mb-2 btn-success">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Add Modal -->
                                <div class="modal fade" id="addModalIdPakan" tabindex="-1" role="dialog"
                                    aria-labelledby="defaultModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="defaultModalLabel">Add Modal</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="/addidpakan" method="POST">
                                                @csrf
                                                @method('POST')
                                                <div class="modal-body">

                                                    <div hidden class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Id Pengeluaran
                                                        </label>
                                                        <input type="text" value="{{ $pengeluaran->id }}"
                                                            name="id_pengeluaran" class="form-control"
                                                            id="recipient-name">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="simple-select2">Data Pakan</label>
                                                        <select name="id_pakan" class="form-control">
                                                            <option selected disabled>Pilih Pakan</option>
                                                            @foreach ($tampildatapakan as $pakan)
                                                                <option value="{{ $pakan->id }}">
                                                                    {{ $pakan->pembelian }} - {{ $pakan->jenis_pakan }}
                                                                    - Rp. {{ number_format($pakan->total_harga) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn mb-2 btn-danger"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn mb-2 btn-success">Save
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Data Pengeluaran Vaksin</h2>
                <p class="card-text">DataTables is a plug-in for the jQuery Javascript library. It is a highly flexible
                    tool,
                    built upon the foundations of progressive enhancement, that adds all of these advanced features to any
                    HTML table. </p>
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-label="Close"><span aria-hidden="true">×</span>
                                        </button>


                                        <?php
                                        
                                        $nomer = 1;
                                        
                                        ?>

                                        @foreach ($errors->all() as $error)
                                            <li>{{ $nomer++ }}. {{ $error }}</li>
                                        @endforeach
                                    </div>
                                @endif <!-- table -->
                                <table class="table datatables" id="dataTable-3">
                                    <div class="align-right text-right mb-3">
                                        <button class="btn btn-success btn-sm" data-toggle="modal"
                                            data-target="#addModalIdVaksin">Add</button>
                                    </div>

                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Jenis Vaksin</th>
                                            <th>Total Biaya</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($datavaksin as $data)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $data->vaksin->tanggal_ovk }}</td>
                                                <td>{{ $data->vaksin->jenis_ovk }}</td>
                                                <td>Rp. {{ number_format($data->vaksin->total_biaya) }}</td>
                                                <td>
                                                    {{-- <a class="btn btn-primary btn-sm"
                                                        href="/detail-pengeluaran/{{ $data->id }}">Detail</a>
 --}}
                                                    {{--
                                                    <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                        data-target="#editModalIdVaksin{{ $data->id }}">Edit</button> --}}

                                                    <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#deleteModalIdVaksin{{ $data->id }}">Delete</button>

                                                </td>
                                            </tr>


                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModalIdVaksin{{ $data->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="defaultModalLabel">Delete Modal
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Yakin Ingin Menghapus Data?
                                                        </div>
                                                        <form action="/deleteidvaksin/{{ $data->vaksin->id }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn mb-2 btn-success"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn mb-2 btn-danger">Delete</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Edit Modal -->
                                            {{-- <div class="modal fade" id="editModalIdVaksin{{ $data->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="defaultModalLabel">Edit Modal</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="/udpateidvaksin/{{ $data->id }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">


                                                                <div hidden class="form-group">
                                                                    <label for="recipient-name" class="col-form-label">Id
                                                                        Pengeluaran
                                                                    </label>
                                                                    <input type="text"
                                                                        value="{{ $data->id_pengeluaran }}"
                                                                        name="id_pengeluaran" class="form-control"
                                                                        id="recipient-name">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="simple-select2">Data Vaksin</label>
                                                                    <select name="id_vaksin" class="form-control">
                                                                        <option selected value="{{ $data->id_vaksin }}">
                                                                            {{ $data->vaksin->tanggal_ovk }} -
                                                                            {{ $data->vaksin->jenis_ovk }} -
                                                                            {{ number_format($data->vaksin->total_biaya) }}
                                                                        </option>
                                                                        @foreach ($tampildatavaksin as $vaksin)
                                                                            <option value="{{ $vaksin->id }}">
                                                                                {{ $vaksin->tanggal_ovk }} -
                                                                                {{ $vaksin->jenis_ovk }} -
                                                                                {{ number_format($vaksin->total_biaya) }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>


                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn mb-2 btn-danger"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn mb-2 btn-success">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Add Modal -->
                                <div class="modal fade" id="addModalIdVaksin" tabindex="-1" role="dialog"
                                    aria-labelledby="defaultModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="defaultModalLabel">Add Modal</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="/addidvaksin" method="POST">
                                                @csrf
                                                @method('POST')
                                                <div class="modal-body">

                                                    <div hidden class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Id
                                                            Pengeluaran
                                                        </label>
                                                        <input type="text" value="{{ $pengeluaran->id }}"
                                                            name="id_pengeluaran" class="form-control"
                                                            id="recipient-name">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="simple-select2">Data Vaksin</label>
                                                        <select name="id_vaksin" class="form-control">
                                                            <option selected value="">Pilih Data Vaksin</option>
                                                            @foreach ($tampildatavaksin as $vaksin)
                                                                <option value="{{ $vaksin->id }}">
                                                                    {{ $vaksin->tanggal_ovk }} -
                                                                    {{ $vaksin->jenis_ovk }} -
                                                                    Rp. {{ number_format($vaksin->total_biaya) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn mb-2 btn-danger"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn mb-2 btn-success">Save
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Data Pengeluaran Gaji</h2>
                <p class="card-text">DataTables is a plug-in for the jQuery Javascript library. It is a highly flexible
                    tool,
                    built upon the foundations of progressive enhancement, that adds all of these advanced features to any
                    HTML table. </p>
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-label="Close"><span aria-hidden="true">×</span>
                                        </button>


                                        <?php
                                        
                                        $nomer = 1;
                                        
                                        ?>

                                        @foreach ($errors->all() as $error)
                                            <li>{{ $nomer++ }}. {{ $error }}</li>
                                        @endforeach
                                    </div>
                                @endif <!-- table -->
                                <table class="table datatables" id="dataTable-4">
                                    <div class="align-right text-right mb-3">
                                        <button class="btn btn-success btn-sm" data-toggle="modal"
                                            data-target="#addModalIdGaji">Add</button>
                                    </div>

                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Nama</th>
                                            <th>Gaji</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($datagaji as $data)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $data->gaji->tanggal }}</td>
                                                <td>{{ $data->gaji->nama_karyawan }}</td>
                                                <td>Rp. {{ number_format($data->gaji->gaji) }}</td>
                                                <td>
                                                    {{-- <a class="btn btn-primary btn-sm"
                                                        href="/detail-pengeluaran/{{ $data->id }}">Detail</a> --}}

                                                    {{-- <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                        data-target="#editModalIdGaji{{ $data->id }}">Edit</button> --}}

                                                    <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#deleteModalIdGaji{{ $data->id }}">Delete</button>

                                                </td>
                                            </tr>


                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModalIdGaji{{ $data->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="defaultModalLabel">Delete Modal
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Yakin Ingin Menghapus Data?
                                                        </div>
                                                        <form action="/deleteidgaji/{{ $data->gaji->id }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn mb-2 btn-success"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn mb-2 btn-danger">Delete</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Edit Modal -->
                                            {{-- <div class="modal fade" id="editModalIdGaji{{ $data->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="defaultModalLabel">Edit Modal</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="/updateidgaji/{{ $data->id }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">

                                                                <div hidden class="form-group">
                                                                    <label for="recipient-name" class="col-form-label">Id
                                                                        Pengeluaran
                                                                    </label>
                                                                    <input type="text"
                                                                        value="{{ $data->id_pengeluaran }}"
                                                                        name="id_pengeluaran" class="form-control"
                                                                        id="recipient-name">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="simple-select2">Data Gaji</label>
                                                                    <select name="id_gaji" class="form-control">
                                                                        <option selected value="{{ $data->id_gaji }}">
                                                                            {{ $data->gaji->tanggal }} -
                                                                            {{ $data->gaji->nama_karyawan }} -
                                                                            {{ number_format($data->gaji->gaji) }}
                                                                        </option>
                                                                        @foreach ($tampildatagaji as $gaji)
                                                                            <option value="{{ $gaji->id }}">
                                                                                {{ $gaji->tanggal }} -
                                                                                {{ $gaji->nama_karyawan }} -
                                                                                {{ number_format($gaji->gaji) }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>



                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn mb-2 btn-danger"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn mb-2 btn-success">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Add Modal -->
                                <div class="modal fade" id="addModalIdGaji" tabindex="-1" role="dialog"
                                    aria-labelledby="defaultModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="defaultModalLabel">Add Modal</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="/addidgaji" method="POST">
                                                @csrf
                                                @method('POST')
                                                <div class="modal-body">

                                                    <div hidden class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Id
                                                            Pengeluaran
                                                        </label>
                                                        <input type="text" value="{{ $pengeluaran->id }}"
                                                            name="id_pengeluaran" class="form-control"
                                                            id="recipient-name">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="simple-select2">Data Gaji</label>
                                                        <select name="id_gaji" class="form-control">
                                                            <option selected value="">Pilih Data Gaji</option>
                                                            @foreach ($tampildatagaji as $gaji)
                                                                <option value="{{ $gaji->id }}">
                                                                    {{ $gaji->tanggal }} -
                                                                    {{ $gaji->nama_karyawan }} - Rp.
                                                                    {{ number_format($gaji->gaji) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn mb-2 btn-danger"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn mb-2 btn-success">Save
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
@endsection

@section('script')
    <script>
        $('#dataTable-1').DataTable({
            autoWidth: true,
            // "lengthMenu": [
            //     [16, 32, 64, -1],
            //     [16, 32, 64, "All"]
            // ]
            dom: 'Bfrtip',


            lengthMenu: [
                [10, 25, 50, -1],
                ['10 rows', '25 rows', '50 rows', 'Show all']
            ],

            buttons: [{
                    extend: 'colvis',
                    className: 'btn btn-primary btn-sm',
                    text: 'Column Visibility',
                    // columns: ':gt(0)'


                },

                {

                    extend: 'pageLength',
                    className: 'btn btn-primary btn-sm',
                    text: 'Page Length',
                    // columns: ':gt(0)'
                },

                {
                    extend: 'excel',
                    className: 'btn btn-primary btn-sm',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-primary btn-sm',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },

                {
                    extend: 'print',
                    className: 'btn btn-primary btn-sm',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
            ],
        });
    </script>
    <script>
        $('#dataTable-2').DataTable({
            autoWidth: true,
            // "lengthMenu": [
            //     [16, 32, 64, -1],
            //     [16, 32, 64, "All"]
            // ]
            dom: 'Bfrtip',


            lengthMenu: [
                [10, 25, 50, -1],
                ['10 rows', '25 rows', '50 rows', 'Show all']
            ],

            buttons: [{
                    extend: 'colvis',
                    className: 'btn btn-primary btn-sm',
                    text: 'Column Visibility',
                    // columns: ':gt(0)'


                },

                {

                    extend: 'pageLength',
                    className: 'btn btn-primary btn-sm',
                    text: 'Page Length',
                    // columns: ':gt(0)'
                },

                {
                    extend: 'excel',
                    className: 'btn btn-primary btn-sm',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-primary btn-sm',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },

                {
                    extend: 'print',
                    className: 'btn btn-primary btn-sm',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
            ],
        });
    </script>
    <script>
        $('#dataTable-3').DataTable({
            autoWidth: true,
            // "lengthMenu": [
            //     [16, 32, 64, -1],
            //     [16, 32, 64, "All"]
            // ]
            dom: 'Bfrtip',


            lengthMenu: [
                [10, 25, 50, -1],
                ['10 rows', '25 rows', '50 rows', 'Show all']
            ],

            buttons: [{
                    extend: 'colvis',
                    className: 'btn btn-primary btn-sm',
                    text: 'Column Visibility',
                    // columns: ':gt(0)'


                },

                {

                    extend: 'pageLength',
                    className: 'btn btn-primary btn-sm',
                    text: 'Page Length',
                    // columns: ':gt(0)'
                },

                {
                    extend: 'excel',
                    className: 'btn btn-primary btn-sm',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-primary btn-sm',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },

                {
                    extend: 'print',
                    className: 'btn btn-primary btn-sm',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
            ],
        });
    </script>
    <script>
        $('#dataTable-4').DataTable({
            autoWidth: true,
            // "lengthMenu": [
            //     [16, 32, 64, -1],
            //     [16, 32, 64, "All"]
            // ]
            dom: 'Bfrtip',


            lengthMenu: [
                [10, 25, 50, -1],
                ['10 rows', '25 rows', '50 rows', 'Show all']
            ],

            buttons: [{
                    extend: 'colvis',
                    className: 'btn btn-primary btn-sm',
                    text: 'Column Visibility',
                    // columns: ':gt(0)'


                },

                {

                    extend: 'pageLength',
                    className: 'btn btn-primary btn-sm',
                    text: 'Page Length',
                    // columns: ':gt(0)'
                },

                {
                    extend: 'excel',
                    className: 'btn btn-primary btn-sm',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-primary btn-sm',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },

                {
                    extend: 'print',
                    className: 'btn btn-primary btn-sm',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
            ],
        });
    </script>
@endsection


@section('sweetalert')
    @if (Session::get('update'))
        <script>
            Swal.fire(
                'Success',
                'Data Berhasil Di Update',
                'success'
            )
        </script>
    @endif
    @if (Session::get('delete'))
        <script>
            Swal.fire(
                'Success',
                'Data Berhasil Di Hapus',
                'success'
            )
        </script>
    @endif
    @if (Session::get('create'))
        <script>
            Swal.fire(
                'Success',
                'Data Berhasil Ditambahkan',
                'success'
            )
        </script>
    @endif
    @if (Session::get('gagal'))
        <script>
            Swal.fire(
                'Error',
                'Data Gagal Ditambahkan',
                'error'
            )
        </script>
    @endif
    @if (Session::get('sudahada'))
        <script>
            Swal.fire(
                'Error',
                'Data Sudah Ada',
                'error'
            )
        </script>
    @endif

@endsection
