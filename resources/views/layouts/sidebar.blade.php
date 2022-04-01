<nav class="navbar navbar-expand-sm navbar-default">

<div id="main-menu" class="main-menu collapse navbar-collapse">
    <ul class="nav navbar-nav">

        <li class="menu-title text-muted">MENU NAVIGASI</li><!-- /.menu-title -->

        <li class="{{ request()->is('data-sdi') ? 'active' : ''}}">
            <a href="{{URL('data-sdi')}}">
                <i class="menu-icon fa fa-table"></i><b>Data SDI</b> 
            </a>
        </li>
        
        <li class="{{ request()->is('riwayat') ? 'active' : ''}}">
            <a href="{{URL('riwayat')}}">
                <i class="menu-icon fa fa-history"></i><b>Riwayat</b> 
            </a>
        </li>

        <li class="{{ request()->is('ekspor') ? 'active' : ''}}">
            <a href="{{URL('ekspor')}}">
                <i class="menu-icon fa  fa-download"></i> <b>Ekspor</b>
            </a>
        </li>
        
    </ul>
</div><!-- /.navbar-collapse -->
</nav>