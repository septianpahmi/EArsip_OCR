<div class="modal fade" id="editPengingat{{ $item->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Pengingat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('reminder.edit', $item->id) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="document_id">Dokumen<code>*</code></label>
                                <select type="text" class="form-control" id="document_id" name="document_id"
                                    required>

                                    <option value="" selected disabled>-- Pilih Dokumen --</option>
                                    @foreach ($dokumen as $dok)
                                        <option value="{{ $dok->id }}"
                                            {{ $dok->id == $item->document_id ? 'selected' : '' }}>{{ $dok->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="remind_at">Tanggal Pengingat<code>*</code></label>
                                <input type="date" class="form-control" value="{{ $item->remind_at }}" id="remind_at"
                                    name="remind_at" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="message">Pesan Pengingat<code>*</code></label>
                                <input type="text" class="form-control" value="{{ $item->message }}"
                                    placeholder="Masukan pesan pengingat ..." id="message" name="message" required>
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
