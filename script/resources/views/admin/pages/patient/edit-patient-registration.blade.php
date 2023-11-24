@extends('admin.resource.main')
@section('title', 'Dashboard')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
    #heading {
        text-transform: uppercase;
        color: #673AB7;
        font-weight: normal
    }

    #msform {
        text-align: center;
        position: relative;
        margin-top: 20px
    }

    #msform fieldset {
        background: white;
        border: 0 none;
        border-radius: 0.5rem;
        box-sizing: border-box;
        width: 100%;
        position: relative
    }

    .form-card {
        text-align: left
    }

    #msform fieldset:not(:first-of-type) {
        display: none
    }

    #msform select {
        display: block;
        width: 100%;
        padding: 0.655rem 0.3rem;
        font-size: 0.8125rem;
        font-weight: 400;
        line-height: 1;
        color: #0c0c0c;
        background-clip: padding-box;
        border: 1px solid #e8ebf3;
        border-radius: 4px;
    }
    .form-control{
        padding: 0.5rem 0.5rem !important;
    }
    #msform select:focus {
        color: #212529;
        background-color: #fff !important;
        border-color: #86b7fe !important;
        outline: 0;
        -webkit-box-shadow: none;
        box-shadow: none;
    }

    #msform .radio {
        padding: 0px 0px 0px 0px;
        border-radius: 50%;
        width: 16px;
    }

    #msform input:focus,
    #msform textarea:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 1px solid #86b7fe;
        outline-width: 0
    }

    #msform .action-button {
        margin: 10px 0px 10px 5px;
        float: right;
    }

    .searchbtn {
        width: 60px;
        background: #673AB7;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 0px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 20px 0px 0px 0px;
        border-radius: 5px;
    }

    .col-form-label {
        padding-top: calc(0.2rem + 1px);
        padding-bottom: calc(0.2rem + 1px);
        margin-bottom: 0;
        font-size: inherit;
        line-height: 1;
    }

    #msform .action-button-previous {
        margin: 10px 5px 10px 0px;
        float: right;
    }

    .card {
        z-index: 0;
        border: none;
        position: relative
    }

    .fs-title {
        font-size: 25px;
        color: #673AB7;
        margin-bottom: 15px;
        font-weight: normal;
        text-align: left
    }

    .purple-text {
        color: #673AB7;
        font-weight: normal
    }

    .steps {
        font-size: 25px;
        color: gray;
        margin-bottom: 10px;
        font-weight: normal;
        text-align: right
    }

    .fieldlabels {
        color: rgb(72 72 72);
        text-align: left;
        font-size: 13px;
        /* font-weight: bold; */
    }

    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        color: lightgrey
    }

    #progressbar .active {
        color: #673AB7
    }

    #progressbar li {
        list-style-type: none;
        font-size: 15px;
        width: 25%;
        float: left;
        position: relative;
        font-weight: 400
    }

    #progressbar #account:before {
        font-family: FontAwesome;
        content: "\f07c"
    }

    #progressbar #personal:before {
        font-family: FontAwesome;
        content: "\f073"
    }

    #progressbar #payment:before {
        font-family: FontAwesome;
        content: "\f156"
    }

    #progressbar #confirm:before {
        font-family: FontAwesome;
        content: "\f00c"
    }

    #progressbar li:before {
        width: 45px;
        height: 45px;
        line-height: 45px;
        display: block;
        font-size: 18px;
        color: #ffffff;
        background: lightgray;
        border-radius: 50%;
        margin: 0 auto 10px auto;
        padding: 2px
    }

    #progressbar li:after {
        content: '';
        width: 100%;
        height: 2px;
        background: lightgray;
        position: absolute;
        left: 0;
        top: 25px;
        z-index: -1
    }

    #progressbar li.active:before,
    #progressbar li.active:after {
        background: #673AB7
    }

    .progress {
        height: 15px
    }

    .progress-bar {
        background-color: #673AB7
    }

    .fit-image {
        width: 100px;
        object-fit: cover;
        margin-left: 90px;
    }

    ul,
    ol,
    dl {
        padding-left: 0rem;
    }
    .form-check-input{
        margin-top:0em !important;
    }
</style>

<script>
    $(document).ready(function() {

        var current_fs, next_fs, previous_fs; //fieldsets
        var opacity;
        var current = 1;
        var steps = $("fieldset").length;

        setProgressBar(current);

        $(".next").click(function() {

            current_fs = $(this).parent();
            next_fs = $(this).parent().next();

            //Add Class Active
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 500
            });
            setProgressBar(++current);
        });

        $(".previous").click(function() {

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //Remove class active
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();

            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    previous_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 500
            });
            setProgressBar(--current);
        });

        function setProgressBar(curStep) {
            var percent = parseFloat(100 / steps) * curStep;
            percent = percent.toFixed();
            $(".progress-bar")
                .css("width", percent + "%")
        }

        $(".submit").click(function() {
            return false;
        })

    });
</script>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-11 col-sm-10 col-md-10 col-lg-12 col-xl-12 text-center p-0 mb-2">
                        <h2 id="heading">New Patient Registration</h2>
                        <form id="msform" action="{{route('patient-registration.update',$data->id)}}" method="post" enctype="multipart/form-data">
                            <!-- progressbar -->
                            <input type="hidden" name="_method" value="PATCH">
                            <ul id="progressbar">
                                <li class="active" id="account"><strong>Account</strong></li>
                                <li id="personal"><strong>Date</strong></li>
                                <li id="payment"><strong>Payment</strong></li>
                                <li id="confirm"><strong>Finish</strong></li>
                            </ul>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div> <br> <!-- fieldsets -->
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="fieldlabels col-form-label"> First Name *</label>
                                            <input type="text" name="f_name" placeholder="First Name"
                                                class="form-control" required value="{{$data->f_name}}"/>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="fieldlabels col-form-label"> Last Name</label>
                                            <input type="text" name="l_name" placeholder="Last Name"
                                                class="form-control" value="{{$data->l_name}}"/>
                                        </div>
                                        <div class="col-md-1">
                                            <label class="fieldlabels col-form-label"> Gender *</label>
                                            <select class="form-select" name="gender" id="floatingSelect" aria-label="Floating label select example" required>
                                                <option value="">select</option>
                                                <option value="male" <?php if ($data->gender == 'male') { echo 'selected';} ?>>Male</option>
                                                <option value="female"<?php if ($data->gender == 'female') {echo 'selected';} ?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="fieldlabels col-form-label"> Marital Status *</label>
                                            <select class="form-select" name="marital_status" id="floatingSelect" naria-label="Floating label select example" required>
                                                <option value="">Select</option>
                                                <option value="married" <?php if ($data->marital_status == 'married') { echo 'selected';} ?>>Married</option>
                                                <option value="unmarried"<?php if ($data->marital_status == 'unmarried') {echo 'selected';} ?>>Unmarried</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="fieldlabels col-form-label"> LMP</label>
                                            <input type="text" name="lmp" placeholder="LMP" class="form-control" value="{{$data->lmp}}"/>
                                        </div>
                                        <div class="col-md-1">
                                            <label class="fieldlabels col-form-label"> Handedness</label>
                                            <select class="form-select" name="handed" id="floatingSelect" aria-label="Floating label select example">
                                                <option selected>Select</option>
                                                <option value="left" <?php if ($data->handed == 'left') { echo 'selected';} ?>>Left</option>
                                                <option value="right"<?php if ($data->handed == 'right') {echo 'selected';} ?>>Right</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="fieldlabels col-form-label"> Blood Group</label>
                                            <select class="form-select" name="blood_group" id="floatingSelect" aria-label="Floating label select example">
                                                <option selected>Select</option>
                                                <option value="a+" <?php if ($data->blood_group == 'a+') { echo 'selected';} ?>>A+</option>
                                                <option value="a-" <?php if ($data->blood_group == 'a-') { echo 'selected';} ?>>A-</option>
                                                <option value="b+" <?php if ($data->blood_group == 'b+') { echo 'selected';} ?>>B+</option>
                                                <option value="b-" <?php if ($data->blood_group == 'b-') { echo 'selected';} ?>>B-</option>
                                                <option value="o+" <?php if ($data->blood_group == 'o+') { echo 'selected';} ?>>O+</option>
                                                <option value="o-" <?php if ($data->blood_group == 'o-') { echo 'selected';} ?>>O-</option>
                                                <option value="ab+" <?php if ($data->blood_group == 'ab+') { echo 'selected';} ?>>AB+</option>
                                                <option value="ab-" <?php if ($data->blood_group == 'ab-') { echo 'selected';} ?>>AB-</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="fieldlabels col-form-label"> Blood Sugar</label>
                                            <input type="text" name="bs" placeholder="Blood Sugar"
                                                class="form-control" value="{{$data->bs}}"/>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="fieldlabels col-form-label"> DOB[dd/mm/yyyy]</label>
                                            <input type="date" name="dob" placeholder="dd/mm/yyyy"
                                                class="form-control" value="{{$data->dob}}" required />
                                        </div>
                                        <div class="col-md-1">
                                            <label class="fieldlabels col-form-label"> Age *</label>
                                            <input type="text" name="age" placeholder="Age" class="form-control" value="{{$data->age}}" required/>
                                        </div>
                                        {{-- <div class="col-md-1">
                                            <label class="fieldlabels col-form-label"> Age: *</label>
                                            <input type="text" name="cpwd" placeholder="Age" class="form-control" />
                                        </div> --}}
                                        <div class="col-md-1">
                                            <label class="fieldlabels col-form-label"> Height(cm)</label>
                                            <input type="text" name="height" placeholder="Height"
                                                class="form-control" value="{{$data->height}}" />
                                        </div>
                                        <div class="col-md-1">
                                            <label class="fieldlabels col-form-label"> Weight(kg)</label>
                                            <input type="text" name="weight" placeholder="Weight"
                                                class="form-control" value="{{$data->weight}}"/>
                                        </div>
                                        <div class="col-md-1">
                                            <label class="fieldlabels col-form-label"> BP(Systolic)</label>
                                            <input type="text" name="bp_sy" placeholder="BP"
                                                class="form-control" value="{{$data->bp_sy}}"/>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="fieldlabels col-form-label"> BP(Diastolic)</label>
                                            <input type="text" name="bp_di" placeholder="BP"
                                                class="form-control" value="{{$data->bp_di}}"/>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="fieldlabels col-form-label"> Occupation *</label>
                                            <select class="form-select" name="occupation" id="floatingSelect" aria-label="Floating label select example">
                                                <option selected>Select</option>
                                                <option value="doctor" <?php if ($data->occupation == 'doctor') { echo 'selected';} ?>>Doctor</option>
                                                <option value="teacher" <?php if ($data->occupation == 'teacher') { echo 'selected';} ?>>Teacher</option>
                                                <option value="engineer" <?php if ($data->occupation == 'engineer') { echo 'selected';} ?>>Engineer</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="fieldlabels col-form-label"> Mobile No *</label>
                                            <input type="text" name="mobile" placeholder="Mobile No"
                                                class="form-control" value="{{$data->mobile}}" required/>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="fieldlabels col-form-label"> Email Id</label>
                                            <input type="email" name="email" placeholder="Email Id"
                                                class="form-control" value="{{$data->email}}" required/>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="fieldlabels col-form-label"> Address</label>
                                            <input type="text" name="address" placeholder="Address"
                                                class="form-control" value="{{$data->address}}" />
                                        </div>
                                    </div>
                                </div>
                                <input type="button" name="next" class="next action-button btn btn-primary btn-sm"
                                    value="Save and Continue" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="fieldlabels col-form-label"> Department *</label>
                                            <?php $departments=DB::table('departments')->where('status','1')->get(); ?>
                                            <select name="depart_id" class="form-select" id="floatingSelect" aria-label="Floating label select example" required>
                                            <option value="" selected>Select</option>
                                            @foreach ( $departments as $dep)
                                            <option value="{{$dep->id}}"
                                            @selected($dep->id==$data->depart_id)>{{$dep->name}}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="fieldlabels col-form-label"> Doctor *</label>
                                            <?php $doctors=DB::table('doctors')->where('status','1')->get(); ?>
                                            <select name="doc_id" class="form-select" id="floatingSelect" aria-label="Floating label select example" required>
                                            <option value="" selected>Select</option>
                                            @foreach ( $doctors as $doc)
                                            <option value="{{$doc->id}}"
                                            @selected($doc->id==$data->doc_id)>{{ strtoupper($doc->f_name . ' ' . $doc->l_name) }} </option>
                                            @endforeach
                                        </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="fieldlabels col-form-label"> Day</label>
                                            <input type="date" name="book_date"
                                                placeholder="date"class="form-control" value="{{$data->book_date}}"/>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="fieldlabels col-form-label"></label>
                                            <button type="button" name="uname" class="searchbtn"><i
                                                    class="fa fa-search" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <input type="button" name="next" class="next action-button btn btn-primary btn-sm"
                                    value="Next" class="form-control" />
                                <input type="button" name="previous"
                                    class="previous action-button-previous btn btn-sm btn-info" value="Previous" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label class="fieldlabels col-form-label"> Total Amount *</label>
                                            <input type="text" name="fees" placeholder="Total Amount"
                                                class="form-control" value="{{$data->fees}}" required/>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="fieldlabels col-form-label"> Paid Amount *</label>
                                            <input type="text" name="total_amount" placeholder="Paid Amount"
                                                class="form-control" value="{{$data->total_amount}}" required/>
                                        </div>
                                        <div class="col-md-1">
                                            <label class="fieldlabels col-form-label"> Discount</label>
                                            <input type="text" name="discount" placeholder="Discount"
                                                class="form-control" value="{{$data->discount}}" />
                                        </div>
                                        <div class="col-md-1">
                                            <label class="fieldlabels col-form-label"> Due</label>
                                            <input type="text" name="due" placeholder="Due"
                                                class="form-control" value="{{$data->due}}" />
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-check-label radio2" for="flexRadioDefault1">Payment Method</label>

                                            <input class="form-check-input radio" type="radio" name="payment_method" id="flexRadioDefault1" value="cash" <?php if ($data->payment_method == 'cash') { echo 'checked';} ?>>
                                            <i class="fa fa-inr" aria-hidden="true">&nbsp;Cash</i>

                                            <input class="form-check-input radio" type="radio" name="payment_method" id="flexRadioDefault2" value="card" <?php if ($data->payment_method == 'card') { echo 'checked';} ?>>
                                            <i class="fa fa-credit-card" aria-hidden="true">&nbsp;Card</i>

                                            <input class="form-check-input radio" type="radio" name="payment_method" id="flexRadioDefault3" value="online" <?php if ($data->payment_method == 'online') { echo 'checked';} ?>>
                                            <i class="fa fa-money" aria-hidden="true"></i>&nbsp;Online</i>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="fieldlabels col-form-label"> Comments</label>
                                            <input type="text" name="comments" placeholder="Comments"
                                                class="form-control" value="{{$data->comments}}"/>
                                        </div>
                                    </div>
                                </div>
                                {{-- <input type="button" name="next" class="next action-button btn btn-primary btn-sm"
                                    value="Submit" /> --}}
                                    <button type="submit" class="btn btn-primary btn-sm" style="float: right; margin-top:10px;">Update</button>
                                <input type="button" name="previous"
                                    class="previous action-button-previous btn btn-sm btn-info" value="Previous" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2> <br>
                                    <div class="row justify-content-center">
                                        <div class="col-3"> <img src="https://i.imgur.com/GwStPmg.png"
                                                class="fit-image">
                                        </div>
                                    </div> <br>
                                    <div class="row justify-content-center">
                                        <div class="col-7 text-center">
                                            <h5 class="purple-text text-center">You Have Successfully Registration</h5>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
