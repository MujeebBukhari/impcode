<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <title>Document</title>
</head>

<body>
    <section style="padding: 60px">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Students
                            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#studentModal">Add new Student</a>
                        </div>
                        <div class="card-body">
                            <table id="studentTable" class="table">
                                <thead>
                                    <tr>   
                                      
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr id="sid{{$student->id}}">
                                            
                                            <td>{{ $student->firstname }}</td>
                                            <td>{{ $student->lastname }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td>{{ $student->phone }}</td>
                                            <td>
                                                <a href="javascript:void(0)" class="btn btn-info" onclick="editStudent({{$student->id}})">Edit</a>
                                                <a href="javascript:void(0)" class="btn btn-danger" onclick="deleteStudent({{$student->id}})">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

x

    <!-- Modal -->
    <div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <form id="studentForm" >
                    @csrf
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" class="form-control" id="firstname">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" class="form-control" id="lastname">
                    </div>
                    <div class="form-group">
                        <label for="firstname">Email</label>
                        <input type="email" class="form-control" id="email">
                    </div>
                    <div class="form-group">
                        <label for="firstname">Phone No</label>
                        <input type="number" class="form-control" id="phone">
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                  </form>
                </div>
               
            </div>
        </div>
    </div>

    <div class="modal fade" id="studentEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form id="studentEditForm" >
                @csrf
                <input type="hidden" id="id" name="id" />
                <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" class="form-control" id="firstname2">
                </div>
                <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input type="text" class="form-control" id="lastname2">
                </div>
                <div class="form-group">
                    <label for="firstname">Email</label>
                    <input type="email" class="form-control" id="email2">
                </div>
                <div class="form-group">
                    <label for="firstname">Phone No</label>
                    <input type="number" class="form-control" id="phone2">
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
              </form>
            </div>
           
        </div>
    </div>
</div>

  

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @include('sweetalert::alert')


    <script>
        $("#studentForm").submit(function(e){
            e.preventDefault();
            
            let firstname = $("#firstname").val();
            let lastname = $("#lastname").val();
            let email = $("#email").val();
            let phone = $("#phone").val();
            let _token = $("input[name=_token]").val();

            $.ajax({
                url: "{{route('addstudents')}}",
                method: "POST",
                data: {
                     firstname: firstname,
                    lastname: lastname, 
                    email: email,
                    phone: phone,
                    _token: _token
                },
                success:function(response)
                {
                    if(response)
                    {
                        $("#studentTable tbody").prepend('<tr> <td>' + response.firstname + '</td> <td>'+ response.lastname +' </td> <td>'+ response.email +'</td> <td>'+ response.phone +'</td> </tr>')
                        $("#studentForm")[0].reset();
                        $("#studentModal").modal('hide'); 
                    }
                }
            })
        })
    </script>
    <script>
        function editStudent(id)
        {
            $.get('/students/'+id, function(student){
                $("#id").val(student.id);
                $("#firstname2").val(student.firstname);
                $("#lastname2").val(student.lastname);
                $("#email2").val(student.email);
                $("#phone2").val(student.phone);
                $("#studentEditModal").modal('toggle');
            });
        }

        $("#studentEditForm").submit(function(e){
            e.preventDefault();
            
            let id = $("#id").val();
            let firstname = $("#firstname2").val();
            let lastname = $("#lastname2").val();
            let email = $("#email2").val();
            let phone = $("#phone2").val();
            let _token = $("input[name=_token]").val();

            $.ajax({    
                url: "{{route('updateStudent')}}",
                type: "PUT",
                data: {
                    id: id, 
                    firstname: firstname,
                    lastname: lastname,
                    email: email,
                    phone: phone,
                    _token: _token
                },
                success:function(response){
                   
                    $("#sid" + response.id).children('td').eq(0).text(response.firstname);
                    $("#sid" + response.id).children('td').eq(1).text(response.lastname);
                    $("#sid" + response.id).children('td').eq(2).text(response.email);
                    $("#sid" + response.id).children('td').eq(3).text(response.phone);
                    
                    $("#studentEditModal").modal('toggle');
                    $("#studentEditForm")[0].reset();
                   
                }
            })  

        })

    </script>

    <script>
        function deleteStudent(id)
        {
            if(confirm("Do you really want to delete Student?"))    
            {
                $.ajax({
                    url: '/students/'+ id,
                    type: 'DELETE',
                    data: {
                        _token :  $("input[name=_token]").val()
                    },
                    success:function(response)
                    {
                         $("#sid"+id).remove();
                    }
                });
            }
        }
    </script>
    @if(Session::has('success'))
        <script>
            toastr.success("{!! Session::get('success') !!}")
        </script>
    @endif
</body>
</html>
