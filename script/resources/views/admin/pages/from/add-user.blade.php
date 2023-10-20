@extends('admin.resource.main')
@section('title', 'Add User')
@section('content')
<div class="row">
    <div class="col-lg-12 mx-auto">
        <div class="row">
            <div class="col-md-6">
                <div class="card dr-pro-pic">
                <div class="card-body">
                    {{-- <h4 class="card-title"> @yield('title')&nbsp;<a href="{{url('/list-users')}}" class="btn btn-warning btn-flat btn-sm" title="Back"><i class="fa fa-plus" aria-hidden="true"></i> Back</a></h4> --}}
                    <h4 class="card-title"> @yield('title')&nbsp;<a href="{{url('/list-organization')}}" class="btn btn-sm" style="float: right;" title="Back"><i class="fa fa-plus text-warning" aria-hidden="true"></i> Back</a></h4>
                    {{-- form start --}}
                    <form action="{{url('/adduser')}}" method="post">

                        @if (session('success'))
                        <script>
                            Swal.fire('Success', '{{ session('success') }}', 'success');
                        </script>
                        @endif

                        @if ($errors->any())
                            <script>
                                Swal.fire('Error', 'User Id Already Exists, Please try another one', 'error');
                            </script>
                        @endif
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text bg-gradient-primary text-white">Name</span>
                                    </div>
                                    <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Name" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-gradient-primary text-white">Email</span>
                                </div>
                                <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text bg-gradient-primary text-white">Phone</span>
                                    </div>
                                    <input type="text" name="phone" value="{{old('phone')}}" class="form-control" placeholder="Phone" required maxlength="10">
                                </div>
                            </div>
                        </div>
                            <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text bg-gradient-primary text-white">User ID</span>
                                    </div>
                                    <input type="text" name="user_id" value="{{old('user_id')}}" class="form-control" placeholder="User ID" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text bg-gradient-primary text-white">Password</span>
                                    </div>
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text bg-gradient-primary text-white">Organization</span>
                                    </div>
                                    <input type="hidden" name="org_id" value="{{$id}}" class="form-control">
                                    <input type="text" value="{{ucfirst(Helper::Organization($id))}}" class="form-control" readonly>
                                </div>
                            </div>

                            <?php $rolls=DB::table('rolls')->get(); ?>
                            <div class="col-md-6" id="selectbox">
                                <select class="form-select" name="roll_id" required>
                                    <option value="">Select Roll</option>
                                    @foreach ($rolls as $roll)
                                    <option value="{{$roll->id}}">{{ucfirst($roll->roll_name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <script>
                            var removeProduct = function() {
                                document.getElementById('remove').disabled = true;
                                var table = document.getElementById('times');
                                let counterSec = Number(document.getElementById('counter_sec').value);
                                //counter = row.length;
                                if (counterSec > 1) {
                                    table.deleteRow(counterSec);
                                    document.getElementById('counter_sec').value = (counterSec - 1);
                                    document.getElementById('remove').disabled = false;
                                } else {
                                    document.getElementById('remove').disabled = false;
                                }

                            }
                            var addProduct = function() {
                                document.getElementById('add').disabled = true;
                                let counterSec = Number(document.getElementById('counter_sec').value);
                                $.ajax({
                                    url: "{{ url('ajax-add-user') }}",
                                    type: 'GET',
                                    data: {
                                        'call': (counterSec + 1),
                                    },
                                    dataType: 'html',
                                    success: function(data) {
                                        $('#times tbody').append(data);
                                        document.getElementById('counter_sec').value = (counterSec + 1);
                                        document.getElementById('add').disabled = false;
                                    },
                                    error: function(request, error) {
                                        document.getElementById('add').disabled = false;
                                        console.log("Request: Fail");
                                    }
                                });
                            }

                        </script>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="hidden" name="counter_sec" id="counter_sec" value="1">
                                <span>Additional Data:</span>
                                <button type="button" id="add" class="btn btn-success btn-sm mb-2 px-2" onclick="addProduct()" style="float: right;"><i class="fas fa-plus"></i>&nbsp;Add</button>
                                <table class="table table-bordered table-responsive" id="times">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th colspan="2">Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" name="title1">
                                            </td>
                                            <td colspan="2">
                                                <input type="text" class="form-control" name="value1">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm px-2 mt-3 mb-0" style="float: right;">Submit</button>
                        </form>
                        {{-- form end --}}
                    </div>
                </div>
                </div>
                <div class="col-md-6">
                    <div class="card dr-pro-pic">
                        <div class="card-body">
                            <h4 class="card-title"> User List</h4>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-responsive table-striped" >
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>User ID</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                    <th>CPWD</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $users=DB::table('users')
                                                ->where('org_id',$id)
                                                ->where('is_delete','N')
                                                ->orderBy('id','DESC')
                                                ->get();?>
                                                @foreach ($users as $user)
                                                <tr>
                                                    <td>{{$user->name}}</td>
                                                    <td>{{$user->phone}}</td>
                                                    <td>{{$user->user_id}}</td>
                                                    <td>
                                                        <div class="text-right">
                                                            <form action="{{url('usersstatus/'.$user->id) }}" name="sstc{{$user->id}}" id="sstc{{$user->id}}" method="post">
                                                                <input type="hidden" name="status" value="{{$user->status}}">
                                                                <div class="form-check-custom form-check-solid form-switch">
                                                                    <input class="form-check-input" type="checkbox" id="status{{$user->id}}" value="{{$user->status}}" {{($user->status=='1')?'checked title=Active':'title=Inactive'}} onchange="statusActivInact('{{ $user->id }}');">
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <form action="{{url('userdelete/'.$user->id)}}" method="post">
                                                        <button type="submit" type="button" style="border: none; background:none;" title="Delete"><i class="fa fa-trash text-danger font-16"></i>
                                                        </button>
                                                        </form>
                                                    </td>
                                                    <td><button type="button" class="btn btn-success btn-sm" onclick="openModal({{$user->id}})" style="border: none;" title="click">Click</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <!--end card-body-->
        </div><!--end card-->
    </div> <!--end col-->
</div>
<script>
    function openModal(id) {
        $('#myModal').modal('show');
    }
</script>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Change Password</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal form-material mb-0" method="post"
                action="{{ url('/add-org-subscription') }}">
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-gradient-primary text-white" style="width:120px !important;">Change Password</span>
                                </div>
                                <input type="text" class="form-control" name="password">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info btn-flat btn-sm" title="Submit"
                    style="float: right;">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    // var ischecked=document.getElementById('status2').checked;
    function statusActivInact(id) {
        var ischecked=document.getElementById('status'+id);
        //alert(ischecked.checked);
        var fid="sstc"+id;
        var result = confirm("Are you want to change the status?");
        if (result) {
            document.getElementById(fid).submit();

        }else{
            if(ischecked.checked==false){
            document.getElementById('status'+id).checked=true;
            }else{
            document.getElementById('status'+id).checked=false;
            }
        }
        }
    </script>
@endsection
