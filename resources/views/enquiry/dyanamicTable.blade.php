<table class="table " id="myTable">
                      <thead>
                        <tr>
                          <th>Company</th>
                          <th>Customer Name</th>
                          <th>Mobile No</th>
                          <th>Email</th>
                          <th>Last Call Date</th>
                          <th>Comment</th>
                          <th>Created Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                            @if(count($enquires) > 0)
                                @foreach($enquires as $enquiry)
                                    <tr>
                                        <td>{{isset($enquiry->company) ? $enquiry->company : "-"}}</td>
                                        <td>{{$enquiry->customer_name}}</td>
                                        <td>{{$enquiry->mobile_no}}</td>
                                        <td>{{$enquiry->email}}</td>
                                        <td>{{$enquiry->last_call}}</td>
                                        <td>{{$enquiry->comment}}</td>
                                        <td>{{$enquiry->created_at}}</td>
                                        <td><a href="{{route('modify.comment',$enquiry->id)}}" class="btn btn-danger">Modify Comment</a></td>
                                    </tr>
                                @endforeach 
                            @endif
                      </tbody>
                    </table>