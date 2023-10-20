@extends('admin.resource.main')
@section('title', 'Edit User')
<style>
    .dr-pro-pic .dropify-wrapper {
        width: 100%;
        height: 35px;
        /* margin-bottom: 30px; */
    }
    .dropify-text{
        font-size: 16px;
    }
    .dropify-wrapper:hover .dropify-preview .dropify-infos {
        opacity: 1;
    }

    .dropify-wrapper .dropify-preview .dropify-infos {
        position: absolute !important;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
        z-index: 3;
        background: rgba(0, 0, 0, .7) !important;
        opacity: 0;
        -webkit-transition: opacity .15s linear;
        transition: opacity .15s linear;
    }

    .dropify-wrapper .dropify-clear {
        background: 0 0 !important;
        border: 1px solid #FFF !important;
        color: #FFF !important;
        top: 2px !important;
        right: 2px !important;
        padding: 2px 4px !important;
    }

    .dropify-wrapper {
        border: 1px dashed #e8ebf3 !important;
    }

    /* ::-webkit-input-placeholder {
    color: #1d1d1d !important;
    } */

    .form-group {
        margin-bottom: 0.6rem !important;
    }

    .table td {
    padding:0.3rem 0.3rem !important;
    }
    .table th {
    padding:0.6rem !important;
    }

    .btn-sm{
        --bs-btn-padding-y: 0.3rem !important;
        --bs-btn-padding-x: 0.3rem !important;
    }
    .input-group-prepend .input-group-text {
        padding: 0.6rem 0.5rem !important;
        width: 80px !important;
    }
    .form-control{
        padding: 0.5rem 1rem !important;
    }
</style>
@section('content')
    <div class="row">
        <div class="col-lg-62 mx-auto">
            <div class="card dr-pro-pic">
                <div class="card-body">
                    <h4 class="card-title"> @yield('title')&nbsp;<a href="{{url('/list-users')}}" class="btn btn-warning btn-flat btn-sm" title="Back"><i class="fa fa-plus" aria-hidden="true"></i> Back</a></h4>
                    <form class="form-horizontal form-material mb-0" action="{{url('editusers/'.$data->id)}}" method="post">
                        <div class="form-group row">
                            <div class="col-md-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text bg-gradient-primary text-white">Name</span>
                                </div>
                                <input type="text" name="name" value="{{$data->name}}" class="form-control" required>
                              </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text bg-gradient-primary text-white">Email</span>
                                  </div>
                                  <input type="email" name="email" value="{{$data->email}}" class="form-control" required>
                                </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text bg-gradient-primary text-white">Phone</span>
                                        </div>
                                        <input type="text" name="phone" value="{{$data->phone}}" class="form-control" required>
                                      </div>
                                </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text bg-gradient-primary text-white">User Id</span>
                                    </div>
                                    <input type="text" name="user_id" value="{{$data->user_id}}" class="form-control" readonly>
                                  </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text bg-gradient-primary text-white">Password</span>
                                    </div>
                                    <input type="password" name="password" class="form-control">
                                  </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <?php $rolls=DB::table('rolls')->get(); ?>
                            <div class="col-md-6" id="selectbox">
                                      <select class="form-select" name="roll_id" required>
                                        <option value="">Select Roll</option>
                                        @foreach ($rolls as $roll)
                                        <option value="{{$roll->id}}"
                                        @selected($roll->id==$data->roll_id)>{{$roll->roll_name}}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="col-md-6" id="selectbox">
                                <?php $organizations=DB::table('organizations')->get(); ?>
                                <select class="form-select" name="org_id" required>
                                    <option value="">Select Organization</option>
                                    @foreach ($organizations as $org)
                                    <option value="{{$org->id}}"
                                    @selected($org->id==$data->org_id)>{{ucfirst($org->org_name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea rows="5" name="additional_data" placeholder="Additional Data" class="form-control">{{$data->additional_data}}</textarea>
                        </div>
                        <button class="btn btn-primary btn-sm px-2 mt-3 mb-0" style="float: right;">Submit</button>
                    </form>
                </div> <!--end card-body-->
            </div><!--end card-->
        </div> <!--end col-->
    </div>
@endsection
