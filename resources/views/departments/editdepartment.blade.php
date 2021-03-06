@extends('layouts.dashboard')

@section('title')
Manage Departments - Vista
@endsection

@section('content')
<div class="app app-header-fixed ">
  

  <!-- header -->
  @include('includes.dashboard-header')
  <!-- / header -->


  <!-- aside -->
  @include('includes.mainmenu-left')
  <!-- / aside -->


  <!-- content -->
  <div id="content" class="app-content" role="main">
    <div class="app-content-body ">
      

<div class="hbox hbox-auto-xs hbox-auto-sm" ng-init="
    app.settings.asideFolded = false; 
    app.settings.asideDock = false;
  ">
  <!-- main -->
  <div class="col">
    <!-- main header -->
    <div class="bg-light lter b-b wrapper-md">
      <div class="row">
        <div class="col-sm-6 col-xs-12">
          <small class="text-muted">Editing Department:</small>
          <h1 class="m-n font-thin h3 text-black">{{$department->name}}</h1>
        </div>
      </div>
    </div>
    <!-- / main header -->

    <div class="wrapper-md">

      @if (count($errors) > 0)
      <div class="panel panel-default">
          <div class="alert alert-danger custom-text-danger-1 m-b-n">
            <ul class="m-b-n m-l-n p-l-lg">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
      </div>
      @endif

      <div class="panel panel-default">
        <div class="panel-body">
          <!-- template-department-edit -->
          <div class="template-department-edit">
            <form method="post" action="{{route('posteditdepartment')}}" enctype="multipart/form-data">
            <div class="row m-b-lg">
              <div class="col-sm-6 p-l-lg">
                <div class="form-group">
                  <label>Name</label>
                  <input 
                    class="form-control" 
                    type="text" 
                    name="name" 
                    placeholder="department name" 
                    value="{{(old('name')) ? old('name') : $department->name}}"
                    maxlength="20">
                </div>
                <div class="form-group" id="attachfileModule">                
                  <label>Attachment</label>
                  @if (count($department->attachment))
                    <div class="form-group" id="fileCurrent">                    
                      <a href="{{route('download_attachment',[$department->attachment->id])}}" class="text-brand-1 p-r-sm">
                        <i class="{{$department->attachment->classNames}}"></i> 
                        <u>{{$department->attachment->filename}}</u></a>                    
                      <button class="btn btn-brand1 btn-sm" id="btnUploadNew">
                        <i class="glyphicon glyphicon-upload"></i> Replace</button>
                      <button class="btn btn-danger btn-sm" id="btnDeleteCurrent">
                        <i class="glyphicon glyphicon-trash"></i> Delete</button>
                    </div>
                    <div class="form-group hide" id="fileDeletedBlock">
                      <span>&lt;delete current file&gt;</span>
                      <input type="hidden" name="deletecurrentfile" value="0">
                      <button class="btn btn-brand1 btn-sm">Undo</button>
                    </div>
                    <div class="form-group text-center hide" id="fileUploadBlock">
                      <input name="attachment" ui-jq="filestyle" ui-options="{icon:false, buttonName:'btn-brand1', buttonText:'Attach File'}" type="file">
                      <!--<input 
                        class="form-control m-b-sm" 
                        type="file" 
                        name="attachment" 
                        placeholder="attachment">-->
                      <button class="btn btn-brand1 btn-sm m-t-sm">Cancel</button>
                    </div>                  
                  @else
                    <div class="form-group">
                      <input name="attachment" ui-jq="filestyle" ui-options="{icon:false, buttonName:'btn-brand1', buttonText:'Attach File'}" type="file">
                      <!--<input 
                        class="form-control m-b-sm" 
                        type="file" 
                        name="attachment" 
                        placeholder="attachment">-->
                    </div>
                  @endif  
                </div>
              </div>
              <div class="col-sm-6" id="routingEmailModule">
                <div class="form-group">
                  <label class="col-sm-12">Routing Emails</label>
                </div>
                @if(!is_array(old('email')))
                  @if ($department->emails)
                    @foreach($department->emails as $email)
                      <div class="form-group emailBlocks">
                        <div class="col-sm-10 m-b-sm">
                          <input 
                            class="form-control" 
                            type="text" 
                            name="email[]" 
                            placeholder="email" 
                            value="{{$email}}">
                        </div>
                        <div class="col-sm-2 text-left">
                          <button class="btn btn-danger btn-danger2 btn-sm btnRemoveEmail" title="remove email">
                          <i class="glyphicon glyphicon-remove"></i></button>
                        </div>
                      </div>
                    @endforeach
                  @else
                    <div class="form-group emailBlocks">
                      <div class="col-sm-10 m-b-sm">
                        <input 
                          class="form-control" 
                          type="text" 
                          name="email[]" 
                          placeholder="email" 
                          value="">
                      </div>
                      <div class="col-sm-2 text-left">
                        <button class="btn btn-danger btn-danger2 btn-sm btnRemoveEmail" title="remove email">
                        <i class="glyphicon glyphicon-remove"></i></button>
                      </div>
                    </div>
                  @endif
                @else
                  @foreach(old('email') as $e)
                    <div class="form-group emailBlocks">
                      <div class="col-sm-10 m-b-sm">
                        <input 
                          class="form-control" 
                          type="text" 
                          name="email[]" 
                          placeholder="email" 
                          value="{{$e}}">
                      </div>
                      <div class="col-sm-2 text-left">
                        <button class="btn btn-danger btn-danger2 btn-sm btnRemoveEmail" title="remove email">
                        <i class="glyphicon glyphicon-remove"></i></button>
                      </div>
                    </div>
                  @endforeach
                @endif

                <div class="form-group" id="AddEmailBox">
                  <div class="col-sm-10">                                  
                    <button class="btn btn-brand1 btn-sm btn-block" id="btnAddEmail">
                      <i class="glyphicon glyphicon-plus"></i> Add Email</button>
                  </div>
                  <div class="col-sm-2">
                  </div>
                </div>
              </div>
            </div>

            <div class="m-b-lg">&nbsp;</div>

            <div id="emailBlockTemplate" class="hide">
              <div class="form-group emailBlocks">
                <div class="col-sm-10 m-b-sm">
                  <input class="form-control" type="text" name="temp_email[]" placeholder="email">
                </div>
                <div class="col-sm-2 text-left">
                  <button class="btn btn-danger btn-danger2 btn-sm btnRemoveEmail" title="remove email">
                  <i class="glyphicon glyphicon-remove"></i></button>
                </div>
              </div>
            </div>

            <div class="row text-center">
              <a href="{{route('departments')}}" class="btn btn-default btn-lg m-b-sm">Back</a> &nbsp; 
              <a href="" class="btn btn-default btn-lg m-b-sm">Reset</a> &nbsp; 
              <button class="btn btn-brand1 btn-lg m-b-sm">
                {{ csrf_field() }}
                <input type="hidden" name="department_id" value="{{$department->id}}">Save Changes</button>
            </div>
            </form>
          </div>
          <!-- template-department-edit -->
        </div>
      </div>
    </div>

  </div>
  <!-- / main -->
</div>


    </div>
  </div>
  <!-- /content -->

  <!-- footer -->
  @include('includes.dashboard-footer')
  <!-- / footer -->

  <script src="{{ URL::asset('js/department/action-department-edit-ui.js') }}"></script>

</div>
@endsection