@include('partials.header')
@include('partials.navbar')
@include('partials.sidebar')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pengingat Dokumen</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pengingat Dokumen</li>
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
                                    <h3 class="card-title">DataTable Pengingat</h3>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-success float-right" data-toggle="modal"
                                        data-target="#addPengingat">Tambah Pengingat</button>
                                </div>
                            </div>
                        </div>
                        @include('admin.reminders.create')
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Dokumen</th>
                                        <th>Tanggal Pengingat</th>
                                        <th>Pesan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reminders as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->document->title }}</td>
                                            <td>{{ Carbon\Carbon::parse($item->remind_at)->format('d F Y') }}</td>
                                            <td>{{ Str::limit($item->message, 30) }}</td>
                                            <td>
                                                @if ($item->is_sent == 1)
                                                    <span class="badge badge-success">Sudah Dibaca</span>
                                                @elseif($item->is_sent == 0)
                                                    <span class="badge badge-warning">Belum Dikirim</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm btn-block">
                                                    @if (!$item->is_sent)
                                                        <button type="button" class="btn btn-primary status"
                                                            url="{{ route('reminder.read', $item->id) }}"
                                                            data-id="{{ $item->id }}">Tandai
                                                            Dibaca</button>
                                                    @endif
                                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                                        data-target="#editPengingat{{ $item->id }}">Edit</button>
                                                    <button type="button" class="btn btn-danger delete"
                                                        url="{{ route('reminder.delete', $item->id) }}"
                                                        data-id="{{ $item->id }}">Delete</button>
                                                </div>
                                                @include('admin.reminders.edit')
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
