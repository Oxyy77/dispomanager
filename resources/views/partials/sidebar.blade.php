<div class="d-flex flex-column flex-shrink-0 sidebar p-3 position-fixed">
  <a href="/dashboard-direktur" class="d-flex mt-4 sidebar-header justify-content-between align-items-center text-decoration-none">
      <span style="color: #fff">Dispo</span><span style="color:#003249;">Manager</span>
  </a>

  <ul class="nav mt-5 nav-pills gap-3 flex-column">
      <li class="nav-item">
          <a href="{{ url('/dashboard/direktur') }}" class="nav-link{{ Request::is('dashboard/direktur') ? ' active' : '' }}" aria-current="page">
              <img src="{{ asset('img/ico-dashboard.svg') }}" alt="">
              Dashboard
          </a>
      </li>
      <li class="nav-item" >
          <a href="{{ url('/kelola-direktur') }}" class="nav-link{{ Request::is('kelola-direktur') ? ' active' : '' }}">
              <img src="{{ asset('img/ico-kelola-white.svg') }}" alt="">
              Kelola Surat
          </a>
      </li>
      <li class="nav-item">
          <a href="{{ url('/kode-surat') }}" class="nav-link{{ Request::is('kode-surat') ? ' active' : '' }}">
              <img src="{{ asset('img/ico-format.svg') }}" alt="">
              Kode Surat
          </a>
      </li>
      <li class="nav-item">
          <a href="{{ url('/surat-masuk') }}" class="nav-link{{ Request::is('surat-masuk') ? ' active' : '' }}">
              <img src="{{ asset('img/surat-masuk.svg') }}" alt="">
              Surat Masuk
          </a>
      </li>
      <li class="nav-item">
          <a href="{{ url('/data-surat') }}" class="nav-link{{ Request::is('data-surat') ? ' active' : '' }}">
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