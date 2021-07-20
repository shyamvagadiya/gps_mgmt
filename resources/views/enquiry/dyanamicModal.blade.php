<form id="updatePayment" method="post" action="{{route('update.payment')}}">
	@csrf		
	<div class="row">
	    <div class="col-md-12">
	    	<div class="form-group">
	    		<label>Payment Details</label>
	    		<input type="hidden" name="client_id" value="{{$client_id}}">
	    		<input type="text" name="payment_details" class="form-control">
	    	</div>
	    </div>
	</div>
</form>