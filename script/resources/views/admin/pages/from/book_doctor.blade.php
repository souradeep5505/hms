@extends('admin.resource.main')
@section('title', 'Dashboard')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #msform {
            text-align: center;
            position: relative;
            margin-top: 30px
        }

        #msform fieldset {
            background: white;
            border: 0 none;
            border-radius: 0.5rem;
            box-sizing: border-box;
            width: 100%;
            /* padding: 5px; */
            padding-bottom: 20px;
            position: relative
        }

        .form-card {
            text-align: left
        }

        #msform fieldset:not(:first-of-type) {
            display: none
        }

        #msform input {
            padding: 8px 8px 4px 10px;
            border: 1px solid #ccc;
            border-radius: 0px;
            margin-bottom: 5px;
            margin-top: 2px;
            width: 100%;
            box-sizing: border-box;
            font-family: montserrat;
            color: #2C3E50;
            background-color: #ffffff;
            font-size: 14px;
            letter-spacing: 1px
        }

        #msform select {
            padding: 5px 8px 2px 10px;
            border: 1px solid #ccc;
            border-radius: 0px;
            margin-bottom: 5px;
            margin-top: 2px;
            width: 100%;
            box-sizing: border-box;
            font-family: montserrat;
            color: #2C3E50;
            background-color: #ffffff;
            font-size: 14px;
            letter-spacing: 1px
        }

        #msform .radio {
            padding: 0px 0px 0px 0px;
            border-radius: 50%;
            width: 14px;
            background-color: #673ab7;
            /* margin: 29px 0px 0px 0px; */
        }

        #msform .radio2 {
            /* margin: 25px 0px 0px 0px; */
        }

        #msform input:focus,
        #msform textarea:focus,
        #msform select:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: 1px solid #673AB7;
            outline-width: 0
        }

        #msform .action-button {
            width: 100px;
            background: #673AB7;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 0px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 0px 10px 5px;
            float: right;
            border-radius: 5px;
        }

        .searchbtn {
            width: 50px;
            background: #673AB7;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 0px;
            cursor: pointer;
            padding: 7px 6px;
            margin: 20px 0px 0px 0px;
            border-radius: 5px;
        }

        #msform .action-button:hover,
        #msform .action-button:focus {
            background-color: #311B92
        }

        #msform .action-button-previous {
            width: 100px;
            background: #616161;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 0px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 5px 10px 0px;
            float: right;
        }

        #msform .action-button-previous:hover,
        #msform .action-button-previous:focus {
            background-color: #000000
        }

        .card {
            z-index: 0;
            border: none;
            position: relative
        }

        .spacer {
            height: 80px;
            border-bottom: solid 1px #000000;
        }

        .btn {
            --bs-btn-padding-x: 0.3rem;
            --bs-btn-padding-y: 0.3rem;
            --bs-btn-border-radius: 0rem;
        }

        .btn.btn-fw {
            min-width: 41px;
            margin: 2px;

        }

        .template-demo>.btn {
            margin-right: 0.3rem !important;
        }

        .border-btn {
            border: solid 1px #bfbfbf;
            margin: 13px;
            background: #F5F5F5;
        }

        /* .avil-time {
            border: solid 2px #bfbfbf;
        } */

        .btn-inverse-info:not(.btn-inverse-light) {
            color: #000000c4;
        }

        .btn-inverse-info {
            background-color: #198ae3;
        }
        .template-demo{
            height: 300px;
            overflow: scroll;
        }
        #heading {
        text-transform: uppercase;
        color: #673AB7;
        font-weight: normal;
        }
        /* .card .card-body{
            padding-bottom:50px;
        } */
    </style>

    <div class="row">
        <div class="col-10">
            <div class="card">
                <div class="card-body">
                    <div class="col-11 col-sm-10 col-md-10 col-lg-12 col-xl-12 text-center p-0 mb-2">
                        <h2 id="heading">Book A Doctor</h2>
                    <form id="msform">
                        <div class="form-card">
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="fieldlabels">Patient ID</label>
                                    <select class="form-select" id="floatingSelect"
                                        aria-label="Floating label select example">
                                        <option selected>Patient ID</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="fieldlabels">Patient Name</label>
                                    <input type="text" name="uname" placeholder="Paid Amount" />
                                </div>
                                <div class="col-md-2">
                                    <label class="fieldlabels">Department</label>
                                    <select class="form-select" id="floatingSelect"
                                        aria-label="Floating label select example">
                                        <option selected>Department</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="fieldlabels">Doctors</label>
                                    <select class="form-select" id="floatingSelect"
                                        aria-label="Floating label select example">
                                        <option selected>Doctors</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="fieldlabels">Day</label>
                                    <input type="date" name="date" placeholder="date" />
                                </div>
                                <div class="col-md-1">
                                    <button type="button" name="uname" class="searchbtn"><i class="fa fa-search"
                                            aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                        <hr>
                        {{-- <hr> --}}
                        <div class="form-card">
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="fieldlabels">Total Amount</label>
                                    <input type="text" name="email" placeholder="Total Amount" />
                                </div>
                                <div class="col-md-2">
                                    <label class="fieldlabels">Paid Amount</label>
                                    <input type="text" name="uname" placeholder="Paid Amount" />
                                </div>
                                <div class="col-md-2">
                                    <label class="fieldlabels">Discount</label>
                                    <input type="text" name="uname" placeholder="Discount" />
                                </div>
                                <div class="col-md-2">
                                    <label class="fieldlabels">Due</label>
                                    <input type="text" name="uname" placeholder="Due" />
                                </div>
                                <div class="col-md-2">
                                    <label class="form-check-label radio2" for="flexRadioDefault1">Payment
                                        Method</label>
                                    <input class="form-check-input radio" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault1">
                                    <i class="fa fa-inr" aria-hidden="true">&nbsp;Cash</i>
                                    <input class="form-check-input radio" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault1">
                                    <i class="fa fa-credit-card" aria-hidden="true">&nbsp;Card</i>
                                </div>
                                <div class="col-md-2">
                                    <label class="fieldlabels">Comments</label>
                                    <input type="text" name="uname" placeholder="UserName" />
                                </div>
                            </div>
                        </div>
                        <input type="button" name="next" class="next action-button" value="Submit" />
                    </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="card" style="margin-bottom: 50px;">
            <div class="avil-time">
                <p style="text-align: center;margin: 5px;">Avail Time</p>
                <div class="template-demo">
                    <div class="border-btn">
                        <button type="button" class="btn btn-outline-primary">7:30</button>
                        <button type="button" class="btn btn-outline-primary">7:30</button>
                        <button type="button" class="btn btn-outline-primary">7:30</button>
                        <button type="button" class="btn btn-outline-primary">7:30</button>
                        <button type="button" class="btn btn-outline-primary">7:30</button>
                        <button type="button" class="btn btn-outline-primary">7:30</button>
                        <button type="button" class="btn btn-outline-primary">7:30</button>
                        <button type="button" class="btn btn-outline-primary">7:30</button>
                        <button type="button" class="btn btn-outline-primary">7:30</button>
                        <button type="button" class="btn btn-outline-primary">7:30</button>
                        <button type="button" class="btn btn-outline-primary">7:30</button>
                        <button type="button" class="btn btn-outline-primary">7:30</button>
                        <button type="button" class="btn btn-outline-primary">7:30</button>
                        <button type="button" class="btn btn-outline-primary">7:30</button>
                        <button type="button" class="btn btn-outline-primary">7:30</button>
                        <button type="button" class="btn btn-outline-primary">7:30</button>
                        <button type="button" class="btn btn-outline-primary">7:30</button>
                        <button type="button" class="btn btn-outline-primary">7:30</button>
                        <button type="button" class="btn btn-outline-primary">7:30</button>
                        <button type="button" class="btn btn-outline-primary">7:30</button>
                        <button type="button" class="btn btn-outline-primary">7:30</button>
                        <button type="button" class="btn btn-outline-primary">7:30</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
