@extends('_partials.index')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <table class='table table-sm table-striped nowrap' id="table-data">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK/Nama Ortu</th>
                            <th>nama Anak</th>
                            <th>Jenis Vitamin</th>
                            <th>Tanggal Vitamin</th>
                            <th>Dosis Vitamin</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </section>

    @include('jenis-imunisasi.add')
    @include('jenis-imunisasi.edit')

    <div class="modal fade text-left" id="hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel130"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title white" id="myModalLabel130">Hapus Data Ibu</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    Anda Yakin akan menghapus data ini?<br>
                    jika dihapus data tidak dapat dipulihkan kembali
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="button" class="btn btn-danger ml-1" id="btn-hapus">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Hapus</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var idData = null
        $(document).ready(function() {
            var table = $('#table-data').DataTable({
                "dom": '<"text-center"B><"row"<"col-md-6"l><"col-md-6"f>>rt<"row"<"col-md-6"i><"col-md-6"p>>',
                buttons: [{
                    extend: 'pdfHtml5',
                    orientation: 'potrait',
                    pageSize: 'A4',
                }],
                responsive: true,
                ajax: {
                    url: '{{ route('checkvitamin.datacheckvitamin.index') }}',
                    type: "GET",
                    dataSrc: "",
                },
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'data_check_up.data_anak.data_ibu',
                        render: function(data) {
                            return `<span class="d-block">${data.nik}</span><span>${data.nama}</span>`
                        }
                    },
                    {
                        data: 'data_check_up.data_anak',
                        render: function(data) {
                            return `<span class="d-block">${data.nama}</span>`
                        }
                    },
                    {
                        data: 'data_jenis_vitamin.nama_vitamin'
                    },
                    {
                        data: 'tanggal_beri'
                    },
                    {
                        data: 'dosis'
                    }
                ],
                deferRender: true,
                displayLength: 25,
            });

            $(".date-lahir").flatpickr({
                enableTime: false,
                dateFormat: "Y-m-d",
            });
            $('#add').on('show.bs.modal', function() {
                $('#form-add')[0].reset()
            })

            $('#add,#edit,#hapus').modal({
                backdrop: 'static',
                keyboard: false
            });

            $('form#form-add').submit(function(e) {
                e.preventDefault();
                e.stopPropagation()

                let formDataArray = new FormData(this)
                const url = '{{ route('jenisimunisasi.datajenisimunisasi.store') }}';
                const requestOptions = {
                    method: 'POST',
                    body: formDataArray
                };

                fetch(url, requestOptions)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        $('#add').modal('hide')
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Your work has been saved",
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            table.ajax.reload(null, false);
                        })
                    })
                    .catch(error => {
                        console.error(error);
                    });

            });

            table.on('click', '.edit', function() {
                let data = table.row($(this).parents('tr')).data()
                idData = data.id
                $('[name="jenis_imunisasi"]').val(data.jenis_imunisasi)
                $('[name="keterangan"]').val(data.keterangan)
                $('#edit').modal('show')
            });

            $('form#form-edit').submit(function(e) {
                e.preventDefault();
                e.stopPropagation()
                let formDataArray = new FormData(this)
                const url =
                    '{{ route('jenisimunisasi.datajenisimunisasi.update', ['datajenisimunisasi' => ':idData']) }}'
                    .replace(':idData',
                        idData);
                const requestOptions = {
                    method: 'POST',
                    body: formDataArray // Ubah objek ke dalam format JSON sebelum mengirim
                };

                fetch(url, requestOptions)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log(data)
                        $('#edit').modal('hide')
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Your work has been saved",
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            idData = null
                            table.ajax.reload(null, false);
                        })
                    })
                    .catch(error => {
                        console.error(error);
                    });

            });

            table.on('click', '.hapus', function() {
                let data = table.row($(this).parents('tr')).data()
                idData = data.id
                $('#hapus').modal('show')
            });

            $('#btn-hapus').on('click', function() {
                const url =
                    '{{ route('jenisimunisasi.datajenisimunisasi.destroy', ['datajenisimunisasi' => ':idData']) }}'
                    .replace(':idData',
                        idData);
                const requestOptions = {
                    method: 'DELETE',
                };

                fetch(url, requestOptions)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        $('#hapus').modal('hide')
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Your work has been Delete",
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            idData = null
                            table.ajax.reload(null, false);
                        })
                    })
                    .catch(error => {
                        console.error('Error deleting data:', error);
                    });
            });

        });
    </script>
@endsection
