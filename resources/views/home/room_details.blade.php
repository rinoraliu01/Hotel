<!DOCTYPE html>
<html lang="en">
   <head>
    <base href="/public">
      @include('home.css')
   </head>
   <!-- body -->
   <body class="main-layout">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="images/loading.gif" alt="#"/></div>
      </div>
      <!-- end loader -->
      <!-- header -->
      <header>
        @include('home.header')
      </header>
      <!-- end header inner -->
      <!-- end header -->

        <div class="our_room">
            <div class="container">
                <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Our Room</h2>
                    </div>
                </div>
                </div>
                <div class="row">
                    <div class="col-md-8 ">
                        <div id="serv_hover"  class="room">
                            <div class="room_img" style="padding: 20px">
                                <figure><img style="height: 300px; width: 100%;" src="{{ asset('room/'.$room->image) }}" /></figure>
                            </div>
                            <div class="bed_room">
                                <h3>{{$room->room_title}}</h3>
                                <p style="padding: 10px;">{{$room->description}}</p>
                                <h4 style="padding: 10px;">Free Wifi: {{$room->wifi}}</h4>
                                <h4 style="padding: 10px;">Room Type: {{$room->room_type}}</h4>
                                <h3 style="padding: 10px;">Price: {{$room->price}}$</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="room_booking">
                            <h1>Book This Room</h1>
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if(session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                              <form action="{{ url('add_booking', $room->id) }}" method="POST">
                                    @csrf

                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input
                                            type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            id="name"
                                            name="name"
                                            @if (Auth::id())
                                                value="{{ Auth::user()->name }}"
                                            @endif
                                        >
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input
                                            type="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            id="email"
                                            name="email"
                                            @if (Auth::id())
                                                value="{{ Auth::user()->email }}"
                                            @endif
                                        >
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input
                                            type="text"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            id="phone"
                                            name="phone"
                                            @if (Auth::id())
                                                value="{{ Auth::user()->phone }}"
                                            @endif
                                        >
                                        @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="check_in">Check-in Date</label>
                                        <input
                                            type="date"
                                            class="form-control @error('check_in') is-invalid @enderror"
                                            id="check_in"
                                            name="check_in"
                                            value="{{ old('check_in') }}"
                                        >
                                        @error('check_in')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="check_out">Check-out Date</label>
                                        <input
                                            type="date"
                                            class="form-control @error('check_out') is-invalid @enderror"
                                            id="check_out"
                                            name="check_out"
                                            value="{{ old('check_out') }}"
                                        >
                                        @error('check_out')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                <button type="submit" class="btn btn-primary">Book Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>




      <!--  footer -->
         @include('home.footer')

         <script type="text/javascript">
            $(function(){
                var dtToday = new Date();

                var month = dtToday.getMonth() + 1;

                var day = dtToday.getDate();

                var year = dtToday.getFullYear();

                if(month < 10)
                    month = '0' + month.toString();

                if(day < 10)
                day = '0' + day.toString();

                var maxDate = year + '-' + month + '-' + day;
                $('#check_in').attr('min', maxDate);
                $('#check_out').attr('min', maxDate);

            });
         </script>
   </body>
</html>
