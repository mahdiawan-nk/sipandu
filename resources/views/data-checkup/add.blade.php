<style>
    .cursor-pointer {
        cursor: pointer;
    }

    .cursor-pointer:hover {
        background-color: hsla(0, 0%, 98%, 0.812);
    }

    /* div.dataTables_srollHeadInner{
        box-sizing: content-box;
        width: 747.5px;
        padding-right: 0px;
    } */
</style>
<div class="modal fade text-left" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen" role="document">
        <form class="modal-content form form-vertical" method="POST" id="form-add">
            @csrf
            <div class="modal-header bg-secondary">
                <h5 class="modal-title white" id="myModalLabel160">Form Check Up</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-body">

                    <div class="row bg-info p-3 rounded rounded-3">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="nik" class="form-label">Cari Data Anak</label>
                                <input type="search" class="form-control" id="searchInput" placeholder="Cari Berdasarkan [Nama Anak][Nama Ortu][NIK Ortu]">
                            </div>
                        </div>
                        <div class="col-12">
                            <ul class="list-group list-group-flush p-2" id="searchResults"
                                style="overflow-y: scroll;max-height:8rem">

                            </ul>
                        </div>
                    </div>
                    <div class="row d-none form-data">
                        <div class="col-12">
                            <hr>
                            <div class="row">
                                <div class="col-sm-6 mx-auto d-block">
                                    <div class="d-table w-100">
                                        <div class="d-table-row">
                                            <div class="d-table-cell w-25"><strong>Nama Orang Tua</strong></div>
                                            <div class="d-table-cell"><strong>:</strong></div>
                                            <div class="d-table-cell ps-2" id="v-ortu"></div>
                                        </div>
                                        <div class="d-table-row">
                                            <div class="d-table-cell w-25"><strong>Nama Anak</strong></div>
                                            <div class="d-table-cell"><strong>:</strong></div>
                                            <div class="d-table-cell ps-2" id="v-anak"></div>
                                        </div>
                                        <div class="d-table-row">
                                            <div class="d-table-cell w-25"><strong>Tanggal Lahir</strong></div>
                                            <div class="d-table-cell"><strong>:</strong></div>
                                            <div class="d-table-cell ps-2" id="v-lahir"></div>
                                        </div>
                                        <div class="d-table-row">
                                            <div class="d-table-cell w-25"><strong>Jenis Kelamin</strong></div>
                                            <div class="d-table-cell"><strong>:</strong></div>
                                            <div class="d-table-cell ps-2" id="v-kelamin"></div>
                                        </div>
                                        <div class="d-table-row">
                                            <div class="d-table-cell w-25"><strong>Berat Lahir</strong></div>
                                            <div class="d-table-cell"><strong>:</strong></div>
                                            <div class="d-table-cell ps-2" id="v-bb"></div>
                                        </div>
                                        <div class="d-table-row">
                                            <div class="d-table-cell w-25"><strong>Tinggi Lahir</strong></div>
                                            <div class="d-table-cell"><strong>:</strong></div>
                                            <div class="d-table-cell ps-2" id="v-bt"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                </div>
                            </div>

                            <hr>
                        </div>
                    </div>
                    <div class="row d-none form-data">
                        <div class="col-2">
                            <div class="form-group mb-3">
                                <input type="hidden" value="{{ session()->get('posyandu') }}" id="id_posyandu"
                                    name="id_posyandu">
                                <input type="hidden" value="" id="id_anak" name="id_anak">
                                <label for="name" class="form-label">Tanggal Periksa</label>
                                <input type="text" class="form-control" name="tanggal_pemeriksaan" readonly
                                    value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Usia Saat Pemeriksaan</label>
                                <input type="text" class="form-control" id="usia_periksa" name="usia_saat_periksa"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Berat Badan</label>
                                <input type="text" class="form-control" id="dosis"
                                    name="berat_badan_pemeriksaan" required>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Tinggi Badan</label>
                                <input type="text" class="form-control" id="dosis"
                                    name="tinggi_badan_pemeriksaan" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group mb-3">
                                <label for="riwayat_kesehatan" class="form-label">Status Gizi</label>
                                <input type="text" class="form-control" id="dosis" name="status_gizi"
                                    required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-3 ">
                                <label for="name" class="form-label d-block">Pemberian Imunisasi</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status_imunisasi"
                                        id="imunisasi_y" value="Y">
                                    <label class="form-check-label" for="imunisasi_y">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status_imunisasi"
                                        id="imunisasi_n" value="N" checked>
                                    <label class="form-check-label" for="imunisasi_n">Tidak</label>
                                </div>
                            </div>
                            <div class="row">
                                <table class="table table-sm" id="table-imunisasi" style="width: 750px">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Tanggal Pemberian</th>
                                            <th>Nama Imunisasi</th>
                                            <th>Dosis</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-3 ">
                                <label for="name" class="form-label d-block">Pemberian Vitamin</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status_vitamin"
                                        id="vitamin_y" value="Y">
                                    <label class="form-check-label" for="vitamin_y">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status_vitamin"
                                        id="vitamin_n" value="N" checked>
                                    <label class="form-check-label" for="vitamin_n">Tidak</label>
                                </div>
                            </div>
                            <div class="row" id="v-vitamin">
                                <div class="table-responsive">
                                    <table class="table table-sm" id="table-vitamin">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Tanggal Pemberian</th>
                                                <th>Jenis Vitamin</th>
                                                <th>Dosis</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <button type="submit" class="btn btn-secondary ml-1" name="action" value="saveAndClose">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Simpan Dan Tutup</span>
                </button>
                <button type="submit" class="btn btn-secondary ml-1" name="action" value="saveAndNew">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Simpan Dan Buat Data Baru</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    var tableImunisasi = $('#table-imunisasi').DataTable({
        paging: false,
        scrollCollapse: false,
        scrollY: '25vh',
        ajax: {
            url: '{{ route('jenisimunisasi.datajenisimunisasi.index') }}',
            type: "GET",
            dataSrc: "",
        },
        columns: [{
                data: 'id',
                render: function(data) {
                    return `<input type="checkbox" class="form-check-input form-check-primary checklist-imunisasi" value="${data}" name="checklis_imunisasi[]" disabled data-id="${data}">`
                }
            },
            {
                data: 'id',
                render: function(data) {
                    return `<input type="text" name="tgl_beri_imunisasi[${data}]" value="" class="form-control tgl-beri" readonly required>`
                }
            },
            {
                data: 'jenis_imunisasi'
            },
            {
                data: {
                    id: 'id'
                },
                render: function(d) {
                    return `<input type="text" name="dosis_imunisasi[${d.id}]"" value="" class="form-control" readonly id="dosis-imunisasi-${d.id}" required>`
                }
            },
        ],
        // deferRender: true,
        "destroy": true
    });

    var tableVitamin = $('#table-vitamin').DataTable({
        paging: false,
        scrollCollapse: false,
        scrollY: '25vh',
        ajax: {
            url: '{{ route('jenisvitamin.datajenisvitamin.index') }}',
            type: "GET",
            dataSrc: "",
        },
        columns: [{
                data: 'id',
                render: function(data) {
                    return `<input type="checkbox" class="form-check-input form-check-primary checklist-vitamin" value="${data}" name="checklis_vitamin[]" disabled data-id="${data}">`
                }
            },
            {
                data: 'id',
                render: function(data) {
                    return `<input type="text" value="" name="tgl_beri_vitamin[${data}]" class="form-control tgl-beri" readonly required>`
                }
            },
            {
                data: 'nama_vitamin'
            },
            {
                data: {
                    id: 'id',
                    dosis: 'dosis'
                },
                render: function(d) {
                    return `<input type="text" name="dosis_vitamin[${d.id}]" value="${d.dosis}" class="form-control" readonly id="dosis-vitamin-${d.id}" required>`
                }
            },
        ],
        // deferRender: true,
        "destroy": true
    });



    $('#add').on('shown.bs.modal', function() {
        let dd = $('div.dataTables_scrollHeadInner').children('table')
        dd.css({
            'width': '750px',
        })

    })

    tableImunisasi.on('draw', function() {
        $('td .tgl-beri').flatpickr({
            enableTime: false,
            dateFormat: "Y-m-d",
            defaultDate: moment().format('YYYY-MM-DD')
        });
    });

    tableVitamin.on('draw', function() {
        $('td .tgl-beri').flatpickr({
            enableTime: false,
            dateFormat: "Y-m-d",
            defaultDate: moment().format('YYYY-MM-DD')
        });
    });

    $('#searchInput').on('input', function() {
        let searchTerm = $(this).val();

        $.ajax({
            url: "{{ route('search') }}",
            method: 'GET',
            data: {
                searchTerm: searchTerm
            },
            success: function(response) {
                let results = $('#searchResults');
                results.empty();
                if (response.length > 0) {
                    $.each(response, function(index, item) {
                        let data = [item.id, item.ibu, item.nama, item.jenis_kelamin, item
                            .berat_lahir, item.tinggi_lahir, item.tanggal_lahir, item
                            .tanggal_lahir
                        ]
                        results.append(
                            `<li class="list-group-item cursor-pointer selectedData" onclick="selectedData('${data}')">
                            <div class="d-table w-100">
                                <div class="d-table-row">
                                    <div class="d-table-cell w-25"><strong>Nama Orang Tua</strong></div>
                                    <div class="d-table-cell"><strong>:</strong></div>
                                    <div class="d-table-cell ps-2">${item.ibu}</div>
                                </div>
                                <div class="d-table-row">
                                    <div class="d-table-cell w-25"><strong>Nama Anak</strong></div>
                                    <div class="d-table-cell"><strong>:</strong></div>
                                    <div class="d-table-cell ps-2">${item.nama}</div>
                                </div>
                                <div class="d-table-row">
                                    <div class="d-table-cell w-25"><strong>Tanggal lahir</strong></div>
                                    <div class="d-table-cell"><strong>:</strong></div>
                                    <div class="d-table-cell ps-2">${item.tanggal_lahir}</div>
                                </div>
                                <div class="d-table-row">
                                    <div class="d-table-cell w-25"><strong>Jenis Kelamin</strong></div>
                                    <div class="d-table-cell"><strong>:</strong></div>
                                    <div class="d-table-cell ps-2">${item.jenis_kelamin}</div>
                                </div>
                                <div class="d-table-row">
                                    <div class="d-table-cell w-25"><strong>Berat Lahir</strong></div>
                                    <div class="d-table-cell"><strong>:</strong></div>
                                    <div class="d-table-cell ps-2">${item.berat_lahir}</div>
                                </div>
                                <div class="d-table-row">
                                    <div class="d-table-cell w-25"><strong>Tinggi Lahir</strong></div>
                                    <div class="d-table-cell"><strong>:</strong></div>
                                    <div class="d-table-cell ps-2">${item.tinggi_lahir}</div>
                                </div>
                            </div>
                        </li>`
                        );
                    });
                } else {
                    results.append('<li class="list-group-item">No results found</li>');
                }
            }
        });
    });

    $('[name="status_imunisasi"]').on('click', function() {
        let selectedValue = $('[name="status_imunisasi"]:checked').val();

        if (selectedValue == 'Y') {
            $('.checklist-imunisasi').prop({
                'disabled': false,
                'checked': false
            });
        } else {
            $('.checklist-imunisasi').prop({
                'disabled': true,
                'checked': false
            });
        }
    });


    $('[name="status_vitamin"]').on('click', function() {
        let selectedValue = $('[name="status_vitamin"]:checked').val();
        if (selectedValue == 'Y') {
            $('.checklist-vitamin').prop({
                'disabled': false,
                'checked': false
            });
        } else {
            $('.checklist-vitamin').prop({
                'disabled': true,
                'checked': false
            });
        }
    });

    $('#table-imunisasi').on('click','.checklist-imunisasi',function(){
        let id = $(this).data('id');
        let status = $(this).prop('checked');
        if(status){
            $('#dosis-imunisasi-'+id).removeAttr('readonly')
        }else{
            $('#dosis-imunisasi-'+id).attr('readonly','readonly')
        }
    })

    $('#table-vitamin').on('click','.checklist-vitamin',function(){
        let id = $(this).data('id');
        let status = $(this).prop('checked');
        if(status){
            $('#dosis-vitamin-'+id).removeAttr('readonly')
        }else{
            $('#dosis-vitamin-'+id).attr('readonly','readonly')
        }
    })
    function selectedData(item) {
        let dataArray = item.split(',');
        $('#id_anak').val(dataArray[0])
        $('#searchResults').empty();
        $('#searchInput').val('');
        $('#usia_periksa').val(hitungUsia(dataArray[6]))
        $('#v-ortu').text(dataArray[1])
        $('#v-anak').text(dataArray[2])
        $('#v-kelamin').text(dataArray[3])
        $('#v-lahir').text(dataArray[6])
        $('#v-bb').text(dataArray[4])
        $('#v-bt').text(dataArray[5])
        $('.form-data').removeClass('d-none');
    }

    function hitungUsia(tanggalLahir) {
        let today = moment(); // Mengambil tanggal saat ini
        let dob = moment(tanggalLahir); // Mengonversi tanggal lahir menjadi objek Moment

        // Menghitung perbedaan waktu antara tanggal lahir dan tanggal saat ini
        let usiaTahun = today.diff(dob, 'years');
        dob.add(usiaTahun, 'years'); // Menambahkan tahun yang telah dihitung
        let usiaBulan = today.diff(dob, 'months');
        dob.add(usiaBulan, 'months'); // Menambahkan bulan yang telah dihitung
        let usiaHari = today.diff(dob, 'days');

        return `${usiaTahun} Tahun - ${usiaBulan} Bulan - ${usiaHari} hari`
    }
</script>
