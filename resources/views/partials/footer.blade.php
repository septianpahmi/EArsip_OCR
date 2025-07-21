<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="dist/js/adminlte.js"></script>
<script src="dist/js/pages/dashboard3.js"></script>
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('.delete').click(function() {
        var dataid = $(this).attr('data-id');
        var url = $(this).attr('url')
        Swal.fire({
            title: "Anda Yakin?",
            text: "Setelah dihapus, Anda tidak akan dapat memulihkan data ini!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "" + url + ""

            }

        });
    });
</script>

<script>
    $('.status').click(function() {
        var dataid = $(this).attr('data-id');
        var url = $(this).attr('url')
        Swal.fire({
            title: "Anda Yakin?",
            text: "Setelah dirubah, Anda tidak akan dapat memulihkan data ini!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, change it!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "" + url + ""

            }

        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    @if (Session::has('success'))
        Swal.fire({
            title: "Berhasil!",
            text: "{{ Session::get('success') }}",
            icon: "success"
        });
    @endif
    @if (Session::has('error'))
        toastr.options.closeButton = true;
        toastr.error("{{ Session::get('error') }}", 'Gagal!')
    @endif
</script>
<!-- bs-custom-file-input -->
<script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
    $(function() {
        bsCustomFileInput.init();
    });
</script>
<!-- Select2 -->
<script src="../../plugins/select2/js/select2.full.min.js"></script>
<script>
    $(function() {
        $('.select2').select2()

        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    })
</script>
<script>
    $('#fileInput').on('change', function() {
        let file = this.files[0];
        if (file && file.type === "application/pdf") {
            let formData = new FormData();
            formData.append('file', file);
            formData.append('_token', '{{ csrf_token() }}');

            $.ajax({
                url: "{{ route('pdf.parse') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#previewText').val(response.text);
                },
                error: function(xhr) {
                    let message = xhr.responseJSON?.error || "Terjadi kesalahan saat parsing.";
                    $('#previewText').val(message);
                }
            });
        } else {
            $('#previewText').val("File bukan PDF.");
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('#tagSearchInput').on('keyup', function() {
            let query = $(this).val();

            // Kosongkan hasil jika query terlalu pendek
            if (query.length < 2) {
                $('#tagSearchResult').remove();
                return;
            }

            $.ajax({
                url: '{{ route('search.tags') }}',
                type: 'GET',
                data: {
                    query: query
                },
                beforeSend: function() {
                    $('#tagSearchResult').remove(); // Hapus sebelum request baru
                },
                success: function(response) {
                    let html = '';

                    if (response.length > 0) {
                        html += '<ul class="list-group list-group-flush">';
                        response.forEach(file => {
                            html += `
                                <li class="list-group-item">
                                    <strong>${file.document?.title || 'Tanpa Judul'}</strong><br>
                                </li>`;
                        });
                        html += '</ul>';
                    } else {
                        html = '<p class="text-muted p-2 mb-0">Tidak ditemukan.</p>';
                    }

                    $('.navbar-search-block').append(`
                        <div id="tagSearchResult" class="dropdown-menu show p-2 w-100" style="position: absolute; z-index: 999;">
                            ${html}
                        </div>
                    `);
                }
            });
        });

        // Tutup hasil pencarian saat tombol close diklik
        $('[data-widget="navbar-search"]').on('click', function() {
            $('#tagSearchResult').remove();
        });
    });
</script>

</body>

</html>
