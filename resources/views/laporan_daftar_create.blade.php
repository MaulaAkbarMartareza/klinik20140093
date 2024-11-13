@extends('layout.app_modern')
@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="ti ti-file-report me-2"></i>Laporan Data Pendaftaran</h4>
                </div>
                <div class="card-body p-4">
                    <form action="/laporan-daftar" method="GET" target="_blank">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label fw-bold mb-2" for="tanggal_mulai">Tanggal Mulai</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="ti ti-calendar"></i></span>
                                        <input type="date" name="tanggal_mulai" class="form-control form-control-lg" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label fw-bold mb-2" for="tanggal_akhir">Tanggal Akhir</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="ti ti-calendar"></i></span>
                                        <input type="date" name="tanggal_akhir" class="form-control form-control-lg" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label fw-bold mb-2" for="poli">Poli</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="ti ti-building-hospital"></i></span>
                                        <select name="poli" class="form-select form-select-lg">
                                            <option value="">Semua Poli</option>
                                            @foreach ($listPoli as $key => $val)
                                            <option value="{{ $key }}" @selected(old('poli') == $key)>
                                                {{ $val }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                <i class="ti ti-printer me-2"></i>Cetak Laporan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection