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
            <h2 class="mb-0">Send Mail</h2>
            <h4>Sending Mail To: {{$message->name}}</h4>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form action="{{url('mail', $message->id)}}" method="POST">
              @csrf

              <div class="form-group">
                <label for="greeting">Greeting:</label>
                <input type="text" name="greeting" id="greeting" class="form-control">
              </div>

              <div class="form-group">
                <label for="body">Mail Body:</label>
                <input type="text" name="body" id="body" class="form-control">
              </div>

              <div class="form-group">
                <label for="action_text">Action Text:</label>
                <input type="text" name="action_text" id="action_text" class="form-control">
              </div>

              <div class="form-group">
                <label for="action_url">Action Url:</label>
                <input type="text" name="action_url" id="action_url" class="form-control">
              </div>

              <div class="form-group">
                <label for="endline">End Line:</label>
                <input type="text" name="endline" id="endline" class="form-control">
              </div>

              <button type="submit" class="btn btn-primary">Send Mail</button>
            </form>
          </div>
        </div>
      </div>
       @include('admin.footer')
  </body>
</html>
