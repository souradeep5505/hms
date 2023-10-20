@extends('admin.resource.main')
@section('title', 'Add organization Suscription')
<style>
    .dr-pro-pic .dropify-wrapper {
        width: 100%;
        height: 35px;
        /* margin-bottom: 30px; */
    }

    .dropify-text {
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

    #selectbox select {
        display: block;
        width: 100%;
        padding: 0.6rem 1rem;
        font-size: 0.8125rem;
        font-weight: 400;
        line-height: 1;
        color: #c9c8d3;
        background-clip: padding-box;
        border: 1px solid #e8ebf3;
        border-radius: 4px;
    }

    #selectbox select:focus {
        color: #212529;
        background-color: #fff !important;
        border-color: #86b7fe !important;
        outline: 0;
        -webkit-box-shadow: none;
        box-shadow: none;
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
        padding: 0.3rem 0.3rem !important;
    }

    .table th {
        padding: 0.6rem !important;
    }

    .btn-sm {
        --bs-btn-padding-y: 0.3rem !important;
        --bs-btn-padding-x: 0.3rem !important;
    }

    .input-group-prepend .input-group-text {
        padding: 0.6rem 0.5rem !important;
        width: 80px !important;
    }

    .form-control {
        padding: 0.5rem 1rem !important;
    }
</style>
@section('content')
    <section class="content-header">
        <h2>
            @yield('title')
            {{-- <a href="{{ url('/list-organization') }}" class="btn btn-warning btn-flat btn-sm" title="Create"><i class="fa fa-plus"
            aria-hidden="true"></i> Back</a> --}}
        </h2>
    </section>
<form action="{{url('/addorganization')}}" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card dr-pro-pic">
                <div class="card-body">
                    <form class="form-horizontal form-material mb-0">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <select name="subscrip_id" class="form-select" id="subscrip_id">
                                    <?php $organizations=DB::table('organizations')->get();?>
                                    <option>select subscriptions</option>
                                    @foreach ( $organizations as $org)
                                    <option value="{{$org->id}}">{{$org->org_name}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-6">
                                <select name="subscrip_id" class="form-select" id="subscrip_id">
                                    <?php $subscriptions=DB::table('subscriptions')->get();?>
                                    <option>select subscriptions</option>
                                    @foreach ( $subscriptions as $sub)
                                    <option value="{{$sub->id}}">{{$sub->subscription_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white">Start Date</span>
                                    </div>
                                    <input type="date" class="form-control" name="org_fax">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white">End Date</span>
                                    </div>
                                    <input type="date" class="form-control" name="org_email">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                              <div class="col-md-12">
                              <button type="submit" class="btn btn-primary" onclick="return confirm('Are you want to add this record?');" title="Submit" style="float: right;">Submit</button>
                            </div>
                          </div>
                      </div>
                    </form>
                </div> <!--end card-body-->
            </div><!--end card-->
        </div> <!--end col-->
    </div>
@endsection
