@extends('admin.resource.main')
@section('title', 'Dashboard')
<style>

    ::-webkit-input-placeholder {
    color: #7081b9 !important;
    }

    .form-group {
        margin-bottom: 0.6rem !important;
    }

    .table td{
        padding:0.5rem 0.5rem !important;
    }

    .table th {
    padding:0.7rem !important;
    }

    .form-select{
        padding: 0.2rem 2.25rem 0.3rem 0.7rem !important;
    }

    .form-control{
        padding: 0.4rem 1rem !important;
    }

</style>
@section('content')
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card dr-pro-pic">
                <div class="card-body">
                    <span>Add Doctor Time:</span>
                    <button type="button" id="btnDis" class="btn btn-success btn-sm mb-2" onclick="addRow()" style="float: right;"><i class="fas fa-plus"></i>&nbsp;Add Time</button>
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th>Day</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Slot</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="" class="form-select" id="">
                                        <option>Select Day</option>
                                        <option>Sunday</option>
                                    </select>
                                </td>
                                <td>
                                  <input type="time" class="form-control">
                                </td>
                                <td>
                                    <input type="time" class="form-control">
                                </td>
                                <td>
                                    <input type="text" class="form-control">
                                </td>
                                <td>
                                    <a href="#"><i class="fas fa-trash-alt text-danger"></i></i></a>
                                </td>
                            </tr>

                        </tbody>
                        </table>
                        <button class="btn btn-primary btn-sm px-4 mt-3 mb-0" style="float: right;">Save</button>
                </div> <!--end card-body-->
            </div><!--end card-->
        </div>
    </div>
@endsection
