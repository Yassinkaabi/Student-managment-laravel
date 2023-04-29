<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Student list</title>
</head>

<body>
    <div class="container" style="margin-top:25px;">
        <div class="row">
            <div class="col-md-12 mt-5">
                <h2>Student list</h2>
                @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('success')}}
                    </div>
                @endif
                <div class="d-flex justify-content-end " style="margin-bottom:20px">
                    <a class="btn btn-primary" href="{{route('add-student')}}">Add</a>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Photo</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $student)
                        <tr>
                            <td>{{$student->id}}</td>
                            <td>{{$student->name}}</td>
                            <td>{{$student->email}}</td>
                            <td>{{$student->phone}}</td>
                            <td>{{$student->adress}}</td>
                            <td>
                                <img src="{{ asset($student->photo) }}" width="60" height="60" alt="">
                            </td>
                            <td>
                                    <a class="btn btn-success" href="{{ url('edit-student/'.$student->id) }}">Edit</a>
                                    <a class="btn btn-danger" href="{{ url('delete-student/'.$student->id) }}">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>