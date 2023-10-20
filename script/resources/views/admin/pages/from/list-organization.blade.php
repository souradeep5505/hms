@extends('admin.resource.main')
@section('title', 'List Organization')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"> @yield('title')&nbsp;<a href="{{url('/add-organization')}}" class="btn btn-sm" style="float: right;" title="Create"><i class="fa fa-plus text-success" aria-hidden="true"></i> Create</a></h4>
                    <form method="GET">
                        <div class="row my-4">
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="Organization Name" name="org_name" value="{{$request->org_name}}">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="Email" name="org_email" value="{{$request->org_email}}">
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
                                <a href="{{url('/list-organization')}}" class="btn btn-danger btn-xs" title="Reset"><i class="fa fa-sync" style="font-size: 0.7rem;"></i> Reset</a>
                            </div>
                        </div>
                    </form>
                    <table class="table table-bordered table-responsive table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Logo</th>
                                <th>Name</th>
                                <th>Abbreviation</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Org Subscription</th>
                                <th>Add User</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=1;
                            $organizations = DB::table('organizations')
                            ->where(function($query) use($request) {
                                    if(!empty($request->org_name)) $query->where("org_name",$request->org_name);
                                    if(!empty($request->org_email)) $query->where("org_email",$request->org_email);
                                    if(!empty($request->status)) $query->where("status",$request->status);
                            })
                            ->orderBy('id','DESC')->paginate(20);
                            ?>
                            @foreach ($organizations as $organization)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td class="py-1">
                                        <img src="{{ url('public/images/org-logo/' . $organization->org_logo) }}"
                                            alt="image">
                                    </td>
                                    <td>{{ ucfirst($organization->org_name) }}</td>
                                    <td>{{ $organization->org_abbreviation }}</td>
                                    <td>{{ $organization->org_mobile }}</td>
                                    <td>{{ $organization->org_email }}</td>
                                    <td>{{ $organization->org_address }}</td>
                                    <td>
                                        <form action="{{url('org-status/'.$organization->id) }}" name="sstc{{$organization->id}}" id="sstc{{$organization->id}}" method="post">
                                            <input type="hidden" name="status" value="{{$organization->status}}">
                                            <div class="form-check-custom form-check-solid form-switch">
                                                <input class="form-check-input" type="checkbox" id="status{{$organization->id}}" value="{{$organization->status}}" {{($organization->status=='1')?'checked title=Active':'title=Inactive'}} onchange="statusActivInact('{{ $organization->id }}');">
                                            </div>
                                        </form>
                                    </td>
                                    <td><a href="{{ url('edit-organization/'.$organization->id) }}" class="mr-2 font-18" title="Edit"><i
                                        class="fas fa-edit text-warning"></i></a></td>
                                    <td><button type="button" class="btn btn-info btn-xs" title="Add Subscription" onclick="openModal('{{$organization->id}}','{{$organization->org_name}}')">Add
                                            Subscription</button>
                                    {{-- <a href="{{url('/create-account')}}" type="button" class="btn btn-info btn-xs">Create Account</a> --}}
                                    </td>
                                    <td><a href="{{url('user/'.$organization->id)}}" title="Add User" class="btn btn-primary btn-xs">Add User</a></td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex mt-3" style="float: right;">
                        {{ $organizations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
function openModal(id,name) {
    document.getElementById('org_id').value=id;
    document.getElementById('org_name').value=name;
    document.getElementById('subscrip_id').value='';
    document.getElementById('end_date').value='';
    $('#myModal').modal('show');
}
</script>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="ModalLabel">Add Subscription</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form class="form-horizontal form-material mb-0" method="post"
            action="{{ url('/add-org-subscription') }}">
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <input type="hidden" name="org_id" id="org_id">
                        <input type="text" id="org_name" class="form-control" readonly>
                    </div>
                    <div class="col-md-6">
                        <select name="subs_id" class="form-select" id="subscrip_id">
                            <?php $subscriptions = DB::table('subscriptions')->get(); ?>
                            <option value="">Select Subscriptions</option>
                            @foreach ($subscriptions as $sub)
                                <option value="{{ $sub->id }}" data-duration="{{ $sub->duration }}">
                                    {{ $sub->subscription_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-gradient-primary text-white">Start
                                    Date</span>
                            </div>
                            <input type="date" class="form-control" name="start_date" style="padding: 7px !important;"
                                value="{{ date('Y-m-d') }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-gradient-primary text-white">End
                                    Date</span>
                            </div>
                            <input type="date" class="form-control" name="end_date" id="end_date" style="padding: 7px !important;">
                        </div>
                    </div>
                    <script>
                        document.getElementById('subscrip_id').addEventListener('change', function() {
                            var selectedOption = this.options[this.selectedIndex];
                            var duration = selectedOption.getAttribute('data-duration');
                            if (duration) {
                                var startDate = new Date(document.getElementsByName('start_date')[0].value);
                                var endDate = new Date(startDate);
                                endDate.setDate(startDate.getDate() + parseInt(duration));
                                var endDateFormat = endDate.toISOString().split('T')[0];
                                document.getElementById('end_date').value = endDateFormat;
                            } else {
                                // Handle the case where 'days' is not defined for the selected option
                                document.getElementById('end_date').value = ''; // Clear the end date
                            }
                        });
                    </script>
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
