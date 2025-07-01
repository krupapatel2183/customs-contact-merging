<div class="header">
    <div class="header-left">
        <a class="logo"> <img src="{{ asset('assets/img/hotel_logo.png') }}" width="50" height="70" alt="logo"></a>
        <a class="logo logo-small"> <img src="{{ asset('assets/img/hotel_logo.png') }}" alt="Logo" width="30" height="30"> </a>
    </div>
    <a href="javascript:void(0);" id="toggle_btn"> <i class="fe fe-text-align-left"></i> </a>
    <a class="mobile_btn" id="mobile_btn"> <i class="fas fa-bars"></i> </a>
    <ul class="nav user-menu">
        
        <li class="nav-item dropdown has-arrow">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"> 
                <span class="user-img">
                    <img class="rounded-circle" src="{{ asset('assets/img/profiles/avatar-01.jpg') }}" width="31" alt="Soeng Souy">
                </span> 
            </a>
            <div class="dropdown-menu">
                <div class="user-header">
                    <div class="avatar avatar-sm"> 
                        <img src="{{ asset('assets/img/profiles/avatar-01.jpg') }}" alt="User Image" class="avatar-img rounded-circle"> 
                    </div>
                    <div class="user-text">
                        <h6>{{ Auth::user()->first_name }}</h6>
                        <p class="text-muted mb-0">Administrator</p>
                    </div>
                </div> 
                <a class="dropdown-item" href="/logout">Logout</a> </div>
        </li>
    </ul>
</div>