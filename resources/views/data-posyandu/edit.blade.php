<div class="modal fade text-left" id="edit" role="dialog" aria-labelledby="myModalLabel130" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <form class="modal-content form form-vertical" id="form-edit">
            @csrf
            @method('PATCH')
            <div class="modal-header bg-secondary">
                <h5 class="modal-title white" id="myModalLabel130">Ubah Data Anak</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Nama Posyandu</label>
                                    <input type="text" class="form-control" id="name" name="nama_posyandu">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="tempat_lahir" class="form-label">Alamat Posyandu</label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="alamat_posyandu">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="pekerjaan" class="form-label">Petugas Posyandu</label>
                                    <input type="text" class="form-control" id="pekerjaan" name="kader_posyandu">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="riwayat_kesehatan" class="form-label">Informasi Posyandu</label>
                                    <textarea class="form-control" id="informasi_posyandu" name="informasi_posyandu" rows="10"></textarea>
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
                <button type="submit" class="btn btn-secondary ml-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Update</span>
                </button>
            </div>
        </form>
    </div>
</div>
