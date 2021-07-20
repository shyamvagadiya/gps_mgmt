	
<div class="row">
    <div class="col-md-6">
    	<div class="form-group">
    		<label><strong>Customer No : {{$client->client->customer_no}}</strong></label>
    		<input type="hidden" name="client_id" value="{{$client->id}}">
    	</div>
    </div>
    <div class="col-md-6">
    	<div class="form-group">
    		<label><strong>Company : {{isset($client->client->company) ? $client->client->company : "-"}}</strong></label>
    	</div>
    </div>
</div>

<div class="row">
    
</div>

<div class="row">
    <div class="col-md-6">
    	<div class="form-group">
    		<label><strong>Customer Name : {{$client->client->customer_name}}</strong></label>
    	</div>
    </div>
    <div class="col-md-6">
    	<div class="form-group">
    		<label><strong>Address : {{$client->client->address}}</strong></label>
    	</div>
    </div>
</div>



<div class="row">
    <div class="col-md-6">
    	<div class="form-group">
    		<label><strong>City : {{$client->client->city}}</strong></label>
    	</div>
    </div>
    <div class="col-md-6">
    	<div class="form-group">
    		<label><strong>State : {{$client->client->state}}</strong></label>
    	</div>
    </div>
</div>

<div class="row">
    
</div>

<div class="row">
    <div class="col-md-6">
    	<div class="form-group">
    		<label><strong>Mobile No : {{$client->client->mobile_no}}</strong></label>
    	</div>
    </div>
    <div class="col-md-6">
    	<div class="form-group">
    		<label><strong>Vehicle No : {{$client->vehicle_no}}</strong></label>
    	</div>
    </div>
</div>

<div class="row">
    
</div>

<div class="row">
    <div class="col-md-6">
    	<div class="form-group">
    		<label><strong>Device Type : {{$client->device_type}}</strong></label>
    	</div>
    </div>
    <div class="col-md-6">
    	<div class="form-group">
    		<label><strong>IMEI No : {{$client->imei_no}}</strong></label>
    	</div>
    </div>
</div>

<div class="row">
    
</div>

<div class="row">
    <div class="col-md-6">
    	<div class="form-group">
    		<label><strong>SIM No : {{$client->sim_no}}</strong></label>
    	</div>
    </div>
    <div class="col-md-6">
    	<div class="form-group">
    		<label><strong>SIM Operator : {{$client->sim_operator}}</strong></label>
    	</div>
    </div>
</div>

<div class="row">
    
</div>

<div class="row">
    <div class="col-md-6">
    	<div class="form-group">
    		<label><strong>Complain</strong></label>
    		<textarea name="complain" class="form-control" required="" placeholder="Enter Complain" cols="4" rows="4"></textarea>
    	</div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label><strong>Technician</strong></label>
            <input name="technician" type="text" class="form-control" required="">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
    	<div class="form-group">
    		<button class="btn btn-info" type="submit">Submit</button>
   		</div>
   	</div>
</div>


