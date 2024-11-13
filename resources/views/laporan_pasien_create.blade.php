@extends('layout.app_modern')
@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-primary text-white py-3">
                    <div class="d-flex align-items-center">
                        <i class="ti ti-file-report me-2 fs-4"></i>
                        <h5 class="mb-0">Laporan Data Pasien</h5>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form action="/laporan-pasien" method="GET" target="_blank">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label fw-bold mb-2" for="tanggal_mulai">
                                        <i class="ti ti-calendar me-1"></i>
                                        Tanggal Mulai
                                    </label>
                                    <input type="date" name="tanggal_mulai" class="form-control form-control-lg shadow-sm" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label fw-bold mb-2" for="tanggal_akhir">
                                        <i class="ti ti-calendar-event me-1"></i>
                                        Tanggal Akhir
                                    </label>
                                    <input type="date" name="tanggal_akhir" class="form-control form-control-lg shadow-sm" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label fw-bold mb-2" for="jenis_kelamin">
                                        <i class="ti ti-users me-1"></i>
                                        Jenis Kelamin
                                    </label>
                                    <select name="jenis_kelamin" class="form-select form-select-lg shadow-sm">
                                        <option value="">Semua Jenis Kelamin</option>
                                        <option value="laki-laki">Laki-laki</option>
                                        <option value="perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary btn-lg px-4">
                                <i class="ti ti-printer me-2"></i>
                                Cetak Laporan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection