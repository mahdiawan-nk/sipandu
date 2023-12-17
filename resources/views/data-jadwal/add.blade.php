<div class="modal fade text-left" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel130"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <form class="modal-content form form-vertical" method="POST" id="form-add">
            @csrf
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="myModalLabel130">Tambah Jadwal</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="nik" class="form-label">Nama Posyandu</label>
                                <select name="id_posyandu" id="id_posyandu" class="form-select"></select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="nik" class="form-label">tanggal Jadwal</label>
                                <input type="text" class="form-control" id="start" name="start" readonly>
                                <input type="hidden" class="form-control" id="end" name="end">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
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
