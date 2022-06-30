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
                        <li><a class="parent-item" href="/all_staffs">Room</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Add Rooms</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="card card-box">
                        <div class="card-head">
                            <header>Room Information</header>
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
                            <form action="{{ route('add_rooms') }}" method="POST" id="form_sample_1"
                                class="form-horizontal">
                                @csrf
                                <div class="form-body">
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Rooms
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-5">
                                            <input type="number" name="rooms" data-required="1"
                                                placeholder="Enter number all number of room" class="form-control input-height" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Price
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-5">
                                            <input type="text" name="price" data-required="1"
                                                placeholder="5000" class="form-control input-height" />
                                        </div>
                                    </div>

                                    </div>
                                    {{-- <div class="form-group row">
                                        <label class="control-label col-md-3">Leave Days
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-5">
                                            <input type="number" name="leave_days" data-required="1" placeholder="Enter Leave Days"
                                                class="form-control input-height" />
                                        </div>
                                    </div> --}}
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="offset-md-3 col-md-9">
                                                <button type="submit"
                                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-circle btn-primary">Submit</button>
                                                <button type="button"
                                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-danger">Cancel</button>
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
