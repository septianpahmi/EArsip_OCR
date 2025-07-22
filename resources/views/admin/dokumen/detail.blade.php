@include('partials.header')
@include('partials.navbar')
@include('partials.sidebar')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $katId->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ $katId->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row items-center">
                                <div class="col-6">
                                    <h3 class="card-title">DataTable {{ $katId->name }}</h3>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Judul</th>
                                        <th>Nama File</th>
                                        <th>Kategori</th>
                                        <th>File Size</th>
                                        <th>Expired</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($file as $doc)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $doc->document->title }}</td>
                                            <td>{{ $doc->file_name }}</td>
                                            <td>{{ $doc->document->category->name }}</td>
                                            <td>
                                                @if ($doc->file_size >= 1048576)
                                                    {{ number_format($doc->file_size / 1048576, 2) }}
                                                    MB
                                                @elseif ($doc->file_size >= 1024)
                                                    {{ number_format($doc->file_size / 1024, 2) }}
                                                    KB
                                                @else
                                                    {{ $doc->file_size }} bytes
                                                @endif
                                            </td>
                                            <td>{{ $doc->document->expired_at ? \Carbon\Carbon::parse($doc->document->expired_at)->format('d F Y') : '-' }}
                                            </td>
                                            <td>{{ $doc->document->status }}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm btn-block">
                                                    <button type="button" class="btn btn-default dropdown-toggle"
                                                        data-toggle="dropdown">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item status" data-id="{{ $doc->id }}"
                                                            url="{{ route('document.status', ['id' => $doc->id]) }}">Arhived</a>
                                                        <a class="dropdown-item"
                                                            href="{{ asset('storage/' . $doc->file_path) }}"
                                                            download>Download</a>
                                                    </div>
                                                    <button type="button" class="btn btn-danger delete"
                                                        url="{{ route('document.delete', $doc->id) }}"
                                                        data-id="{{ $doc->id }}">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials.footer')
