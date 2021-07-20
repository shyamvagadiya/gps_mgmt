@extends('layouts.main')

@section('title')
Complain Management
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
                                <input type="date" name="created_at_start" value="{{date('Y-m-d')}}" class="form-control created_at_start">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Created Date End</label>
                                <input type="date" name="created_at_end" value="{{date('Y-m-d')}}" class="form-control created_at_end">
                            </div>
                        </div>


                        <div class="col-md-2">
                            <div class="form-group">
                                <a href="javascript:;" class="btn btn-warning downloadReport" style="margin-top: 20px">Download Report</a>
                            </div>
                        </div>
                        <div class="col-md-2" style="margin-top: 20px">
                            <a href="{{route('create.complain')}}" class="btn btn-info">Add Complain</a>
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
                    <h4 class="card-title">Complain Management</h4>
                    </p>
                    <div class="dyanamicTable">
                    </div>
                  </div>
                </div>
        </div>
    </div>
</div>

<form method="get" action="{{route('download.report_complain')}}" id="formExport">
    <input type="hidden" name="company_id" class="company_id_export">
    <input type="hidden" name="city" class="city_export">
    <input type="hidden" name="created_at_start" class="created_at_start_export">
    <input type="hidden" name="created_at_end" class="created_at_end_export">
</form>

<div class="modal" id="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Remarks</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{route('update.remarks')}}">
          @csrf
          <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Remarks</label>
                        <input type="hidden" name="id" class="complain_id">
                        <input type="text" name="remarks" class="form-control">
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
      </form>
    </div>
  </div>
</div>

<div class="modal" id="modal_resolved" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Conclusion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{route('mark.resolved')}}">
          @csrf
          <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Conclusion</label>
                        <input type="hidden" name="id" class="complain_id_resolved">
                        <input type="text" name="conclusion" class="form-control">
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
      </form>
    </div>
  </div>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
    
    $(document).on('click','.openConclusion',function(){
        var id=$(this).data('id');
        $('.complain_id_resolved').val(id);
        $('#modal_resolved').modal('show');
    });

    $(document).on('click','.addRemarks',function(){
        var id=$(this).data('id');
        $('.complain_id').val(id);
        $('#modal').modal('show');
    })        

    $(document).ready( function () {
        $('#myTable').DataTable();
    } );

    getData();

    $(document).on('click','.downloadReport',function(){
        $('#formExport').trigger('submit');
    });

    $(document).on('focusout','.company_id',function(){
        $('.company_id_export').val($(this).val());
        getData();
    });
    
    $(document).on('focusout','.city',function(){
        $('.city_export').val($(this).val());
        getData();
    });

    $(document).on('change','.created_at_start',function(){
        $('.created_at_start_export').val($(this).val());
        getData();
    });
    $(document).on('change','.created_at_end',function(){
        $('.created_at_end_export').val($(this).val());
        getData();
    });
    
    function getData()
    {
        var formData=$('#searchData').serialize();
        $.ajax({
            url: "{{route('complain.management')}}",
            data: formData,
            success: function(response){
              $('.dyanamicTable').html(response.html);
                $('#myTable').DataTable();
            }
        });
    }
</script>
@endsection