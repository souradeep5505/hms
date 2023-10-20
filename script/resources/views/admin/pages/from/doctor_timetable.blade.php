@extends('admin.resource.main')
@section('title', 'Dashboard')
<style>
    .custom-table thead tr th {
        border-right: solid 3px #fff !important;
        border-left: solid 3px #fff !important;
        background-color: #3e4b5b !important;
        text-align: center !important;
        padding: 1rem;
        width: 139px;
        color: #fff;
    }
    .custom-table tbody tr td {
        border: solid 5px #fff !important;
        background-color: #ECEFF4 !important;
    }
    .fc-event p{
        font-size: 0.8375rem;
        line-height: 0.9;
        margin-bottom: 0.8rem;
    }
    .custom-table tbody tr.spacer td {
        padding: 0 !important;
        height: 10px;
        border-radius: 0 !important;
        background: #ECEFF4 !important;
    }
    .fc-external-events .fc-event {
        padding: 10px !important;
    }
</style>
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="fc-external-events">
                <p class="text-light bg-dark ps-1" style="text-align: center; padding:10px;">Doctors</p>
                <div class='fc-event'>
                    <p style="text-align: center;">DR. ASOK KR. DATTA</p>
                    <p style="text-align: center;">(PAEDIATRIC MEDICINE)</p>
                    <p class="small-text"></p>
                </div>
                <div class='fc-event'>
                    <p style="text-align: center;">DR. ASOK KR. DATTA</p>
                    <p style="text-align: center;">(PAEDIATRIC MEDICINE)</p>
                    <p class="small-text"></p>
                </div>
                <div class='fc-event'>
                    <p style="text-align: center;">DR. ASOK KR. DATTA</p>
                    <p style="text-align: center;">(PAEDIATRIC MEDICINE)</p>
                    <p class="small-text"></p>
                </div>
                <div class='fc-event'>
                    <p style="text-align: center;">DR. ASOK KR. DATTA</p>
                    <p style="text-align: center;">(PAEDIATRIC MEDICINE)</p>
                    <p class="small-text"></p>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="table-responsive custom-table-responsive">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th>
                                    <span>Sun</span>
                                </th>
                                <th>
                                    <span>Mon</span>
                                </th>
                                <th>
                                    <span>Tue</span>
                                </th>
                                <th>
                                    <span>Wed</span>
                                </th>
                                <th>
                                    <span>Thu</span>
                                </th>
                                <th>
                                    <span>Fri</span>
                                </th>
                                <th>
                                    <span>Sat</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <p>08:00 to 10:00</p>
                                </td>
                                <td>
                                    <p>08:00 to 10:00</p>
                                </td>
                                <td>
                                    <p>08:00 to 10:00</p>
                                </td>
                                <td>
                                    <p>08:00 to 10:00</p>
                                </td>
                                <td>
                                    <p>N.A.</p>
                                </td>
                                <td>
                                    <p>08:00 to 10:00</p>
                                </td>
                                <td>
                                    <p>08:00 to 10:00</p>
                                </td>
                            </tr>
                            <tr class="spacer">
                                <td colspan="100"></td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td>
                                    <p>08:00 to 10:00</p>
                                </td>
                                <td>
                                    <p>08:00 to 10:00</p>
                                </td>
                                <td>
                                    <p>08:00 to 10:00</p>
                                </td>
                                <td>
                                    <p>08:00 to 10:00</p>
                                </td>
                                <td>
                                    <p>N.A.</p>
                                </td>
                                <td>
                                    <p>08:00 to 10:00</p>
                                </td>
                                <td>
                                    <p>08:00 to 10:00</p>
                                </td>
                            </tr>
                            <tr class="spacer">
                                <td colspan="100"></td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td>
                                    <p>08:00 to 10:00</p>
                                </td>
                                <td>
                                    <p>08:00 to 10:00</p>
                                </td>
                                <td>
                                    <p>08:00 to 10:00</p>
                                </td>
                                <td>
                                    <p>08:00 to 10:00</p>
                                </td>
                                <td>
                                    <p>N.A.</p>
                                </td>
                                <td>
                                    <p>08:00 to 10:00</p>
                                </td>
                                <td>
                                    <p>08:00 to 10:00</p>
                                </td>
                            </tr>
                            <tr class="spacer">
                                <td colspan="100"></td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td>
                                    <p>08:00 to 10:00</p>
                                </td>
                                <td>
                                    <p>08:00 to 10:00</p>
                                </td>
                                <td>
                                    <p>08:00 to 10:00</p>
                                </td>
                                <td>
                                    <p>08:00 to 10:00</p>
                                </td>
                                <td>
                                    <p>N.A.</p>
                                </td>
                                <td>
                                    <p>08:00 to 10:00</p>
                                </td>
                                <td>
                                    <p>08:00 to 10:00</p>
                                </td>
                            </tr>
                            <tr class="spacer">
                                <td colspan="100"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
