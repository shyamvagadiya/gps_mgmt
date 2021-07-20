@extends('layouts.main')

@section('title')
Client Addition
@endsection
@section('content')
<div class="container">
    
    <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Client Addition Form</h4>
                    <form class="form-sample" method="post" action="{{route('submit.client')}}">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Customer No</label>
                            <div class="col-sm-9">
                              <input type="text" name="customer_no" value="{{$customer_no}}" readonly="" class="form-control">
                            </div>
                          </div>
                        </div>
                        @csrf
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Company</label>
                            <div class="col-sm-9">
                              <input type="text" name="company_id" class="form-control">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Customer Name</label>
                            <div class="col-sm-9">
                              <input type="text" name="customer_name" maxlength="100" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                              <!-- <input type="text" class="form-control"> -->
                              <textarea class="form-control" name="address"></textarea>
                            </div>
                          </div>
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">City</label>
                            <div class="col-sm-9">
                              <input type="text" name="city" maxlength="100" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">State</label>
                            <div class="col-sm-9">
                              <input type="text" name="state" maxlength="100" class="form-control">
                            </div>
                          </div>
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Mobile No</label>
                            <div class="col-sm-9">
                              <input type="number" name="mobile_no" required="" maxlength="10" class="form-control">
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Alternate Mobile No</label>
                            <div class="col-sm-9">
                              <input type="number" name="alt_mobile_no" maxlength="10" class="form-control">
                            </div>
                          </div>
                        </div>

                        

                        {{--<div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Type</label>
                            <div class="col-sm-9">
                              <select name="type_id" class="form-control">
                                <option value="">--Type--</option>
                                @if(count($types) > 0)
                                    @foreach($types as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                @endif
                              </select>
                            </div>
                          </div>
                        </div>--}}
                      </div>

                      {{--<div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">User ID</label>
                            <div class="col-sm-9">
                              <input type="email" name="user_id" maxlength="100" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Application</label>
                            <div class="col-sm-9">
                              <select name="application_id" class="form-control">
                                <option value="">--Application--</option>
                                @if(count($applications) > 0)
                                    @foreach($applications as $application)
                                        <option value="{{$application->id}}">{{$application->name}}</option>
                                    @endforeach
                                @endif
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Vehicle No</label>
                            <div class="col-sm-9">
                              <input type="text" name="vehicle_no" maxlength="100" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Device Type</label>
                            <div class="col-sm-9">
                              <input type="text" name="device_type" maxlength="100" class="form-control">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">IMEI No</label>
                            <div class="col-sm-9">
                              <input type="text" name="imei_no" maxlength="100" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">SIM No</label>
                            <div class="col-sm-9">
                              <input type="text" name="sim_no" maxlength="100" class="form-control">
                            </div>
                          </div>
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">SIM Operator</label>
                            <div class="col-sm-9">
                              <input type="text" name="sim_operator" maxlength="100" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Monthly SIM Charge</label>
                            <div class="col-sm-8">
                              <input type="number" name="monthly_sim_charge" class="form-control">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Created Date</label>
                            <div class="col-sm-9">
                              <input type="date" readonly="" value="{{date('Y-m-d')}}" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Expiry Date</label>
                            <div class="col-sm-9">
                              <input type="date" name="expiry_date" value="{{date('Y-m-d',strtotime('+1 year'))}}" class="form-control">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Warranty</label>
                            <div class="col-sm-9">
                              <input type="date" name="warranty" value="{{date('Y-m-d',strtotime('+1 year'))}}" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Payment Details</label>
                            <div class="col-sm-9">
                              <input type="text" name="payment_details" maxlength="250" disabled="" class="form-control">
                            </div>
                          </div>
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Vehicle Status</label>
                            <div class="col-sm-4">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="vehicle_status" id="vehicle_status" value="Active" checked=""> Active <i class="input-helper"></i></label>
                              </div>
                            </div>
                            <div class="col-sm-5">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="vehicle_status" id="vehicle_status2" value="Inactive"> Inactive <i class="input-helper"></i></label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Salesman</label>
                            <div class="col-sm-9">
                              <input class="form-control" name="salesman" maxlength="250" type="text" placeholder="">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Technician</label>
                            <div class="col-sm-9">
                              <input type="text" name="technician" maxlength="250" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Prepared By</label>
                            <div class="col-sm-9">
                              <input type="text" name="prepared_by" required="" maxlength="250" class="form-control">
                            </div>
                          </div>
                        </div>
                      </div>--}}
                      <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Created Date</label>
                              <div class="col-sm-9">
                                <input type="date" name="created_at" value="{{date('Y-m-d')}}" class="form-control">
                              </div>
                            </div>
                          </div>                          
                        </div>

                      <div class="row">
                        <div class="col-md-6">
                          <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </div>


                      <!-- <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Category</label>
                            <div class="col-sm-9">
                              <select class="form-control">
                                <option>Category1</option>
                                <option>Category2</option>
                                <option>Category3</option>
                                <option>Category4</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Membership</label>
                            <div class="col-sm-4">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="membershipRadios" id="membershipRadios1" value="" checked=""> Free <i class="input-helper"></i></label>
                              </div>
                            </div>
                            <div class="col-sm-5">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="membershipRadios" id="membershipRadios2" value="option2"> Professional <i class="input-helper"></i></label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <p class="card-description"> Address </p>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Address 1</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">State</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Address 2</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Postcode</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">City</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Country</label>
                            <div class="col-sm-9">
                              <select class="form-control">
                                <option>America</option>
                                <option>Italy</option>
                                <option>Russia</option>
                                <option>Britain</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div> -->
                    </form>
                  </div>
                </div>
              </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).on('click','.getRoute',function(){
        var route=$(this).data('route');
        location.replace(route);
    });
</script>
@endsection