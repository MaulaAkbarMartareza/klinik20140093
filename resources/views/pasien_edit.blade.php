@extends('layout.app', ['title' => 'Data Pasien'])
@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="ti ti-user-edit me-2"></i>Edit Data Pasien</h4>
                </div>
                <div class="card-body p-4">
                    <form action="/pasien/{{ $pasien->id }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-bold mb-2" for="foto">Foto Pasien</label>
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <img src="{{ \Storage::url($pasien->foto) }}" alt="Foto Pasien" class="rounded-circle shadow-sm" style="width: 100px; height: 100px; object-fit: cover;">
                                        </div>
                                        <div class="flex-grow-1">
                                            <input type="file" class="form-control form-control-lg @error('foto') is-invalid @enderror" name="foto">
                                            <small class="text-muted">Format: JPG, JPEG, PNG</small>
                                            @error('foto')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-bold mb-2" for="no_pasien">Nomor Pasien</label>
                                    <input type="text" class="form-control form-control-lg @error('no_pasien') is-invalid @enderror" id="no_pasien" name="no_pasien" value="{{ old('no_pasien') ?? $pasien->no_pasien }}">
                                    @error('no_pasien')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-bold mb-2" for="nama">Nama Pasien</label>
                                    <input type="text" class="form-control form-control-lg @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') ?? $pasien->nama }}">
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-bold mb-2" for="umur">Umur</label>
                                    <input type="number" class="form-control form-control-lg @error('umur') is-invalid @enderror" id="umur" name="umur" value="{{ old('umur') ?? $pasien->umur }}">
                                    @error('umur')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-bold mb-2">Jenis Kelamin</label>
                                    <div class="d-flex gap-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki_laki" value="laki-laki" {{ (old('jenis_kelamin') ?? $pasien->jenis_kelamin) === 'laki-laki' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="laki_laki">Laki-laki</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="perempuan" {{ (old('jenis_kelamin') ?? $pasien->jenis_kelamin) === 'perempuan' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="perempuan">Perempuan</label>
                                        </div>
                                    </div>
                                    @error('jenis_kelamin')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-bold mb-2" for="alamat">Alamat</label>
                                    <textarea class="form-control form-control-lg @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3">{{ old('alamat') ?? $pasien->alamat }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-end mt-4">
                            <a href="/pasien" class="btn btn-light btn-lg me-2 px-4 animate__animated animate__fadeIn">
                                <i class="ti ti-arrow-left me-2"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg px-5 animate__animated animate__fadeIn">
                                <i class="ti ti-device-floppy me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.btn {
    transition: all 0.3s ease;
}
.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
.form-control {
    transition: all 0.2s ease;
}
.form-control:focus {
    box-shadow: 0 0 0 3px rgba(13,110,253,0.15);
}
.card {
    transition: all 0.3s ease;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
}
</style>

@endsection