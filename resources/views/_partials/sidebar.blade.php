<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            {{-- <img src="assets/images/logo.svg" alt="" srcset=""> --}}
            <h2 class="fw-bolder">SIPANDU</h2>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Main Menu</li>
                <li class="sidebar-item active ">
                    <a href="{{ route('dashboard') }}" class="sidebar-link">
                        <i class="fa-solid fa-house"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                @if (in_array(session()->get('role'), ['A', 'P']))
                    <li class="sidebar-item  has-sub">
                        <a href="#" class="sidebar-link">
                            <i class="fa-solid fa-server"></i>
                            <span>Data Master</span>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="{{ route('master-ibu') }}" class="ps-4">
                                    <i class="fa-solid fa-circle-dot fa-sm me-1"></i>
                                    <span>Data Ibu</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('master-anak') }}" class="ps-4">
                                    <i class="fa-solid fa-circle-dot fa-sm me-1"></i>
                                    <span>Data Anak</span>
                                </a>
                            </li>
                            @if (in_array(session()->get('role'), ['A']))
                                <li>
                                    <a href="{{ route('master-posyandu') }}" class="ps-4">
                                        <i class="fa-solid fa-circle-dot fa-sm me-1"></i>
                                        <span>Data Posyandu</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('master-jenis-vitamin') }}" class="ps-4">
                                        <i class="fa-solid fa-circle-dot fa-sm me-1"></i>
                                        <span>Data Jenis Vitamin</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('master-jenis-imunisasi') }}" class="ps-4">
                                        <i class="fa-solid fa-circle-dot fa-sm me-1"></i>
                                        <span>Data Jenis Imunisasi</span>
                                    </a>
                                </li>
                            @endif

                        </ul>

                    </li>
                @endif
                @if (in_array(session()->get('role'), ['A', 'O']))
                    @if (in_array(session()->get('role'), ['A']))
                        <li class="sidebar-item ">
                            <a href="{{ route('master-check-imunisasi') }}" class="sidebar-link">
                                <i class="fa-solid fa-syringe"></i>
                                <span>Data Imunisasi</span>
                            </a>
                        </li>
                        <li class="sidebar-item ">
                            <a href="{{ route('master-check-vitamin') }}" class="sidebar-link">
                                <i class="fa-solid fa-pills"></i>
                                <span>Data Vitamain</span>
                            </a>
                        </li>
                    @endif

                    <li class="sidebar-item ">
                        <a href="{{ route('master-jadwal-posyandu') }}" class="sidebar-link">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span>Jadwal Posyandu</span>
                        </a>
                    </li>
                @endif

                <li class="sidebar-item ">
                    <a href="{{ route('master-check-up') }}" class="sidebar-link">
                        <i class="fa-solid fa-stethoscope"></i>
                        <span>Check UP</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
