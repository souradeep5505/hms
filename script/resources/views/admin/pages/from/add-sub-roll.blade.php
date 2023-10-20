@extends('admin.resource.main')
@section('title', 'Add subscription Roll')

@section('content')
<form action="{{url('/addsubscriptionroll')}}" method="POST">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title"> @yield('title')&nbsp;<a href="{{url('/list-subscription-roll')}}" class="btn btn-warning btn-flat btn-sm" title="Back"><i class="fa fa-plus" aria-hidden="true"></i> Back</a></h4>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label style="margin-top: 1rem;">Subscription Name</label>
                        <select name="subscrip_id" class="form-select" id="subscrip_id">
                            <?php
                            $subscriptions = DB::table('subscriptions')->where('status','1')->get(); ?>
                            <option value="">Select Subscriptions</option>
                            @foreach ($subscriptions as $sub)
                                <option value="{{ $sub->id }}">{{ $sub->subscription_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label style="margin-top: 1rem;">Roll</label>
                        <select name="roll_id" class="form-select" id="roll_id">
                            <?php
                            $rolls = DB::table('rolls')->where('status','1')->get(); ?>
                            <option value="">Select Rolls</option>
                            @foreach ( $rolls as $roll)
                                <option value="{{$roll->id}}">{{$roll->roll_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <?php $permissions = DB::table('permissions')
                        ->where('is_parent', '0')
                        ->get(); ?>
                    <div class="row">
                        @foreach ($permissions as $permission)
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" id="mainSel{{ $permission->id }}"
                                                onclick="checkAll('{{ $permission->id }}')" class="form-check-input">
                                            {{ $permission->permis_name }} <i class="input-helper"></i></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php
                                    $permiss = DB::table('permissions')
                                    ->where('is_parent', $permission->id)
                                    ->get();
                                    $i = 1;
                                    ?>
                                    @foreach ($permiss as $permis)
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox"
                                                    class="form-check-input selectall{{ $permission->id }}" name="permis_id[]" value="{{ $permis->id }}">
                                                {{ $permis->permis_route }} <i class="input-helper"></i></label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <hr>
                        @endforeach
                        <div class="form-group">
                            <div class="row">
                              <div class="col-md-12">
                              <button type="submit" class="btn btn-primary btn-flat btn-sm" onclick="return confirm('Are you want to add this record?');" title="Submit" style="float: right;">Submit</button>
                            </div>
                          </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
    <script>
        function checkAll(id) {

            mainChk = document.getElementById('mainSel' + id).checked;
            permissionCheckboxes = document.querySelectorAll('.selectall' + id);
            if (mainChk == true) {
                for (var i = 0; i < permissionCheckboxes.length; i++) {
                    permissionCheckboxes[i].checked = true;
                }
            } else {
                for (var i = 0; i < permissionCheckboxes.length; i++) {
                    permissionCheckboxes[i].checked = false;
                }
            }

        }
    </script>

@endsection
