@extends('layouts.main')

@section('title')
SIM Management
@endsection
@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <form id="searchData">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Company</label>
                                <input type="text" class="form-control company_id" name="company_id">
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
                                <label>Warranty Start</label>
                                <input type="date" name="warranty_start" class="form-control warranty_start">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Warranty End</label>
                                <input type="date" name="warranty_end" class="form-control warranty_end">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2" >
                            <div class="form-group">
                                <a href="javascript:;" class="btn btn-warning downloadReport" style="margin-top: 20px">Download Report</a>
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
                    <h4 class="card-title">SIM Management</h4>
                    </p>
                    <div class="dyanamicTable">
                        {{--@include('client.dyanamicTable')--}}
                    </div>
                  </div>
                </div>
        </div>
    </div>
</div>

<form method="get" action="{{route('download.report_sim')}}" id="formExport">
    <input type="hidden" name="company_id" class="company_id_export">

    <input type="hidden" name="created_at_start" class="created_at_start_export">
    <input type="hidden" name="expiry_date_start" class="expiry_date_start_export">
    <input type="hidden" name="warranty_start" class="warranty_start_export">

    <input type="hidden" name="created_at_end" class="created_at_end_export">
    <input type="hidden" name="expiry_date_end" class="expiry_date_end_export">
    <input type="hidden" name="warranty_end" class="warranty_end_export">

    <input type="hidden" name="city" class="city_export">
</form>

@endsection
@section('scripts')
<script type="text/javascript">
        
    getData();

    $(document).on('click','.downloadReport',function(){
        $('#formExport').trigger('submit');
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
            url: "{{route('sim.management')}}",
            data: formData,
            success: function(response){
              $('.dyanamicTable').html(response.html);
              $('#myTable').DataTable();
            }
        });
    }
</script>
@endsection