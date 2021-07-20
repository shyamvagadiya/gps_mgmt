@extends('layouts.main')

@section('title')
Vehicle Status Update
@endsection
@section('content')
<div class="container">
    
    <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Vehicle Status Update</h4>
                    <form class="form-sample" method="post" action="{{route('update.vehicle_status')}}">
                      @csrf

                      <input type="hidden" name="id" value="{{$vehicle->id}}">
                      <div class="row">
                          <div class="col-md-12">
                              @if(Session::has('message-error'))
                              <div class="alert alert-danger">
                                {{Session::get('message-error')}}
                              </div>
                              @endif
                          </div>
                      </div>

                      <div class="row">
                      
                        
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Customer</label>
                            <div class="col-sm-9">
                              <input type="text" name="customer" value="{{isset($vehicle->client->company) ? $vehicle->client->company : '-'}}({{isset($vehicle->client->mobile_no) ? $vehicle->client->mobile_no : ''}})" required="" class="form-control customer">
                              <input type="hidden" name="customer_id" value="{{$vehicle->client_id}}" class="customer_id">
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Type</label>
                            <div class="col-sm-9">
                              <select name="type_id" class="form-control">
                                <option value="">--Type--</option>
                                @if(count($types) > 0)
                                    @foreach($types as $type)
                                        <option value="{{$type->id}}" @if($vehicle->type_id == $type->id) selected @endif>{{$type->name}}</option>
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
                            <label class="col-sm-3 col-form-label">User ID</label>
                            <div class="col-sm-9">
                              <input type="text" name="user_id" value="{{$vehicle->user_id}}" maxlength="100" class="form-control">
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
                                        <option value="{{$application->id}}" @if($vehicle->application_id == $application->id) selected @endif>{{$application->name}}</option>
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
                              <input type="text" name="vehicle_no" value="{{$vehicle->vehicle_no}}" maxlength="100" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Device Type</label>
                            <div class="col-sm-9">
                              <input type="text" name="device_type" value="{{$vehicle->device_type}}" maxlength="100" class="form-control">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">IMEI No</label>
                            <div class="col-sm-9">
                              <input type="text" name="imei_no" value="{{$vehicle->imei_no}}" maxlength="100" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">SIM No</label>
                            <div class="col-sm-9">
                              <input type="text" name="sim_no" value="{{$vehicle->sim_no}}" maxlength="100" class="form-control">
                            </div>
                          </div>
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">SIM Operator</label>
                            <div class="col-sm-9">
                              <select class="form-control" name="sim_operator">
                                <option value="Vodafone" @if($vehicle->sim_operator == 'Vodafone') selected @endif>Vodafone</option>
                                <option value="Airtel" @if($vehicle->sim_operator == 'Airtel') selected @endif>Airtel</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Monthly SIM Charge</label>
                            <div class="col-sm-8">
                              <!-- <input type="number" name="monthly_sim_charge" value="{{$vehicle->monthly_sim_charge}}" class="form-control"> -->

                                <select class="form-control" name="monthly_sim_charge">
                                  <option value="29.5" @if($vehicle->monthly_sim_charge == 29.5) selected @endif>29.5</option>
                                  <option value="41.3" @if($vehicle->monthly_sim_charge == 41.3) selected @endif>41.3</option>
                                </select>

                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Created Date</label>
                            <div class="col-sm-9">
                              <input type="date"  name="created_at" value="{{date('Y-m-d',strtotime($vehicle->created_at))}}" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Expiry Date</label>
                            <div class="col-sm-9">
                              <input type="date" name="expiry_date" value="{{$vehicle->expiry_date}}" class="form-control">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Warranty</label>
                            <div class="col-sm-9">
                              <input type="date" name="warranty" value="{{$vehicle->warranty}}" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Payment Details</label>
                            <div class="col-sm-9">
                              <input type="text" name="payment_details" value="{{$vehicle->payment_details}}" maxlength="250" disabled="" class="form-control">
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
                                  <input type="radio" class="form-check-input" name="vehicle_status" id="vehicle_status" value="Active" @if($vehicle->vehicle_status == 'Active') checked="" @endif> Active <i class="input-helper"></i></label>
                              </div>
                            </div>
                            <div class="col-sm-5">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="vehicle_status" id="vehicle_status2" value="Inactive" @if($vehicle->vehicle_status == 'Inactive') checked="" @endif> Inactive <i class="input-helper"></i></label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Dealer</label>
                            <div class="col-sm-9">
                              <input class="form-control" name="dealer" value="{{$vehicle->dealer}}" maxlength="250" type="text" placeholder="">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Technician</label>
                            <div class="col-sm-9">
                              <input type="text" name="technician" value="{{$vehicle->technician}}" maxlength="250" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Prepared By</label>
                            <div class="col-sm-9">
                              <input type="text" name="prepared_by" value="{{$vehicle->prepared_by}}" required="" maxlength="250" class="form-control">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Salesman</label>
                            <div class="col-sm-9">
                              <input class="form-control" name="salesman" value="{{$vehicle->salesman}}" maxlength="250" type="text" placeholder="">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $('.customer').autocomplete({
          serviceUrl: '{{route("load_data_autofill")}}',
          onSelect: function (suggestion) {
              $(this).val(suggestion.value);
              $('.customer_id').val(suggestion.data);
              //alert(suggestion.load_data);
              
          }
      });
</script>
@endsection