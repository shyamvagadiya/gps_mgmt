<table class="table table-responsive" id="myTable">
                      <thead>
                        <tr>
                          <th>Customer No</th>
                          <th>Company</th>
                          <th>Vehicle No</th>
                          <th>Device Type</th>
                          <th>IMEI No</th>
                          <th>SIM No</th>
                          <th>SIM Operator</th>
                          <th>Monthly SIM Charges</th>
                          <th>Created Date</th>
                          <th>SIM Cost</th>
                          <th>SIM Pending Cost</th>
                          <th>SIM Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                            @if(count($clients) > 0)
                                @foreach($clients as $client)
                                    <tr>
                                        <td>{{$client->client->customer_no}}</td>
                                        <td>{{isset($client->client->company) ? $client->client->company : "-"}}</td>
                                        <td>{{$client->vehicle_no}}</td>
                                        <td>{{$client->device_type}}</td>
                                        <td>{{$client->imei_no}}</td>
                                        <td>{{$client->sim_no}}</td>
                                        <td>{{$client->sim_operator}}</td>
                                        <td>{{$client->monthly_sim_charge}}</td>
                                        <td>{{$client->created_at}}</td>
                                        <td>
                                          @php

                                            $date1 = date('Y-m-d',strtotime($client->created_at));
                                            $date2 = date('Y-m-d');

                                            $ts1 = strtotime($date1);
                                            $ts2 = strtotime($date2);

                                            $year1 = date('Y', $ts1);
                                            $year2 = date('Y', $ts2);

                                            $month1 = date('m', $ts1);
                                            $month2 = date('m', $ts2);

                                            $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
                                            if($diff > 0)
                                            {
                                              $mainData=$client->monthly_sim_charge*intval($diff);
                                            }
                                            else
                                            { 
                                              $mainData=$client->monthly_sim_charge;
                                            }
                                          @endphp
                                          {{$mainData}}
                                        </td>
                                        <td>
                                        	@php

                                            $date1_check = date('Y-m-d',strtotime($client->created_at));
                                            $date2_check = date('Y-m-d',strtotime($client->expiry_date));

                                            $ts1_check = strtotime($date1_check);
                                            $ts2_check = strtotime($date2_check);

                                            $year1_check = date('Y', $ts1_check);
                                            $year2_check = date('Y', $ts2_check);

                                            $month1_check = date('m', $ts1_check);
                                            $month2_check = date('m', $ts2_check);

                                            $diff_check = (($year2_check - $year1_check) * 12) + ($month2_check - $month1_check);
                                            #dd($diff_check,$date1_check,$date2_check);

                                            if($diff_check > 0)
                                            {
                                              $mainData_check=$client->monthly_sim_charge*intval($diff_check);
                                            }
                                            else
                                            { 
                                              $mainData_check=$client->monthly_sim_charge;
                                            }
                                          @endphp
                                          {{intval($mainData_check)-intval($mainData)}}
                                        </td>
                                        <td>{{$client->sim_status}}</td>
                                        @if($client->sim_status == 'Active')
                                        	<td><a href="{{route('inactive.sim',$client->id)}}" class="btn btn-danger">Inactive</a></td>
                                        @else
                                        	<td>
                                            {{--<a href="{{route('active.sim',$client->id)}}" class="btn btn-success">Active</a>--}}
                                            -
                                          </td>
                                        @endif
                                    </tr>
                                @endforeach 
                            @endif
                      </tbody>
                    </table>