<div class="modal fade text-left" id="edit" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <form class="modal-content form form-vertical" method="POST" id="form-edit">
            @csrf
            @method('PATCH')
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="myModalLabel160">Tambah Pengguna</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>

            <div class="modal-body">

                <div class="form-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Role</label>
                                <?php $jenis = ['A' => 'Admin', 'P' => 'Petugas Posyandu']; ?>
                                <select name="role" id="e-role" class="form-select">
                                    <option value="">Pilih Role</option>
                                    @foreach ($jenis as $key => $item)
                                        <option value="{{ $key }}">{{ $key }} : {{ $item }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 d-none e-posyandu">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Posyandu</label>
                                <select name="id_posyandu" id="e-id_posyandu" class="form-select"></select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="nik" class="form-label">Nama Pengguna</label>
                                <input type="text" class="form-control" id="e-nama_pengguna" name="nama_pengguna">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Email Pengguna</label>
                                <input type="email" class="form-control" id="e-email_pengguna" name="email_pengguna">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="e-password_pengguna"
                                        name="password_pengguna">
                                    <span class="input-group-text e-show-ps" style="cursor: pointer"><i
                                            class="fa-regular fa-eye-slash"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Re-Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="e-re-password">
                                    <span class="input-group-text e-show-re-ps" style="cursor: pointer"><i
                                            class="fa-regular fa-eye-slash"></i></span>
                                </div>
                                <small class="message"></small>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="name" class="form-label d-block">Status Akun</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_akun" id="e-status_y"
                                    value="Y">
                                <label class="form-check-label" for="e-status_y">Aktif</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_akun" id="e-status_n"
                                    value="N" checked>
                                <label class="form-check-label" for="e-status_n">Suspend</label>
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
                <button type="submit" class="btn btn-primary ml-1 submited" disabled>
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Simpan</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    $(function() {
        $('#e-role').change(function(e) {
            e.preventDefault();
            let val = $(this).val()
            if (val != '') {
                if (val == 'P') {
                    $('.e-posyandu').removeClass('d-none');
                    dataPosyandu('#edit')
                } else {
                    $('.e-posyandu').addClass('d-none');
                }

            } else {
                $('e-.posyandu').addClass('d-none');
            }
        });

        $('.e-show-ps').on('click', function() {
            let type = $('#e-password_pengguna').attr('type')
            console.log(type)
            if (type == 'text') {
                $('#e-password_pengguna').attr('type', 'password')
                $(this).html('<i class="fa-regular fa-eye-slash"></i>')
            } else {
                $('#e-password_pengguna').attr('type', 'text')
                $(this).html('<i class="fa-regular fa-eye"></i>')
            }
        });

        $('.e-show-re-ps').on('click', function() {
            let type = $('#e-re-password').attr('type')
            console.log(type)
            if (type == 'text') {
                $('#e-re-password').attr('type', 'password')
                $(this).html('<i class="fa-regular fa-eye-slash"></i>')
            } else {
                $('#e-re-password').attr('type', 'text')
                $(this).html('<i class="fa-regular fa-eye"></i>')
            }
        });

        $('#e-re-password').keyup(function() {
            var password = $('#e-password_pengguna').val();
            var confirmPassword = $(this).val();

            if (password !== confirmPassword) {
                $('.submited').attr('disabled', true);
                $('.message').text('Password tidak cocok').css('color', 'red');
            } else {
                $('.submited').removeAttr('disabled', false);
                $('.message').text('Password cocok').css('color', 'green');
            }
        });


    });
</script>
