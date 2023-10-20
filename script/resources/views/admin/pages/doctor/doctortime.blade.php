@extends('admin.resource.main')
@section('title', 'Doctor Timetable')

@section('content')
<style>
    .select2-container {
        display: block;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        font-size: 0.800rem;
    }

    .table th {
        padding: 5px !important;
    }
</style>

    {{-- <form action="{{url('doctime/'.$doctrs->id)}}" method="post" enctype="multipart/form-data"> --}}
        <form action="" method="get" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="card dr-pro-pic">
                    <div class="card-body">
                        <h4 class="card-title">{{strtoupper($doctrs->f_name.' '.$doctrs->l_name)}} Timeing:</h4>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <select class="form-select" id="selector" name="opt">
                                            <option value="">Select Option</option>
                                            <option value="day" @selected($request->opt=='day')>Day</option>
                                            <option value="week" @selected($request->opt=='week')>Week</option>
                                            <option value="month" @selected($request->opt=='month')>Month</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8 showhide" id="day">
                                    <select name="day[]" id="selectMultipleDay" class="form-control" multiple="multiple"
                                        data-placeholder="Select Day">
                                        <option value="">Select Day</option>
                                        @for ($day = 1; $day <= 31; $day++)
                                            <option value="{{ $day }}">{{ $day }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-8 showhide" id="week">
                                    <select name="week[]" id="selectMultipleWeek" class="form-control" multiple="multiple"
                                        data-placeholder="Select Week">
                                        <option value="">Select Week</option>
                                        @for ($wk = 1; $wk <= 7; $wk++)
                                            <option value="{{ $wk }}">{{ Helper::weekDays($wk) }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <input type="hidden" name="counter_sec" id="counter_sec" value="1">

                                <table class="table table-bordered table-responsive showhide mt-4" id="month">
                                    <thead>
                                        <tr>
                                            <th style="width: 15%">Months</th>
                                            <th style="width: 15%">Day/Week</th>
                                            <th style="width: 60%">Chose</th>
                                            <th style="width: 10%"><button type="button"
                                                    class="btn btn-success btn-sm px-2" onclick="addRow()"
                                                    style="float: right;"><i class="fas fa-plus"></i>&nbsp;Add</button></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select class="form-select" name="month1">
                                                    <option value="">Select Month</option>
                                                    @for ($mon = 1; $mon <= 12; $mon++)
                                                        <option value="{{ $mon }}">{{ Helper::months($mon) }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </td>
                                            <td>
                                                <select name="mulopt1" class="form-select"
                                                    onchange="selectMulOpt(this.value,'1')">
                                                    <option value="">Select Option</option>
                                                    <option value="day">Day</option>
                                                    <option value="week">Week</option>
                                                </select>
                                            </td>
                                            <td colspan="2">
                                                <div id="mulDay1" style="display: none;">
                                                    <select name="mul_day1[]" id="selectMultipleDay1" class="form-control"
                                                        multiple="multiple" data-placeholder="Select Day">
                                                        <option value="">Select Day</option>
                                                        @for ($day = 1; $day <= 31; $day++)
                                                            <option value="{{ $day }}">{{ $day }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div id="mulWeek1" style="display: none;">
                                                    <select name="mul_week1[]" id="selectMultipleWeek1" class="form-control"
                                                        multiple="multiple" data-placeholder="Select Week">
                                                        <option value="">Select Week</option>
                                                        @for ($wk = 1; $wk <= 7; $wk++)
                                                            <option value="{{ $wk }}">{{ Helper::weekDays($wk) }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                    <tbody id="times"></tbody>
                                    </tbody>
                                </table>
                            </div>
                            <button class="btn btn-primary btn-sm px-2 mt-3 mb-0 btnhid" style="float: right;">Choose Time</button>
                        </div>
                        <div class="col-md-12" style="display: block;" id="ttable">
                       @if (!empty($request->opt))
                       <?php
                       if (!empty($request->day)){
                           $datas=$request->day;
                           $tl="Day";
                           $type='day';
                       }elseif (!empty($request->week)){
                           $datas=$request->week;
                           $tl="Week";
                           $type='week';
                       }elseif(!empty($request->month1)){
                        $month=[];
                        $day=[];
                        $week=[];
                        for($c=1;$c<=$request->counter_sec;$c++){
                            $dm="month".$c;
                            $mulOpt_dis="mulopt".$c;
                            $mulDay_dis="mul_day".$c;
                            //echo $request->$dm;
                            array_push($month, ($request->$dm));

                            if($request->$mulOpt_dis=="day"){
                                //dump($request->$mulDay_dis);
                                array_push($day, ($request->$mulDay_dis));
                            }
                        }
                       // $month='month'.$request->counter_sec
                           $datas=array_merge($month);
                           $day_datas=array_merge($day);
                           $tl="Month";
                           $type='month';
                           dump($day_datas);
                          // die;
                       }
                       //dump($month);
                      // die;
                        $t=1;
                       ?>

                            <div class="row">
                            <table class="table table-bordered table-responsive mt-4" id="">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">#</th>
                                        <th style="width: 45%">{{$tl}}</th>
                                        <th style="width: 20%">Open Time</th>
                                        <th style="width: 20%">Close Time</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <input type="hidden" name="counter_section" id="counter_section" value="1">

                                    @foreach($datas as $data)
                                    <tr>
                                        <td>{{$t}}</td>
                                        <td>
                                            @if($type=='day')
                                            {{$data}}
                                            @elseif($type=='week')
                                            {{ Helper::weekDays($data) }}
                                            @elseif($type=='month')
                                            {{ Helper::months($data) }}
                                            @if($request->$mulOpt_dis=="day")
                                            @foreach ($day_datas as $day_item)
                                                <?php //dump($day_item); ?>
                                                {{$day_item}}
                                            @endforeach
                                            @endif
                                            @endif

                                        </td>
                                        <td>
                                            <input type="time" class="form-control" name="">
                                            <br>
                                            <div id="start_time{{$t}}"></div>
                                        </td>
                                        <td>
                                            <input type="time" class="form-control" name="">
                                            <br>
                                            <div id="end_time{{$t}}"></div>
                                        </td>
                                        <td><button type="button" class="btn btn-success btn-sm px-2" onclick="addTime('{{$t}}')" style="float: right;"><i class="fas fa-plus"></i>&nbsp;Add</button>
                                        </td>
                                    </tr>
                                    <?php $t++; ?>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>

                        @endif
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
                url: "{{ url('ajaxdoctortime') }}",
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
        function selectMulOpt(vals, id) {
            // alert(vals);

            if (vals == "day") {
                document.getElementById("mulDay" + id).style.display = 'block';
                document.getElementById("mulWeek" + id).style.display = 'none';
            } else if (vals == "week") {
                document.getElementById("mulWeek" + id).style.display = 'block';
                document.getElementById("mulDay" + id).style.display = 'none';
            } else {
                document.getElementById("mulDay" + id).style.display = 'none';
                document.getElementById("mulWeek" + id).style.display = 'none';
            }

        }
        $(function() {
            $('.showhide').hide();
            $('.showmonth').hide();
            $('.showday').hide();
            $('.month').hide();
            $('.btnhid').hide();
            //   $('.add').hide();

            $('#selector').change(function() {
                var selectedOption = $(this).val();
                // alert(selectedOption);
                document.getElementById('ttable').style.display='none';
                if (selectedOption == '') {
                    $('.showhide').hide();
                    $('.showday').hide();
                    $('.showmonth').hide();
                    $('.month').hide();
                    $('.thide').hide();
                    $('.add').hide();
                    $('.btnhid').hide();
                } else {
                    $('.showhide').hide();
                    $('.thide').hide();
                    $('.add').hide();
                    $('.btnhid').show();
                    $('#' + selectedOption).show();
                }
            });

            $('#dayweek').change(function() {
                var selectedOption = $(this).val();

                if (selectedOption == 'day') {
                    $('.month').hide();
                    $('.showday').show();
                    $('.thide').show();
                    // $('.add').show();
                } else if (selectedOption == 'week') {
                    $('.showday').hide();
                    $('.month').show();
                    $('.thide').show();
                    // $('.add').show();
                }
            });
        });
    </script>

<script>
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-button1')) {
            removeTime(event.target);
        }
    });

    function removeTime(button) {
        var table = document.getElementById('timest');
        var row = button.closest('tr');

        if (row) {
            table.removeChild(row);
            var counterSec = Number(document.getElementById('counter_sec').value);
            document.getElementById('counter_sec').value = (counterSec - 1);
        }
    }
    var addTime = function(p) {
        // document.getElementById('add').disabled = true;
        let counterSec = Number(document.getElementById('counter_section').value);
        // counter = row.length;
        $.ajax({
            url: "{{ url('ajaxdoctimetable') }}",
            type: 'GET',
            data: {
                'call': (counterSec + 1),
            },
            // dataType: 'html',
            success: function(data) {
               // console.log(data[0]);
               $('#start_time'+p).append(data[0]);
               $('#end_time'+p).append(data[1]);
                document.getElementById('counter_section').value = (counterSec + 1);
                // document.getElementById('add').disabled = false;
            },
            error: function(request, error) {
                // document.getElementById('add').disabled = false;
                console.log("Request: Fail");
            }
        });
    }

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
