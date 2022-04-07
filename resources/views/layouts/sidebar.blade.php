            <li class="menu-item {{ request()->is('data-sdi*') ? 'active' : '' }}">
              <a href="{{URL('data-sdi')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-food-menu"></i>
                <div data-i18n="Analytics">Data Primer</div>
              </a>
            </li>
            <li class="menu-item {{ request()->is('riwayat*') ? 'active' : '' }}">
              <a href="{{URL('riwayat')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-analyse"></i>
                <div data-i18n="Analytics">Riwayat</div>
              </a>
            </li>
            <li class="menu-item {{ request()->is('ekspor*') ? 'active' : '' }}">
              <a href="{{URL('ekspor')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-download"></i>
                <div data-i18n="Analytics">Ekspor</div>
              </a>
            </li>