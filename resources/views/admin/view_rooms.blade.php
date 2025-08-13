<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')
  </head>
  <body>
   @include('admin.header')
    @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
       <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
                @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
            <table class="table table-bordered">
                <tr class="table-light">
                    <th>Room Title</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Type</th>
                    <th>Wifi</th>
                    <th>Image</th>
                    <th>Delete</th>
                    <th>Edit</th>
                </tr>
                @foreach ($rooms as $room )

               <tr class="">
                <td>
                    {{ $room->room_title }}
                </td>
                <td>
                    {!! Str::limit($room->description, 20) !!}
                </td>
                <td>
                    {{$room->price}}$
                </td>
                <td>
                    {{$room->wifi}}
                </td>
                <td>
                    {{$room->room_type}}
                </td>
                <td>
                    <img src="{{ asset('room/'.$room->image) }}" alt="Room Image" class="img-fluid" style="width: 100px; height: 100px;">
                </td>
                <td>
                    <a onclick="return confirm('Are you sure you want to delete this room?');" href="{{ url('room_delete', $room->id) }}" class="btn btn-outline-danger">Delete</a>
                </td>
                <td>
                    <a href="{{url('room_update', $room->id)}}" class="btn btn-outline-warning">Edit</a>
                </td>
                </tr>
                 @endforeach
            </table>

          </div>
        </div>
       </div>
       @include('admin.footer')
  </body>
</html>
