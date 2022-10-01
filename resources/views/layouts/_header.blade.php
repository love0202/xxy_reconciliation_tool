<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <span class="navbar-brand"
                  rel="{{ config('app.name', 'Laravel') }}">
                <img src="{{ yxx_path_static('logo.png') }}" alt="logo" width="30" height="30">
                {{ isset($webProject->name) ? $webProject->name : '' }}
            </span>
            @auth
                <div class="d-flex">
                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('auth.admin.logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    退出登录
                                </a>
                                <form id="logout-form" action="{{ route('auth.admin.logout') }}" method="POST"
                                      class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
        @endauth
    </nav>
    <nav class="navbar navbar-expand-lg navbar-dark p-0" style="background-color:#3f59ba">
        <div class="container-fluid p-0">
            <button class="navbar-toggler m-auto" type="button" data-bs-toggle="collapse"
                    data-bs-target="#yxx-navbar-scroll"
                    aria-controls="yxx-navbar-scroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="yxx-navbar-scroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll">
                    @foreach(get_yxx_menu($webProject) as $menu)
                        <li class="nav-item text-center" style="min-width: 100px;border:1px solid #8d8484">
                            <a class="nav-link @if(isset($menu['active'])) active @endif " href="{{ route($menu['routeName']) }}">
                                <div class="d-flex flex-column">
                                    <i class="bi bi-house fs-3"></i>
                                    <span>{{ $menu['name'] }}</span>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
                @if($webProject)
                    <div class="d-flex">
                        <div class="btn-group">
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#model-quit-project">
                                <span class="me-2">切换对账方案</span><i class="bi bi-arrow-left-right"></i>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </nav>
</header>
<!-- model-quit-project -->
<div class="modal fade" id="model-quit-project" tabindex="-1" aria-labelledby="model-quit-project-label"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="model-quit-project-label">切换对账方案</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                是否确定切换对账方案？
            </div>
            <div class="modal-footer">
                <a href="{{ route('project.quit') }}" class="btn btn-primary text-white">确认</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>
