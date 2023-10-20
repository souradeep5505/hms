@extends('admin.resource.main')
@section('title', 'Edit organization')
<style>
    .form-group {
        margin-bottom: 0.8rem !important;
    }

    .input-group-prepend .input-group-text {
        padding: 0.6rem 0.5rem !important;
        width: 90px !important;
    }

    .form-control {
        padding: 0.5rem 1rem !important;
    }
</style>
@section('content')
    <form action="{{ url('editorganization/'.$data->id) }}" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="card dr-pro-pic">
                    <div class="card-body">
                        <h4 class="card-title"> @yield('title')&nbsp;<a href="{{url('/list-organization')}}" class="btn btn-warning btn-flat btn-sm" title="Back"><i class="fa fa-plus" aria-hidden="true"></i> Back</a></h4>
                        <form class="form-horizontal form-material mb-0">
                            @if (session('success'))
                            <script>
                                Swal.fire('Success', '{{ session('success') }}', 'success');
                            </script>
                            @endif

                            @if ($errors->any())
                                <script>
                                    Swal.fire('Error', 'Abbreviation Already Exists, Please try another one', 'error');
                                </script>
                            @endif
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-gradient-primary text-white"> Name</span>
                                        </div>
                                        <input type="text" class="form-control" name="org_name" value="{{$data->org_name}}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-gradient-primary text-white">Mobile</span>
                                        </div>
                                        <input type="text" class="form-control" name="org_mobile" value="{{$data->org_mobile}}" maxlength="10"
                                            required>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-gradient-primary text-white">Email</span>
                                        </div>
                                        <input type="email" class="form-control" name="org_email" value="{{$data->org_email}}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-gradient-primary text-white">Fax</span>
                                        </div>
                                        <input type="text" class="form-control" name="org_fax" value="{{$data->org_fax}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-gradient-primary text-white">Reg: No</span>
                                        </div>
                                        <input type="text" class="form-control" name="org_registration_no" value="{{$data->org_registration_no}}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-gradient-primary text-white">GST No</span>
                                        </div>
                                        <input type="text" class="form-control" name="org_gst_no" maxlength="15" value="{{$data->org_gst_no}}"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span
                                                class="input-group-text bg-gradient-primary text-white">Abbreviation</span>
                                        </div>
                                        <input type="text" class="form-control" name="org_abbreviation" value="{{$data->org_abbreviation}}" required disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-gradient-primary text-white">Address</span>
                                        </div>
                                        <input type="text" class="form-control" name="org_address" value="{{$data->org_address}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label><b>Logo</b></label>
                                    <img src="{{ url('public/images/org-logo/' . $data->org_logo) }}"
                                        alt="image" style="width: 30px;">
                                    <div class="input-group">
                                        <input type="file" class="form-control" name="org_logo">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label><b>Latter Head</b></label>
                                    <img src="{{ url('public/images/org-lhead/' . $data->org_lhead) }}"
                                    alt="image" style="width: 30px;">
                                    <div class="input-group">
                                        <input type="file" class="form-control" name="org_lhead">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label><b>Latter Head Footer</b></label>
                                    <img src="{{ url('public/images/org-lfooter/' . $data->org_lfooter) }}"
                                    alt="image" style="width: 30px;">
                                    <div class="input-group">
                                        <input type="file" class="form-control" name="org_lfooter">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-info btn-flat btn-sm"
                                onclick="return confirm('Are you want to add this record?');" title="Submit"
                                style="float: right;">Submit</button>
                        </form>
                    </div> <!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script>
            $(document).ready(function() {
                var $submit = $('input[type="submit"]');
                $submit.prop('disabled', true);
                $('input[type="text"]').on('input change', function() { //'input change keyup paste'
                    $submit.prop('disabled', !$(this).val().length);
                });
            });
        </script>
    @endsection
