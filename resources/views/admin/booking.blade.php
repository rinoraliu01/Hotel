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
            <h4 class="mb-3">Bookings</h4>
                 @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                @endif
                @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                @endif
            <div class="table-responsive">
             <table class="table table-striped  table-sm">
                <tr class="table-light">
                    <th>Room ID</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Check_in</th>
                    <th>Check_out</th>
                    <th>Status</th>
                    <th>Room Title</th>
                    <th>Room Price</th>
                    <th>Delete</th>
                    <th>Status Update</th>
                </tr>
                @foreach($bookings as $booking)
                    <tr class="">
                        <td>{{ $booking->room_id }}</td>
                        <td>{{ $booking->name }}</td>
                        <td>{{ $booking->email }}</td>
                        <td>{{ $booking->phone }}</td>
                        <td>{{ $booking->check_in }}</td>
                        <td>{{ $booking->check_out }}</td>
                        <td>
                            @if($booking->status == 'Approved')
                                <span style="background-color: #a3e635 !important; color:#000 !important;" class="badge">{{ $booking->status }}</span>
                            @elseif($booking->status == 'Rejected')
                                <span class="badge bg-danger">{{ $booking->status }}</span>
                            @else
                                <span class="badge bg-warning">{{ $booking->status }}</span>
                            @endif
                        </td>
                        <td>{{ $booking->room->room_title }}</td>
                        <td>{{ $booking->room->price }}</td>
                        <td>
                            <a class="btn btn-outline-danger"
                            onclick="return confirm('Are you sure to delete this booking?')"
                            href="{{ url('delete_booking', $booking->id) }}"
                            >Delete</a>
                        </td>
                        <td class="">
                            <span style="padding-bottom: 10px">
                                <a  class="btn btn-outline-success " href="{{ url('approve_booking', $booking->id) }}">Approve</a>
                            </span>
                            <a class="btn btn-outline-warning" href="{{ url('reject_booking', $booking->id) }}">Reject</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
          </div>
        </div>
      </div>


       @include('admin.footer')
  </body>
</html>
