@extends('admin.resource.main')
@section('title', 'Edit Doctor')
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
        border: 0px solid #FFF !important;
        padding: 0px !important;
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
    .select2-selection__choice{
    background-color: var(--bs-gray-200);
    border: none !important;
    font-size: 12px !important;
    /* font-size: 0.85rem !important; */
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice{
        padding: 3px !important;
    }
</style>
@section('content')
    <form action="{{ route('doctor.update', $data->id) }}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PATCH">
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="card dr-pro-pic">
                    <div class="card-body">
                        <h4 class="card-title"> @yield('title')&nbsp;<a href="{{ route('doctor.index') }}" class="btn btn-sm" style="float: right;" title="Create"><i class="fa fa-plus text-warning" aria-hidden="true"></i> Back</a></h4>
                        <script>
                            function previewimg(id) {
                                viewimg.src = URL.createObjectURL(event.target.files[0]);
                            }

                            function removeImage() {
                                var fileInput = document.getElementById('docimage');
                                fileInput.value = '';
                                var imagePreview = document.getElementById('viewimg');
                                imagePreview.src = '';
                                var removeButton = document.querySelector('.dropify-clear');
                                removeButton.style.display = '';
                            }
                        </script>
                        <div class="form-group row my-4">
                            <div class="col-md-3">
                                <label for="exampleInputUsername1">First Name</label>
                                <input type="text" placeholder="First Name" class="form-control" name="f_name"
                                    value="{{ $data->f_name }}">
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputUsername1">Last Name</label>
                                <input type="text" placeholder="Last Name" class="form-control" name="l_name"
                                    value="{{ $data->l_name }}">
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputUsername1">Email</label>
                                <input type="email" placeholder="Email" class="form-control" name="email"
                                    value="{{ $data->email }}">
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputUsername1">Phone No</label>
                                <input type="text" placeholder="Phone No" class="form-control" name="mobile"
                                    value="{{ $data->mobile }}">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-3">
                                <label for="exampleInputUsername1">DOB</label>
                                <input type="date" placeholder="Date of Birth" class="form-control" name="dob"
                                    value="{{ $data->dob }}">
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputUsername1">Degree</label>
                                <div class="input-group">
                                    <?php $degrees = DB::table('degrees')->where('status', '1')->get(); ?>
                                    <select id="selectMultiple" class="form-control" multiple="multiple" data-placeholder="Select Degree" name="degree_id[]">
                                        <option value="">Select Degree</option>
                                        @php
                                         $array_str = $data->degree_id;
                                        $array_str = str_replace(['[', ']', '"'], '', $array_str);
                                        $elements = explode(',', $array_str);

                                        $array = array_map('intval', $elements);
                                            // $selectedDegrees = json_decode($data->degree_id);
                                        @endphp
                                        {{ $data->degree_id}}
                                        {{-- @foreach ($degrees as $degree)
                                            <option value="{{ $degree->id }}" @if(is_array($selectedDegrees) && in_array($degree->id, $selectedDegrees)) selected @endif>{{ $degree->name }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>




                            <div class="col-md-3">
                                <label for="exampleInputUsername1">Department</label>
                                <?php $departments = DB::table('departments')
                                    ->where('status', '1')
                                    ->get(); ?>
                                <select class="form-select" name="department_id">
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $dep)
                                        <option value="{{ $dep->id }}" @selected($dep->id == $data->department_id)>
                                            {{ $dep->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputUsername1">Fees</label>
                                <input type="text" placeholder="Fees" class="form-control" name="fees"
                                    value="{{ $data->fees }}">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-3">
                                <label for="exampleInputUsername1">Gender</label>
                                <select class="form-select" name="gender">
                                    <option value="">select</option>
                                    <option value="male" <?php if ($data->gender == 'male') { echo 'selected';} ?>>Male</option>
                                    <option value="female"<?php if ($data->gender == 'female') {echo 'selected';} ?>>Female</option>
                                </select>
                            </div>
                            <div class="col-md-3 card-box">
                                <label for="exampleInputUsername1">Image</label>
                                <img src="{{ url('public/images/doctor/' . $data->image) }}" style="height: 20px;">
                                <div class="dropify-wrapper has-preview">
                                    <input type="file" id="docimage" class="dropify" name="image"
                                        data-default-file="{{ url('assets/images/doctor/dr-pro.png') }}"
                                        onchange="previewimg(this.value)">
                                        <button type="button" class="dropify-clear" onclick="removeImage()"><i class="fa fa-trash"></i></button>
                                    <div class="dropify-preview" style="display: block;"><span
                                            class="dropify-render"><img id="viewimg"
                                                src="{{ url('assets/images/doctor/dr-pro.png') }}"></span>
                                        <div class="dropify-infos">
                                            <div class="dropify-infos-inner">
                                                <p class="dropify-filename"><span class="dropify-text">Doctor image Upload</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputUsername1">Address</label>
                                <input type="text" placeholder="Address" class="form-control" name="address"
                                    value="{{ $data->address }}">
                            </div>
                        </div>
                        <button class="btn btn-primary btn-sm px-3 mb-0" style="float: right;">Update</button>
                    </div> <!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
        </div>
    </form>
@endsection
@push('js')
<script>
    $(document).ready(function() {
        $('#selectMultiple').select2();
    });
</script>
@endpush
