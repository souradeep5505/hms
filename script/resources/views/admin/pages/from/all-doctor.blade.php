@extends('admin.resource.main')
@section('title', 'Dashboard')
<style>
    .card .card-body {
        padding: 1rem !important;
    }

    .text-right {
        text-align: right !important;
    }

    .mb-1 {
        margin-bottom: 0.25rem !important;
    }
    h5{
        color: #303e67;
        margin: 10px 0 !important;
    }
    .rounded-circle{
        width:60px;
    }
    .form-switch .form-check-input{
        width: 1.5em !important;
    }
    .form-check-input{
        margin-top: 0.1em !important;
    }
</style>
@section('content')
    <div class="row">
        <div class="col-lg-2">
            <div class="card">
                <div class="card-body text-center">
                    <div class="text-right">
                        <a href="#" class="mr-2" data-toggle="modal" data-animation="bounce"
                            data-target=".bs-example-modal-lg"><i class="fas fa-edit text-warning font-16"></i></a>
                            <a href="#" class="form-switch"><input class="form-check-input" type="checkbox" id="status" value=""></a>
                            <a href="#"><i class="far fa-clock text-info font-16"></i></a>
                    </div>
                    <img src="{{ url('assets/images/doctor/dr-2.jpg') }}" alt="user" class="rounded-circle mt-n3">
                    <h5 class="mb-1 client-name">Dr.Wendy Keen</h5>
                    <p class="text-muted">MD Orthopedic</p>
                    <p class="text-center font-14">4 years experience in Apollo Hospital</p>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
        <div class="col-lg-2">
            <div class="card">
                <div class="card-body text-center">
                    <div class="text-right">
                        <a href="#" class="mr-2" data-toggle="modal" data-animation="bounce"
                            data-target=".bs-example-modal-lg"><i class="fas fa-edit text-warning font-16"></i></a>
                            <a href="#" class="form-switch"><input class="form-check-input" type="checkbox" id="status" value=""></a>
                            <a href="#"><i class="far fa-clock text-info font-16"></i></a>
                    </div>
                    <img src="{{ url('assets/images/doctor/dr-2.jpg') }}" alt="user" class="rounded-circle mt-n3">
                    <h5 class="mb-1 client-name">Dr.Wendy Keen</h5>
                    <p class="text-muted">MD Orthopedic</p>
                    <p class="text-center font-14">4 years experience in Apollo Hospital</p>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
        <div class="col-lg-2">
            <div class="card">
                <div class="card-body text-center">
                    <div class="text-right">
                        <a href="#" class="mr-2" data-toggle="modal" data-animation="bounce"
                            data-target=".bs-example-modal-lg"><i class="fas fa-edit text-warning font-16"></i></a>
                            <a href="#" class="form-switch"><input class="form-check-input" type="checkbox" id="status" value=""></a>
                            <a href="#"><i class="far fa-clock text-info font-16"></i></a>
                    </div>
                    <img src="{{ url('assets/images/doctor/dr-2.jpg') }}" alt="user" class="rounded-circle mt-n3">
                    <h5 class="mb-1 client-name">Dr.Wendy Keen</h5>
                    <p class="text-muted">MD Orthopedic</p>
                    <p class="text-center font-14">4 years experience in Apollo Hospital</p>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
        <div class="col-lg-2">
            <div class="card">
                <div class="card-body text-center">
                    <div class="text-right">
                        <a href="#" class="mr-2" data-toggle="modal" data-animation="bounce"
                        data-target=".bs-example-modal-lg"><i class="fas fa-edit text-warning font-16"></i></a>
                        <a href="#" class="form-switch"><input class="form-check-input" type="checkbox" id="status" value=""></a>
                        <a href="#"><i class="far fa-clock text-info font-16"></i></a>
                    </div>
                    <img src="assets/images/doctor/dr-4.jpg" alt="user" class="rounded-circle mt-n3">
                    <h5 class="mb-1 client-name">Dr.Helen White</h5>
                    <p class="text-muted">MS Cardiology</p>
                    <p class="text-center font-14">3 years experience in Apollo Hospital</p>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
        <div class="col-lg-2">
            <div class="card">
                <div class="card-body text-center">
                    <div class="text-right">
                        <a href="#" class="mr-2" data-toggle="modal" data-animation="bounce"
                        data-target=".bs-example-modal-lg"><i class="fas fa-edit text-warning font-16"></i></a>
                        <a href="#" class="form-switch"><input class="form-check-input" type="checkbox" id="status" value=""></a>
                        <a href="#"><i class="far fa-clock text-info font-16"></i></a>
                    </div>
                    <img src="assets/images/doctor/dr-5.jpg" alt="user" class="rounded-circle mt-n3">
                    <h5 class="mb-1 client-name">Dr.Thomas Fant</h5>
                    <p class="text-muted">MD Neurology</p>
                    <p class="text-center font-14">10 years experience in Apollo Hospital</p>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
        <div class="col-lg-2">
            <div class="card">
                <div class="card-body text-center">
                    <div class="text-right">
                        <a href="#" class="mr-2" data-toggle="modal" data-animation="bounce"
                        data-target=".bs-example-modal-lg"><i class="fas fa-edit text-warning font-16"></i></a>
                        <a href="#" class="form-switch"><input class="form-check-input" type="checkbox" id="status" value=""></a>
                        <a href="#"><i class="far fa-clock text-info font-16"></i></a>
                    </div>
                    <img src="assets/images/doctor/dr-6.jpg" alt="user" class="rounded-circle mt-n3">
                    <h5 class="mb-1 client-name">Dr.Justin Williams</h5>
                    <p class="text-muted">MS Psychology</p>
                    <p class="text-center font-14">4 years experience in Apollo Hospital</p>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
    </div>
@endsection
