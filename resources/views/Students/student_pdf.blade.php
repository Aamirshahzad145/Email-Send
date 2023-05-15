<!DOCTYPE html>
<html>
<head>
    <title>Laravel 9 Generate PDF Example - ItSolutionStuff.com</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap_main.css') }}">
    {{--  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">  --}}
</head>
<body>
    <h1 style="text-align: center;">{{ $title }}</h1>
    <p style="text-align: center; margin-bottom: 20px;">{{ $today }}</p>
    <p>PDF student records provide an efficient and organized way for educational institutions to store and share important student information. These digital documents include personal information, and other relevant details in a compact and easily accessible format.</p>
  
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Username</th>
            <th>Phone</th>
            <th>DOB</th>
        </tr>
        @php
            $i=0;
        @endphp
        @foreach($Student as $user)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ \Carbon\Carbon::parse($user->dob)->format('d-m-y') }}</td>
            {{--  <td>{{ $user->dob }}</td>  --}}
        </tr>
        @endforeach
    </table>
  
</body>
</html>