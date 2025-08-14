<div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="title">
            <h1 class="h5">{{ Auth::user()->name }}</h1>
            <p>Web Developer</p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
                <li class="active"><a href="index.html"> <i class="icon-home"></i>Home </a></li>

                <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Hotel Rooms </a>
                  <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                    <li><a href="{{url('/create_room')}}">Add Room</a></li>
                    <li><a href="{{url('/view_rooms')}}">View Rooms</a></li>
                  </ul>
                </li>
                <li><a href="{{url('bookings')}}"> <i class="icon-home"></i>Bookings </a></li>
                <li><a href="{{url('view_gallary')}}"><i class="icon-home"></i>Gallary</a></li>
                <li><a href="{{url('messages')}}"><i class="icon-home"></i>Messages</a></li>

                <li><a href="login.html"> <i class="icon-logout"></i>Login page </a></li>
        </ul>

      </nav>
