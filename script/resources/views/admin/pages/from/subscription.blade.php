@extends('admin.resource.main')
@section('title', 'Subscriptions')
@section('content')

<div class="row grid-margin">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><i class="fa fa-home"></i> @yield('title')
                    <button type="button" id="btnDis" class="btn btn-sm" style="float: right;" onclick="addRow()"><i class="fas fa-plus text-success"></i>&nbsp;Add New</button></h4>
                <script>
                    function addRow(){
                        document.getElementById('jsrow').style.display='contents';
                    }
                    function deleteRow(){
                        document.getElementById('jsrow').style.display='none';
                    }
                    function editRow(idrow,dataid) {
                        //console.log(dataid);
                        getTableData('{{url("getSubscriptions")}}','post',dataid).then(
                        response =>{
                            data = response[0];
                            document.getElementById(idrow).innerHTML='<td colspan="1"></td><td><input type="text" class="form-control form-control-danger" id="ud_sub_name" value="' + data.subscription_name + '"></td><td><input type="text" class="form-control form-control-danger" id="ud_subn_amt_month" value="' + data.subscription_amount_month + '"></td><td><input type="text" class="form-control form-control-danger" id="ud_sub_amt_year" value="' + data.subscription_amount_year + '"></td><td><input type="text" class="form-control form-control-danger" id="ud_duration" value="' + data.duration + '"></td><td colspan="3"><button class="btn btn-sm" type="button" onclick="updateRow(' + " 'ud_sub_name,ud_subn_amt_month,ud_sub_amt_year,ud_duration', 'post', '{{url('updateSubscriptions ')}}' " + ',' + " '" + data.id + "' " + ')"><i class="fas fa-check text-primary font-18" aria-hidden="true"></i></button><button class="btn btn-sm" type="button" onclick="location.reload();"><i class="fas fa-times text-danger font-18" aria-hidden="true"></i></button></td>';
                            var edt=document.getElementsByClassName('edit-row');
                            for (var i = 0; i < edt.length; i++) {
                            edt[i].innerHTML='';

                            }
                        }
                        );
                    }

                </script>
                <form method="GET">
                    <div class="row my-4">
                        <div class="col-md-2">
                            <input type="text" class="form-control" placeholder="Subscription Name" name="subscription_name" value="{{$request->subscription_name}}">
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control" placeholder="Amount (Month)" name="subscription_amount_month" value="{{$request->subscription_amount_month}}">
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control" placeholder="Amount (Year)" name="subscription_amount_year" value="{{$request->subscription_amount_year}}">
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control" placeholder="Duration" name="duration" value="{{$request->duration}}">
                        </div>
                        <div class="col-md-2">
                            <select name="status" id="" class="form-select">
                                <option value="">Select One</option>
                                <option value="0">Inactive</option>
                                <option value="1">Active</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary btn-xs"><i class="fa fa-search" style="font-size: 0.7rem;"></i>  Search</button>
                            <a href="{{url('/subscriptions')}}" class="btn btn-danger btn-xs"><i class="fa fa-sync" style="font-size: 0.7rem;"></i> Reset</a>
                        </div>
                    </div>
                </form>
                <table class="table table-bordered table-responsive table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Subscription Name</th>
                        <th>Subscription Amount (In Month)</th>
                        <th>Subscription Amount (In Year)</th>
                        <th>Duration (Days)</th>
                        <th>Status</th>
                        <th>Permissions</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="editTable">
                    <tr id="jsrow" style="display: none;">
                        <td colspan="1"></td>
                        <td><input type="text" class="form-control form-control-danger" name="subscription_name" id="sub_name" required ></td>
                        <td><input type="text" class="form-control form-control-danger" name="subscription_amount_month" id="subn_amt_month" required></td>
                        <td><input type="text" class="form-control form-control-danger" name="subscription_amount_year" id="sub_amt_year" required ></td>
                        <td><input type="text" class="form-control form-control-danger" name="duration" id="duration" required></td>
                        <td colspan="3">
                            <button type="submit" class="btn btn-sm" onclick="addData('sub_name,subn_amt_month,sub_amt_year,duration','post','{{url('add-subscriptions')}}')"><i class="fas fa-check text-info font-18" aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-sm" onclick="deleteRow()"><i class="fas fa-times text-danger font-18" aria-hidden="true"></i></button>
                        </td>
                    </tr>
                    <?php $i=1;
                    $datas=DB::table('subscriptions')
                        ->where(function($query) use($request) {
                            if(!empty($request->subscription_name)) $query->where("subscription_name",$request->subscription_name);
                            if(!empty($request->subscription_amount_month)) $query->where("subscription_amount_month",$request->subscription_amount_month);
                            if(!empty($request->subscription_amount_year)) $query->where("subscription_amount_year",$request->subscription_amount_year);
                            if(!empty($request->duration)) $query->where("duration",$request->duration);
                            if(!empty($request->status)) $query->where("status",$request->status);
                    })
                    ->orderBy('id','DESC')->paginate(20);
                    ?>
                    @foreach ($datas as $data)
                    <tr id="row{{$i}}">
                        <td>{{$i}}</td>
                        <td>{{$data->subscription_name}}</td>
                        <td>₹{{$data->subscription_amount_month}}</td>
                        <td>₹{{$data->subscription_amount_year}}</td>
                        <td>{{$data->duration}} Days</td>
                        <td>
                            <form action="{{url('subscriptions-status/'.$data->id) }}" name="sstc{{$data->id}}" id="sstc{{$data->id}}" method="post">
                            <input type="hidden" name="status" value="{{$data->status}}">
                            <div class="form-check-custom form-check-solid form-switch">
                                <input class="form-check-input" type="checkbox" id="status{{$data->id}}" value="{{$data->status}}" {{($data->status=='1')?'checked title=Active':'title=Inactive'}} onchange="statusActivInact('{{ $data->id }}');">
                            </div>
                            </form>
                            </td>
                            <td><a href="{{url('list-subscription-permissions/'.$data->id)}}" class="btn btn-primary btn-xs" type="button"  title="Permissions">Permissions</a></td>
                            <td class="edit-row"><button class="btn btn-sm" type="button" onclick="editRow('row{{$i}}','{{$data->id}}')" title="Edit"><i class="fas fa-edit text-warning font-18" aria-hidden="true"></i></button></td>

                    </tr>
                    <?php $i++; ?>
                    @endforeach
                </tbody>
                </table>
                <div class="d-flex mt-3" style="float: right;">
                    {{ $datas->links() }}
                </div>
            </div>
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
