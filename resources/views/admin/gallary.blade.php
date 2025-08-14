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

            <h4 class="page-title">Gallery</h4>
            <p class="text-muted">Manage your gallery images here.</p>

            <div class="row">
            @foreach ($gallary as $image)
                <div class="col-md-3 col-sm-6 me-4">
                    <div class="gallery_img">
                        <figure><img src="{{ asset('gallery/' . $image->image) }}" alt="#" style="width: 250px !important; height: 250px !important;"/></figure>
                        <div class="gallery_action me-4">
                            <a
                                onclick="return confirm('Are you sure you want to delete this image?')"
                                href="{{ url('delete_gallery', $image->id) }}" class="btn btn-danger btn-sm ">
                                Delete
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>

            @if (session('success'))
                <div class="alert alert-success mt-4">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{url('add_gallery')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group mt-4">
                <label for="image">Upload Image</label>
                <input type="file" name="image" class="form-control" id="image" >
              </div>
              <button type="submit" class="btn btn-primary">Add</button>
            </form>
          </div>
        </div>
      </div>
       @include('admin.footer')
  </body>
</html>
