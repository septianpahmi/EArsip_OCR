<div class="modal fade" id="editUsers{{ $users->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Pengguna</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('users.edit', $users->id) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Nama Pengguna<code>*</code></label>
                                <input type="text" class="form-control" id="name" value="{{ $users->name }}"
                                    name="name" placeholder="Masukan nama pengguna ..." autofocus required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="email">Email<code>*</code></label>
                                <input type="email" class="form-control" value="{{ $users->email }}" id="email"
                                    name="email" placeholder="Masukan email pengguna ..." required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="password">Password<code>*</code></label>
                                <input type="text" class="form-control" id="password" name="password"
                                    placeholder="Masukan password ..." required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="role">Hak Akses<code>*</code></label>
                                <select type="text" class="form-control" id="role" name="role" required>
                                    <option value="" selected disabled>-- Pilih Hak Akses --</option>
                                    <option value="admin">Admin</option>
                                    <option value="tata usaha">Tata Usaha</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
