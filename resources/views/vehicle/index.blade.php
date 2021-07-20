@extends('layouts.main')

@section('title')
Vehicle List
@endsection
@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <form id="searchData" method="post" enctype="multipart/form-data" action="{{route('import.data')}}">
                @csrf
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Company</label>
                                <input type="text" name="company_id" class="form-control company_id">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" name="city" class="form-control city">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Created Date Start</label>
                                <input type="date" name="created_at_start" class="form-control created_at_start">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Created Date End</label>
                                <input type="date" name="created_at_end" class="form-control created_at_end">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Expiry Date Start</label>
                                <input type="date" name="expiry_date_start" class="form-control expiry_date_start">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Expiry Date End</label>
                                <input type="date" name="expiry_date_end" class="form-control expiry_date_end">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Warranty</label>
                                <input type="date" name="warranty_start" class="form-control warranty_start">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Warranty</label>
                                <input type="date" name="warranty_end" class="form-control warranty_end">
                            </div>
                        </div>

                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <a href="{{route('add.vehicle')}}" class="btn btn-danger" style="margin-top: 20px">Add Vehicle</a>
                            </div>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <a href="javascript:;" class="btn btn-warning downloadReport" style="margin-top: 20px">Download Report</a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <a href="{{route('download_blank_excel')}}" class="btn btn-info" style="margin-top: 20px">Download Blank Excel</a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>File To Import</label>
                                <input type="file" name="file" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <button class="btn btn-success" style="margin-top: 22px" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Vehicle List</h4>
                    </p>
                    <div class="dyanamicTable">
                        
                    </div>
                  </div>
                </div>
        </div>
    </div>
</div>

<div class="modal" id="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Payment Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body dyanamicRow">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary submitBtn">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<form method="get" action="{{route('download.report')}}" id="formExport">
    <input type="hidden" name="company_id" class="company_id_export">
    <input type="hidden" name="city" class="city_export">

    <input type="hidden" name="created_at_start" class="created_at_start_export">
    <input type="hidden" name="expiry_date_start" class="expiry_date_start_export">
    <input type="hidden" name="warranty_start" class="warranty_start_export">

    <input type="hidden" name="created_at_end" class="created_at_end_export">
    <input type="hidden" name="expiry_date_end" class="expiry_date_end_export">
    <input type="hidden" name="warranty_end" class="warranty_end_export">
</form>

@endsection
@section('scripts')
<script type="text/javascript">
        
    getData();

    
    $(document).on('click','.downloadReport',function(){
        $('#formExport').trigger('submit');
    });

    $(document).on('click','.submitBtn',function(){
        $('#updatePayment').trigger('submit');
    });

    $(document).on('focusout','.company_id',function(){
        $('.company_id_export').val($(this).val());
        getData();
    });
    $(document).on('change','.created_at_start',function(){
        $('.created_at_start_export').val($(this).val());
        getData();
    });
    $(document).on('change','.expiry_date_start',function(){
        $('.expiry_date_start_export').val($(this).val());
        getData();
    });
    $(document).on('change','.warranty_start',function(){
        $('.warranty_start_export').val($(this).val());
        getData();
    });


    $(document).on('change','.created_at_end',function(){
        $('.created_at_end_export').val($(this).val());
        getData();
    });
    $(document).on('change','.expiry_date_end',function(){
        $('.expiry_date_end_export').val($(this).val());
        getData();
    });
    $(document).on('change','.warranty_end',function(){
        $('.warranty_end_export').val($(this).val());
        getData();
    });

    $(document).on('focusout','.city',function(){
        $('.city_export').val($(this).val());
        getData();
    });
    
    function getData()
    {
        var formData=$('#searchData').serialize();
        $.ajax({
            url: "{{route('show.vehicle')}}",
            data: formData,
            success: function(response){
              $('.dyanamicTable').html(response.html);
              $('#myTable').DataTable();
            }
        });
    }

    $(document).on('click','.updatePayment',function(){
        var client_id=$(this).data('id');
        $.ajax({
            url: "{{route('update_payment.modal')}}",
            data: "client_id="+client_id,
            success: function(response){
              $('#modal').modal("show");
              $('.dyanamicRow').html(response.html);
            }
        });
    })
</script>
@endsection