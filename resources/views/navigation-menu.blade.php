                    {{-- || उद्यम से ही कार्य सिद्ध होते हैं, इच्छा से नहीं। सोते हुए शेर के मुँह में कोई भी मृग नहीं घुसता। || --}}
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="#" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/faviconnews.jpg') }}" alt="" height="30" />
                {{-- <h3 class="fs-3 pt-3 pb-3">ASI</h3> --}}
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/news.jpg') }}" alt="" height="40" />
                {{-- <h3 class=" fs-3 pt-3 pb-3 fw-bold">AUTO SPORTS INDIA</h3> --}}
            </span>
        </a>
        <!-- Light Logo-->
        <a href="#" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/faviconnews.jpg ') }}" alt="" height="30" />
                {{-- <h3 class="fs-3 pt-3 pb-3">ASI</h3> --}}
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/news.jpg') }}" alt="" height="40" />

                {{-- <h3 class=" fs-3 pt-3 pb-3 fw-bold">AUTO SPORTS INDIA</h3> --}}
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                {{-- <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('dashboard') }}">
                        <i class="bx bxs-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li> --}}
                <li class="menu-title"><span data-key="t-menu">Master</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('viewaddnews') }}">
                        <i class="bx bx-plus"></i>
                        <span>Add Newspapers</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('allnewspapers') }}">
                        <i class="bx bx-news"></i>
                        <span>All Newspapers</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
