<div class="modal fade text-left" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <form class="modal-content form form-vertical" method="POST" id="form-edita">
            @csrf
            @method('PATCH')
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="myModalLabel160">Detail Informasi Data Check Up Anak</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4>Detail Orang Tua</h4>
                            <div class="d-table w-100" id="detail-ortu">
                                <div class="d-table-row">
                                    <div class="d-table-cell w-25"><strong>No NIK</strong></div>
                                    <div class="d-table-cell"><strong>:</strong></div>
                                    <div class="d-table-cell ps-2 ortu" id="nik"></div>
                                </div>
                                <div class="d-table-row">
                                    <div class="d-table-cell w-25"><strong>Nama Lengkap</strong></div>
                                    <div class="d-table-cell"><strong>:</strong></div>
                                    <div class="d-table-cell ps-2 ortu" id="nama"></div>
                                </div>
                                <div class="d-table-row">
                                    <div class="d-table-cell w-25"><strong>Tempat Lahir</strong></div>
                                    <div class="d-table-cell"><strong>:</strong></div>
                                    <div class="d-table-cell ps-2 ortu" id="tempat_lahir"></div>
                                </div>
                                <div class="d-table-row">
                                    <div class="d-table-cell w-25"><strong>Tanggal Lahir</strong></div>
                                    <div class="d-table-cell"><strong>:</strong></div>
                                    <div class="d-table-cell ps-2 ortu" id="tanggal_lahir"></div>
                                </div>
                                <div class="d-table-row">
                                    <div class="d-table-cell w-25"><strong>Pekerjaan</strong></div>
                                    <div class="d-table-cell"><strong>:</strong></div>
                                    <div class="d-table-cell ps-2 ortu" id="pekerjaan"></div>
                                </div>
                                <div class="d-table-row">
                                    <div class="d-table-cell w-25"><strong>Alamat</strong></div>
                                    <div class="d-table-cell"><strong>:</strong></div>
                                    <div class="d-table-cell ps-2 ortu" id="alamat"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <h4>Detail Anak</h4>
                            <div class="d-table w-100" id="detail-anak">
                                <div class="d-table-row">
                                    <div class="d-table-cell w-25"><strong>Nama Anak</strong></div>
                                    <div class="d-table-cell"><strong>:</strong></div>
                                    <div class="d-table-cell ps-2 anak" id="nama"></div>
                                </div>
                                <div class="d-table-row">
                                    <div class="d-table-cell w-25"><strong>Tempat Lahir</strong></div>
                                    <div class="d-table-cell"><strong>:</strong></div>
                                    <div class="d-table-cell ps-2 anak" id="tempat_lahir"></div>
                                </div>
                                <div class="d-table-row">
                                    <div class="d-table-cell w-25"><strong>Tanggal Lahir</strong></div>
                                    <div class="d-table-cell"><strong>:</strong></div>
                                    <div class="d-table-cell ps-2 anak" id="tanggal_lahir"></div>
                                </div>
                                <div class="d-table-row">
                                    <div class="d-table-cell w-25"><strong>Jenis Kelamin</strong></div>
                                    <div class="d-table-cell"><strong>:</strong></div>
                                    <div class="d-table-cell ps-2 anak" id="jenis_kelamin"></div>
                                </div>
                                <div class="d-table-row">
                                    <div class="d-table-cell w-25"><strong>Berat Lahir</strong></div>
                                    <div class="d-table-cell"><strong>:</strong></div>
                                    <div class="d-table-cell ps-2 anak" id="berat_lahir"></div>
                                </div>
                                <div class="d-table-row">
                                    <div class="d-table-cell w-25"><strong>Tinggi Lahir</strong></div>
                                    <div class="d-table-cell"><strong>:</strong></div>
                                    <div class="d-table-cell ps-2 anak" id="tinggi_lahir"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="divider">
                        <div class="divider-text">Informasi Check UP</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h4>Detail Check UP</h4>
                            <div class="d-table w-100" id="detail-checkup">
                                <div class="d-table-row" >
                                    <div class="d-table-cell w-25"><strong>Posyandu</strong></div>
                                    <div class="d-table-cell"><strong>:</strong></div>
                                    <div class="d-table-cell ps-2 posyandu" id="nama_posyandu"></div>
                                </div>
                                <div class="d-table-row">
                                    <div class="d-table-cell w-25"><strong>Tanggal Periksa</strong></div>
                                    <div class="d-table-cell"><strong>:</strong></div>
                                    <div class="d-table-cell ps-2 checkup" id="tanggal_pemeriksaan"></div>
                                </div>
                                <div class="d-table-row">
                                    <div class="d-table-cell w-25"><strong>Usia Saat Periksa</strong></div>
                                    <div class="d-table-cell"><strong>:</strong></div>
                                    <div class="d-table-cell ps-2 checkup" id="usia_saat_periksa"></div>
                                </div>
                                <div class="d-table-row">
                                    <div class="d-table-cell w-25"><strong>Berat Badan Saat periksa</strong></div>
                                    <div class="d-table-cell"><strong>:</strong></div>
                                    <div class="d-table-cell ps-2 checkup" id="berat_badan_pemeriksaan"></div>
                                </div>
                                <div class="d-table-row">
                                    <div class="d-table-cell w-25"><strong>Tinggi Badan Saat periksa</strong></div>
                                    <div class="d-table-cell"><strong>:</strong></div>
                                    <div class="d-table-cell ps-2 checkup" id="tinggi_badan_pemeriksaan"></div>
                                </div>
                                <div class="d-table-row">
                                    <div class="d-table-cell w-25"><strong>Status Gizi</strong></div>
                                    <div class="d-table-cell"><strong>:</strong></div>
                                    <div class="d-table-cell ps-2 checkup" id="status_gizi"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="divider">
                        <div class="divider-text">Informasi Pemberisan Vitamin dan Imunisasi</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <table class="table table-sm" id="rincian-imunisasi">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Pemberian</th>
                                        <th>Nama Imunisasi</th>
                                        <th>Dosis</th>
                                    </tr>
                                </thead>
                                <tbody>


                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-6">
                            <table class="table table-sm" id="rincian-vitamin">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Tanggal Pemberian</th>
                                        <th>Nama Vitamin</th>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                {{-- <button type="submit" class="btn btn-primary ml-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Simpan</span>
                </button> --}}
            </div>
        </form>
    </div>
</div>
