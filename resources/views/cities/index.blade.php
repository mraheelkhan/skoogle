@extends('layouts.mainlayout')
@section('content')
@if(session('success'))
    <script>
      $( document ).ready(function() {
        swal("Success", "{{session('success')}}", "success");
      });
      
    </script>
@endif
@if(session('failed'))
    <script>
      $( document ).ready(function() {
        swal("Failed", "{{session('failed')}}", "error");
      });
      
    </script>
@endif



<!-- Table start -->
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">City</h3>
              <span class="pull-right">
                <a href="#" class="btn btn-info addModelbtn" id="#addModel"><span class="fa fa-plus"></span> Add</a>
                
              </span>
            </div>
            <!-- /.box-header -->
             <div class="box-body">
              
                    <div class="alert alert-danger alert-styled-left" style="display: none;" id="delete">
                         <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                         <p class="delete"></p>
                    </div>

                    <div class="alert alert-success alert-styled-left" style="display: none;" id="success">
                         <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                         <p class="success"></p>
                    </div> 

              <table id="table_data" class="display table-striped responsive nowrap" style="width:100%">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>City Name</th>
                  <th>Created At</th>
                  <th>Country</th>
                  <th>Status</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>City Name</th>
                  <th>Created At</th>
                  <th>Country</th>
                  <th>Status</th>
                  <th>Action</th>
                  
                </tr>
                </tfoot>
              </table>
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
</div>
<!-- Table end -->

<!--Modal -->
  <div class="modal fade" id="addModel" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">City Form</h4>
        </div>
        <div class="modal-body">
          
          <form action="{{route('city.store')}}" class="form" id="add_form" method="POST">
               @csrf   
                <div class="modal-body" id="modalbody">
                       
                  <div class="form-group">
                    <label>City Name</label>
                      <input type="text" class="form-control" id="edit_city_name" name="city_name" placeholder="City Name" autocomplete="off" value="{{ old('city_name') }}" require >
                      <span class="text-red">
                                <strong class="city_name"></strong>
                      </span>
                  </div>
                       
                        <div class="form-group">
                            <label>Select Country</label>
                            <select type="text" name="country_id" id="edit_country_id" class="form-control" required="required">
                              <option value="" selected disabled>Select Country</option>
                              @foreach($countries as $country)
                                <option value="{{$country->id}}">{{$country->country_name}}</option>
                              @endforeach
                            </select>
                            <span class="text-red">
                              <strong class="country_id"></strong>
                            </span>
                        </div> 
                        <div class="form-group">
                            <label>Status</label>
                            <select type="text" name="status" id="edit_status" class="form-control" required="required">
                              <option value="Active">Active</option>
                              <option value="Disable">Disable</option>
                            </select>
                            <span class="text-red">
                              <strong class="status"></strong>
                            </span>
                        </div> 
                        <input type="hidden" name="edit_id" id="edit_id" value="">
                        
                </div>
              
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" id="add_form_btn" value="Save">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        </div>
      </div>
      </form>
    </div>
  </div>
<!--Update Modal end-->
      <!-- /.row -->  
@endsection

@push('scripts')
<script src="{{ asset('robo/app.js')}}" type="text/javascript"></script>
<script type="text/javascript">
  var dataTableRoute = "{{ route('city.fetch') }}";
  var editRoute = "{{route('city.edit')}}";
  var activeRoute = "{{route('city.active')}}";
  var disableRoute = "{{route('city.disable')}}";
  var token = '{{csrf_token()}}';
  var data = [
                { "data": "id" },
                { "data": "city_name" },
                { "data": "created_at" },
                { "data": "country_id" },
                { "data": "status" },
                { "data": "options" ,"orderable":false},
            ]
$( document ).ready(function() {

  InitTable();
});
</script> 
@endpush