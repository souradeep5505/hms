@extends('admin.resource.main')
@section('title', 'List Patient')
@section('content')
<style>
    .form-check-input{
        margin-top:0px;
    }
</style>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"> @yield('title')</h4>
                <table class="table table-bordered table-responsive table-striped" >
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Patient ID</th>
                        <th>Patient Name</th>
                        <th>Doctor Name </th>
                        <th>Department</th>
                        <th>Booking Date </th>
                        <th>Fees</th>
                        <th>Paid Amount</th>
                        <th>Discount</th>
                        <th>Due</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i=1;
                    $patients=DB::table('patient_registrations')
                    // ->where('status','1')
                    ->get();
                    foreach ($patients as $patient) {

                    ?>
                    <?php
                    $dateString = $patient->book_date;
                    $date = new DateTime($dateString);
                    $formattedDate = $date->format('d M Y');
                    $pStatus=$patient->status;
                    ?>

                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$patient->patient_id}}</td>
                        <td>{{strtoupper($patient->f_name.' '.$patient->l_name)}}</td>
                        <td>{{Helper::DoctorName($patient->doc_id)}}</td>
                        <td>{{Helper::DepartmentName($patient->depart_id)}}</td>
                        <td>{{$formattedDate}}</td>
                        <td>{{$patient->fees}}</td>
                        <td>{{$patient->total_amount}}</td>
                        <td>{{$patient->discount}}</td>
                        <td>{{$patient->due}}</td>
                        @if ($pStatus == '0')
                        <td>Canceled</td>
                        @elseif ($pStatus == '1')
                        <td>Booked</td>
                        @endif
                        {{-- <td>{{$patient->total_amount}}</td> --}}
                        <td><button type="button" class="btn btn-success btn-xs">Confirm</button>
                            <a href="{{route('patient-registration.edit',$patient->id)}}" class="mr-2" title="Edit"><i class="fas fa-edit text-warning"></i></a>
                        </td>
                    </tr>
                </tbody>
                <?php  } ?>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
