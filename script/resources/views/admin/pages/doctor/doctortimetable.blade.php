@extends('admin.resource.main')
@section('title', 'Doctor Timetable')

@section('content')
<style>
    .select2-container{
        display: block;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice{
        font-size: 0.800rem;
    }
    .table th{
        padding:5px !important;
    }
</style>
<form action="{{route('doctor.doctime')}}" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card dr-pro-pic">
                <div class="card-body">
                    <h4 class="card-title"> @yield('title')&nbsp;</h4>
                    <div class="col-md-12">
                                <input type="hidden" name="counter_sec" id="counter_sec" value="1">
                                <table class="table table-bordered table-responsive showhide mt-4" id="month">
                                    <thead>
                                        <tr>
                                            <th style="width: 50%">Day</th>
                                            <th style="width: 20%">Open Time</th>
                                            <th style="width: 20%">Close Time</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>

                                            <td>
                                                <select name="mul_day1[]" id="selectMultipleDay1" class="form-control" multiple="multiple" data-placeholder="Select Day">
                                                    <option value="">Select Day</option>
                                                    @for($day=1;$day<=31;$day++)
                                                        <option value="{{ $day }}">{{ $day }}</option>
                                                        @endfor
                                                </select>
                                            </td>
                                            <td>
                                                <input type="time" class="form-control" name="start_time1">
                                                <div id="times"></div>
                                            </td>
                                            <td>
                                                <input type="time" class="form-control" name="start_time1">
                                            </td>
                                            <td><button type="button" class="btn btn-success btn-sm px-2" onclick="addRow()" style="float: right;"><i class="fas fa-plus"></i>&nbsp;Add</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    {{-- <tbody>
                                        <tr>
                                            <td>
                                                <select class="form-select" name="months1">
                                                    <option value="">Select Month</option>
                                                    <option value="Feb" selected>Feb</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="day_week" class="form-select" onchange="selectMulOpt(this.value,'1')">
                                                    <option value="">Select Option</option>
                                                    <option value="day" selected>Day</option>
                                                    <option value="week">Week</option>
                                                </select>
                                            </td>
                                            <td colspan="2">

                                                <div id="mulWeek1" style="display: none;">
                                                    <select name="mul_week1[]" id="selectMultipleWeek1" class="form-control" multiple="multiple" data-placeholder="Select Week" >
                                                        <option value="">Select Week</option>
                                                        @for ($wk=1;$wk<=7;$wk++)
                                                            <option value="{{ $wk }}">{{ Helper::weekDays($wk) }}</option>
                                                            @endfor
                                                    </select>
                                                </div>
                                            </td>
                                            <td><button type="button" class="btn btn-success btn-sm px-2" onclick="addRow()" style="float: right;"><i class="fas fa-plus"></i>&nbsp;Add</button>
                                            </td>
                                        </tr>
                                    </tbody> --}}
                                </table>
                            <button class="btn btn-primary btn-sm px-4 mt-3 mb-0 btnhid" style="float: right;">Save</button>
                        </div>
                    </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div>
</form>

<script>
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-button')) {
            removeRow(event.target);
        }
    });

    function removeRow(button) {
        var table = document.getElementById('times');
        var row = button.closest('tr');

        if (row) {
            table.removeChild(row);
            var counterSec = Number(document.getElementById('counter_sec').value);
            document.getElementById('counter_sec').value = (counterSec - 1);
        }
    }
    var addRow = function() {
        // document.getElementById('add').disabled = true;
        let counterSec = Number(document.getElementById('counter_sec').value);
        // counter = row.length;
        $.ajax({
            url: "{{ url('ajaxdoctimetable') }}",
            type: 'GET',
            data: {
                'call': (counterSec + 1),
            },
            dataType: 'html',
            success: function(data) {
                $('#times').append(data);
                document.getElementById('counter_sec').value = (counterSec + 1);
                // document.getElementById('add').disabled = false;
            },
            error: function(request, error) {
                // document.getElementById('add').disabled = false;
                console.log("Request: Fail");
            }
        });
    }

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
<script>
    // function selectMulOpt(vals,id) {
    //    // alert(vals);
    //     if(vals=="day"){
    //         document.getElementById("mulDay"+id).style.display='block';
    //         document.getElementById("mulWeek"+id).style.display='none';
    //     }else if(vals=="week"){
    //         document.getElementById("mulWeek"+id).style.display='block';
    //         document.getElementById("mulDay"+id).style.display='none';
    //     }else{
    //         document.getElementById("mulDay"+id).style.display='none';
    //         document.getElementById("mulWeek"+id).style.display='none';
    //     }
    // }
    // $(function() {
    //   $('.showhide').hide();
    //   $('.showmonth').hide();
    //   $('.showday').hide();
    //   $('.month').hide();
    //   $('.btnhid').hide();
    // //   $('.add').hide();

    //   $('#selector').change(function(){
    //     var selectedOption = $(this).val();
    //    // alert(selectedOption);
    //     if (selectedOption == '') {
    //       $('.showhide').hide();
    //       $('.showday').hide();
    //       $('.showmonth').hide();
    //       $('.month').hide();
    //       $('.thide').hide();
    //       $('.add').hide();
    //       $('.btnhid').hide();
    //     } else {
    //       $('.showhide').hide();
    //       $('.thide').hide();
    //       $('.add').hide();
    //       $('.btnhid').show();
    //       $('#' + selectedOption).show();
    //     }
    //   });

    //     $('#dayweek').change(function(){
    //         var selectedOption = $(this).val();

    //         if (selectedOption == 'day') {
    //             $('.month').hide();
    //             $('.showday').show();
    //             $('.thide').show();
    //             // $('.add').show();
    //         } else if (selectedOption == 'week') {
    //             $('.showday').hide();
    //             $('.month').show();
    //             $('.thide').show();
    //             // $('.add').show();
    //         }
    //     });
    // });
</script>

@endsection

@push('js')
<script>

    $(document).ready(function() {
        $('#selectMultipleDay').select2();
        $('#selectMultipleWeek').select2();
        $('#selectMultipleDay1').select2();
        $('#selectMultipleWeek1').select2();

    });
</script>

@endpush
