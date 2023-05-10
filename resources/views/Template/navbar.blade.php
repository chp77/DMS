<nav class="main-header navbar navbar-expand navbar-dark-blue navbar-light">
    <a class="nav-link push-menu" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fa fa-bell nav-white"></i>
                <span class="nav-text">Alert</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fa fa-link nav-white"></i>
                <span class="nav-text">Enroll</span>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <span class="badge badge-danger navbar-badge">3</span>
                <i class="fa fa-envelope nav-white"></i>
                <span class="nav-text">Info Center</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right arrow-top">
                <a href="#" class="dropdown-item">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Brad Diesel
                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">Call me whenever you can...</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                </a>

                <div class="dropdown-divider"></div>

                <a href="#" class="dropdown-item">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                John Pierce
                                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">I got your message bro</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                </a>

                <div class="dropdown-divider"></div>

                <a href="#" class="dropdown-item">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Nora Silvester
                                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">The subject goes here</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                </a>

                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fa fa-globe nav-white"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right arrow-top">
                <a href="#" class="dropdown-item">
                    English
                </a>
                <a href="#" class="dropdown-item">
                    繁體中文
                </a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-commenting nav-white"></i>
                <span class="badge badge-warning navbar-badge">4</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right arrow-top">
                <span class="dropdown-item dropdown-header">4 Notifications</span>
                <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-user nav-white"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right arrow-top">
                <span class="dropdown-header text-left text-dark font-weight-bold">
                    @if(session('user'))
                        {{ session('user.name') }}
                    @endif
                </span>
                <span class="dropdown-header text-left">
                    Pro
                    </br>
                    (Remaining357 days)
                </span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fa fa-cog"></i> Settings
                </a>
                <a href="{{ route('logout') }}" class="dropdown-item">
                    <i class="fa fa-sign-out"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
