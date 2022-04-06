            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./"><img src="{{ asset('assets') }}/images/logo.png" alt="Logo"></a>
                    <a class="navbar-brand hidden" href="./"><img src="{{ asset('assets') }}/images/logo2.png" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="header-left">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button">
                                <i class="fa fa-refresh"></i> Refresh
                            </button>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button">
                                <i class="fa fa-question-circle"></i> Tutorial
                            </button>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button">
                                <i class="fa fa-info-circle"></i> Info
                            </button>
                        </div>
                    </div>

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="{{ asset('assets') }}/images/admin.jpg" alt="User Avatar">
                        </a>
                        <div class="user-menu dropdown-menu">
                            <a class="nav-link"><i class="fa fa-circle text-success"></i> 
                                <strong>{{Auth::user()->name }}</strong>
                            </a>
                            <a class="nav-link" href="#"><i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>
                </div>
            </div>