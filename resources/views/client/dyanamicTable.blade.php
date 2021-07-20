<table class="table " id="myTable">
                      <thead>
                        <tr>
                          <th>Customer No</th>
                          <th>Company</th>
                          <th>Name</th>
                          <th>City</th>
                          <th>State</th>
                          <th>Mobile No</th>
                          <th>Alternate Mobile No</th>
                          <th>Created Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                            @if(count($clients) > 0)
                                @foreach($clients as $client)
                                    <tr>
                                        <td>{{$client->customer_no}}</td>
                                        <td>{{isset($client->company) ? $client->company : "-"}}</td>
                                        <td>{{$client->customer_name}}</td>
                                        <td>{{$client->city}}</td>
                                        <td>{{$client->state}}</td>
                                        <td>{{$client->mobile_no}}</td>
                                        <td>{{$client->alt_mobile_no}}</td>
                                        <td>{{$client->created_at}}</td>
                                        <td><a href="{{route('client.edit',$client->id)}}" class="btn btn-info">Edit</a></td>
                                    </tr>
                                @endforeach 
                            @endif
                      </tbody>
                    </table>