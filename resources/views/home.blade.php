@extends('layouts.main')

@section('title')
Home
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card bg-dark text-white " data-route="{{route('show.client')}}" style="background: linear-gradient(135deg, rgb(19, 241, 252) 0%, rgb(4, 112, 220) 100%);height: 150px;">
                <h1 class="" style="color: white;margin-top: 50px;" align="center"><a href="{{route('show.client')}}" style="color: white" target="_blank">Client</a></h1>
            </div>
        </div>

        <!-- <div class="col-md-4">
            <div class="card bg-dark text-white " data-route="{{route('add.client')}}" style="background: linear-gradient(135deg, rgb(98, 39, 116) 0%, rgb(197, 51, 100) 100%);height: 150px;">
                <h1 class="" style="color: white;margin-top: 50px;" align="center"><a href="{{route('add.client')}}" style="color: white" target="_blank">Client Addition</a></h1>
            </div>
        </div> -->

        <div class="col-md-4">
            <div class="card bg-dark text-white " data-route="{{route('show.vehicle')}}" style="background: linear-gradient(135deg, rgb(999, 55, 116) 0%, rgb(197, 51, 100) 100%);height: 150px;">
                <h1 class="" style="color: white;margin-top: 50px;" align="center"><a href="{{route('show.vehicle')}}" style="color: white" target="_blank">Vehicle</a></h1>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-dark text-white " data-route="{{route('show.enquiry')}}" style="background: linear-gradient(135deg, rgb(252, 223, 138) 0%, rgb(243, 131, 129) 100%);height: 150px;">
                <h1 class="" style="color: white;margin-top: 50px;" align="center"><a href="{{route('show.enquiry')}}" style="color: white" target="_blank">New Enqiury</a></h1>
            </div>
        </div>

    </div>
    <div class="row mt-3">
    	

        <div class="col-md-4">
            <div class="card bg-dark text-white " data-route="{{route('sim.management')}}" style="background: linear-gradient(135deg, rgb(24, 78, 104) 0%, rgb(87, 202, 133) 100%);height: 150px;">
                <h1 class="" style="color: white;margin-top: 50px;" align="center"><a href="{{route('sim.management')}}" style="color: white" target="_blank">SIM Mgmt</a></h1>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-dark text-white " data-route="{{route('complain.management')}}" style="background: linear-gradient(135deg, rgb(240, 47, 194) 0%, rgb(96, 148, 234) 100%);height: 150px;">
                <h1 class="" style="color: white;margin-top: 50px;" align="center"><a href="{{route('complain.management')}}" style="color: white" target="_blank">Complain Mgmt</a></h1>
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