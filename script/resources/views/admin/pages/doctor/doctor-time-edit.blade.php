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
        padding:10px !important;
    }

    .form-control{
        padding: 0.4rem 1rem !important;
    }

</style>
@section('content')
<form action="{{route('doctor.doctortimeupdate',$doctrs->id)}}" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card dr-pro-pic">
                <div class="card-body">

                    <span>DR. {{strtoupper($doctrs->f_name.' '.$doctrs->l_name)}} Timeing:</span>
                    <button type="button" id="add" class="btn btn-success btn-sm mb-2 px-2" onclick="addRow()" style="float: right;"><i class="fas fa-plus"></i>&nbsp;Add Time</button>
                    <input type="hidden" name="counter_sec" id="counter_sec" value="0">
                    <script>
                       var removeRow = function() {
                            document.getElementById('remove').disabled = true;
                            var table = document.getElementById('times');
                            let counterSec = table.rows.length; // Get the number of rows in the 'times' tbody

                            if (counterSec > 1) {
                                table.deleteRow(counterSec - 1); // Delete the last row
                            }

                            document.getElementById('remove').disabled = false;
                        }
                        var addRow = function() {
                            document.getElementById('add').disabled = true;
                            let counterSec = Number(document.getElementById('counter_sec').value);
                            // counter = row.length;
                            $.ajax({
                                url: "{{ url('ajaxadddoctor') }}",
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
                            <?php
                            $i=1;
                            foreach ($doctors as $doctor) {
                            ?>
                            <tr id="tid{{ $doctor->id }}">
                                <td>
                                    <select name="day" class="form-select">
                                        <option value="">Select Day</option>
                                        <option value="sunday" <?php if ($doctor->day == 'sunday') { echo 'selected';} ?>>Sunday</option>
                                        <option value="monday" <?php if ($doctor->day == 'monday') { echo 'selected';} ?>>Monday</option>
                                        <option value="twesday" <?php if ($doctor->day == 'twesday') { echo 'selected';} ?>>Twesday</option>
                                        <option value="wednesday" <?php if ($doctor->day == 'wednesday') { echo 'selected';} ?>>Wednesday</option>
                                        <option value="thursday" <?php if ($doctor->day == 'thursday') { echo 'selected';} ?>>Thursday</option>
                                        <option value="friday" <?php if ($doctor->day == 'friday') { echo 'selected';} ?>>Friday</option>
                                        <option value="saturday" <?php if ($doctor->day == 'saturday') { echo 'selected';} ?>>Saturday</option>
                                    </select>
                                </td>
                                <td>
                                  <input type="time" class="form-control" value="{{$doctor->start_time}}">
                                </td>
                                <td>
                                    <input type="time" class="form-control" value="{{$doctor->end_time}}">
                                </td>
                                <td>
                                    <input type="text" class="form-control" value="{{$doctor->slot}}">
                                </td>
                                <td>
                                    <a title="Delete" onclick="timedelete('{{ $doctor->id }}');"><i class="fas fa-trash-alt text-danger" style="cursor: pointer;"></i></a>
                                </td>
                            </tr>
                            <script>
                                function timedelete(id) {
                                    let counterSec = Number(document.getElementById('counter_sec').value);
                                    if (confirm("Do you really want to delete this record?")) {
                                        // alert(id);
                                        $.ajax({
                                            url: "{{ url('ajaxdeletedoctime') }}" + '/' + id,
                                            type: 'DELETE',
                                            data: {
                                                _token: $("input[name=_token]").val()
                                            },
                                            cache: false,
                                            success: function(response) {
                                                document.getElementById('counter_sec').value = (counterSec - 1);
                                                $("#tid" + id).remove();
                                                window.location.reload(true);
                                            }
                                        });
                                    }
                                }
                            </script>

                        </tbody>
                        <?php } ?>
                        <tbody id="times">
                        </tbody>
                        </table>
                        <button class="btn btn-primary btn-sm px-4 mt-3 mb-0" style="float: right;">Save</button>
                </div> <!--end card-body-->
            </div><!--end card-->
        </div>
    </div>
</form>
@endsection
