@include('partials.header')
@include('partials.navbar')
@include('partials.sidebar')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tags</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dahboard</a></li>
                        <li class="breadcrumb-item active">Tags</li>
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
                                    <h3 class="card-title">DataTable Tags</h3>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-success float-right" data-toggle="modal"
                                        data-target="#addTags">Tambah Tags</button>
                                </div>
                            </div>
                        </div>
                        @include('admin.tags.create')
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tags</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tags as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm btn-block">
                                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                                        data-target="#editTags{{ $item->id }}">Edit</button>
                                                    <button type="button" class="btn btn-danger delete"
                                                        url="{{ route('tag.delete', $item->id) }}"
                                                        data-id="{{ $item->id }}">Delete</button>
                                                </div>
                                                @include('admin.tags.edit')
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
