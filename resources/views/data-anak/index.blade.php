@extends('_partials.index')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#add"><i
                        class="fa-solid fa-user-plus me-1"></i> Tambah Data Anak</button>
            </div>
            <div class="card-body">
                <table class='table table-sm table-striped nowrap' id="table-data">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Ibu </th>
                            <th>Nama Anak</th>
                            <th>Jenis Kelamin</th>
                            <th>Tmp Lahir / Tgl Lahir</th>
                            <th>Pengukuran</th>
                            <th>Riwayat Kesehatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </section>

    @include('data-anak.add')
    @include('data-anak.edit')

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
                    url: '{{ route('anak.dataanak.index') }}',
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
                        data: 'ibu'
                    },
                    {
                        data: 'nama'
                    },
                    {
                        data: 'jenis_kelamin'
                    },
                    {
                        data: {
                            tempat_lahir: 'tempat_lahir',
                            tanggal_lahir: 'tanggal_lahir'
                        },
                        render: function(data) {
                            return data.tempat_lahir + ', ' + data.tanggal_lahir
                        }
                    },
                    {
                        data: {
                            berat_lahir: 'berat_lahir',
                            tinggi_lahir: 'tinggi_lahir'
                        },
                        render: function(data) {
                            return `<span class="d-block">Berat lahir : ${data.berat_lahir} kg </span><span>Tinggi Lahir : ${data.tinggi_lahir} cm</span>`
                        }
                    },
                    {
                        data: 'riwayat_kesehatan'
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
                const url = '{{ route('anak.dataanak.store') }}';
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
                dataIbu('#edit')
                let data = table.row($(this).parents('tr')).data()
                idData = data.id
                console.log(data)
                $('#e-id_ibu').val(data.id_ibu).trigger('change'); 
                $('[name="nama"]').val(data.nama)
                if(data.jenis_kelamin == 'L'){
                    $('#jenis_l').prop('checked', true);
                }else{
                    $('#jenis_p').prop('checked', true);
                }
                $('[name="jenis_kelamin"]').val(data.jenis_kelamin)
                $('[name="tempat_lahir"]').val(data.tempat_lahir)
                $('[name="tanggal_lahir"]').val(data.tanggal_lahir)
                $('[name="berat_lahir"]').val(data.berat_lahir)
                $('[name="tinggi_lahir"]').val(data.tinggi_lahir)
                $('[name="riwayat_kesehatan"]').val(data.riwayat_kesehatan)
                
                $('#edit').modal('show')
            });

            $('form#form-edit').submit(function(e) {
                e.preventDefault();
                e.stopPropagation()
                let formDataArray = new FormData(this)
                const url = '{{ route('anak.dataanak.update', ['dataanak' => ':idData']) }}'.replace(':idData',
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
                const url = '{{ route('anak.dataanak.destroy', ['dataanak' => ':id']) }}'.replace(':id',
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

        dataIbu()

        function dataIbu(elm = '#add') {

            const url = '{{ route('ibu.dataibu.index') }}';
            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok.');
                    }
                    return response.json();
                })
                .then(data => {
                    let result = [{
                        id:'',
                        text:'Pilih'
                    }]
                    data.forEach(item => {
                        result.push({
                            id: item.id,
                            text: item.nama
                        })
                    });

                    $('#id_ibu,#e-id_ibu').select2({
                        dropdownParent: $(elm),
                        width: '100%',
                        theme: 'bootstrap-5',
                        allowClear: true,
                        placeholder: 'Masukan Nama Ibu',
                        data: result
                    })
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });

        }

        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode;

            // Allow only numbers (0-9) and some special keys like backspace, delete, arrow keys, etc.
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }

        function validateNumberInput(input) {
            // Remove any non-numeric characters using regular expression
            input.value = input.value.replace(/\D/g, '');

            // Limit the length to a maximum of 16 characters
            if (input.value.length > 16) {
                input.value = input.value.slice(0, 16);
            }
        }
    </script>
@endsection
