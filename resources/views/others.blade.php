@extends('layout/master')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Others</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="/">Home</a>&nbsp;<i
                                class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Other</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="card card-box">
                        <div class="card-head">
                            <header>Others</header>
                            
                        </div>

                        <div class="panel tab-border card-box">
                            <header class="panel-heading panel-heading-gray custom-tab">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a href="#order_food" data-bs-toggle="tab" class="active">
                                        </i> Add
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#add_food" data-bs-toggle="tab">
                                        </i> Reports
                                    </a>
                                </li>
                                </ul>
                            </header>
                            <div class="panel-body">
                                <div class="tab-content" id="tab">
                                    <div class="tab-pane" id="add_food">
                                        
                                     <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                        id="example4">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th> Item </th>
                                                <th> Price </th>
                                                {{-- <th>Available</th> --}}

                                                {{-- <th> Leave Days </th> --}}
                                                <th> Infomation </th>
                                            </tr>
                                        </thead>
                                        <tbody id="result"></tbody>
                                        <tbody id="old">
                                            @if (isset($others) && count($others) > 0)
                                            @foreach ($others as $other)
                                            <tr class="odd gradeX">
                                                <td class="patient-img">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>{{ $other->name }}
                                                </td>
                                                <td class="center">N{{ $other->price }}</td>
                                               


                                                <td>
                                                    <div class="justify-content-between">
                                                        
                                                        {{-- <button type="button" class="btn btn-primary btn-lg"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#edit_modal{{ $other->id }}">
                                                            <i class="fa fa-edit"></i>
                                                            Edit
                                                        </button>

                                                        <a onclick="return confirm('Are you sure you want to delete this other?')"
                                                            href="/delete_food/{{ base64_encode($other->id) }}"
                                                            class="btn btn-danger btn-lg">Delete</a> --}}
                                                            {{$other->info}}
                                                    </div>
                                                </td>
                                            </tr>






                                            <!--Edit Modal -->
                                            <div class="modal fade" id="edit_modal{{ $other->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                Edit
                                                                Food </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="/edit_food" method="POST"
                                                                id="form_sample_1" class="form-horizontal">
                                                                @csrf
                                                                <div class="form-body">
                                                                    <input type="hidden" name="food_id"
                                                                        value="{{ $other->id }}" id="">
                                                                    <div class="form-group row">
                                                                        <label class="control-label col-md-3">Food
                                                                            Name
                                                                            <span class="required"> * </span>
                                                                        </label>
                                                                        <div class="col-md-5">
                                                                            <input type="text" name="food_name"
                                                                                data-required="1"
                                                                                placeholder="Food Name"
                                                                                value="{{ $other->name }}"
                                                                                class="form-control input-height" />
                                                                        </div>
                                                                    </div>
                                                                   
                                                                    <div class="form-group row">
                                                                        <label class="control-label col-md-3">Price
                                                                            <span class="required"> * </span>
                                                                        </label>
                                                                        <div class="col-md-5">
                                                                            <input type="number" name="food_price"
                                                                                data-required="1"
                                                                                placeholder="Enter Food Price"
                                                                                value="{{ $other->price }}"
                                                                                class="form-control input-height" />
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save
                                                                        changes</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- End of edit modal --}}

                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                      {{ $others->links('vendor.pagination.bootstrap-4') }}

                                    </div>
                                    <div class="tab-pane active" id="order_food">
                                        <div class="card-body" id="bar-parent">
                                            @include('flash.flash')
                                            
                                            <form method="POST" id="form_sample_1"
                                                class="form-horizontal">
                                                @csrf
                                                <div class="form-body">
                                                    <div class="form-group row">
                                                        <label class="control-label col-md-3">Item Name
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-5">
                                                            <input type="text" name="name" data-required="1"
                                                                placeholder="Enter Name"
                                                                class="form-control input-height" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="control-label col-md-3">Price(optional)
                                                            <span class="required">  </span>
                                                        </label>
                                                        <div class="col-md-5">
                                                            <input type="number" name="price" data-required="1"
                                                                placeholder="Enter Price"
                                                                class="form-control input-height" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="control-label col-md-3">Information(optional)
                                                            <span class="required">  </span>
                                                        </label>
                                                        <div class="col-md-5">
                                                           <textarea name="info" id="" cols="71" placeholder="...all information about this item" rows="5"></textarea>
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


<script src="../leave_report/assets/plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
        $(document).ready(function(){
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('#tab a[href="' + activeTab + '"]').tab('show');
    }
});
</script>
