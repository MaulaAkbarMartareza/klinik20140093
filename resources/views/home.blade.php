@extends('layout.app_modern')

@section('content')
<div class="container-fluid py-4">

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="text-primary fw-bold">Selamat Datang, {{ Auth::user()->name }}</h1>
            <p class="text-muted fs-5">{{ now()->format('l, d F Y') }} | <span class="badge bg-info fs-6">{{ Auth::user()->role }}</span></p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-4">
                    <h4 class="card-title mb-4 text-dark">
                        <i class="ti ti-bolt fs-3 me-2"></i>Aksi Cepat
                    </h4>
                    <div class="quick-actions-grid">
                        @php
                        $actions = [
                            ['route' => 'patients.create', 'icon' => 'ti-user-plus', 'title' => 'Tambah Pasien', 'desc' => 'Daftarkan pasien baru', 'color' => '#4e73df'],
                            ['route' => 'appointments.create', 'icon' => 'ti-calendar-plus', 'title' => 'Buat Janji', 'desc' => 'Atur jadwal konsultasi', 'color' => '#1cc88a'],
                            ['route' => 'reports.daily', 'icon' => 'ti-report', 'title' => 'Laporan Harian', 'desc' => 'Lihat statistik hari ini', 'color' => '#36b9cc'],
                            ['route' => 'inventory.check', 'icon' => 'ti-medicine', 'title' => 'Cek Stok Obat', 'desc' => 'Kelola inventaris obat', 'color' => '#f6c23e'],
                            ['route' => 'services.index', 'icon' => 'ti-heartbeat', 'title' => 'Layanan', 'desc' => 'Lihat daftar layanan', 'color' => '#e74a3b'],
                            ['route' => 'doctors.schedule', 'icon' => 'ti-calendar-time', 'title' => 'Jadwal Dokter', 'desc' => 'Lihat jadwal praktik', 'color' => '#858796']
                        ];
                        @endphp
                        
                        @foreach ($actions as $action)
                            <a href="{{ route($action['route']) }}" class="quick-action-card" style="--card-color: {{ $action['color'] }}">
                                <div class="icon-wrapper">
                                    <i class="{{ $action['icon'] }}"></i>
                                </div>
                                <h5>{{ $action['title'] }}</h5>
                                <p>{{ $action['desc'] }}</p>
                                <div class="hover-effect"></div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row g-4">
        <!-- Statistik Harian -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-lg h-100">
                <div class="card-header bg-gradient-primary text-white py-3">
                    <h5 class="card-title mb-0"><i class="ti ti-chart-bar fs-4 me-2"></i>Statistik Harian</h5>
                </div>
                <div class="card-body">
                    <canvas id="dailyStats" height="250"></canvas>
                </div>
            </div>
        </div>

        <!-- Antrian Pasien -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-lg h-100">
                <div class="card-header bg-gradient-warning text-dark py-3">
                    <h5 class="card-title mb-0"><i class="ti ti-users fs-4 me-2"></i>Antrian Pasien</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-4">
                        <div class="text-center">
                            <h2 class="mb-0 fw-bold text-warning">15</h2>
                            <p class="text-muted mb-0">Menunggu</p>
                        </div>
                        <div class="text-center">
                            <h2 class="mb-0 fw-bold text-info">5</h2>
                            <p class="text-muted mb-0">Sedang Diperiksa</p>
                        </div>
                        <div class="text-center">
                            <h2 class="mb-0 fw-bold text-success">30</h2>
                            <p class="text-muted mb-0">Selesai</p>
                        </div>
                    </div>
                    <div class="progress" style="height: 15px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-info" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-success" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stok Obat Kritis -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-lg h-100">
                <div class="card-header bg-gradient-danger text-white py-3">
                    <h5 class="card-title mb-0"><i class="ti ti-medicine fs-4 me-2"></i>Stok Obat Kritis</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach ([
                            ['name' => 'Paracetamol 500mg', 'quantity' => 5, 'class' => 'bg-danger'],
                            ['name' => 'Amoxicillin 500mg', 'quantity' => 10, 'class' => 'bg-warning text-dark'],
                            ['name' => 'Omeprazole 20mg', 'quantity' => 3, 'class' => 'bg-danger']
                        ] as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="fw-bold">{{ $item['name'] }}</span>
                            <span class="badge {{ $item['class'] }} rounded-pill">{{ $item['quantity'] }} strip</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer bg-light py-3">
                    <a href="#" class="btn btn-outline-primary w-100">Lihat Semua Stok</a>
                </div>
            </div>
        </div>

        <!-- Shift Dokter -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-lg h-100">
                <div class="card-header bg-gradient-info text-white py-3">
                    <h5 class="card-title mb-0"><i class="ti ti-calendar-time fs-4 me-2"></i>Shift Dokter Hari Ini</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Dokter</th>
                                    <th>Spesialisasi</th>
                                    <th>Jam Kerja</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ([
                                    ['name' => 'Dr. Andi Pratama', 'specialty' => 'Umum', 'hours' => '08:00 - 14:00', 'status' => 'Bertugas', 'statusClass' => 'bg-success'],
                                    ['name' => 'Dr. Siti Nurhaliza', 'specialty' => 'Anak', 'hours' => '10:00 - 16:00', 'status' => 'Istirahat', 'statusClass' => 'bg-warning text-dark'],
                                    ['name' => 'Dr. Budi Santoso', 'specialty' => 'Penyakit Dalam', 'hours' => '14:00 - 20:00', 'status' => 'Akan Bertugas', 'statusClass' => 'bg-info']
                                ] as $doctor)
                                <tr>
                                    <td>{{ $doctor['name'] }}</td>
                                    <td>{{ $doctor['specialty'] }}</td>
                                    <td>{{ $doctor['hours'] }}</td>
                                    <td><span class="badge {{ $doctor['statusClass'] }}">{{ $doctor['status'] }}</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jadwal Kegiatan -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-lg h-100">
                <div class="card-header bg-gradient-success text-white py-3">
                    <h5 class="card-title mb-0"><i class="ti ti-calendar-event fs-4 me-2"></i>Jadwal Kegiatan</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach ([
                            ['event' => 'Seminar Kesehatan', 'date' => 'Sabtu, 10 Juli 2023 | 09:00 WIB', 'status' => 'Mendatang', 'statusClass' => 'bg-primary'],
                            ['event' => 'Vaksinasi Massal', 'date' => 'Minggu, 18 Juli 2023 | 08:00 - 15:00 WIB', 'status' => 'Terjadwal', 'statusClass' => 'bg-success'],
                            ['event' => 'Pelatihan Pertolongan Pertama', 'date' => 'Jumat, 23 Juli 2023 | 13:00 WIB', 'status' => 'Pendaftaran Dibuka', 'statusClass' => 'bg-info']
                        ] as $activity)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0 fw-bold">{{ $activity['event'] }}</h6>
                                <small class="text-muted">{{ $activity['date'] }}</small>
                            </div>
                            <span class="badge {{ $activity['statusClass'] }} rounded-pill">{{ $activity['status'] }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer bg-light py-3">
                    <a href="#" class="btn btn-outline-success w-100">Lihat Semua Jadwal</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    transition: all 0.3s ease;
    border-radius: 1rem;
    overflow: hidden;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
}

.progress {
    height: 15px;
    border-radius: 10px;
    overflow: hidden;
}

.list-group-item {
    border: none;
    padding: 1rem 1.25rem;
}

.badge {
    font-weight: 500;
    padding: 0.6em 1em;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #6e8efb, #4466f2);
}

.bg-gradient-success {
    background: linear-gradient(135deg, #28c76f, #1f9d55);
}

.bg-gradient-info {
    background: linear-gradient(135deg, #00cfe8, #0097a7);
}

.bg-gradient-warning {
    background: linear-gradient(135deg, #ff9f43, #ff8510);
}

.bg-gradient-danger {
    background: linear-gradient(45deg, #e74a3b, #be2617);
}

.btn-lg {
    padding: 1rem 1.5rem;
    font-size: 1.1rem;
    transition: all 0.3s ease;
}

.btn-lg:hover {
    transform: translateY(-3px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.rounded-pill {
    border-radius: 50rem !important;
}

.card-header {
    border-bottom: none;
}

.card-footer {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-top: 1px solid rgba(0, 0, 0, 0.05);
}

.quick-actions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    padding: 0.5rem;
}

.quick-action-card {
    position: relative;
    background: white;
    padding: 1.5rem;
    border-radius: 1rem;
    text-decoration: none;
    color: #444;
    transition: all 0.3s ease;
    border: 1px solid #eee;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.quick-action-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    color: white;
}

.quick-action-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: var(--card-color);
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 1;
}

.quick-action-card:hover::before {
    opacity: 0.95;
}

.quick-action-card .icon-wrapper {
    width: 60px;
    height: 60px;
    background: var(--card-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1rem;
    transition: all 0.3s ease;
}

.quick-action-card .icon-wrapper i {
    font-size: 1.5rem;
    color: white;
}

.quick-action-card h5 {
    margin: 0;
    font-weight: 600;
    font-size: 1.1rem;
    position: relative;
    z-index: 2;
}

.quick-action-card p {
    margin: 0.5rem 0 0;
    font-size: 0.9rem;
    opacity: 0.8;
    position: relative;
    z-index: 2;
}

.hover-effect {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: radial-gradient(circle at center, rgba(255,255,255,0.2) 0%, transparent 70%);
    transition: opacity 0.3s ease;
    z-index: 2;
}

.quick-action-card:hover .hover-effect {
    opacity: 0;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('dailyStats').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Pasien', 'Resep', 'Pendapatan (Juta)'],
            datasets: [{
                label: 'Statistik Hari Ini',
                data: [45, 38, 5.2],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
});
</script>

@endsection