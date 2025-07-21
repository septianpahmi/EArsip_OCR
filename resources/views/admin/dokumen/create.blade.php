@include('partials.header')
@include('partials.navbar')
@include('partials.sidebar')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Upload Manual</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Upload Manual</li>
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
                                    <h3 class="card-title">Upload Dokumen</h3>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('document.post') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="title">Judul<code>*</code></label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                placeholder="Masukan judul ..." required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Input file<code>*</code></label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="file"
                                                        id="exampleInputFile">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="expired_at">Tanggal Kadaluarsa</label>
                                            <input type="date" class="form-control" id="expired_at"
                                                name="expired_at">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="category_id">Pilih Kategori<code>*</code></label>
                                            <select type="text" class="form-control" id="category_id"
                                                name="category_id" required>
                                                <option value="" selected disabled>-- Pilih Kategori --</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group">
                                            <label>Tags<code>*</code></label>
                                            <div class="select2-primary">
                                                <select class="select2" multiple="multiple" name="tag_id[]"
                                                    data-placeholder="Select Tags"
                                                    data-dropdown-css-class="select2-primary" style="width: 100%;">
                                                    @foreach ($tags as $tag)
                                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="description">Deskripsi</label>
                                            <input type="text" class="form-control" id="description"
                                                name="description" placeholder="Masukan deskripsi ...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials.footer')
