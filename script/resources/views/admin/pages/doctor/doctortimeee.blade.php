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
<?php //dump($request->all());?>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card dr-pro-pic">
                    <div class="card-body">
                        <h4 class="card-title">{{strtoupper($doctrs->f_name.' '.$doctrs->l_name)}} Timing:</h4>
                        <div class="col-md-12">
                            <?php
                            // $opt = null;
                            $values = DB::table('doctors_times')->where('doc_id',$doctrs->id)->where('status', '1')->first();
                            $valueArray = json_decode($values->value, true);
                            //dump($valueArray);
                            // $start_time1_1 = $valueArray['start_time1_1'];
                            // dump($start_time1_1);
                            ?>

                            <form method="get" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <select class="form-select" id="selector" name="opt">
                                            <option value="">Select Option</option>
                                            <option value="day" @selected($request->opt=='day' || (!empty($values->opt) && $values->opt=="day")) >Day</option>
                                            <option value="week" @selected($request->opt=='week' || (!empty($values->opt) && $values->opt=="week"))>Week</option>
                                            {{-- <option value="month" @selected($request->opt=='month')>Month</option> --}}
                                        </select>
                                    </div>
                                </div>
                                @if (!empty($values->opt) && $values->opt=="day")
                                <?php $opV='day';
                                $jVals=json_decode($values->value);
                                $dataVal=json_decode($jVals->$opV);

                                ?>

                                <div class="col-md-8" id="day">
                                    <select name="day[]" id="selectMultipleDay" class="form-control" multiple="multiple" data-placeholder="Select Day" selected-value="1">
                                        <option value="">Select Day</option>
                                        @for ($day = 1; $day <= 31; $day++)
                                            <option value="{{ $day }}" @if(in_array($day, $dataVal)) selected @endif>{{ $day }}</option>
                                        @endfor
                                    </select>
                                </div>
                                @elseif(!empty($values->opt) && $values->opt=="week")
                                <?php $opVw='week';
                                $jValsw=json_decode($values->value);
                                $dataValw=json_decode($jValsw->$opVw);
                                ?>
                                <div class="col-md-8 showhide" id="week">
                                    <select name="week[]" id="selectMultipleWeek" class="form-control" multiple="multiple"
                                        data-placeholder="Select Week">
                                        <option value="">Select Week</option>
                                        @for ($wk = 1; $wk <= 7; $wk++)
                                            <option value="{{ $wk }}" @if(in_array($wk, $dataValw)) selected @endif>{{ Helper::weekDays($wk) }}</option>
                                        @endfor
                                    </select>
                                </div>

                                @endif

                                {{-- <div class="col-md-8 showhide" id="day">
                                    <select name="day[]" id="selectMultipleDay" class="form-control" multiple="multiple"
                                        data-placeholder="Select Day">
                                        <option value="">Select Day</option>
                                        @for ($day = 1; $day <= 31; $day++)
                                            <option value="{{ $day }}">{{ $day }}</option>
                                        @endfor
                                    </select>
                                </div> --}}
                                {{-- <div class="col-md-8 showhide" id="week">
                                    <select name="week[]" id="selectMultipleWeek" class="form-control" multiple="multiple"
                                        data-placeholder="Select Week">
                                        <option value="">Select Week</option>
                                        @for ($wk = 1; $wk <= 7; $wk++)
                                            <option value="{{ $wk }}">{{ Helper::weekDays($wk) }}</option>
                                        @endfor
                                    </select>
                                </div> --}}
                                {{-- ################ MONTH ################## --}}
                                <div class="col-md-12">
                                    <?php $tt=1; ?>
                                    <input type="hidden" name="counter_sec" id="counter_sec" value="{{!empty($request->counter_sec) ? $request->counter_sec : '1'}}">

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
                                    <?php $tt++; ?>
                                </div>
                              {{-- ################ END MONTH ################## --}}
                                </div>


                              <button class="btn btn-primary btn-sm px-2 mt-3 mb-0 btnhid" style="float: right;">Set Time</button>
                            </form>
                        <?php
                           // die;
                            ?>
                        </div>
                    @if(!empty($request->opt))
                    <form action="{{url('doctime/'.$doctrs->id)}}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="opt" value="{{$request->opt}}">
                        <input type="hidden" name="day" value="{{json_encode($request->day)}}">
                        <input type="hidden" name="week" value="{{json_encode($request->week)}}">
                        <input type="hidden" name="counter_sect" value="{{$request->counter_sec}}">

                        <div class="col-md-12" style="display: block;" id="ttable">
                                @if (!empty($request->opt))
                                <?php
                                $day_datas='';
                                $week_datas='';
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
                                        $mulWeek_dis="mul_week".$c;
                                        //echo $request->$dm;
                                        array_push($month, ($request->$dm));

                                        if($request->$mulOpt_dis=="day"){
                                            //dump($request->$mulDay_dis);
                                            array_push($day, ($request->$mulDay_dis));
                                        }
                                        if($request->$mulOpt_dis=="week"){
                                            //dump($request->$mulDay_dis);
                                            array_push($week, ($request->$mulWeek_dis));
                                        }
                                    }
                                // $month='month'.$request->counter_sec
                                    $datas=array_merge($month);
                                    $day_datas=array_merge($day);
                                    $week_datas=array_merge($week);
                                    $tl="Month";
                                    $type='month';
                                    }
                                    // dump($day_datas);
                                    //    echo '<br>';
                                    // dump($week_datas);
                                    //    if(!empty($day_datas)){
                                    //     $sdatas=$day_datas;
                                    //    }elseif(!empty($week_datas)){
                                    //     $sdatas=$week_datas;
                                    //    }else{
                                    //     $sdatas=[];
                                    //    }
                                    // dump($sdatas);
                                    //     die;

                                    // dump($month);
                                    // die;
                                    // dump($request->all());
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

                                    {{-- <input type="text" name="month" value="{{json_encode($datas)}}"> --}}
                                    @foreach($datas as $data)
                                    <?php $mp='mulopt'.$t; ?>
                                    <input type="hidden" name="counter_section{{$t}}" id="counter_section{{$t}}" value="1">
                                    @if($type=='month')
                                    <input type="text" name="month" value="{{json_encode($datas)}}">
                                    <tr>
                                        <td>{{$t}}</td>
                                        <td colspan="3"> {{ Helper::months($data) }}</td>
                                        <td>
                                            @if(!empty($day_datas) && $request->$mp=="day")
                                            <?php $days=count($day_datas);?>
                                            <input type="text" name="mds[]" value="{{json_encode(array($data=>array('day'=>$day_datas)))}}">
                                            {{-- for(0;$vsa<count:bsdh++) --}}
                                            <?php for($d=0; $d<$days; $d++){ ?>
                                            @foreach ($day_datas[$d] as $day_item)
                                            <?php //dump($day_item); ?>
                                            <tr>
                                                <td colspan="2" style="text-align: center;">{{$day_item}}</td>
                                                <td><input type="time" class="form-control" name="open_time{{$t}}_1"></td>
                                                <td><input type="time" class="form-control" name="close_time{{$t}}_1"></td>
                                                <td>*</td>
                                            </tr>

                                            @endforeach
                                            <?php } ?>
                                            @endif


                                        @if(!empty($week_datas) && $request->$mp=="week")
                                        <?php $weeks=count($day_datas);?>
                                        <input type="text" name="mds[]" value="{{json_encode(array($data=>array('week'=>$week_datas)))}}">
                                        <?php for($w=0; $w<$weeks; $w++){ ?>

                                        @foreach ($week_datas[$w] as $week_item)
                                        <tr>
                                            <td colspan="2" style="text-align: center;">  {{ Helper::weekDays($week_item) }}</td>
                                            <td><input type="time" class="form-control" name="open_time{{$t}}_1"></td>
                                            <td><input type="time" class="form-control" name="close_time{{$t}}_1"></td>
                                            <td>*</td>
                                        </tr>
                                        @endforeach
                                        <?php } ?>
                                        @endif
                                        </td>
                                    <tr>
                                    @else

                                    <tr>
                                        <td>{{$t}}</td>
                                        <td>
                                            @if($type=='day')
                                            {{$data}}
                                            @elseif($type=='week')
                                            {{ Helper::weekDays($data) }}
                                            @elseif($type=='month')
                                            {{ Helper::months($data) }}

                                            @endif

                                        </td>

                                        <td>
                                            <input type="time" class="form-control" name="start_time{{$t}}_1">
                                            <br>
                                            <div id="start_time{{$t}}_1"></div>
                                        </td>
                                        <td>
                                            <input type="time" class="form-control" name="end_time{{$t}}_1" value="">
                                            <br>
                                            <div id="end_time{{$t}}_1"></div>
                                        </td>
                                        <td><button type="button" class="btn btn-success btn-sm px-2" onclick="addTime('{{$t}}')" style="float: right;"><i class="fas fa-plus"></i>&nbsp;Add Time</button>
                                        </td>
                                    </tr>
                                    @endif
                                    <?php $t++; ?>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>

                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm px-2 mt-3 mb-0" style="float: right; margin-right: 4px;">Submit</button>
                    </form>
                    @else
                    <div id="ttable"></div>
                    @endif
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->

            </div>
            <!--end col-->

            <div class="col-lg-4 mx-auto">
                <div class="card dr-pro-pic">
                    <div class="card-body">
                        <div class="w3-bar w3-black">
                            <p style="text-align: center;"><b>Doctor Timetable</b></p>
                        </div>

                        <div id="London" class="w3-container city">
                            <table class="table table-bordered table-responsive mt-2">
                                <thead>
                                    <tr>
                                        <th>Day/Week</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $valuess = DB::table('doctors_times')->where('status', '1')->get();
                                    foreach ($valuess as $data) {
                                        $result = json_decode($data->value, true);

                                        if ($result['opt'] == "day") {
                                            $dw_datas = json_decode($result['day']);
                                        } elseif ($result['opt'] == "week") {
                                            $dw_datas = json_decode($result['week']);
                                        }

                                        for ($p = 1; $p <= count($dw_datas); $p++) {
                                            echo '<tr>';
                                            echo '<td>' . ($result['opt'] == "week" ? Helper::weekDays($dw_datas[$p - 1]) : $dw_datas[$p - 1]) . '</td>';
                                            echo '<td>';
                                            for ($pc = 1; $pc <= $result['counter_section' . $p]; $pc++) {
                                                echo $result['start_time' . $p . '_' . $pc] . '<br>';
                                            }
                                            echo '</td>';
                                            echo '<td>';
                                            for ($pc = 1; $pc <= $result['counter_section' . $p]; $pc++) {
                                                echo $result['end_time' . $p . '_' . $pc] . '<br>';
                                            }
                                            echo '</td>';
                                            echo '</tr>';
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
        let counterSec = Number(document.getElementById('counter_section'+p).value);
        // counter = row.length;
        $.ajax({
            url: "{{ url('ajaxdoctimetable') }}",
            type: 'GET',
            data: {
                'call': (counterSec + 1), 'p': p,
            },
            // dataType: 'html',
            success: function(data) {
               // console.log(data[0]);
               $('#start_time'+p+'_1').append(data[0]);
               $('#end_time'+p+'_1').append(data[1]);
                document.getElementById('counter_section'+p).value = (counterSec + 1);
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
