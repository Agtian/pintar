<div>
    <div class="card card-dark">
        <div class="card-header border-transparent">
            <h3 class="card-title">Metode Pembayaran</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group row">
                        <label for="total_waktu" class="col-sm-3 col-form-label">Pilih Pembayaran</label>
                        <div class="col-sm-9">
                            <div class="custom-control custom-radio">
                                <input wire:model.defer="pilih_pembayaran" class="custom-control-input @error('pilih_pembayaran') is-invalid @enderror" type="radio" id="radioOption1" name="pilih_pembayaran">
                                <label for="radioOption1" class="custom-control-label">Transfer Bank</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input wire:model.defer="pilih_pembayaran" class="custom-control-input @error('pilih_pembayaran') is-invalid @enderror" type="radio" id="radioOption2" name="pilih_pembayaran">
                                <label for="radioOption2" class="custom-control-label">Bayar di RSUD dr. Rehatta</label>
                            </div>
                            @error('pilih_pembayaran')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <table>
                        <tr>
                            <td width="250" align="right"><h6>Total Pembayaran</h6></td>
                            <td width="250" align="right"><h3>Rp. {{ $total_biaya_diklat }}</h3></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="button" wire:click.prevent="submitTraining()" class="btn btn-primary btn-md float-right">Kirim Permohonan Diklat</button>
            <button type="button" wire:click.prevent="cancelRegistration()" class="btn btn-danger btn-md float-right mr-2">Batalkan Pengajuan Diklat</button>
        </div>
    </div>
</div>
