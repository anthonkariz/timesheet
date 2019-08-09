@extends('layout.main')
@section('content')
<section class="content">
   <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Welcome to holdons Email Marketing </h3>
            </div>
            <!-- /.box-header -->
     
          </div>
          <!-- /.box -->       

           <p class="tex-center"> We use sparkpost and mailgun to send emails ,  we will set them up for you and design the email for you . Then;  </p>
           <ul>
             <li>Add as much  emails and the client you wish to send emails to on the "Add new client  section "  </li>
             <li>Select the emails added on the added section and schedule you email at what time you want them to go , this can be recuring  </li>
             <li>The dash will show you the client who have opened , rejected as well the ones landed in  spam folder </li>
             <li>Call us on <strong> 07599 04 8070 {{Auth::user()->mykey}}</strong>  We are happy to assist </li>
           </ul>
         

        </div>
     
        <!--/.col (right) -->
      </div>
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
         <?php var_dump(Auth::user()->id); ?>  
      @if (session('status_edit'))
    <div class="alert alert-success">
        {{ session('status_edit') }}
    </div>
@endif
                    
              <table class="table tbn ttable">
                <tr><th>Company </th> <td>{{$company->cname}}</td></tr>
                 <tr><th>Type </th> <td>{{$company->type}}</td></tr>
                 <tr><th>Email key </th> <td>{{$company->mykey}}</td></tr>
                 <tr><td colspan="2"> <a href="" class="btn btn-primary tbbat">Edit</a></td></tr>
              </table>
              <form class="form-horizontal" id="tform" action="/editDetails" method="post"  style="display: none;">
           {{ csrf_field() }}         
           <input type="hidden" name="id" value="{{$company->id}}">   
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Company Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="inputEmail3" value="{{$company->name}}" placeholder="Company Name">
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Type</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="type">
                      <option value="{{$company->type}}">{{$company->type}}</option>
                      <option value="security">Security</option>
                      <option value="care">Care</option>
                    </select>
                  </div>
                </div>                        
                      <div class="form-group">                
                <button type="submit" class="btn btn-info pull-right">Edit Details</button>
              </div>
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
          <form class="form-horizontal" name="addclient" method="post" action="/newclient" data-parsley-validate>
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

        Rejected bounced emails 
         

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
                opened Email 
                
             
               
              </div>
              <!-- /.box-body -->
           
              <!-- /.box-footer -->
            </form>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
     
        <!-- left column -->
      

      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Schedule your Emails </h3>
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
                      @foreach($campaign as $campaign)
                      <option value="{{$campaign->id}}"> {{$campaign->name}} </option>                    
                      @endforeach                     
                    </select>
                  </div>
                </div>  

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Start Date</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="start_date" id="start_date1"  placeholder="Start Date" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Start Time</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="start_time" id="start_time1" placeholder="Start Time" required>
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
              <tr><th>Check</th><th>Company Name  </th> <th> Email </th><th> Action </th></tr>
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