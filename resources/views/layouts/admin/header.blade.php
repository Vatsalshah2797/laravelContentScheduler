<!-- topbar -->
<div class="topbar">
    <nav class="navbar navbar-expand-lg navbar-light">
       <div class="full">
          <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
          <div class="logo_section">
             <a href="index.html"><img class="img-responsive" src="{{ asset('import/images/logo/logo.png') }}" alt="#" /></a>
          </div>
          <div class="right_topbar">
             <div class="icon_info">
                <ul class="">
                   <li><a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i></a></li>
                   <li style="width: auto !important"><a href="#"><i class="fa fa-rupee"></i>{{$walletBalance ?? 0}}</a></li>
                   {{-- <li><a href="#"><i class="fa fa-bell-o"></i><span class="badge">2</span></a></li> --}}
                   {{-- <li><a href="#"><i class="fa fa-question-circle"></i></a></li> --}}
                   {{-- <li><a href="#"><i class="fa fa-envelope-o"></i><span class="badge">3</span></a></li> --}}
                </ul>
                <ul class="user_profile_dd">
                   <li>
                      <a class="dropdown-toggle" data-toggle="dropdown"><img class="img-responsive rounded-circle" src="{{ asset('import/images/layout_img/user_img.jpg') }}" alt="#" /><span class="name_user">{{ucwords($user->name)??''}}</span></a>
                      <div class="dropdown-menu">
                         <a class="dropdown-item" href="{{ route('profile') }}">My Profile</a>
                         <a class="dropdown-item" href="profile.html">Change Password</a>
                         {{-- <a class="dropdown-item" href="settings.html">Settings</a> --}}
                         {{-- <a class="dropdown-item" href="help.html">Help</a> --}}
                         <a class="dropdown-item" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                               {{ __('Log Out') }}
                               <i class="fa fa-sign-out"></i>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                               @csrf
                            </form>
                         {{-- <a class="dropdown-item" href="{{ route('logout') }}"><span>Log Out</span> <i class="fa fa-sign-out"></i></a> --}}
                      </div>
                   </li>
                </ul>
             </div>
          </div>
       </div>
    </nav>
 </div>
 <!-- end topbar -->