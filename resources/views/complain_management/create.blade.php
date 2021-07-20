@extends('layouts.main')

@section('title')
Complain Addition
@endsection

@section('content')
<div class="container">
    
    <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Complain Addition Form</h4>
                    <form class="form-sample" method="post" action="{{route('submit.complain')}}">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Vehicle No</label>
                            <div class="col-sm-9">
                              <input type="text" name="vehicle_no" class="form-control vehicle_no">
                            </div>
                          </div>
                        </div>
                        @csrf
                      </div>  
                        <div class="dyanamicDiv">
                          
                        </div>
                    </form>
                  </div>
                </div>
              </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $('.vehicle_no').autocomplete({
          serviceUrl: '{{route("load_data")}}',
          onSelect: function (suggestion) {
              $(this).val(suggestion.value);
              //alert(suggestion.load_data);
              $.ajax({
                  url: "{{route('get_client.data')}}",
                  data: "client_id="+suggestion.data,
                  success: function(response){
                    $('.dyanamicDiv').html(response.html);
                  }
              });
          }
      });
</script>
@endsection