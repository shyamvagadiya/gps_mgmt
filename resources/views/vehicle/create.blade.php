@extends('layouts.main')

@section('title')
Vehicle Addition
@endsection
@section('content')
<div class="container">
    
    <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Vehicle Addition Form</h4>
                    <form class="form-sample" method="post" action="{{route('submit.vehicle')}}">
                      @csrf

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
                              <input type="text" name="customer" required="" class="form-control customer">
                              <input type="hidden" name="customer_id" class="customer_id">
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
                                        <option value="{{$type->id}}">{{$type->name}}</option>
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
                              <input type="text" name="user_id" maxlength="100" class="form-control user_id">
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
                              <input type="text" name="device_type" value="evo2" maxlength="100" class="form-control">
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
                              <select class="form-control" name="sim_operator">
                                <option value="Vodafone">Vodafone</option>
                                <option value="Airtel">Airtel</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Monthly SIM Charge</label>
                            <div class="col-sm-8">
                              <!-- <input type="number" name="monthly_sim_charge" class="form-control"> -->
                              <select class="form-control" name="monthly_sim_charge">
                                  <option value="29.5">29.5</option>
                                  <option value="41.3">41.3</option>
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
                              <input type="date"  name="created_at" value="{{date('Y-m-d')}}" class="form-control">
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
                            <label class="col-sm-3 col-form-label">Dealer</label>
                            <div class="col-sm-9">
                              <input class="form-control dealer" name="dealer" maxlength="250" type="text" placeholder="">
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
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Salesman</label>
                            <div class="col-sm-9">
                              <input class="form-control salesman" name="salesman" maxlength="250" type="text" placeholder="">
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

              $.ajax({
                  url: "{{route('load.prev_data')}}",
                  data: "customer_id="+suggestion.data,
                  success: function(response){
                    $('.salesman').val(response.salesman);
                    $('.dealer').val(response.dealer);
                    $('.user_id').val(response.user_id);
                  }
              });
          }
      });
</script>
@endsection