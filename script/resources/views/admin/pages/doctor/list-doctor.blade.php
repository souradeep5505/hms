@extends('admin.resource.main')
@section('title', 'List Doctor')
@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"> @yield('title')&nbsp;<a href="{{route('doctor.create')}}" class="btn btn-sm" style="float: right;" title="Create"><i class="fa fa-plus text-success" aria-hidden="true"></i> Create</a></h4>
                <table class="table table-bordered table-responsive table-striped" >
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i=1;
                    $doctors=DB::table('doctors')
                    ->where('status','1')
                    ->get();
                    foreach ($doctors as $doctor) {

                    ?>
                    <tr>
                        <td>{{$i++}}
                        <td class="py-1">
                            <img src="{{ url('public/images/doctor/'.$doctor->image) }}" alt="image">
                            </td>
                        <td>{{strtoupper($doctor->f_name.' '.$doctor->l_name)}}</td>
                        <td>{{$doctor->mobile}}</td>
                        <td>{{$doctor->email}}</td>
                        <td>{{$doctor->address}}</td>
                        <td>
                            <div class="text-right">
                                <a href="{{route('doctor.edit',$doctor->id)}}" class="mr-2"><i class="fas fa-edit text-warning"></i></a>
                                <a href="#" class="form-switch"><input class="form-check-input" type="checkbox" id="status" value=""></a>
                                <a href="{{url('doctortime/'.$doctor->id)}}"><i class="far fa-clock text-info font-16"></i></a>
                            </div>
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
