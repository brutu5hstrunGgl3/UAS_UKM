<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Learning module sistem</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">Course</a>
        </div>
        <ul class="sidebar-menu">

            {{-- Menu untuk ADMIN --}}
            @if(auth()->user()->rul == 'ADMIN')
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-users"></i><span>User</span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('user.index') }}">Tambah User</a>
                    </li>
                </ul>
            </li>
            @endif

            {{-- Menu untuk ADMIN dan PEMATERI --}}
            @if(auth()->user()->rul == 'ADMIN' || auth()->user()->rul == 'PEMATERI')
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-school"></i><span>Pemateri</span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('lecturer.index') }}">Tambah Kelas</a>
                    </li>
                </ul>
            </li>
            @endif

            {{-- Menu untuk PESERTA --}}
            @if(auth()->user()->rul == 'PESERTA')
                @php
                    $pembayaran = App\Models\Pembayaran::whereHas('user', function ($query) {
                        $query->where('name', auth()->user()->name);
                    })->first();
                @endphp

                @if($pembayaran && $pembayaran->status == 'Sudah Bayar')
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link has-dropdown">
                            <i class="fas fa-book"></i><span>Materi</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="nav-link" href="{{ route('lecturer.index') }}">Lihat Materi</a>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-danger">Anda belum menyelesaikan pembayaran atau belum divalidasi oleh admin.</a>
                    </li>
                @endif
            @endif

            {{-- Menu untuk ADMIN dan PEMATERI - Absensi --}}
            @if(auth()->user()->rul == 'ADMIN' || auth()->user()->rul == 'PEMATERI')
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-list"></i><span>Absensi</span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('absensi.index') }}">Absensi peserta</a>
                    </li>
                </ul>
            </li>
            @endif

            {{-- Menu untuk Tugas --}}
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-book"></i><span>Tugas</span>
                </a>
                <ul class="dropdown-menu">
                    @if(auth()->user()->rul == 'ADMIN' || auth()->user()->rul == 'PEMATERI')
                    <li>
                        <a class="nav-link" href="{{ route('tugas.create') }}">Upload Soal</a>
                    </li>
                    @endif

                    <li>
    {{-- Jika pengguna adalah PESERTA, hanya dapat mengakses jika sudah membayar --}}
    @if(auth()->user()->rul == 'PESERTA' && $pembayaran && $pembayaran->status == 'Sudah Bayar')
        <a class="nav-link" href="{{ route('tugas.index') }}">Lihat Tugas</a>
    {{-- Jika pengguna adalah ADMIN atau PEMATERI, tidak perlu validasi pembayaran --}}
    @elseif(auth()->user()->rul == 'ADMIN' || auth()->user()->rul == 'PEMATERI')
        <a class="nav-link" href="{{ route('tugas.index') }}">Lihat Tugas</a>
    @endif
</li>
                </ul>
            </li>

            {{-- Menu untuk Nilai --}}
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-star"></i><span>Nilai</span>
                </a>
                <ul class="dropdown-menu">
                    @if(auth()->user()->rul == 'ADMIN' || auth()->user()->rul == 'PEMATERI')
                    <li>
                        <a class="nav-link" href="">Input Nilai</a>
                    </li>
                    @endif
                    @if(auth()->user()->rul == 'ADMIN')
                    <li>
                        <a class="nav-link" href="">Report Nilai</a>
                    </li>
                    @endif
                </ul>
            </li>

            {{-- Menu untuk Laporan (ADMIN) --}}
            @if(auth()->user()->rul == 'ADMIN')
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-folder"></i><span>Laporan</span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="">Pendaftaran Peserta</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('pembayaran.index') }}">Pembayaran Bimbel</a>
                    </li>
                </ul>
            </li>
            @endif

            {{-- Menu untuk Transaksi (PESERTA) --}}
            @if(auth()->user()->rul == 'PESERTA')
            <li class="nav-item dropdown">
                <a class="nav-link has-dropdown" href="">
                    <i class="fas fa-shopping-cart"></i><span>Transaksi</span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('pages.Pembayaran.paket') }}">Bimbel</a>
                    </li>
                </ul>
            </li>
            @endif

            {{-- Menu Settings --}}
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-fire"></i><span>Settings</span>
                </a>
                <ul class="dropdown-menu">
                    <!-- Add your settings options here -->
                </ul>
            </li>

        </ul>
    </aside>
</div>
