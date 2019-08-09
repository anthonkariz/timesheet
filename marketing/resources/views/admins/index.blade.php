@extends('layout.main')
@section('content')
<section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"> </h3>
            </div>
            <!-- /.box-header -->
     
          </div>
          <!-- /.box -->       
        <div class="box-body">    

      @if (session('status_edit'))
    <div class="alert alert-success">
        {{ session('status_edit') }}
    </div>
@endif   
        <form class="form-horizontal" action="/newcompany" method="post" data-parsley-validate>
           {{ csrf_field() }}
            
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Contact Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="inputEmail3" placeholder="Company Name" required="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Type</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="type">
                      <option value="">-- Select --</option>
                      <option value="security">Security</option>
                      <option value="care">Care</option>
                    </select>
                  </div>
                </div>
              
            
              <!-- /.box-body -->
              <div class="box-footer">
                
                <button type="submit" class="btn btn-info pull-right">Add Your Comapany</button>
              </div>
              <!-- /.box-footer -->
            </form>

  </div>
        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Add new client</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
          </div>
          <!-- /.box -->
         @if (session('status_client'))
    <div class="alert alert-success">
        {{ session('status_client') }}
    </div>
@endif
          <form class="form-horizontal" name="addclient" method="post" action="/adminnewclient" data-parsley-validate>
              <div class="box-body">
                 {{ csrf_field() }}
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Client Name</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="Client_name" name="Client_name" placeholder="Client name" required>
                  </div>
                </div>                 
                 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label" >Client email</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="Client_email" name="Client_email" placeholder="Client email" required>
                  </div>
                </div>       
                 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Type</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="type" required>
                      <option value="">-- Select --</option>
                      <option value="security">Security</option>
                      <option value="care">Care</option>
                    </select>
                  </div>
                </div>   
               
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                
                <button type="submit" class="btn btn-info pull-right">Add new client</button>
              </div>
              <!-- /.box-footer -->
            </form>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
   

    
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Bounced Emails</h3>
            </div>
            <!-- /.box-header -->
     
          </div>
          <!-- /.box -->       

           <table class="table">
             <tr><th>Company Name </th>  <th> User </th> <th>  Action </th></tr>
             @foreach($company as $company)
             <tr><td> {{$company->name}} </td><td> User</td><td> <a href="/viewcomapny/{{$company->id}}"> Viewe </a> <a href=""> Delete </a></td></tr>
             @endforeach
           </table>
         

        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Opened Emails</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
          </div>
          <!-- /.box -->
         
          <form class="form-horizontal">
              <div class="box-body">
                    <table class="table">
             <tr><th>Campaign  Name </th>  <th> W</th> <th>  Action </th></tr>
             @foreach($campagin as $company)
             <tr><td> {{$company->name}} </td><td> User</td><td> <a href="/admins/destroy/{{$company->id}}"> View </a> </td></tr>
             @endforeach
           </table>
                
             
               
              </div>
              <!-- /.box-body -->
           
              <!-- /.box-footer -->
            </form>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
         <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Create A Campaign</h3>
            </div>
            <!-- /.box-header -->
     
          </div>
          <!-- /.box -->     
            <div class="col-md-5 col-md-offset-3">
                @if (session('status_campaign'))
    <div class="alert alert-success">
        {{ session('status_campaign') }}
    </div>
@endif
           <form class="form-horizontal" action="/admins/campaign" method="post" data-parsley-validate>
           {{ csrf_field() }}
            
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Campaign Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="campaign_name" id="campaign_name" placeholder="Campaign Name" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Start Date</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="start_date" id="start_date"  placeholder="Start Date" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Start Time</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="start_time" id="start_time" placeholder="Start Time" required>
                  </div>
                </div>             
            
              <!-- /.box-body -->
              <div class="box-footer">
                
                <button type="submit" class="btn btn-info pull-right">Add Your campaign</button>
              </div>
              <!-- /.box-footer -->
            </form>         


        
         

        </div>
        <!--/.col (left) -->
        <!-- right column -->
        
        <!--/.col (right) -->
      </div>

      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Send Emails </h3>
            </div>
            <!-- /.box-header -->
     
          </div>
          <!-- /.box -->   
                      @if (session('status_emails'))
                      <div class="col-md-5 col-md-offset-3">
    <div class="alert alert-success">
        {{ session('status_emails') }}
    </div>
@endif
             <form class="form-horizontal" action="/createcampign" method="post" data-parsley-validate>
           {{ csrf_field() }}    

           <div class="campaign col-md-5 col-md-offset-3">
                 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Campaign</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="campagin" required>
                      <option value="">-- Select --</option>
                      @foreach($campagin as $campagin)
                      <option value="{{$campagin->id}}">{{str_replace("_"," ",$campagin->name)}}</option>                      
                      @endforeach
                    </select>
                  </div>
                </div>         
  
           </div>
          
           <div class="mails col-md-7 col-md-offset-3">
                                 @if (session('status_deemail'))
                      <div class="col-md-5 col-md-offset-3">
    <div class="alert alert-success">
        {{ session('status_deemail') }}
    </div>
@endif
           {{ csrf_field() }}  
            <table class="table table-striped">
              <tr><th></th><th>Company Name  </th> <th> Email </th><th> Action </th></tr>
              @foreach($clients as $client)
              <tr> <td> <input type="checkbox" name="emails[]" value="{{$client->id}}" data-parsley-mincheck="1" required><td>{{$client->name}}</td><td>{{$client->email}}</td><td><a href="/deleteemails/{{$client->id}}" class="bg-red">Delete</a></td>
              @endforeach
            </table>


             

           </div>
   
        @if($clients)
          <div class="form-group col-md-12">
            <center> <button type="submit" class="btn btn-primary">Create campaign</button></center>    
            
           </div>
            @endif 
      
        </form>  
        <!--/.col (left) -->
        <!-- right column -->
        
        <!--/.col (right) -->
      </div>
    </section>
    @endsection