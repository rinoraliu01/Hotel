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
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <table class="table table-striped table-small">
                <tr class="table-light">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
             @foreach($messages as $message)
               <tr class="">
                    <td>{{ $message->name }}</td>
                    <td>{{ $message->email }}</td>
                    <td>{{ $message->phone }}</td>
                    <td>{{ $message->message }}</td>
                    <td>
                        <a href="{{url('send_mail/'.$message->id)}}" class="btn btn-success">Send mail</a>
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
