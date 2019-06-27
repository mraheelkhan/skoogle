@extends('layouts.mainlayout')
@section('content')
@if(session('success'))
    <script>
      $( document ).ready(function() {
        swal("Success", "{{session('success')}}", "success");
      });
      
    </script>
@endif
<!-- some CSS styling changes and overrides -->
<style>
.kv-avatar .krajee-default.file-preview-frame,.kv-avatar .krajee-default.file-preview-frame:hover {
    margin: 0;
    padding: 0;
    border: none;
    box-shadow: none;
    text-align: center;
}
.kv-avatar {
    display: inline-block;
}
.kv-avatar .file-input {
    display: table-cell;
    width: 213px;
}
.kv-reqd {
    color: red;
    font-family: monospace;
    font-weight: normal;
}
</style>
<form class="form-horizontal" action="{{action('UserController@update', $id)}}" method="post" enctype="multipart/form-data" role="form">
@csrf
<input name="_method" type="hidden" value="PATCH">
    <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Staff/User {{$user->fname}} {{$user->lname}}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div id="kv-avatar-errors-1" class="center-block" style="width:800px;display:none"></div>
            <div class="box-body" >
            <div class="row">
              <div class="col-md-4 text-center">
                  <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="avatar-1" name="avatar-1" type="file">
                      </div>
                  </div>
                  <div class="kv-avatar-hint"><small>Select file < 1000 KB</small></div>
              </div> 
              <div class="col-md-8">
                <div class="form-group">
                  <label for="fname" class="col-sm-3 control-label">First Name</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" autocomplete="off" value="{{ $user->fname }}" require >
                    @if ($errors->has('fname'))
                          <span class="text-red">
                              <strong>{{ $errors->first('fname') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="lname" class="col-sm-3 control-label">Last Name</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value="{{ $user->lname }}" autocomplete="off" require>
                    @if ($errors->has('lname'))
                          <span class="text-red">
                              <strong>{{ $errors->first('lname') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>
                <div class="form-group">
                        <label for="salary" class="col-sm-3 control-label">Basic Salary</label>
    
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="salary" name="salary" placeholder="Basic Salary" value="{{ $user->staffdetails->salary }}" autocomplete="off" required>
                            @if ($errors->has('salary'))
                                <span class="text-red">
                                    <strong>{{ $errors->first('salary') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                <div class="form-group">
                        <label for="bloodgroup" class="col-sm-3 control-label">Blood Gruop</label>
    
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="bloodgroup" name="bloodgroup" placeholder="Blood Group" value="{{ $user->staffdetails->bloodgroup }}" autocomplete="off">
                            @if ($errors->has('bloodgroup'))
                                <span class="text-red">
                                    <strong>{{ $errors->first('bloodgroup') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dob" class="col-sm-3 control-label">Date of Birth</label>
                
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="dob" name="dob" placeholder="Date of Birth" value="{{ $user->staffdetails->dob ? $user->staffdetails->dob->format('Y-m-d')  : null }}" autocomplete="off" required>
                            @if ($errors->has('dob'))
                                <span class="text-red">
                                    <strong>{{ $errors->first('dob') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cnic" class="col-sm-3 control-label">CNIC No.</label>
                
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="cnic" name="cnic" value="{{ $user->staffdetails->cnic }}" autocomplete="off"  required data-inputmask="'mask': ['99999-9999999-9']" data-mask>
    
                            @if ($errors->has('cnic'))
                                <span class="text-red">
                                    <strong>{{ $errors->first('cnic') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


              </div>
              </div>

          </div>
</div>

<!-- address row begins -->
<div class="row">
        <div class="col-md-6">
        <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Present Address</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="cstreetaddress" class="col-sm-3 control-label">Street Address 1</label>
              
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="cstreetaddress" name="cstreetaddress" placeholder="Enter Street Address" value="{{ $user->staffdetails->cstreetaddress }}" autocomplete="off" require>
                                  @if ($errors->has('cstreetaddress'))
                                        <span class="text-red">
                                            <strong>{{ $errors->first('cstreetaddress') }}</strong>
                                        </span>
                                    @endif
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="cstreetaddress2" class="col-sm-3 control-label">Street Address 2</label>
              
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="cstreetaddress2" name="cstreetaddress2" placeholder="Enter Street Address 2" value="{{ $user->staffdetails->cstreetaddress2 }}" autocomplete="off">
                                  @if ($errors->has('cstreetaddress2'))
                                        <span class="text-red">
                                            <strong>{{ $errors->first('cstreetaddress2') }}</strong>
                                        </span>
                                    @endif
                                </div>
                              </div>
    
                              <div class="form-group">
                                <label for="ccity" class="col-sm-3 control-label">City</label>
              
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="ccity" name="ccity" placeholder="City" value="{{ $user->staffdetails->ccity }}" autocomplete="off" require>
                                  @if ($errors->has('ccity'))
                                        <span class="text-red">
                                            <strong>{{ $errors->first('ccity') }}</strong>
                                        </span>
                                    @endif
                                </div>
                              </div>
    
                        </div>
                    </div>
        
                </div>
        
        </div>
        </div>
        
        <div class="col-md-6">
                <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Permanent Address</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="pstreetaddress" class="col-sm-3 control-label">Street Address 1</label>
                  
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" id="pstreetaddress" name="pstreetaddress" placeholder="Enter Street Address" value="{{ $user->staffdetails->pstreetaddress }}" autocomplete="off" require>
                                      @if ($errors->has('pstreetaddress'))
                                            <span class="text-red">
                                                <strong>{{ $errors->first('pstreetaddress') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="pstreetaddress2" class="col-sm-3 control-label">Street Address 2</label>
                  
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" id="pstreetaddress2" name="pstreetaddress2" placeholder="Enter Street Address 2" value="{{ $user->staffdetails->pstreetaddress2 }}" autocomplete="off">
                                      @if ($errors->has('pstreetaddress2'))
                                            <span class="text-red">
                                                <strong>{{ $errors->first('pstreetaddress2') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                  </div>
        
                                  <div class="form-group">
                                    <label for="pcity" class="col-sm-3 control-label">City</label>
                  
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" id="pcity" name="pcity" placeholder="City" value="{{ $user->staffdetails->pcity }}" autocomplete="off" require>
                                      @if ($errors->has('pcity'))
                                            <span class="text-red">
                                                <strong>{{ $errors->first('pcity') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                  </div>
                
                            </div>
                            </div>
                
                        </div>
                
                </div>
                </div>
            </div>
    <!-- address now end-->
    
    <!-- Gaurdian Info row begins -->
    <div class="row">
            <div class="col-md-6">
            <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Gaurdian Info</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="gaurdianname" class="col-sm-3 control-label">Father/Gaurdian Name</label>
                  
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" id="gaurdianname" name="gaurdianname" placeholder="Gaurdian Name" value="{{ $user->staffdetails->gaurdianname }}" autocomplete="off" require>
                                      @if ($errors->has('gaurdianname'))
                                            <span class="text-red">
                                                <strong>{{ $errors->first('gaurdianname') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="gaurdianrelation" class="col-sm-3 control-label">Relationship</label>
                  
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" id="gaurdianrelation" name="gaurdianrelation" placeholder="Relationship with Gaurdian" value="{{ $user->staffdetails->gaurdianrelation }}" autocomplete="off">
                                      @if ($errors->has('gaurdianrelation'))
                                            <span class="text-red">
                                                <strong>{{ $errors->first('gaurdianrelation') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                  </div>
        
                                  <div class="form-group">
                                    <label for="gaurdiancontact" class="col-sm-3 control-label">Contact Number:</label>
                  
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" id="gaurdiancontact" name="gaurdiancontact" placeholder="Gaurdian Contact Number" value="{{ $user->staffdetails->gaurdiancontact }}" autocomplete="off" require>
                                      @if ($errors->has('gaurdiancontact'))
                                            <span class="text-red">
                                                <strong>{{ $errors->first('gaurdiancontact') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                  </div>
        
        
        
                            </div>
                        </div>
            
                    </div>
            
            </div>
            </div>
            
            <div class="col-md-6">
                    <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Personal Contact Info</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="landline" class="col-sm-3 control-label">Landline Number</label>
                      
                                        <div class="col-sm-9">
                                          <input type="text" class="form-control" id="landline" name="landline" placeholder="Landline Number" value="{{ $user->staffdetails->landline }}" autocomplete="off">
                                          @if ($errors->has('landline'))
                                                <span class="text-red">
                                                    <strong>{{ $errors->first('landline') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="phonenumber" class="col-sm-3 control-label">Mobile Number</label>
                        
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder="Mobile Number" value="{{ $user->staffdetails->phonenumber }}" autocomplete="off" require>
                                            @if ($errors->has('phonenumber'))
                                                <span class="text-red">
                                                    <strong>{{ $errors->first('phonenumber') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        </div>
            
                                      
                    
                                </div>
                                </div>
                    
                            </div>
                    
                    </div>
                    </div>
                </div>
    <!-- Gaurdian Info now end-->
    
    <!-- Regarding User row begins -->
    <div class="row">
        <div class="col-md-6">
        <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">User Department & Role</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="department_id" class="col-sm-3 control-label">Select Department</label>
              
                                <div class="col-sm-9">
                                    <select class="select2 form-control" id="department_id" name="department_id" required>
                                        <option value="" selected>None</option>    
                                      @foreach ($departments as $department)
                                      <option value="{{$department->id}}"  {{ ($department->id==$user->department_id) ? 'selected' : '' }}    >{{$department->deptname}}</option>    
                                      @endforeach
                                    </select>
                                  @if ($errors->has('department_id'))
                                        <span class="text-red">
                                            <strong>{{ $errors->first('department_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                              </div>
                              <div class="form-group">
                                    <label for="designation_id" class="col-sm-3 control-label">Select Designation</label>
                  
                                    <div class="col-sm-9">
                                      <select id="designation_id" name="designation_id" class="form-control select2" required>
                                              @if(count($designations) > 0)
                                                  <option value="" selected>None</option>
                                                  @foreach($designations as $designation)    
                                                      <option value="{{$designation->id}}"" {{ ($designation->id==$user->designation_id) ? 'selected' : '' }}>{{$designation->name}}</option>                    
                                                  @endforeach
                                              @else
                                                  <option value="">None</option>
                                              @endif
                                          </select>
                                            @if ($errors->has('designation_id'))
                                            <span class="text-red">
                                                <strong>{{ $errors->first('designation_id') }}</strong>
                                            </span>
                                            @endif
                                    </div>
                                  </div>
    
                                  <div class="form-group">
                                        <label for="role_id" class="col-sm-3 control-label">Select Role</label>
                      
                                        <div class="col-sm-9">
                                          <select id="role_id" name="role_id" class="form-control select2" required>
                                                  @if(count($roles) > 0)
                                                      <option value="" selected>None</option>
                                                      @foreach($roles as $role)    
                                                          <option value="{{$role->id}}" {{ ($role->id==$user->role_id) ? 'selected' : '' }}>{{$role->role_title}}</option>                    
                                                      @endforeach
                                                  @else
                                                      <option value="">None</option>
                                                  @endif
                                              </select>
                                                @if ($errors->has('role_id'))
                                                <span class="text-red">
                                                    <strong>{{ $errors->first('role_id') }}</strong>
                                                </span>
                                                @endif
                                        </div>
                                      </div>
    
    
    
                        </div>
                    </div>
        
                </div>
        
        </div>
        </div>
        
        <div class="col-md-6">
                <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">User Account Info</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                
                                <div class="form-group">
                                    <label for="email" class="col-sm-3 control-label">Email</label>
                    
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $user->email }}" autocomplete="off" require>
                                        @if ($errors->has('email'))
                                            <span class="text-red">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    </div>

                                    <div class="form-group">
                                    <label for="status" class="col-sm-3 control-label">Status</label>
                    
                                    <div class="col-sm-9">
                                        <select name="status" class="form-control">
                                            <option value="1" <?php echo ($user->status==1) ? "selected" : ""; ?>>Active</option>
                                            <option value="2" <?php echo ($user->status==2) ? "selected" : ""; ?>>Deactivate</option>
                                        </select>
                                    </div>
                                    </div>
                
                            </div>
                            </div>
                
                        </div>
                
                </div>
                </div>
            </div>
    <!-- Regarding User now end-->
    
    <!-- Other Info & Settings begins -->
    <div class="row">
            <div class="col-md-12">
            <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Settings & Other Info</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                <label for="passportno" class="col-sm-3 control-label">Passport No.</label>
                
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="passportno" name="passportno" placeholder="Passport No." value="{{ $user->staffdetails->passportno }}" autocomplete="off">
                                    @if ($errors->has('passportno'))
                                        <span class="text-red">
                                            <strong>{{ $errors->first('passportno') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-sm-3 control-label">Shift</label>
                    
                                    <div class="col-sm-9">
                                        <select id="shift" name="shift" class="form-control select2" required>
                                            <option value="day" {{ (old('shift')=="day") ? 'selected' : '' }}>Day</option>
                                            <option value="night" {{ (old('shift')=="night") ? 'selected' : '' }}>Night</option>
                                            <option value="evening" {{ (old('shift')=="evening") ? 'selected' : '' }}>Evening</option>
                                        </select>
                                        @if ($errors->has('shift'))
                                            <span class="text-red">
                                                <strong>{{ $errors->first('shift') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    </div>

                                    <div class="form-group">
                                    <label for="email" class="col-sm-3 control-label">Timing</label>
                    
                                    <div class="col-sm-9">
                                        <div class="row">
                                        <div class="col-sm-6">
                                                <input type="text" class="form-control" id="starttime" name="starttime" placeholder="Start Time" value="{{ $user->staffdetails->starttime }}" autocomplete="off" required>
                                                @if ($errors->has('starttime'))
                                                    <span class="text-red">
                                                        <strong>{{ $errors->first('starttime') }}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                        <div class="col-sm-6">
                                                <input type="text" class="form-control" id="endtime" name="endtime" placeholder="End Time" value="{{ $user->staffdetails->endtime }}" autocomplete="off" required>
                                                @if ($errors->has('endtime'))
                                                    <span class="text-red">
                                                        <strong>{{ $errors->first('endtime') }}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                        </div>
                                    </div>
                                    </div>

                                    @can('attendance-exception')
                                <div class="form-group">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9">
                                        <span class="button-checkbox">
                                        <button type="button" class="btn btn-default" data-color="primary"><i class="state-icon glyphicon glyphicon-unchecked"></i>&nbsp;Attendance Check</button>
                                        <input type="checkbox" class="hidden"  name="attendancecheck" {{($user->staffdetails->attendancecheck) ? 'checked' : '' }} value="1">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                  <label for="latecomming" class="col-sm-3 control-label">Late Comming Margin</label>
                
                                  <div class="col-sm-9">
                                        <input type="number" class="form-control" id="latecomming" name="latecomming" placeholder="Late Comming Margin" value="{{ $user->staffdetails->latecomming }}" autocomplete="off">
                                    @if ($errors->has('latecomming'))
                                          <span class="text-red">
                                              <strong>{{ $errors->first('latecomming') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                                </div>
                                <div class="form-group">
                                      <label for="latecomming" class="col-sm-3 control-label">Early Going Margin</label>
                    
                                      <div class="col-sm-9">
                                        <input type="number" class="form-control" id="earlygoing" name="earlygoing" placeholder="Early Going Margin in Mins" value="{{ $user->staffdetails->earlygoing }}" autocomplete="off">
                                        @if ($errors->has('earlygoing'))
                                              <span class="text-red">
                                                  <strong>{{ $errors->first('earlygoing') }}</strong>
                                              </span>
                                          @endif
                                      </div>
                                    </div>
                              @endcan
    
                                  <div class="form-group">
                                    <label for="attendanceid" class="col-sm-3 control-label">Attendance Id</label>
                  
                                    <div class="col-sm-9">
                                      <input type="number" class="form-control" id="attendanceid" name="attendanceid" placeholder="Attendance Id" value="{{ $user->staffdetails->attendanceid }}" autocomplete="off">
                                      @if ($errors->has('attendanceid'))
                                            <span class="text-red">
                                                <strong>{{ $errors->first('attendanceid') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                  </div>
    
                                  <div class="form-group">
                                    <label for="extension" class="col-sm-3 control-label">Extension No.</label>
                    
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="extension" name="extension" placeholder="Extension No. from Voice Server" value="{{ $user->staffdetails->extension }}" autocomplete="off">
                                        @if ($errors->has('extension'))
                                            <span class="text-red">
                                                <strong>{{ $errors->first('extension') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    </div>
    
                                    <div class="form-group">
                                    <label for="skypeid" class="col-sm-3 control-label">Skype Id</label>
                    
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="skypeid" name="skypeid" placeholder="Skype Id" value="{{ $user->staffdetails->skypeid }}" autocomplete="off">
                                        @if ($errors->has('skypeid'))
                                            <span class="text-red">
                                                <strong>{{ $errors->first('skypeid') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    </div>
    
                                    <div class="form-group">
                                    <label for="ccmsid" class="col-sm-3 control-label">CCMS Id</label>
                    
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="ccmsid" name="ccmsid" placeholder="CCMS Id" value="{{ $user->staffdetails->ccmsid }}" autocomplete="off">
                                        @if ($errors->has('ccmsid'))
                                            <span class="text-red">
                                                <strong>{{ $errors->first('ccmsid') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    </div>
        
                                  

                                  <div class="form-group">
                                    <label for="hrlead_id" class="col-sm-3 control-label">Applicant/HR Lead Id  </label>
                    
                                    <div class="col-sm-9">
                                        <select id="hrlead_id" name="hrlead_id" class="form-control select2">
                                            <option value="">None</option>
                                            @foreach($hrleads as $hrlead)
                                            <option value="{{$hrlead->id}}" {{ ($user->staffdetails->hrlead_id==$hrlead->id) ? 'selected' : '' }}>{{$hrlead->name}}</option>
                                            @endforeach
                                        </select>
        
                                        @if ($errors->has('hrlead_id'))
                                            <span class="text-red">
                                                <strong>{{ $errors->first('hrlead_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    </div>
        
                            <!-- checkboxes -->
                            <div class="form-group">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9">
                                    <span class="button-checkbox">
                                    <button type="button" class="btn btn-default" data-color="primary"><i class="state-icon glyphicon glyphicon-unchecked"></i>&nbsp;Do one to one appintments</button>
                                    <input type="checkbox" class="hidden"  name="isGoOnAppoints" value="1">
                                    </span>
                                </div>
                            </div>
    
                            
        
                            </div>
                        </div>
            
                    </div>
                    <div class="box-footer">
                            <a href="{!! url('/admins'); !!}" class="btn btn-default">Cancel</a>
                            <button type="submit" class="btn btn-info pull-right">Update Staff</button>
                          </div>
                          <!-- /.box-footer -->
            </div>
            </div>
            
    </div>
    <!-- Other Info & Settings end-->
    
    
    </form>
    
    
    @endsection
    
    
    @push('scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
    <style>
    .select2-container--classic .select2-selection--single .select2-selection__rendered{
        line-height: 35px;
        
    }
    .select2-container .select2-selection--single .select2-selection__rendered {
        padding-left: 8px;
    }
    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #3c8dbc;
        border-radius: 4px;
    }
    .select2 {
    width:100%!important;
    }
    
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
    <!-- InputMask -->
    <script src="../../plugins/input-mask/jquery.inputmask.js"></script>
    <script src="../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="../../plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <script>
    $(document).ready(function (e) {
        $(".select2").select2({
        theme: "classic"
        });
    
        $('[data-mask]').inputmask();
    });
    
    $(function () {
        $('#starttime, #endtime').datetimepicker({
            format: 'LT'
        });
        $('.button-checkbox').each(function () {
    
            // Settings
            var $widget = $(this),
                $button = $widget.find('button'),
                $checkbox = $widget.find('input:checkbox'),
                color = $button.data('color'),
                settings = {
                    on: {
                        icon: 'glyphicon glyphicon-check'
                    },
                    off: {
                        icon: 'glyphicon glyphicon-unchecked'
                    }
                };
    
            // Event Handlers
            $button.on('click', function () {
                $checkbox.prop('checked', !$checkbox.is(':checked'));
                $checkbox.triggerHandler('change');
                updateDisplay();
            });
            $checkbox.on('change', function () {
                updateDisplay();
            });
    
            // Actions
            function updateDisplay() {
                var isChecked = $checkbox.is(':checked');
    
                // Set the button's state
                $button.data('state', (isChecked) ? "on" : "off");
    
                // Set the button's icon
                $button.find('.state-icon')
                    .removeClass()
                    .addClass('state-icon ' + settings[$button.data('state')].icon);
    
                // Update the button's color
                if (isChecked) {
                    $button
                        .removeClass('btn-default')
                        .addClass('btn-' + color + ' active');
                }
                else {
                    $button
                        .removeClass('btn-' + color + ' active')
                        .addClass('btn-default');
                }
            }
    
            // Initialization
            function init() {
    
                updateDisplay();
    
                // Inject the icon if applicable
                if ($button.find('.state-icon').length == 0) {
                    $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
                }
            }
            init();
        });
    });
    </script>
    @endpush