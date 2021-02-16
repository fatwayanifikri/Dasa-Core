@extends("crudbooster::admin_template")
@section("content")
         <!-- SELECT2 EXAMPLE -->
 <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Roles</h3>


        </div>
        <!-- /.box-header -->
        <div class="box-body">
         <form method="post" action="{{CRUDBooster::mainpath('edit-save/'.$row->id)}}">
         <input type="hidden" name="_token" value="{{csrf_token()}}">
              <div class="form-group">
                <label for="nama">Head Roles</label>
                   <option value="" ="">** Select Head Roles</option>
                  
                </select>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>Level Roles</label>
               
                </select>
              </div>
              <div class="form-group">
                <label>Roles Name</label>
                   
              <!-- /.form-group -->
              </div>
            <div class="panel-footer">
          	<input type="submit" name="submit" class="btn btn-primary" value="Save">
          </div> <!-- /.col -->
          </form>  
        </div>
             <!-- /.form-group -->
            </div>
            <!-- /.col -->
          		</div>
          <!-- /.row -->
        		</div>
				
</div>


@endsection