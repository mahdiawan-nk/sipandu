@extends('_partials.index')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="btn-group btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-primary v-kalendar"><i class="fa-solid fa-calendar-days"></i>
                        Tampilan
                        Kalender</button>
                    <button type="button" class="btn v-table"><i class="fa-solid fa-table"></i> Tampilan Tabel</button>

                </div>
            </div>
            <div class="card-body" id="tampilan-table" hidden>
                @if (in_array(session()->get('role'), ['A']))
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#add"><i
                            class="fa-solid fa-plus me-1"></i> Tambah Jadwal</button>
                    <hr>
                @endif

                <div class="table-responsive">
                    <table class="table" id="table-data" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Posyandu</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-body" id="tampilan-kalendar">
                <div id="calendar"></div>
            </div>
        </div>
    </section>
    @include('data-jadwal.add')
    @include('data-jadwal.edit')
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
                    <button type="button" class="btn btn-danger ml-1" id="btn-hapus-table">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Hapus</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @if (in_array(session()->get('role'), ['A']))
        <script>
            var eventClick = true
            var selectable = true
        </script>
    @else
        <script>
            var eventClick = false
            var selectable = false
        </script>
    @endif
    <script>
        var idData = null

        $(document).ready(function() {
            var table = $('#table-data').DataTable({
                ajax: {
                    url: '{{ route('jadwalposyandu.datajadwalposyandu.index') }}',
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
                        data: 'start'
                    },
                    {
                        data: 'title'
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
                columnDefs: [{
                    target: 3,
                    visible: selectable
                }],
                deferRender: true,
                displayLength: 25,
            });


            $('#add').on('show.bs.modal', function() {
                dataPosyandu('#add')
                $("#start").flatpickr({
                    enableTime: false,
                    dateFormat: "Y-m-d",
                    onChange: function(selectedDates, dateStr, instance) {
                        $('#end').val(dateStr)
                    },
                });
            });
            $('#update').on('show.bs.modal', function() {
                $("#e-start").flatpickr({
                    enableTime: false,
                    dateFormat: "Y-m-d",
                    onChange: function(selectedDates, dateStr, instance) {
                        $('#e-end').val(dateStr)
                    },
                });
            });
            $('#update').on('hide.bs.modal', function() {
                $('#btn-hapus').removeClass('d-none')
            });
            $('#add,#update,#hapus').modal({
                backdrop: 'static',
                keyboard: false
            });
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'multiMonthYear,dayGridMonth,timeGridWeek,timeGridDay'
                },
                initialView: 'dayGridMonth',
                editable: false,
                selectable: selectable,
                select: function(info) {
                    dataPosyandu('#add')
                    $('[name="start"]').val(info.startStr)
                    $('[name="end"]').val(info.endStr)
                    $('#add').modal('show')
                },
                eventClick: function(info) {
                    if (eventClick) {
                        idData = info.event.id
                        dataPosyandu('#update')
                        $.ajax({
                            type: "GET",
                            url: '{{ route('jadwalposyandu.datajadwalposyandu.show', ['datajadwalposyandu' => ':idData']) }}'
                                .replace(':idData', info.event.id),
                            dataType: "JSON",
                            success: function(response) {
                                $('#e-id_posyandu').val(response.id_posyandu).trigger(
                                    'change');
                                $('[name="start"]').val(response.start)
                                $('[name="end"]').val(response.end)
                                $('#update').modal('show')
                            }
                        });
                    }



                },
                events: {
                    url: '{{ route('jadwalposyandu.datajadwalposyandu.index') }}',
                    method: 'GET'
                }
            });
            calendar.render();

            $('.v-table').on('click', function() {
                $(this).addClass('btn-primary')
                $('.v-kalendar').removeClass('btn-primary')
                $('#tampilan-table').removeAttr('hidden', false)
                $('#tampilan-kalendar').attr('hidden', true)

            });
            $('.v-kalendar').on('click', function() {
                $(this).addClass('btn-primary')
                $('.v-table').removeClass('btn-primary')
                $('#tampilan-kalendar').removeAttr('hidden', false)
                $('#tampilan-table').attr('hidden', true)
                calendar.render();
                calendar.refetchEvents();
            });
            $('#addEventBtn').on('click', function() {
                var eventName = $('#eventName').val();
                if (eventName !== '') {
                    calendar.addEvent({
                        title: eventName,
                        start: new Date(),
                        allDay: true
                    });
                    $('#eventName').val('');
                } else {
                    alert('Please enter event name');
                }
            });

            $('#table-data').on('click', '.edit', function() {
                $('#btn-hapus').addClass('d-none')
                let data = table.row($(this).parents('tr')).data()
                idData = data.id
                dataPosyandu('#update')
                $.ajax({
                    type: "GET",
                    url: '{{ route('jadwalposyandu.datajadwalposyandu.show', ['datajadwalposyandu' => ':idData']) }}'
                        .replace(':idData', data.id),
                    dataType: "JSON",
                    success: function(response) {
                        $('#e-id_posyandu').val(response.id_posyandu).trigger(
                            'change');
                        $('[name="start"]').val(response.start)
                        $('[name="end"]').val(response.end)
                        $('#update').modal('show')
                    }
                });
            })
            table.on('click', '.hapus', function() {
                let data = table.row($(this).parents('tr')).data()
                idData = data.id
                $('#hapus').modal('show')
            });
            $('form#form-add').submit(function(e) {
                e.preventDefault();
                e.stopPropagation()

                let formDataArray = new FormData(this)
                const url = '{{ route('jadwalposyandu.datajadwalposyandu.store') }}';
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
                            table.ajax.reload();
                            calendar.refetchEvents();
                        })
                    })
                    .catch(error => {
                        console.error(error);
                    });

            });

            $('form#form-edit').submit(function(e) {
                e.preventDefault();
                e.stopPropagation()
                let formDataArray = new FormData(this)
                const url =
                    '{{ route('jadwalposyandu.datajadwalposyandu.update', ['datajadwalposyandu' => ':idData']) }}'
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
                        $('#update').modal('hide')
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Your work has been saved",
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            idData = null
                            table.ajax.reload();
                            calendar.refetchEvents();

                        })
                    })
                    .catch(error => {
                        console.error(error);
                    });

            });

            $('#btn-hapus,#btn-hapus-table').on('click', function() {
                const url =
                    '{{ route('jadwalposyandu.datajadwalposyandu.update', ['datajadwalposyandu' => ':idData']) }}'
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
                        $('#update').modal('hide')

                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Your work has been Delete",
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            $('#hapus').modal('hide')
                            idData = null
                            table.ajax.reload();
                            calendar.refetchEvents();
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
                    let result = [{
                        id: '',
                        text: 'Pilih'
                    }]
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
