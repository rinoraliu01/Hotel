 <div  class="our_room">
        <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Our Room</h2>
                  </div>
               </div>
            </div>
            <div class="row">
                @foreach ($room as $rooms)
               <div class="col-md-4 col-sm-6">
                  <div id="serv_hover"  class="room">
                     <div class="room_img">
                        <figure><img style="height: 200px; width:100%" src="{{ asset('room/'.$rooms->image) }}" alt="#"/></figure>
                     </div>
                     <div class="bed_room">
                        <h3>{{ $rooms->room_title }}</h3>
                        <p style="padding: 10px">{!! Str::limit($rooms->description, 20) !!} </p>

                        <a href="{{url('room_details/'.$rooms->id)}}" class="btn btn-outline-success">View Details</a>
                     </div>
                  </div>
               </div>
               @endforeach
            </div>
         </div>
      </div>
