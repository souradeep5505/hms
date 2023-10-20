@extends('admin.resource.main')
@section('title', 'Subscription Permissions')

@section('content')
    <div class="row grid-margin">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"> @yield('title')&nbsp;<a href="{{url('/add-subscription-roll')}}" class="btn btn-sm" style="float: right;" title="Create"><i class="fa fa-plus text-success" aria-hidden="true"></i> Create</a></h4>

                    <table class="table table-bordered table-responsive table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Subscription Name</th>
                                <th>Roll Name</th>
                                <th>Permission</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $i = 1;

                            $datas = DB::table('subscription_rolls')
                            ->where('subscrip_id',$id)
                            ->orderBy('id','DESC')->get();
                            ?>
                            @foreach ($datas as $data)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{ Helper::Subscription($data->subscrip_id) }}</td>
                                    <td>{{ Helper::commaVal($data->roll_id, 'Roll') }}</td>

                                    <?php
                                    $array_str = $data->permis_id;
                                    $array_str = str_replace(['[', ']', '"'], '', $array_str);
                                    $elements = explode(',', $array_str);

                                    $array = array_map('intval', $elements);

                                    echo '<td>';
                                            $kk=1;
                                    for ($i = 0; $i < count($array); $i++) {
                                        switch($kk){
                                            case 1:
                                            $color="primary";
                                            break;
                                            case 2:
                                            $color="info";
                                            break;
                                            case 3:
                                            $color="success";
                                            break;
                                            case 4:
                                            $color="danger";
                                            break;
                                            default:
                                            $color="primary"; $kk=1;

                                        }

                                        $result = Helper::Permission($array[$i]);
                                        $class = 'badge badge-'.$color.' badge-pill mx-1 px-1'; // Define the class as 'info'
                                        echo '<span class="' . $class . '">' . $result . '</span>';
                                    $kk++;
                                    }

                                    echo '</td>';
                                    ?>
                                    <td>
                                        <form action="{{ url('sub-roll-status/' . $data->id) }}"
                                            name="sstc{{ $data->id }}" id="sstc{{ $data->id }}"
                                            method="post">
                                            <input type="hidden" name="status" value="{{ $data->status }}">
                                            <div class="form-check-custom form-check-solid form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="status{{ $data->id }}" value="{{ $data->status }}"
                                                    {{ $data->status == '1' ? 'checked title=Active' : 'title=Inactive' }}
                                                    onchange="statusActivInact('{{ $data->id }}');">
                                            </div>
                                        </form>
                                    </td>
                                    <td><a href="{{ url('edit-subscription-roll/'.$data->id) }}" class="mr-2 font-18"><i
                                        class="fas fa-edit text-warning"></i></a></td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>


    <script>
        // var ischecked=document.getElementById('status2').checked;
        function statusActivInact(id) {
            var ischecked = document.getElementById('status' + id);
            //alert(ischecked.checked);
            var fid = "sstc" + id;
            var result = confirm("Are you want to change the status?");
            if (result) {
                document.getElementById(fid).submit();
            } else {
                if (ischecked.checked == false) {
                    document.getElementById('status' + id).checked = true;
                } else {
                    document.getElementById('status' + id).checked = false;
                }
            }
        }
    </script>
@endsection
@push('css')
@endpush

@push('js')
@endpush
