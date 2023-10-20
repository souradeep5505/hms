@extends('admin.resource.main')
@section('title', 'Permissions')
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
                        getTableData('{{url("getPermission")}}','post',dataid).then(
                        response =>{
                            data = response[0];
                            document.getElementById(idrow).innerHTML='<td colspan="2"></td><td><input type="text" class="form-control form-control-danger" id="permis_name_update" value="'+data.permis_name+'"></td><td><input type="text" class="form-control form-control-danger" id="permis_route_update" value="'+data.permis_route+'"></td><td colspan="2"><button class="btn btn-sm" type="button" onclick="updateRow('+"'permis_name_update,permis_route_update','post','{{url('updatePermission')}}'"+','+"'"+data.id+"'"+')"><i class="fas fa-check text-primary font-18" aria-hidden="true"></i></button><button class="btn btn-sm" type="button" onclick="location.reload();"><i class="fas fa-times text-danger font-18" aria-hidden="true"></i></button></td>';
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
                        <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="Permission Name" name="permis_name" value="{{$request->permis_name}}">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="Permission Route" name="permis_route" value="{{$request->permis_route}}">
                        </div>
                        <div class="col-md-3">
                            <select name="status" id="" class="form-select">
                                <option value="">Select One</option>
                                <option value="0">Inactive</option>
                                <option value="1">Active</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary btn-xs"><i class="fa fa-search" style="font-size: 0.7rem;"></i> Search</button>
                            <a href="{{url('/permissions')}}" class="btn btn-danger btn-xs"><i class="fa fa-sync" style="font-size: 0.7rem;"></i> Reset</a>
                        </div>
                    </div>
                </form>
                <table class="table table-bordered table-responsive table-striped" >
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Permission Head</th>
                        <th>Permission Name</th>
                        <th>Permission Route</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="editTable">
                    <tr id="jsrow" style="display: none;">
                        <td colspan="1"></td>
                        <td><input type="text" class="form-control form-control-danger" name="permis_name" id="permis_name" required ></td>
                        <td><input type="text" class="form-control form-control-danger" name="permis_route" id="permis_route" required></td>
                        <td>
                            <?php
                            $datas= DB::table('permissions')->where('is_parent','0')->get();
                            ?>
                            <select name="is_parent" class="form-select" id="is_parent">
                            <optgroup label="Select Head No">
                                <option value="0">No</option>
                            </optgroup>
                            <optgroup label="Select Head Yes">
                                @foreach ($datas as $data)
                                <option value="{{ $data->id }}">{{ $data->permis_name }}</option>
                                @endforeach
                            </optgroup>
                            </select>
                        </td>
                        <td colspan="2">
                            <button type="submit" class="btn btn-sm" onclick="addData('permis_name,permis_route,is_parent','post','{{url('add-permission')}}')" ><i class="fas fa-check text-info font-18" aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-sm" onclick="deleteRow()"><i class="fas fa-times text-danger font-18" aria-hidden="true"></i></button>
                        </td>
                    </tr>
                    <?php $i=1;
                    $datas=DB::table('permissions')
                    ->where(function($query) use($request) {
                            if(!empty($request->permis_name)) $query->where("permis_name",$request->permis_name);
                            if(!empty($request->permis_route)) $query->where("permis_route",$request->permis_route);
                            if(!empty($request->status)) $query->where("status",$request->status);
                    })
                    ->orderBy('id','DESC')->paginate(20);

                    ?>
                    @foreach ($datas as $data)
                    <tr id="row{{$i}}">
                        <td>{{$i}}</td>
                        <td>{{ Helper::Permission(($data->is_parent>'0') ? $data->is_parent : $data->id) }}</td>
                        <td>{{$data->permis_name}}</td>
                        <td>{{$data->permis_route}}</td>
                        <td>
                            <form action="{{url('permission-status/'.$data->id) }}" name="sstc{{$data->id}}" id="sstc{{$data->id}}" method="post">
                                <input type="hidden" name="status" value="{{$data->status}}">
                                <div class="form-check-custom form-check-solid form-switch">
                                    <input class="form-check-input" type="checkbox" id="status{{$data->id}}" value="{{$data->status}}" {{($data->status=='1')?'checked title=Active':'title=Inactive'}} onchange="statusActivInact('{{ $data->id }}');">
                                </div>
                                </form>
                            </td>
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
