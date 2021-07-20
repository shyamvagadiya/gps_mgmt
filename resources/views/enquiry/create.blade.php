@extends('layouts.main')

@section('title')
Enquiry Addition
@endsection
@section('content')
<div class="container">
    
    <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Enquiry Addition Form</h4>
                    <form class="form-sample" method="post" action="{{route('submit.enquiry')}}">
                      <div class="row">
                        
                        @csrf
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Company</label>
                            <div class="col-sm-9">
                              <input type="text" name="company"  class="form-control">
                            </div>
                          </div>
                        </div>
                      
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
                            <label class="col-sm-3 col-form-label">Mobile No</label>
                            <div class="col-sm-9">
                              <input type="number" name="mobile_no" maxlength="100" class="form-control">
                            </div>
                          </div>
                        </div>
                        

                      
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                              <input type="email" name="email" maxlength="100" class="form-control">
                            </div>
                          </div>
                        </div>
                        

                      </div>


                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Last Call Date</label>
                            <div class="col-sm-9">
                              <input type="date" name="last_call" class="form-control">
                            </div>
                          </div>
                        </div>
                          

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Comment</label>
                            <div class="col-sm-9">
                              <!-- <input type="text" class="form-control"> -->
                              <textarea class="form-control" name="comment" cols="4" rows="4"></textarea>
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