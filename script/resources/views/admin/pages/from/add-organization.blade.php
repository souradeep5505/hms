@extends('admin.resource.main')
@section('title', 'Add organization')

@section('content')
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card dr-pro-pic">
                <div class="card-body">
                    <h4 class="card-title"> @yield('title')&nbsp;<a href="{{url('/list-organization')}}" class="btn btn-warning btn-flat btn-sm" title="Back"><i class="fa fa-plus" aria-hidden="true"></i> Back</a></h4>
                    <form class="form-horizontal form-material mb-0" action="{{ url('/addorganization') }}" method="POST" enctype="multipart/form-data">
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
                                    <input type="text" class="form-control" name="org_name" id="slug-source" value="{{old('org_name')}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white">Mobile</span>
                                    </div>
                                    <input type="text" class="form-control" name="org_mobile" value="{{old('org_mobile')}}" maxlength="10"
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
                                    <input type="email" class="form-control" name="org_email" value="{{old('org_email')}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white">Fax</span>
                                    </div>
                                    <input type="text" class="form-control" name="org_fax" value="{{old('org_fax')}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white">Reg: No</span>
                                    </div>
                                    <input type="text" class="form-control" name="org_registration_no" value="{{old('org_registration_no')}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white">GST No</span>
                                    </div>
                                    <input type="text" class="form-control" name="org_gst_no" maxlength="15" value="{{old('org_gst_no')}}"
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
                                    <input type="text" class="form-control" name="org_abbreviation" value="{{old('org_abbreviation')}}" required >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white">Address</span>
                                    </div>
                                    <input type="text" class="form-control" name="org_address" value="{{old('org_address')}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <select name="" id="check" class="form-select" onchange="checkvalue(this.value)">
                                    <option value="">Select</option>
                                    <option value="domain">Domain</option>
                                    <option value="subdomain">Sub Domain</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="slug-target" style="text-align:right;" name="domain">
                                    <div class="col-md-4" id="subdomain" style="display: none; ">
                                        <input type="text" class="form-control" id="slug-target-sub" name="" value=".{{$request->getHttpHost()}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label><b>Logo</b></label>
                                <div class="input-group">
                                    <input type="file" class="form-control" name="org_logo" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label><b>Latter Head</b></label>
                                <div class="input-group">
                                    <input type="file" class="form-control" name="org_lhead">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label><b>Latter Head Footer</b></label>
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
    <script>
        function checkvalue(val) {
            var subdomainField = document.getElementById('subdomain');
            var domainField = document.getElementById('slug-target');
            var subdomainFieldInput = document.getElementById('slug-target-sub');

            if (val === "subdomain") {
                subdomainField.style.display = 'block';
                subdomainFieldInput.style.display = 'block';
                domainField.style.display = 'block';
            } else if (val === "domain") {
                subdomainField.style.display = 'none';
                subdomainFieldInput.style.display = 'none';
                domainField.style.display = 'block';
            } else {
                subdomainField.style.display = 'none';
                subdomainFieldInput.style.display = 'none';
                domainField.style.display = 'none';
            }
        }

    </script>
@endsection
