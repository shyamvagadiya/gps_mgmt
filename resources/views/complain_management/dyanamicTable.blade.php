<table class="table table-responsive" id="myTable">
                      <thead>
                        <tr>
                          <th>Customer No</th>
                          <th>Company</th>
                          <th>Address</th>
                          <th>City</th>
                          <th>State</th>
                          <th>Mobile No</th>
                          <th>Vehicle No</th>
                          <th>Device Type</th>
                          <th>IMEI No</th>
                          <th>SIM No</th>
                          <th>SIM Operator</th>
                          <th>Complain</th>
                          <th>Technician</th>
                          <th>Created Date</th>
                          <th>Status</th>
                          <th>Remarks</th>
                          <th>Conclusion</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                            @if(count($complains) > 0)
                                @foreach($complains as $complain)
                                    <tr>
                                        <td>{{$complain->customer_no}}</td>
                                        <td>{{isset($complain->company) ? $complain->company : "-"}}</td>
                                        <td>{{$complain->address}}</td>
                                        <td>{{$complain->city}}</td>
                                        <td>{{$complain->state}}</td>
                                        <td>{{$complain->mobile_no}}</td>
                                        <td>{{$complain->vehicle_no}}</td>
                                        <td>{{$complain->device_type}}</td>
                                        <td>{{$complain->imei_no}}</td>
                                        <td>{{$complain->sim_no}}</td>
                                        <td>{{$complain->sim_operator}}</td>
                                        <td>{{$complain->complain}}</td>
                                        <td>{{$complain->technician}}</td>
                                        <td>{{$complain->created_at}}</td>
                                        <td>{{$complain->status}}</td>
                                        <td>{{$complain->remarks}}</td>
                                        <td>{{$complain->conclusion}}</td>
                                        <td>
                                            @if($complain->status != 'Resolved')
                                              <a href="javascript:;" class="btn btn-info openConclusion" data-id="{{$complain->id}}">Mark as Resolved</a>
                                            @else
                                              <a disabled href="javascript:;" class="btn btn-danger">Resolved</a>
                                            @endif
                                            <a href="javascript:;" class="btn btn-primary addRemarks" data-id="{{$complain->id}}">Add Remarks</a>
                                        </td>
                                    </tr>
                                @endforeach 
                            @endif
                      </tbody>
                    </table>