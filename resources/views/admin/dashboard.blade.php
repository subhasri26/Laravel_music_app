<!DOCTYPE html>
<html>
<head>
    <title>Admin Approval</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <style>
        .column {
            float: left;
            width: 50%;
            padding: 10px;
        }
         .container h1 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="row">
        <div class="col-md-6">
    <table id="pending-musicians-table" class="display">
                <h1><center>Details of File</center></h1>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pendingMusicians as $musicFile)
                <tr>
                    <td>{{ $musicFile->musician->name ?? 'N/A'}}</td>
                    <td>
                         <audio controls>
                                <source src="/audio/{{$musicFile->filename}}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </td>
                    <td>
                      @if ($musicFile->approved == 0)
                        <a href="{{ url('/admin/file/approve', $musicFile->id) }}">Approve</a>
                    @else
                        <a href="{{ url('/admin/file/unapprove', $musicFile->id) }}">Unapprove</a>
                    @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
 <div class="col-md-6">
    <!-- Display list of musicians -->
<table id="musicians-table" class="display">
            <h1><center>Details of musicans</center></h1>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($musicians as $musician)
            <tr>
                <td>{{$musician->name}}</td>
                <td>{{$musician->email}}</td>
                <td>
                 <td>
                      @if ($musician->approved == 0)
                        <a href="{{ url('/admin/musician/approve', $musician->id) }}">Approve</a>
                    @else
                        <a href="{{ url('/admin/musician/unapprove', $musician->id) }}">Unapprove</a>
                    @endif
                    </td>
                </td>
            </tr>
        @endforeach
    </tbody>
 </table>
        </div>
    </div>
    <div style="text-align: center; margin-top: 20px;">
        <button><a href="{{ url('/admin/logout') }}">Logout</a></button>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#pending-musicians-table').DataTable();
            // $('#musicians-table').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#musicians-table').DataTable();
        });
    </script>

</body>
</html>