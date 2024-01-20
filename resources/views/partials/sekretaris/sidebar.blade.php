<div class="d-flex flex-column flex-shrink-0 sidebar p-3 position-fixed">
    <a href="/dashboard/sekretaris" class="d-flex mt-4 sidebar-header justify-content-between align-items-center text-decoration-none">
        <span style="color: #fff">Dispo</span><span style="color:#003249;">Manager</span>
    </a>
  
    <ul class="nav mt-5 nav-pills gap-3 flex-column">
        <li class="nav-item">
            <a href="{{ url('/dashboard/sekretaris') }}" class="nav-link{{ Request::is('dashboard/sekretaris') ? ' active' : '' }}" aria-current="page">
                <img src="{{ asset('img/ico-dashboard.svg') }}" alt="">
                Dashboard
            </a>
        </li>
        <li class="nav-item" >
            <a href="{{ url('/kelola-sekretaris') }}" class="nav-link{{ Request::is('kelola-sekretaris') ? ' active' : '' }}">
                <img src="{{ asset('img/ico-kelola-white.svg') }}" alt="">
                Kelola Surat
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('/sekretaris/format-surat') }}" class="nav-link{{ Request::is('sekretaris/format-surat') ? ' active' : '' }}">
                <img src="{{ asset('img/ico-format.svg') }}" alt="">
                Format Surat
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('/sekretaris/surat-masuk') }}" class="nav-link{{ Request::is('sekretaris/surat-masuk') ? ' active' : '' }}">
                <img src="{{ asset('img/surat-masuk.svg') }}" alt="">
                Surat Masuk
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('sekretaris/data-surat') }}" class="nav-link{{ Request::is('sekretaris/data-surat') ? ' active' : '' }}">
                <img src="{{ asset('img/ico-data.svg') }}" alt="">
                Data Surat
            </a>
        </li>
    </ul>
  
    <ul class="nav nav-pills gap-3 flex-column">
        <li class="nav-item" >
            <form id="logout-form" action="/logout" method="post">
                @csrf
                <div class="logout d-flex ms-4 gap-4">
                    <img src="{{ asset('img/ico-keluar.svg') }}" alt="">
                    <button class="btn-logout" type="button" onclick="confirmLogout()">Keluar</button>
                </div>
            </form>
        </li>
    </ul>
  </div>