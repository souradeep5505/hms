@extends('admin.resource.main')
@section('title', 'Create Form')
@section('content')
    <div class="row">
        <script>
            var removeForm = function() {
                document.getElementById('remove').disabled = true;
                var table = document.getElementById('times');
                let counterSec = Number(document.getElementById('counter_sec').value);
                //counter = row.length;
                if (counterSec > 1) {
                    table.deleteRow(counterSec);
                    document.getElementById('counter_sec').value = (counterSec - 1);
                    document.getElementById('remove').disabled = false;
                } else {
                    document.getElementById('remove').disabled = false;
                }

            }
            var addForm = function() {
                document.getElementById('add').disabled = true;
                let counterSec = Number(document.getElementById('counter_sec').value);
                // counter = row.length;
                $.ajax({
                    url: "{{ url('ajax-create-form') }}",
                    type: 'GET',
                    data: {
                        'call': (counterSec + 1),
                    },
                    dataType: 'html',
                    success: function(data) {
                        $('#times').append(data);
                        document.getElementById('counter_sec').value = (counterSec + 1);
                        document.getElementById('add').disabled = false;
                    },
                    error: function(request, error) {
                        document.getElementById('add').disabled = false;
                        console.log("Request: Fail");
                    }
                });
            }
        </script>
        <div class="col-lg-12 mx-auto">
            <div class="card dr-pro-pic">
                <div class="card-body">
                    <h4 class="card-title"> @yield('title')&nbsp;<a href="{{url('/list-subscription-roll')}}" class="btn btn-warning btn-flat btn-sm" title="Back"><i class="fa fa-plus" aria-hidden="true"></i> Back</a></h4>
                    <button type="button" id="add" class="btn btn-success btn-sm mb-2" onclick="addForm()"
                        style="float: right;"><i class="fas fa-plus"></i>&nbsp;Add Row</button>
                        <form action="{{url('createform/'.$data->id)}}" method="post">
                            <input type="hidden" name="counter_sec" id="counter_sec" value="1">
                    <table class="table table-bordered table-responsive" id="times">
                        <thead>
                            <tr>
                                <th>Field Name</th>
                                <th>Input Type</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" name="meta_fld1" class="form-control">
                                </td>
                                <td colspan="2">
                                    <select class="form-select" name="meta_type1">
                                        <option value="">Select Input Type</option>
                                        <option value="text">Text</option>
                                        <option value="longText">Long Text</option>
                                        <option value="email">Email</option>
                                        <option value="number">Number</option>
                                        <option value="password">Password</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-primary btn-sm px-4 mt-3 mb-3" style="float: right;">Save</button>
                </form>

                <div class="mt-5">
                    <?php
                    if(!empty($data->meta_data)){
                    ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php
                            $resultArray=json_decode($data->meta_data);
                               // dump($resultArray);
                            $p=1;
                            foreach ($resultArray as $key => $value) {
                            ?>
                            <tr>
                                <td>{{$p++}}</td>
                                <td>{{$key}}</td>
                                <td>{{$value}}</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php } ?>
                </div>
                </div> <!--end card-body-->
            </div><!--end card-->
        </div>
    </div>
@endsection
