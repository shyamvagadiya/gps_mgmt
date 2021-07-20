<table class="table table-responsive" id="myTable">
                      <thead>
                        <tr>
                          <th>Customer No</th>
                          <th>Company</th>
                          <th>Name</th>
                          <th>City</th>
                          <th>State</th>
                          <th>Mobile No</th>
                          <th>Dealer Name</th>
                          <th>Salesman</th>
                          <th>Type</th>
                          <th>User ID</th>
                          <th>Application</th>
                          <th>Vehicle No</th>

                          <th>Device Type</th>
                          <th>SIM No</th>
                          <th>IMEI NO</th>

                          <th>Created Date</th>
                          <th>Expiry Date</th>
                          <th>Warranty</th>

                          

                          <th>Vehicle Status</th>
                          <th>Payment Details</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                            @if(count($clients) > 0)
                                @foreach($clients as $client)
                                    <tr>
                                        <td>{{isset($client->client->customer_no) ? $client->client->customer_no : "-"}}</td>
                                        <td>{{isset($client->client->company) ? $client->client->company : "-"}}</td>
                                        <td>{{isset($client->client->customer_name) ? $client->client->customer_name : "-"}}</td>
                                        <td>{{isset($client->client->city) ? $client->client->city : "-"}}</td>
                                        <td>{{isset($client->client->state) ? $client->client->state : "-"}}</td>
                                        <td>{{isset($client->client->mobile_no) ? $client->client->mobile_no : "-"}}</td>
                                        <td>{{$client->dealer}}</td>
                                        <td>{{$client->salesman}}</td>
                                        <td>{{isset($client->type->name) ? $client->type->name : "-"}}</td>
                                        <td>{{$client->user_id}}</td>
                                        <td>{{isset($client->application->name) ? $client->application->name : "-"}}</td>
                                        <td>{{$client->vehicle_no}}</td>
                                        <td>{{$client->device_type}}</td>
                                        <td>{{$client->sim_no}}</td>
                                        <td>{{$client->imei_no}}</td>
                                        <td>{{$client->created_at}}</td>
                                        <td>{{$client->expiry_date}}</td>
                                        <td>{{$client->warranty}}</td>


                                        <td>{{$client->vehicle_status}}</td>
                                        <td>{{$client->payment_details}}</td>
                                        <td>
                                            @if(Auth::user()->is_admin == 1)
                                                <button class="btn btn-info updatePayment" data-id="{{$client->id}}">Update Payment</button>
                                            @else 
                                                <button disabled class="btn btn-info" data-id="{{$client->id}}">Update Payment</button>
                                            @endif

                                            <a class="btn btn-primary" href="{{route('edit.vehicle_status',$client->id)}}">Edit Status</a>
                                        </td>
                                    </tr>
                                @endforeach 
                            @endif
                      </tbody>
                    </table>