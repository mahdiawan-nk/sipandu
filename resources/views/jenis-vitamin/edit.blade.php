<div class="modal fade text-left" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <form class="modal-content form form-vertical" method="POST" id="form-edit">
            @csrf
            @method('PATCH')
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="myModalLabel160">Tambah Data Jenis Vitamin</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>

            <div class="modal-body">

                <div class="form-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="nik" class="form-label">Kode Vitamin</label>
                                <input type="text" class="form-control" id="kode_vitamin" name="kode_vitamin">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Nama Vitamin</label>
                                <input type="text" class="form-control" id="nama_vitamin" name="nama_vitamin">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Dosis</label>
                                <input type="text" class="form-control" id="dosis" name="dosis">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Jenis</label>
                                <?php $jenis = ['kapsul', 'Tablet', 'Cairan', 'Serbuk']; ?>
                                <select name="jenis" id="jenis" class="form-select">
                                    @foreach ($jenis as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="riwayat_kesehatan" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
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
                <button type="submit" class="btn btn-primary ml-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Simpan</span>
                </button>
            </div>
        </form>
    </div>
</div>
