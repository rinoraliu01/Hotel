<!DOCTYPE html>
<html>
  <head>
    <base href="/public">
    @include('admin.css')
  </head>
  <body>
   @include('admin.header')
    @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
    <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">

            <div class="">
                <h1 class="fs-1">Update Room</h1>
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                <form action="{{url('edit_room/'.$room->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="title" class="form-label font-bold ">Room Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $room->room_title }}">
                    </div>
                    <div>
                        <label for="description" class="form-label font-bold">Room Description</label>
                        <textarea name="description" class="form-control">{{ $room->description }}</textarea>
                    </div>
                    <div>
                        <label for="price" class="form-label font-bold">Room Price</label>
                        <input type="text" name="price" class="form-control" value="{{ $room->price }}">
                    </div>
                     <div>
                        <label for="wifi" class="form-label font-bold">Wifi</label>
                        <select name="wifi" class="form-control">
                            <option value="{{$room->wifi}}" selected>{{$room->wifi}}</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                    <div>
                        <label for="type" class="form-label font-bold">Room Type</label>
                        <select name="type" class="form-control">
                            <option value="{{ $room->room_type }}" selected>{{ $room->room_type }}</option>
                            <option value="Single">Single</option>
                            <option value="Double">Double</option>
                            <option value="Suite">Suite</option>
                        </select>
                    </div>
                    <div class="mt-4">
                        <label for="current_image" class="form-label font-bold">Current Image</label>
                        <img src="{{ asset('room/'.$room->image) }}" alt="Room Image" class="img-fluid" style="width: 100px; height: 100px;">
                    </div>

                    <div>
                        <label for="image" class="form-label font-bold">Room Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Update Room</button>
                    </div>

                </form>
            </div>

          </div>
        </div>
    </div>

       @include('admin.footer')
  </body>
</html>
