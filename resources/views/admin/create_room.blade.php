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

            <div class="">
                <h1 class="fs-1">Create Room</h1>
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

                <form action="{{url('add_room')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="">Room Title</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div>
                        <label for="">Room Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <div>
                        <label for="">Room Price</label>
                        <input type="text" name="price" class="form-control">
                    </div>
                     <div>
                        <label for="">Wifi</label>
                        <select name="wifi" class="form-control">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                    <div>
                        <label for="">Room Type</label>
                        <select name="type" class="form-control">
                            <option value="single">Single</option>
                            <option value="double">Double</option>
                            <option value="suite">Suite</option>
                        </select>
                    </div>



                    <div>
                        <label for="">Room Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Create Room</button>
                    </div>

                </form>
            </div>

          </div>
        </div>
    </div>

       @include('admin.footer')
  </body>
</html>
