@extends('_partials.index')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                @if (in_array(session()->get('role'), ['P']))
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#add">Tambah Data Check
                        Up</button>
                @endif

            </div>
            <div class="card-body">
                <table class='table table-sm table-light nowrap' id="table-data">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Anak</th>
                            <th>Berat/Tinggi Lahir</th>
                            <th>Usia Saat Ukur</th>
                            <th>Tanggal Pengukuran</th>
                            <th>Berat/Tinggi Ukur</th>
                            <th>Status Gizi</th>
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

    @include('data-checkup.add')
    @include('data-checkup.edit')

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
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                }],
                responsive: true,
                ajax: {
                    url: '{{ route('checkup.datacheckup.index') }}',
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
                        data: 'nama'
                    },
                    {
                        data: {
                            berat_lahir: 'berat_lahir',
                            tinggi_lahir: 'tinggi_lahir'
                        },
                        render: function(data) {
                            return data.berat_lahir + ' Kg / ' + data.tinggi_lahir + ' cm'
                        }
                    },
                    {
                        data: 'usia_saat_periksa'
                    },
                    {
                        data: 'tanggal_pemeriksaan'
                    },
                    {
                        data: {
                            berat_badan_pemeriksaan: 'berat_badan_pemeriksaan',
                            tinggi_badan_pemeriksaan: 'tinggi_badan_pemeriksaan'
                        },
                        render: function(data) {
                            return data.berat_badan_pemeriksaan + ' Kg / ' + data
                                .tinggi_badan_pemeriksaan + ' cm'
                        }
                    },
                    {
                        data: 'status_gizi'
                    },
                    {
                        data: {
                            status_imunisasi: 'status_imunisasi',
                            status_vitamin: 'status_vitamin'
                        },
                        render: function(data) {
                            let statImunisasi, stateVitamin
                            if (data.status_imunisasi == 'N') {
                                statImunisasi =
                                    `<span class="badge bg-danger badge-pill badge-round ml-1">N</span>`
                            } else {
                                statImunisasi =
                                    `<span class="badge bg-success badge-pill badge-round ml-1 show-im" style="cursor:pointer;">Y</span>`
                            }
                            if (data.status_vitamin == 'N') {
                                stateVitamin =
                                    `<span class="badge bg-danger badge-pill badge-round ml-1">N</span>`
                            } else {
                                stateVitamin =
                                    `<span class="badge bg-success badge-pill badge-round ml-1 show-vi" style="cursor:pointer;">Y</span>`
                            }
                            return `<ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span> Imunisasi</span>
                                     ${statImunisasi}
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span> Vitamin</span>
                                     ${stateVitamin}
                                </li>
                                
                            </ul>`

                        }
                    },
                    {
                        data: {
                            id: 'id'
                        },
                        render: function(d) {
                            return `<button class="btn btn-secondary waves-effect waves-light btn-xs view" data-id="${d.id}">Lihat CheckUP</button>`
                        }
                    }
                ],
                deferRender: true,
                displayLength: 25,
            });

            function formatImunisasi(d) {
                let tr = ''
                d.checkup_imunisasi.forEach(item => {
                    tr += ` <tr>
                                <td class="text-bold-500">${item.tanggal_beri}</td>
                                <td>${item.data_jenis_imunisasi.jenis_imunisasi}</td>
                                <td class="text-bold-500">${item.dosis}</td>
                            </tr>`
                });
                return (
                    `<table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Tanggal Beri</th>
                                <th>Jenis Imunisasi</th>
                                <th>Dosis</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${tr}
                        </tbody>
                    </table>`
                );
            }

            function formatVitamin(d) {
                let tr = ''
                d.checkup_vitamin.forEach(item => {
                    tr += ` <tr>
                                <td class="text-bold-500">${item.tanggal_beri}</td>
                                <td>${item.data_jenis_vitamin.nama_vitamin}</td>
                                <td class="text-bold-500">${item.dosis}</td>
                            </tr>`
                });
                return (
                    `<table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Tanggal Beri</th>
                                <th>Jenis Vitamin</th>
                                <th>Dosis</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${tr}
                        </tbody>
                    </table>`
                );
            }

            var detailRows = [];

            $('#table-data').on('click', '.show-im', function() {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                var idx = detailRows.indexOf(tr.attr('id'));

                if (row.child.isShown()) {
                    tr.removeClass('details');
                    row.child.hide();

                    // Remove from the 'open' array
                    detailRows.splice(idx, 1);
                } else {
                    tr.addClass('details');
                    row.child(formatImunisasi(row.data())).show();

                    // Add to the 'open' array
                    if (idx === -1) {
                        detailRows.push(tr.attr('id'));
                    }
                }
            });

            $('#table-data').on('click', '.show-vi', function() {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                var idx = detailRows.indexOf(tr.attr('id'));

                if (row.child.isShown()) {
                    tr.removeClass('details');
                    row.child.hide();

                    // Remove from the 'open' array
                    detailRows.splice(idx, 1);
                } else {
                    tr.addClass('details');
                    row.child(formatVitamin(row.data())).show();

                    // Add to the 'open' array
                    if (idx === -1) {
                        detailRows.push(tr.attr('id'));
                    }
                }
            });

            $('#table-data').on('click', '.view', function() {
                let id = $(this).data('id')
                let detail_ortu = $('#detail-ortu').find('.ortu');
                let detail_anak = $('#detail-anak').find('.anak');
                let detail_checkup = $('#detail-checkup').find('.checkup');

                const url =
                    '{{ route('checkup.datacheckup.show', ['datacheckup' => ':idData']) }}'
                    .replace(':idData',
                        id);
                const requestOptions = {
                    method: 'GET',
                };

                fetch(url, requestOptions)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        let dataOrtu = data.data_anak.data_ibu
                        let dataAnak = data.data_anak
                        let dataPosyandu = data.data_posyandu.nama_posyandu
                        let dataCheckup = data
                        let dataImun = data.data_imunisasi
                        let dataVitamin = data.data_vitamin
                        $('#nama_posyandu').text(dataPosyandu)
                        $.each(detail_ortu, function(indexInArray, valueOfElement) {
                            let attr = $(valueOfElement).attr('id')
                            let textContent = dataOrtu[attr];
                            $(this).text(textContent);
                        });
                        $.each(detail_anak, function(indexInArray, valueOfElement) {
                            let attr = $(valueOfElement).attr('id')
                            let textContent = dataAnak[attr];
                            $(this).text(textContent);
                        });
                        $.each(detail_checkup, function(indexInArray, valueOfElement) {
                            let attr = $(valueOfElement).attr('id')
                            let textContent = dataCheckup[attr];
                            $(this).text(textContent);
                        });

                        dataImun.forEach((element, indexs) => {
                            $('#rincian-imunisasi').append(`<tr>
                                <td class="text-bold-500">${indexs + 1}</td>
                                <td class="text-bold-500">${element.tanggal_beri}</td>
                                <td>${element.data_jenis_imunisasi.jenis_imunisasi}</td>
                                <td class="text-bold-500">${element.dosis}</td>
                            </tr>`)
                        });

                        dataVitamin.forEach((element, index) => {
                            $('#rincian-vitamin').append(`<tr>
                                <td class="text-bold-500">${index + 1}</td>
                                <td class="text-bold-500">${element.tanggal_beri}</td>
                                <td>${element.data_jenis_vitamin.nama_vitamin}</td>
                                <td class="text-bold-500">${element.dosis}</td>
                            </tr>`)
                        });

                    })
                    .catch(error => {
                        console.error(error);
                    });

                $('#edit').modal('show')
            })

            $(".date-lahir").flatpickr({
                enableTime: false,
                dateFormat: "Y-m-d",
            });

            $('#add,#edit,#hapus').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('button[type="submit"]').click(function() {
                $("button[type='submit']").removeAttr("clicked");
                $(this).attr("clicked", "true");
            });

            $('form#form-add').submit(function(e) {
                e.preventDefault();
                e.stopPropagation()

                var action = $('button[type="submit"][clicked=true]').val();

                let stateSubmit = action === 'saveAndClose' ? true : false

                console.log(stateSubmit)

                let formDataArray = new FormData(this)
                const url = '{{ route('checkup.datacheckup.store') }}';
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
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Your work has been saved",
                            showConfirmButton: false,
                            timer: 1000
                        }).then((result) => {
                            if (stateSubmit) {
                                window.location.reload()
                                $('#add').modal('hide')
                            } else {
                                $('.checklist-imunisasi').prop({
                                    'disabled': true,
                                    'checked': false
                                });
                                $('.checklist-vitamin').prop({
                                    'disabled': true,
                                    'checked': false
                                });
                                $('#searchResults').empty();
                                $('form#form-add')[0].reset()
                            }
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
                const url =
                    '{{ route('jenisvitamin.datajenisvitamin.update', ['datajenisvitamin' => ':idData']) }}'
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
                    '{{ route('jenisvitamin.datajenisvitamin.destroy', ['datajenisvitamin' => ':idData']) }}'
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
