@extends('./layouts/adminview/master')
@section('content')
<br>

<div class="row">
	<div class="card-tools"> 
       <div class="row">
        <div class="col-md-8">
            <form class="bs-example bs-example-form" role="form"> 
                <div class="row">
                   <div class="col-lg-10"> 
                        <div class="input-group"> 
                            <input type="text" class="form-control" placeholder="Search"> 
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search" class="btn btn-flat form-control "><strong><i class="fa fa-search"></i></strong>
                                </button>
                             </span>
                        </div><!-- /input-group --> 
                    </div>
                </div>
            </form>
        </div>
        <div class="adduser col-md-4">
            <button class="create-modal btn btn-success pull-right" 
                 name="create_admin_modal" id="create_admin_modal">Add New   <i class="fa fa-user-plus fa-fw"></i></button>
        </div>
        		
      </div>
     </div>       
		<!-- form add new users admin-->
<!---add modal-->
		<div class="create_modal_form modal fade" id="create_modal_form" role="dialog"         >
			    <div class="modal-dialog">
			      <div class="modal-content">
			          <div class="modal-header">
			          	<div class="form-group">
				          	<h3 class="modal-title-admin  text-center  col-xs-11"></h3>

				            <button class="close" type="button" data-dismiss="modal" aria-label="close" class="btn btn-danger col-xs-1">
				              <span aria-hidden="true">&times;</span>
				            </button>
				         </div>
			          </div>

			          <div class="modal-body  modal-body-admin">
			              <form method="post" accept="multipart/form-data" action="" id="upload_form" name="upload_form">
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group row name">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" value="{{ old('name') }}" required autofocus>

                                    <span class="name-error invalid-feedback" role="alert">
                                      
                                    </span>
                               
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                            <div class="col-md-6">
                              <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" id="phone" value="{{ old('phone') }}" required autofocus>

                               
                              <span class="phone-error invalid-feedback" role="alert">
                               
                                    </span>
                               
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="adress" class="col-md-4 col-form-label text-md-right">{{ __('Adress') }}</label>

                            <div class="col-md-6">
                              <input id="adress" type="text" class="form-control{{ $errors->has('adress') ? ' is-invalid' : '' }}" name="adress" id="adress" value="{{ old('adress')}}">
                                    <span class="adress-error invalid-feedback" role="alert">
                                     
                                    </span>
                              
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" value="{{ old('email') }}" required>

                                    <span class="email-error invalid-feedback " role="alert">
                                    
                                    </span>
                             
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                            <div class="col-md-6">
                                <div class="input-group"> 
                                  <input type="file" name="file" id="file" accept="image/*" class="hidden">
                                    <input type="text" class="form-control" placeholder="ajouter image" id="image" name="image" disabled=""> 
                                    <span class="input-group-btn">
                                        <a  name="add_image" id="add_image" class="btn btn-default form-control " 
                                        onclick="document.getElementById('file').click();return false;"><strong><i class="glyphicon glyphicon-picture "></i></strong>
                                        </a>
                                    </span>
                                  </div>
                              
                            </div>
                        </div>
                        <!-- script get image name-->
                        <script type="text/javascript">
                   $(document).ready(function(){
                          $('input[type="file"]').change(function(e){
                              var fileName = e.target.files[0].name;
                              $('#image').val(fileName);
                              
                      });
                        });
                  </script>

                        <div class="form-group row form-password">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                 <div class="input-group"> 
                                  
                                    <input type="password" class="form-control" placeholder="enter password"  id="password" name="password" > 
                                    <span class="input-group-btn">
                                        <a  name="add_image" id="add_image" class="btn btn-default form-control " 
                                        onclick="action_password()"><strong><i class="fa fa-eye-slash" id="eye" style="color: red;"></i></strong>
                                        </a>
                                    </span>
                                  </div>

                               <script type="text/javascript">
                                function action_password()
                                {
                                     var pwd= document.getElementById('password');
                                      var pwd_cofirm= document.getElementById('password_confirmation');
                                     var eye= document.getElementById('eye');
                                     if(pwd.type=='password'){
                                          pwd.type='text';
                                          pwd_cofirm.type='text';
                                          $('#eye').removeClass('fa fa-eye-slash');
                                          $('#eye').addClass('fa fa-eye');
                                          $('#eye').css('color','green');
                                       }
                                      else
                                      {
                                        pwd.type='password';
                                        pwd_cofirm.type='password';
                                        $('#eye').removeClass('fa fa-eye');
                                        $('#eye').addClass('fa fa-eye-slash');
                                        $('#eye').css('color','red');
                                      }

                                     
                                } 

                                  </script>
                                    <span class="password-error invalid-feedback" role="alert">
                                      
                                    </span>
                              
                            </div>
                        </div>

                        <div class="form-group row form-password">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">

                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Permission') }}</label>

                            <div class="col-md-6">
                               <select id="permission" type="select" class="form-control" name="permission" value="{{ old('permission') }}">
                                	<option>admin</option>
                                	<option>author</option>
                                </select>
                            </div>
                        </div>

                     
                       
                    </form>
			             
			          </div>
                      <div class="modal-footer">
                         <div class="form-group action-modal">
                            <button  type="button" class="btn btn-danger pull-left" data-dismiss="modal">close</button>
                            
                                
                              
                           </div>
                            
                      </div>

			            
			    	</div>
          	</div>
          </div>
          <!-- delete user modal-->
<style type="text/css">
            .modal-dialog{
    overflow-y: initial !important
    }
     .modal-body-admin{
    height: 300px;
    overflow-y: auto;
}
          </style>
          <div class="modal fade" id="delete_modal_form" role="dialog"         >
                <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                        <div class="form-group">
                            <h3 class="modal-title  text-center  col-xs-11"> delete admin</h3>

                            <button class="close" type="button" data-dismiss="modal" aria-label="close" class="btn btn-danger col-xs-1">
                              <span aria-hidden="true">&times;</span>
                            </button>
                         </div>
                      </div>
                      <div class="modal-body">
                        @csrf
                          <h3 class="text-center">are you sure want to delete <span class="name-user"></span></h3>
                          <span class="id hidden" ></span>
                      </div>
                     <div class="modal-footer">
                        <button  type="button" class="btn btn-danger pull-left" data-dismiss="modal">close</button>
                            
                                <button type="submit" class="btn btn-primary pull-right delete" name="btn_delete" id="btn_delete" onclick="deleteUser()">
                                    <i class="glyphicon glyphicon-trash"> </i>delete
                                </button>
                              
                            </div> 
                     </div>
                  </div>
              </div>
          
  		

  
   
   <script type="text/javascript">
  $(document).on('click','.create-modal',function(){
    if((".action-button").length)
      $(".action-button").remove();
    if(('.id-user-edit').length)
          $('.id-user-edit').remove();
         $('.invalid-feedback').text('');
              $('#name').val("");
              $('#phone').val("");
              $('#adress').val("");
              $('#email').val("");
              $('#image').val("");
              $('#password').val("");
              $('#password_confirmation').val("");
              $('#permission').val("admin");
    $('.create_modal_form').modal('show');
    $(".invalid-feedback").text('');
    $('.form-password').removeClass('hidden');
    $('.modal-title-admin').text("Create  Admin");
    $('.action-modal').append('<button type="submit"'+
           ' class="btn btn-primary pull-right action-button" name="btnadd" id="bntadd" onclick="addUser()">'+
                                        'Add New<i class="fa fa-user-plus"></i> </button>');

  });
  
  function addUser(){
    var my_form=document.getElementById('upload_form');
    var v=new FormData(my_form);
    for(var value of v.keys())
      console.log(value);
    $.ajax({
      type:'POST',
      url:"{{route('admin/users/addadmin')}}",
      dataType:'json',
      contentType: false,
      processData: false,
      data:v,
      
        

      
      success: function(data){
        
       if((data.errors)){
        console.log(data);
       
         
           if(data.errors.hasOwnProperty("name"))
            $('.name-error').html("<strong class='text-danger'>"
              +data.errors.name[0]+"</strong>");

           if(data.errors.hasOwnProperty("phone"))
            $('.phone-error').html("<strong class='text-danger'>"
              +data.errors.phone[0]+"</strong>");
           if(data.errors.hasOwnProperty("adress"))
            $('.adress-error').html("<strong class='text-danger'>"+data.errors.adress[0]+"</strong>");
          if(data.errors.hasOwnProperty("email"))
           $('.email-error').html("<strong class='text-danger'>"+data.errors.email[0]+"</strong>");

          if(data.errors.hasOwnProperty("image"))
            $('.image-error').html("<strong class='text-danger'>"+data.errors.image[0]+"</strong>");

          if(data.errors.hasOwnProperty("password"))
            $('.password-error').html("<strong class='text-danger'>"+data.errors.password[0]+"</strong>");
           
        }
        else{
          
            $('#table').append("<tr class='user"+data.id+" bg-info'><td>"+
                    data.id+
                "</td><td>"+
                    data.name+
               " </td><td>"+
                    data.email+
               " </td><td>"+
                    data.phone+
               " </td><td>"+
                    data.adress+
                " </td><td>"+
                data.permission+    
              " </td> <td><a  class='edit-modal btn btn-success'   data-id='" +(data.id)+ "'  data-name='"
               +data.name+
               "'   data-phone='"
               +data.phone+
               "'   data-adress='"
               +data.adress+
               " '  data-email='"
               +data.email+
               "'   data-image='"
               +data.image
               +"'  data-permission='"+
               data.permission
               +"'><span class='fa fa-edit'></span></a> </td>"
               +
               "<td><a  class='delete-modal btn btn-danger pull-right'  data-id='"+data.id+"'  data-name='"+data.name+"'><span class='fa fa-trash'"+"></a> </td> </tr>");
              $('.invalid-feedback').text('');
              $('#name').val("");
              $('#phone').val("");
              $('#adress').val("");
              $('#email').val("");
              $('#image').val("");
              $('#password').val("");
              $('#password_confirmation').val("");
              $('#permission').val("admin");
                  

        }
      },
       
    });
   
  }
   </script>
   <!-- script delete user -->
   <script type="text/javascript">
       $(document).on('click','.delete-modal',function(){
         $('#delete_modal_form').modal('show');
         $('.modal-body').css('color','red');
         $('.name-user').html($(this).data('name'));
         $('.id').text($(this).data('id'));

       } );

function deleteUser(){

   $.ajax({
     type:'post',
     url:"{{ route('admin/users/delete')}}",
     data:{
        '_token':"{{ csrf_token() }}",
        'id': parseInt($('.id').text()),
     },
     success: function(data){
        $('.user'+$('.id').text()).remove();
        $('#delete_modal_form').modal('hide');

     },
   });

}


   </script>
  <!-- Script edit admin-->
  <script type="text/javascript">
    $(document).on('click', '.edit-modal', function(){
      if(('.id-user-edit').length)
          $('.id-user-edit').remove();
      if(('.action-button').length)
        $('.action-button').remove();
      $('.create_modal_form').modal('show');
      $('.form-password').addClass('hidden');
      $('<div class="form-group row id-user-edit">'+
      '<label for="id" class="col-md-4 col-form-label text-md-right">id</label> <div class="col-md-6">'+
                             ' <input  type="text" class="form-control" name="id_user_edit" id="id_user_edit" disabled> </div> </div>').insertBefore('.name');
      $('.action-modal').append('<button type="submit"'+
           ' class="btn btn-primary pull-right action-button" name="btnadd" id="bntadd" onclick="editUser()">'+
                                        'Edit User<i class="fa fa-user-plus"></i> </button>');
      $('#id_user_edit').val($(this).data('id'));
      $('#name').val($(this).data('name'));
      $('.modal-title-admin').text("Edit  Admin");
      $('#phone').val($(this).data('phone'));
      $('#adress').val($(this).data('adress'));
      $('#email').val($(this).data('email'));
      $('#permission').val($(this).data('permission'));
      $('#image').val($(this).data('image'));
      
      



     });

    function editUser(){
       var my_form=document.getElementById('upload_form');
      var v=new FormData(my_form);
      v.append('id',$('#id_user_edit').val());
      for(var value of v.values())
        console.log(value);
    $.ajax({
      type:'POST',
      url:"{{route('admin/users/editUser')}}",
      dataType:'json',
      contentType: false,
      processData: false,
      data:v,
      success: function(data){
        
       if((data.errors)){
        console.log(data);
       
          
           if(data.errors.hasOwnProperty("name"))
            $('.name-error').html("<strong class='text-danger'>"
              +data.errors.name[0]+"</strong>");

           if(data.errors.hasOwnProperty("phone"))
            $('.phone-error').html("<strong class='text-danger'>"
              +data.errors.phone[0]+"</strong>");
           if(data.errors.hasOwnProperty("adress"))
            $('.adress-error').html("<strong class='text-danger'>"+data.errors.adress[0]+"</strong>");
          if(data.errors.hasOwnProperty("email"))
           $('.email-error').html("<strong class='text-danger'>"+data.errors.email[0]+"</strong>");

          if(data.errors.hasOwnProperty("image"))
            $('.image-error').html("<strong class='text-danger'>"+data.errors.image[0]+"</strong>");

           
        }
        else{
          
            $('.user'+data.id).replaceWith("<tr class='user"+data.id+" bg-info'><td>"+
                    data.id+
                "</td><td>"+
                    data.name+
               " </td><td>"+
                    data.email+
               " </td><td>"+
                    data.phone+
               " </td><td>"+
                    data.adress+
                " </td><td>"+
                data.permission+    
              " </td> <td><a  class='edit-modal btn btn-success'   data-id='" +(data.id)+ "'  data-name='"
               +data.name+
               "'   data-phone='"
               +data.phone+
               "'   data-adress='"
               +data.adress+
               " '  data-email='"
               +data.email+
               "'   data-image='"
               +data.image
               +"'  data-permission='"+
               data.permission
               +"'><span class='fa fa-edit'></span></a> </td>"
               +
               "<td><a  class='delete-modal btn btn-danger pull-right'  data-id='"+data.id+"'  data-name='"+data.name+"'><span class='fa fa-trash'"+"> </td> </tr>");
            $('.invalid-feedback').text();
           $('.create_modal_form').modal('hide'); 
    }
  }
  });
  }
  </script>
		<hr>
		

		<div class="table-title text-center"> <h1>List Of Users </h1></div>
        @if(count($admins)>0)
      <div class="table-responsive">
		<table class="table table-bordered " id="table" name="table">
			<thead class="thead-light">
				<th>Id </th>
				<th>Name</th>
				<th>Email</th>
				<th>Phone</th>
                <th>Adress</th>
				<th>Permission</th>
				<th class="text-center" colspan="2">Edit</th>
			</thead>
            @foreach($admins as $admin)
			<tr class="user{{$admin->id}}  bg-info" >
				<td>
					{{$admin->id}}
				</td>
				<td>
					{{$admin->name}}
				</td>
				<td>
					{{$admin->email}}
				</td>
				<td>
					{{$admin->phone}}
				</td>
                <td>
                    {{$admin->adress}}
                </td>
				<td>
					{{$admin->permission}}
				</td>
				<td >
					<a  class="edit-modal btn btn-success" data-id="{{$admin->id}}" data-name="{{$admin->name}}" data-phone="{{$admin->phone}}" data-adress="{{$admin->adress}}" data-email="{{$admin->email}}" data-image="{{$admin->image}}" data-permission="{{$admin->permission}}"><span class="fa fa-edit"></span></a> </td>
                <td>
					<a  class="delete-modal btn btn-danger pull-right" data-id="{{$admin->id}}" data-name="{{$admin->name}}"><span class="fa fa-trash">
						
					</span></a>
				</td>
			</tr>
            @endforeach
		</table>
                <div class=" col-xs-12 text-center"> <h3>{{$admins->links()}}
                 </h3> 
                </div>
      </div>
                
        @endif
<?php echo ob_get_clean();?>
</div>
@endsection