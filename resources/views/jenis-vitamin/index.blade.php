@extends('_partials.index')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#add">Tambah Data Jenis Vitamin</button>
            </div>
            <div class="card-body">
                <table class='table table-sm table-striped nowrap' id="table-data">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Vitamin</th>
                            <th>Nama Vitamin</th>
                            <th>Dosis</th>
                            <th>Jenis</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </section>

    @include('jenis-vitamin.add')
    @include('jenis-vitamin.edit')

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

                responsive: true,
                ajax: {
                    url: '{{ route('jenisvitamin.datajenisvitamin.index') }}',
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
                        data: 'kode_vitamin'
                    },
                    {
                        data: 'nama_vitamin'
                    },
                    {
                        data: 'dosis'
                    },
                    {
                        data: 'jenis'
                    },
                    {
                        data: 'keterangan'
                    },
                    {
                        data: {
                            id: 'id'
                        },
                        render: function(d) {
                            return `<button class="btn btn-secondary waves-effect waves-light btn-xs edit">Edit</button>
                                        <button class="btn btn-danger waves-effect waves-light btn-xs hapus">Hapus</button>`
                        }
                    }
                ],
                deferRender: true,
                displayLength: 25,
            });

            $(".date-lahir").flatpickr({
                enableTime: false,
                dateFormat: "Y-m-d",
            });

            $('#add,#edit,#hapus').modal({
                backdrop: 'static',
                keyboard: false
            });

            $('form#form-add').submit(function(e) {
                e.preventDefault();
                e.stopPropagation()

                let formDataArray = new FormData(this)
                const url = '{{ route('jenisvitamin.datajenisvitamin.store') }}';
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
                $('[name="kode_vitamin"]').val(data.kode_vitamin)
                $('[name="nama_vitamin"]').val(data.nama_vitamin)
                $('[name="dosis"]').val(data.dosis)
                $('[name="jenis"]').val(data.jenis)
                $('[name="keterangan"]').val(data.keterangan)
                $('#edit').modal('show')
            });

            $('form#form-edit').submit(function(e) {
                e.preventDefault();
                e.stopPropagation()
                let formDataArray = new FormData(this)
                const url = '{{ route('jenisvitamin.datajenisvitamin.update', ['datajenisvitamin' => ':idData']) }}'.replace(':idData',
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
                const url = '{{ route('jenisvitamin.datajenisvitamin.destroy', ['datajenisvitamin' => ':idData']) }}'.replace(':idData',
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
