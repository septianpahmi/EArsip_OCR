@include('partials.header')
@include('partials.navbar')
@include('partials.sidebar')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Arsip Dokumen</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Arsip Dokumen</li>
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
                                    <h3 class="card-title">DataTable Arsip</h3>
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
                                    @foreach ($file as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->document->title }}</td>
                                            <td>{{ $item->file_name ?? '-' }}</td>
                                            <td>{{ $item->document->category->name }}</td>
                                            <td>
                                                @php $size = $item->file_size ?? 0; @endphp
                                                @if ($size >= 1048576)
                                                    {{ number_format($size / 1048576, 2) }} MB
                                                @elseif ($size >= 1024)
                                                    {{ number_format($size / 1024, 2) }} KB
                                                @else
                                                    {{ $size }} bytes
                                                @endif
                                            </td>
                                            <td>{{ $item->document->expired_at ? \Carbon\Carbon::parse($item->document->expired_at)->format('d F Y') : '-' }}
                                            </td>
                                            <td>{{ $item->document->status }}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm btn-block">
                                                    <button type="button" class="btn btn-default dropdown-toggle"
                                                        data-toggle="dropdown">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item status" data-id="{{ $item->id }}"
                                                            url="{{ route('arsip.status', ['id' => $item->id]) }}">Active</a>
                                                    </div>
                                                    <button type="button" class="btn btn-danger delete"
                                                        url="{{ route('arsip.delete', $item->id) }}"
                                                        data-id="{{ $item->id }}">Delete</button>
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
