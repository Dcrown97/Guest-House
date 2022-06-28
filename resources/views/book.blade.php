@extends('layout/master')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Rooms</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="/">Home</a>&nbsp;<i
                                class="fa fa-angle-right"></i>
                        </li>
                        <li><a class="parent-item" href="/rooms">Rooms</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Book Room</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="card card-box">
                        <div class="card-head">
                            <header>Bookings Information</header>
                            <button id="panel-button" class="mdl-button mdl-js-button mdl-button--icon pull-right"
                                data-upgraded=",MaterialButton">
                                <i class="material-icons">more_vert</i>
                            </button>
                            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                                data-mdl-for="panel-button">
                                <li class="mdl-menu__item"><i class="material-icons">assistant_photo</i>Action
                                </li>
                                <li class="mdl-menu__item"><i class="material-icons">print</i>Another action
                                </li>
                                <li class="mdl-menu__item"><i class="material-icons">favorite</i>Something else
                                    here</li>
                            </ul>
                        </div>
                        <div class="card-body" id="bar-parent">
                            @include('flash.flash')
                            <form method="POST" id="form_sample_1"
                                class="form-horizontal">
                                @csrf
                                <div class="form-body">
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Room
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-5">
                                            <input type="text" readonly name="name" value="{{ $room->name }}" data-required="1"
                                                placeholder="Enter room name" class="form-control input-height" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Price
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-5">
                                            <input type="text" name="price" id="price" value="{{ $room->price }}" data-required="1"
                                                placeholder="5000" class="form-control input-height" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Status
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-5">
                                            <input type="text" readonly name="status" value="{{ $room->status }}" data-required="1"
                                                placeholder="5000" class="form-control input-height" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Check In
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-5">
                                            <input type="datetime-local" id="datefield"  name="check_in" data-required="1"
                                             class="form-control input-height" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Check Out
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-5">
                                            <input type="datetime-local" name="check_out"  id="datefield1" data-required="1"
                                                placeholder="5000" class="form-control input-height" />
                                        </div>
                                    </div>
                                    <input id="days" hidden name="days" type="text">
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Total
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-5">
                                            <input type="text" readonly id="total" name="amount" data-required="1"
                                             class="form-control input-height" />
                                        </div>
                                    </div>

                                    </div>
                                   
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="offset-md-3 col-md-9">
                                                <button type="submit"
                                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-circle btn-primary">Book</button>
                                                <a href="/rooms" class="btn btn-danger btn-circle"
                                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-danger">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
<script type="text/javascript" >
    $(document).ready(function(){
        $('#datefield1').change(function(){
            var check_in = $('#datefield').val();
            var check_out = $('#datefield1').val();
            var check_in_date = new Date(check_in);
            var check_out_date = new Date(check_out);
            var diff = check_out_date.getTime() - check_in_date.getTime();
            var days = diff/(1000*60*60*24);
            var total = days * $('#price').val();
            $('#total').val(total);
            $('#days').val(days);
            
        });

    });


        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();
        if(dd<10){
                dd='0'+dd
            } 
            if(mm<10){
                mm='0'+mm
            } 

        today = yyyy+'-'+mm+'-'+dd ;
        document.getElementById("datefield").setAttribute("max", today)
</script>
