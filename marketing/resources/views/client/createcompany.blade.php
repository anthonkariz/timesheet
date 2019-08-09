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

         <form class="form-horizontal" action="/newcompany" method="post">
           {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Contact Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="inputEmail3" placeholder="Company Name">
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
              
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                
                <button type="submit" class="btn btn-info pull-right">Add new client</button>
              </div>
              <!-- /.box-footer -->
            </form>
         

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
         
         
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->  
      
    
    </section>
    @endsection