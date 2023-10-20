@extends('admin.resource.main')
@section('title', 'List Degree')

@section('content')

<div class="row grid-margin">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><i class="fa fa-home"></i> @yield('title')
                    <button type="button" id="btnDis" class="btn btn-sm" title="Add New" style="float: right;" onclick="addRow()"><i class="fas fa-plus text-success"></i>&nbsp;Add New</button></h4>

                <script>
                    function addRow(){
                        document.getElementById('jsrow').style.display='contents';
                    }
                    function deleteRow(){
                        document.getElementById('jsrow').style.display='none';
                    }
                    function editRow(idrow,dataid) {
                        //console.log(idrow);
                        getTableData('{{route("degree.getdegree")}}','post',dataid).then(
                        response =>{
                            data = response[0];

                            document.getElementById(idrow).innerHTML='<td colspan="1"></td><td><input type="text" class="form-control form-control-danger" id="name_update" value="'+data.name+'" oninput="this.value = this.value.toUpperCase()"></td><td colspan="4"><button class="btn btn-sm" type="button" onclick="updateRow('+"'name_update','post','{{route('degree.updet')}}'"+','+"'"+data.id+"'"+')"><i class="fas fa-check text-primary font-18" aria-hidden="true"></i></button><button class="btn btn-sm" type="button" onclick="location.reload();"><i class="fas fa-times text-danger font-18" aria-hidden="true"></i></button></td>';
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
                            <input type="text" class="form-control" placeholder="Name" name="name" value="{{$request->name}}">
                        </div>
                        <div class="col-md-3">
                            <select name="status" id="" class="form-select">
                                <option value="">Select One</option>
                                <option value="0">Inactive</option>
                                <option value="1">Active</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary btn-xs" title="Search"><i class="fa fa-search" style="font-size: 0.7rem;"></i>  Search</button>
                            <a href="{{url('/rolls')}}" class="btn btn-danger btn-xs" title="Reset"><i class="fa fa-sync" style="font-size: 0.7rem;"></i> Reset</a>
                        </div>
                    </div>
                </form>
                <table class="table table-bordered table-responsive table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tr id="jsrow" style="display: none;">
                    <td colspan="1"></td>
                    <td><input type="text" class="form-control" id="name"  placeholder="Name" oninput="this.value = this.value.toUpperCase()"></td>
                    <td colspan="2">
                        <button type="button" class="btn btn-sm" onclick="addData('name','post','{{route('degree.store')}}')" title="Add"><i class="fas fa-check text-info font-18" aria-hidden="true"></i></button>
                        <button type="button" class="btn btn-sm" onclick="deleteRow()" title="Delete"><i class="fas fa-times text-danger font-18" aria-hidden="true"></i></button>
                    </td>
                </tr>

                <tbody id="editTable">
                    <?php $i=1;
                    $datas=DB::table('degrees')
                    ->where(function($query) use($request) {
                            if(!empty($request->name)) $query->where("name",$request->name);
                            if(!empty($request->status)) $query->where("status",$request->status);
                    })
                    ->orderBy('id','asc')->paginate(20);
                    ?>
                    @foreach ($datas as $data)
                    <tr id="row{{$i}}" >
                        <td>{{$i}}</td>
                        <td>{{$data->name}}</td>
                        <td>
                            <form action="{{route('degree.update',$data->id) }}" name="sstc{{$data->id}}" id="sstc{{$data->id}}" method="post">
                            <input type="hidden" name="_method" value="PATCH">
                            <input type="hidden" name="status" value="{{$data->status}}">
                            <div class="form-check-custom form-check-solid form-switch">
                                <input class="form-check-input" type="checkbox" id="status{{$data->id}}" value="{{$data->status}}" {{($data->status=='1')?'checked title=Active':'title=Inactive'}} onchange="statusActivInact('{{ $data->id }}');">
                            </div>
                            </form>
                            </td>
                            <td class="edit-row">
                                {{-- <a href="{{url('create-form/'.$data->id)}}" id="" class="btn btn-sm" title="Create Form"><i class="fas fa-clipboard-list text-info font-18" aria-hidden="true"></i></button></a> --}}
                                <button class="btn btn-sm " type="button" title="Edit" onclick="editRow('row{{$i}}','{{$data->id}}')" title="Edit"><i class="fas fa-edit text-warning font-18" aria-hidden="true"></i></button></td>
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
