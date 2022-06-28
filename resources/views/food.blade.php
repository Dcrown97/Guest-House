@extends('layout/master')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Restaurant</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="/">Home</a>&nbsp;<i
                                class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Food</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="card card-box">
                        <div class="card-head">
                            <header>Basic Information</header>
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

                        <div class="panel tab-border card-box">
                            <header class="panel-heading panel-heading-gray custom-tab">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a href="#add_food" data-bs-toggle="tab" class="active">
                                            </i> Add Food
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#order_food" data-bs-toggle="tab">
                                            </i> Order Food
                                        </a>
                                    </li>
                                </ul>
                            </header>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="add_food">
                                        <div class="card-body" id="bar-parent">
                                            @include('flash.flash')
                                            <form action="{{ route('add_food') }}" method="POST" id="form_sample_1"
                                                class="form-horizontal">
                                                @csrf
                                                <div class="form-body">
                                                    <div class="form-group row">
                                                        <label class="control-label col-md-3">Food Name
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-5">
                                                            <input type="text" name="food_name" data-required="1"
                                                                placeholder="Enter Food Name"
                                                                class="form-control input-height" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="control-label col-md-3">Price
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-5">
                                                            <input type="number" name="food_price" data-required="1"
                                                                placeholder="Enter Food Price"
                                                                class="form-control input-height" />
                                                        </div>
                                                    </div>
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
                                    <div class="tab-pane " id="order_food">
                                        <div class="card-body" id="bar-parent">
                                            @include('flash.flash')
                                            <form action="{{ route('order_drinks') }}" method="POST" id="form_sample_1"
                                                class="form-horizontal">
                                                @csrf
                                                <div class="form-body">
                                                    <div class="form-group row">
                                                        <label class="control-label col-md-3">Food
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-5">
                                                            <select class="form-select input-height" name="food_id"
                                                                id="food_id">
                                                                <option value="">Select...</option>
                                                                @if (isset($Foods) && count($Foods) > 0)
                                                                    @foreach ($Foods as $food)
                                                                        <option value="{{ $food->id }}">
                                                                            {{ $food->food_name }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="control-label col-md-3">Food Order Price
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-5">
                                                            <input type="number" name="ordered_food_price"
                                                                data-required="1" id="food_price"
                                                                placeholder="Enter Order Price"
                                                                class="form-control input-height" />
                                                        </div>
                                                    </div>
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
                </div>
            </div>
        </div>
    </div>
@endsection


<script src="http://code.jquery.com/jquery-3.4.1.js"></script>

<script>
    $(document).ready(function() {
        console.log('ready');
        $('#food_id').on('change', function() {
            $('#food_price').val('');
            let food_id = $(this).val();
            // console.log(food_id)
            if (food_id === null) {
                alert('Please select food');
                return false;
            }
            $.ajax({
                type: 'GET',
                url: `/food_price/${food_id}`,
                data: {
                    food_id: food_id
                },
                success: function(response) {
                    // alert('yes', response.room)
                    console.log('response', response);
                    var response = JSON.parse(response);
                    console.log('response', response);
                    // $('#sub_category').empty();
                    $('#error1').text('');
                    $('#food_price').val(response)
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log("Oops!", "An error occurred.");
                    console.log(XMLHttpRequest, textStatus, errorThrown);
                }
            });
        });
    });
</script>
