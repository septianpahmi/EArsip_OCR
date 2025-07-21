@include('partials.header')
@include('partials.navbar')
@include('partials.sidebar')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Klasifikasi Otomatis</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Klasifikasi Otomatis</li>
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
                                    <h3 class="card-title">Upload Dokumen Otomatis</h3>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('documentOcr.post') }}" method="POST" id="uploadForm"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Input file<code>*</code></label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="file"
                                                        id="fileInput">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="expired_at">Tanggal Kadaluarsa</label>
                                            <input type="date" class="form-control" id="expired_at"
                                                name="expired_at">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
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
                                    <div class="col-12 col-sm-12">
                                        <div class="form-group mt-3">
                                            <label for="previewText">Preview Isi PDF</label>
                                            <textarea class="form-control" id="previewText" rows="10" readonly></textarea>
                                        </div>
                                        <!-- /.form-group -->
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
