@extends('_partials.index')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#add">Tambah Pengguna</button>
            </div>
            <div class="card-body">
                <table class='table table-sm table-striped nowrap' id="table-data">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pengguna</th>
                            <th>Email Pengguna</th>
                            <th>Role</th>
                            <th>Status Akun</th>
                            <th>Posyandu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </section>

    @include('data-pengguna.add')
    @include('data-pengguna.edit')

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
                    url: '{{ route('pengguna.pengguna.index') }}',
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
                        data: 'nama_pengguna'
                    },
                    {
                        data: 'email_pengguna'
                    },
                    {
                        data: 'role',
                        render: function(data) {
                            if (data == 'P') {
                                return 'Posyandu'
                            } else {
                                return 'Adminstrator'
                            }
                        }
                    },
                    {
                        data: 'status_akun',
                        render: function(data) {
                            if (data == 'Y') {
                                return '<span class="badge bg-success">Aktif</span>'
                            } else {
                                return '<span class="badge bg-danger">Suspend</span>'
                            }
                        }
                    },
                    {
                        data: 'posyandu'
                    },
                    {
                        data: {
                            id: 'id',
                            role: "role"
                        },
                        render: function(d) {
                            if (d.role == 'A') {
                                return `<div class="btn-group-xs">
                                            <button class="btn btn-secondary waves-effect waves-light btn-block btn-xs edit">Edit</button>
                                        </div>`
                            } else {
                                return `<button class="btn btn-secondary waves-effect waves-light btn-xs edit">Edit</button>
                                        <button class="btn btn-danger waves-effect waves-light btn-xs hapus">Hapus</button>`
                            }

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
            $('#edit').on('show.bs.modal', function() {
                dataPosyandu('#edit')
                console.log('run')
            });

            $('form#form-add').submit(function(e) {
                e.preventDefault();
                e.stopPropagation()

                let formDataArray = new FormData(this)
                const url = '{{ route('pengguna.pengguna.store') }}';
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
                        console.log(data)
                        if (data.status) {
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
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "Email Sudah Terdaftar!",
                            });
                        }

                    })
                    .catch(error => {
                        console.error(error);
                    });

            });

            table.on('click', '.edit', function() {
                let data = table.row($(this).parents('tr')).data()

                idData = data.id
                $('#e-role[name="role"]').val(data.role).trigger('change')
                if (data.role == 'P') {
                    $('.e-posyandu').removeClass('d-none');
                } else {
                    $('.e-posyandu').addClass('d-none');
                }

                $('#e-id_posyandu').val(data.id_posyandu).trigger(
                    'change');
                console.log(data.id_posyandu)
                $('#e-nama_pengguna[name="nama_pengguna"]').val(data.nama_pengguna)
                $('#e-email_pengguna[name="email_pengguna"]').val(data.email_pengguna)
                $('#e-password_pengguna,#e-re_password').val('')
                if (data.status_akun == 'Y') {
                    $('#e-status_y').prop('checked', true);
                } else {
                    $('#e-status_n').prop('checked', true);
                }
                $('.submited').removeAttr('disabled', false);
                $('#edit').modal('show')
            });

            $('form#form-edit').submit(function(e) {
                e.preventDefault();
                e.stopPropagation()
                let formDataArray = new FormData(this)
                const url =
                    '{{ route('pengguna.pengguna.update', ['pengguna' => ':idData']) }}'
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
                    '{{ route('pengguna.pengguna.destroy', ['pengguna' => ':idData']) }}'
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

        function dataPosyandu(elm = '#add') {

            const url = '{{ route('posyandu.dataposyandu.index') }}';
            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok.');
                    }
                    return response.json();
                })
                .then(data => {
                    let result = []
                    data.forEach(item => {
                        result.push({
                            id: item.id,
                            text: item.nama_posyandu
                        })
                    });

                    $('#id_posyandu,#e-id_posyandu').select2({
                        dropdownParent: $(elm),
                        width: '100%',
                        theme: 'bootstrap-5',
                        allowClear: true,
                        placeholder: 'Masukan Nama Posyandu',
                        data: result
                    })
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });

        }
    </script>
@endsection
