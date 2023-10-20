@extends('admin.resource.main')
@section('title', 'Profile')
@section('content')
<section class="content">

<form action="{{url('changePassword/'.$data->id)}}" onsubmit="btnDisable()" method="post">
        <div class="content-wrapper d-flex align-items-center auth">
        <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
                <h4 style="text-align: center;">Change Password</h4>
                <div class="form-group">
                    <input type="text" name="name" class="form-control form-control-sm" id="exampleInputEmail1" placeholder="Name">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-sm" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="mt-3 text-center">
                    <button type="submit" class="btn btn-block btn-gradient-primary btn-sm font-weight-medium auth-form-btn px-3">Submit</button>
                </div>
            </div>
            </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
</form>

</section>
@endsection
