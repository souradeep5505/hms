@extends('admin.resource.main')
@section('title', 'Doctor Timetable')
<?php
// $opt = null;
$values = DB::table('doctors_times')
    ->where('doc_id', $doctrs->id)
    ->where('status', '1')
    ->first();

$valueArray = json_decode($values->value, true);

if (!empty($values->opt) && ($values->opt == 'day' || $values->opt == 'week')) {
    $opV = $values->opt;
    $jVals = json_decode($values->value);
    //dump($jVals);
    $dataVal = isset($jVals->$opV) ? $jVals->$opV : [];
    //dump($dataVal);
} else {
    $opV = '';
    $dataVal = [];
}
?>

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
    <script>
        $(function() {
            $('#day').hide();
            $('#week').hide();
            $('#ttable').hide();
            //$('#sbutton').hide();
            var data = '{{ !empty($values->opt) ? $values->opt : '' }}';
            var data2 = '{{ !empty($dataVal) ? true : ''}}' ;

            if (data != '') {
                $('#' + data).show();
                //$('#sbutton').show();
                document.getElementById("sbutton").style.display = 'block';
            }

            if(data2 !=''){
                $('#ttable').show();
            }

            $('#selector').change(function() {
                var selectedOption = $(this).val();
                // alert(selectedOption);

                if (selectedOption == '') {
                    $('#day').hide();
                    $('#week').hide();
                    $('#ttable').hide();
                    $('#sbutton').hide();
                } else {
                    $('#day').hide();
                    $('#week').hide();
                    $('#ttable').hide();
                    $('#sbutton').hide();
                    $('#' + selectedOption).show();

                }
            });


        //     $("#settime").click(function () {

        //     var opt = $('#selector').val();
        //     var mulval;

        //     if (opt === 'day') {
        //         mulval = $('#selectMultipleDay').val().join(',');
        //     } else if (opt === 'week') {
        //         mulval = $('#selectMultipleWeek').val().join(',');
        //     }

        //     var nameArr = mulval.split(',');

        //     console.log(nameArr);

        //     $('#ttable').show();

        //     var table = $("#jsTable");
        //     document.getElementById("sbutton").style.display = 'block';
        //     // Clear existing rows before adding new ones
        //     table.empty();

        //     // Create a new <tr> element for each item in nameArr
        //     for (var i = 0; i < nameArr.length; i++) {

        //         var hiddenInput = $("<input>").attr({
        //         type: "hidden",
        //         name: "counter_section" + (i + 1),
        //         value: 1,
        //         id: "counter_section" + (i + 1),
        //         });

        //         var newRow = $("<tr>");

        //         var resultCell = $("<td>").text(i + 1);

        //         var nameCell = $("<td>").text(nameArr[i]);

        //         var inputCell1 = $("<td>").append(
        //             $("<input>").attr({
        //                 type: "time",
        //                 class: "form-control",
        //                 name: "start_time" + (i + 1) + '_' + 1
        //             })
        //         ).append("<br>");

        //         inputCell1.append(
        //             $("<div>").attr({
        //                 id: "start_time" + (i + 1) + '_' + 1
        //             })
        //         );

        //         var inputCell2 = $("<td>").append(
        //             $("<input>").attr({
        //                 type: "time",
        //                 class: "form-control",
        //                 name: "end_time" + (i + 1) + '_' + 1
        //             })
        //         ).append("<br>");

        //         inputCell2.append(
        //             $("<div>").attr({
        //                 id: "end_time" + (i + 1) + '_' + 1
        //             })
        //         );

        //         var buttonCell = $("<td>").append(
        //             $("<button>").attr({
        //                 type: "button",
        //                 class: "btn btn-success btn-sm px-2",
        //                 onclick: "addTime('" + (i + 1) + "')"
        //             }).text("Add Time")
        //         );

        //         newRow.append(resultCell, nameCell, inputCell1, inputCell2, buttonCell,hiddenInput);

        //         table.append(newRow);
        //     }

        // });


        $("#settime").click(function () {
    var opt = $('#selector').val();
    var mulval;

    if (opt === 'day') {
        mulval = $('#selectMultipleDay').val().join(',');
    } else if (opt === 'week') {
        mulval = $('#selectMultipleWeek').val().join(',');
    }

    var nameArr = mulval.split(',');

    console.log(nameArr);

    $('#ttable').show();

    var table = $("#jsTable");
    document.getElementById("sbutton").style.display = 'block';

    // Get the existing items in the table
    var existingItems = table.find('td:nth-child(2)').map(function () {
        return $(this).text();
    }).get();

    // Filter out the items that are already in the table
    var newItems = nameArr.filter(function (item) {
        return existingItems.indexOf(item) === -1;
    });

    // Create a new <tr> element for each new item
    newItems.forEach(function (itemName, i) {
        var hiddenInput = $("<input>").attr({
            type: "hidden",
            name: "counter_section" + (i + 1),
            value: 1,
            id: "counter_section" + (i + 1),
        });

        var newRow = $("<tr>");

        var resultCell = $("<td>").text(i + 1);

        var nameCell = $("<td>").text(itemName);

        var inputCell1 = $("<td>").append(
            $("<input>").attr({
                type: "time",
                class: "form-control",
                name: "start_time" + (i + 1) + '_' + 1
            })
        ).append("<br>");

        inputCell1.append(
            $("<div>").attr({
                id: "start_time" + (i + 1) + '_' + 1
            })
        );

        var inputCell2 = $("<td>").append(
            $("<input>").attr({
                type: "time",
                class: "form-control",
                name: "end_time" + (i + 1) + '_' + 1
            })
        ).append("<br>");

        inputCell2.append(
            $("<div>").attr({
                id: "end_time" + (i + 1) + '_' + 1
            })
        );

        var buttonCell = $("<td>").append(
            $("<button>").attr({
                type: "button",
                class: "btn btn-success btn-sm px-2",
                onclick: "addTime('" + (i + 1) + "')"
            }).text("Add Time")
        );

        newRow.append(resultCell, nameCell, inputCell1, inputCell2, buttonCell, hiddenInput);

        table.append(newRow);
    });
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
 <form action="{{url('doctime/'.$doctrs->id)}}" method="post" enctype="multipart/form-data">
    <input type="hidden" name="opt" value="{{$request->opt}}">
    <input type="hidden" name="day" value="{{json_encode($request->day)}}">
    <input type="hidden" name="week" value="{{json_encode($request->week)}}">
    {{-- <input type="hidden" name="counter_sect" value="{{$request->counter_sec}}"> --}}
    <input type="hidden" name="doc_id" value="{{$doctrs->id}}">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card dr-pro-pic">
                <div class="card-body">
                    <h4 class="card-title">{{ strtoupper($doctrs->f_name . ' ' . $doctrs->l_name) }} Timing:</h4>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <select class="form-select" id="selector" name="opt">
                                        <option value="">Select Option</option>
                                        <option value="day" @selected($request->opt == 'day' || (!empty($values->opt) && $values->opt == 'day'))>Date</option>
                                        <option value="week" @selected($request->opt == 'week' || (!empty($values->opt) && $values->opt == 'week'))>Day</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-8" id="day">
                                <select name="day[]" id="selectMultipleDay" class="form-control" multiple="multiple"
                                    data-placeholder="Select Day" selected-value="1">
                                    <option value="">Select Day</option>
                                    @for ($day = 1; $day <= 31; $day++)
                                        <option value="{{ $day }}"
                                            @if ($opV == 'day' && in_array($day, $dataVal)) selected @endif>{{ $day }}
                                        </option>
                                     @endfor
                                </select>
                            </div>

                            <div class="col-md-8" id="week">
                                <select name="week[]" id="selectMultipleWeek" class="form-control" multiple="multiple"
                                    data-placeholder="Select Week">
                                    <option value="">Select Week</option>
                                    @for ($wk = 1; $wk <= 7; $wk++)
                                        <option value="{{ $wk }}"
                                            @if ($opV == 'week' && in_array($wk, $dataVal)) selected @endif>{{ Helper::weekDays($wk) }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary btn-sm px-2 mt-3 mb-0 btnhid" style="float: right;"
                            id="settime" >Set Time</button><br><br>

                        <table class="table table-bordered table-responsive mt-4" id="ttable">
                            <thead>
                                <tr>
                                    <th style="width: 5%">#</th>
                                    <th style="width: 45%">Day/Week</th>
                                    <th style="width: 20%">Open Time</th>
                                    <th style="width: 20%">Close Time</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(!empty($opV)){
                                        $p=1;
                                       foreach ($dataVal  as $resval) {
                                        $cs="counter_section".$p;
                                ?>
                                <tr>
                                    <td>{{$p}}</td>
                                    <td>{{($opV=="day") ? $resval : Helper::weekDays($resval)}} </td>

                                    <td>
                                        <input type="hidden" name="{{$cs}}" value="{{$valueArray[$cs]}}" id="{{$cs}}">
                                        <input type="time" class="form-control" name="start_time{{$p}}_1" value="{{$valueArray['start_time'.$p.'_1']}}">
                                        <br>
                                        <div id="start_time{{$p}}_1">
                                            <?php
                                            if (isset($valueArray[$cs]) && $valueArray[$cs] > 1) {
                                                for ($csc = 2; $csc <= $valueArray[$cs]; $csc++) {
                                                    $scs = "start_time" . $p . "_" . $csc;
                                            ?>
                                                    <input type="time" class="form-control" name="<?php echo $scs; ?>" value="<?php echo isset($valueArray[$scs]) ? $valueArray[$scs] : ''; ?>">
                                                    <br>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="time" class="form-control" name="end_time{{$p}}_1"  value="{{$valueArray['end_time'.$p.'_1']}}">
                                        <br>
                                        <div id="end_time{{$p}}_1">
                                            <?php
                                            if (isset($valueArray[$cs]) && $valueArray[$cs] > 1) {
                                                for ($csc = 2; $csc <= $valueArray[$cs]; $csc++) {
                                                    $scs = "end_time" . $p . "_" . $csc;
                                            ?>
                                                    <input type="time" class="form-control" name="<?php echo $scs; ?>" value="<?php echo isset($valueArray[$scs]) ? $valueArray[$scs] : ''; ?>">
                                                    <br>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </td>
                                    <td><button type="button" class="btn btn-success btn-sm px-2" onclick="addTime('{{$p}}')" style="float: right;">Add Time</button>
                                    </td>
                                </tr>
                              <?php $p++; } }  ?>
                            </tbody>
                            {{-- @if ($values->opt==null) --}}
                            <tbody id="jsTable">

                            </tbody>
                            {{-- @endif --}}

                        </table>

                        <button type="submit" class="btn btn-primary btn-sm px-2 mt-3 mb-0" style="float: right; display:none;" id="sbutton">Submit</button>

                    </div>
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->

            </form>
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

                            @if ($values->opt != null)
                            <tbody>
                                <?php
                                $valuess = DB::table('doctors_times')->where('doc_id', $doctrs->id)->where('status', '1')->get();
                                foreach ($valuess as $data) {
                                    $result = json_decode($data->value, true);

                                    // Check if "week" is set to a valid array or "null"
                                    if ($result['opt'] == "day") {
                                        $dw_datas = $result['day'];  // Use $result['day'] directly
                                    } elseif ($result['opt'] == "week" && is_array($result['week'])) {
                                        $dw_datas = $result['week'];  // Use $result['week'] directly
                                    } else {
                                        $dw_datas = [];  // Set to an empty array or handle the case as needed
                                    }

                                    for ($p = 1; $p <= count($dw_datas); $p++) {
                                        echo '<tr>';
                                        echo '<td>' . ($result['opt'] == "week" ? Helper::weekDays($dw_datas[$p - 1]) : $dw_datas[$p - 1]) . '</td>';
                                        echo '<td>';
                                        for ($pc = 1; $pc <= $result['counter_section' . $p]; $pc++) {
                                            $key = 'start_time' . $p . '_' . $pc;
                                            echo isset($result[$key]) ? $result[$key] . '<br>' : '';  // Check if the key exists
                                        }
                                        echo '</td>';
                                        echo '<td>';
                                        for ($pc = 1; $pc <= $result['counter_section' . $p]; $pc++) {
                                            $key = 'end_time' . $p . '_' . $pc;
                                            echo isset($result[$key]) ? $result[$key] . '<br>' : '';  // Check if the key exists
                                        }
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                }
                                ?>
                            </tbody>
                            @endif

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>

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
