 @extends('/layouts/adminview/master')
 @section('content')
 <br>
 <div class="container-fluid">
 	<div ><button class="btn btn-success pull-right create-restaurant">Add New</button></div><br>
 	<!---add modal-->
		<div class="create_modal_form-restaurant modal fade"         id="create_modal_form" role="dialog"         >
			    <div class="modal-dialog">
			      <div class="modal-content">
				          <div class="modal-header">
				          	<div class="form-group">
					          	<h3 class="modal-title-res text-center  col-xs-11"></h3>

					            <button class="close" type="button" data-dismiss="modal" aria-label="close" class="btn btn-danger col-xs-1">
					              <span aria-hidden="true">&times;</span>
					            </button>
					         </div>
				          </div>

			          <div class="modal-body  modal-body-restaurant">
			            <form method="POST" action="" class="form-horizontal form-add-restaurant">
			             	 @csrf
							 <div class="form-group row form-label">
		                            <label for="label" class="col-md-4 col-form-label text-md-right">{{ __('Label') }}</label>

		                            <div class="col-md-8">
		                                <input id="label" type="text" class="form-control" name="label" value="" required autofocus>

		                 
		                                    <span class="invalid-feedback label-error" role="alert">
		                                        
		                                    </span>
		                              
		                            </div>
		                        </div>
		                         <div class="form-group row">
		                            <label for="adress" class="col-md-4 col-form-label text-md-right">{{__('Adress') }}</label>

		                            <div class="col-md-8">
		                                <input id="adress" type="text" class="form-control" name="adress" value="" required autofocus>

		                              
		                                    <span class="invalid-feedback adress-error" role="alert">
		                                        
		                                    </span>
		                             
		                            </div>
		                        </div>
		                         <div class="form-group row">
		                            <label for="latitude" class="col-md-4 col-form-label text-md-right">{{ __('Adress map latitude') }}</label>

		                            <div class="col-md-8">
		                                <input id="latitude" type="text" class="form-control" name="latitude" value="" required autofocus>

		                               
		                                    <span class="invalid-feedback latitude-error" role="alert">
		                                        
		                                    </span>
		                              
		                            </div>
		                        </div>
		                         <div class="form-group row">
		                            <label for="longitude" class="col-md-4 col-form-label text-md-right">{{ __('Adress map longitude') }}</label>

		                            <div class="col-md-8">
		                                <input id="longitude" type="text" class="form-control" name="longitude" value="" required autofocus>

		                               
		                                    <span class="invalid-feedback longitude-error" role="alert">
		                                       
		                                    </span>
		                              
		                            </div>
		                        </div>
		                </form>
		                <div class="modal-footer">       
				              <div class="form-group action-modal">
                            <button  type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancel</button>
                            
                                
                              
                           </div>
				                 
				              
					    </div>
				       
				</div>
			</div>
		</div>
	</div>
	<!-- modal delete restaurant-->
	<div class="delete_modal_form-restaurant modal fade" id="delete_modal_form" role="dialog"         >
			<div class="modal-dialog">
			    <div class="modal-content">
				        <div class="modal-header">
				          	<div class="form-group">
					          	<h3 class="modal-title text-center  col-xs-11"> Delete Restaurant</h3>

					            <button class="close" type="button" data-dismiss="modal" aria-label="close" class="btn btn-danger col-xs-1">
					              <span aria-hidden="true">&times;</span>
					            </button>
					        </div>
				        </div>

			        <div class="modal-body">
			            <form method="POST" action="" class="form-horizontal form-add-restaurant">
			             	 @csrf
			             	 <h3 class="text-center text-danger">are you sure to delete <span class="restaurant-name"></span></h3>
			             	 <input type="text" name="id_delete_rest" id="id_delete_rest" class="form-control hidden" >
			            </form>
			        </div>
			        
			        <div class="modal-footer">       
				        <div class="form-group action-modal">
                            <button  type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancel</button>
                            <button class="btn btn-default pull-right" type="submit" onclick="delete_Restaurant()"> Delete <span class="fa fa-trash"></span></button>
                                
                              
                        </div> 	 
			        </div>
			</div>
	    </div>
	 </div>
 	<hr>
 	 <script src="{{ asset('adminLTE/js/jquery-3.1.1.min.js')}}"></script>
 	<script type="text/javascript">
 		
 		$(document).on('click','.create-restaurant',function(){
 			if(('.action-button-rest').length)
 			$('.action-button-rest').remove();
 			$('.create_modal_form-restaurant').modal('show');
 			$('.modal-title-res').text('Add New Restaurant');
 			$('.action-modal').append('<button type="submit"'+
           ' class="btn btn-primary pull-right action-button-rest" name="btnadd" id="bntadd" onclick="addRestaurant()">'+
                                        'Add  Restaurant<i class="fa fa-plus"></i> </button>');


 		});
 		function addRestaurant(){
 			$.ajax({
 				type:'POST',
 				url:'{{route("ajout_restaurant")}}',
 				dataType:'json',
 				data:{
 					 '_token': $('meta[name="csrf-token"]').attr('content'),
 					 'label':$('#label').val(),
 					 'adress':$('#adress').val(),
 					 'latitude':$('#latitude').val(),
 					 'longitude':$('#longitude').val(),
 				},
 				success:function(data){
 					if(data.errors){
 						if(data.errors.hasOwnProperty('label'))
 							$('.label-error').html('<strong class="text-danger">'+data.errors.label[0]+'</strong>');
 						if(data.errors.hasOwnProperty('adress'))
 							$('.adress-error').html('<strong class="text-danger">'+data.errors.adress[0]+'</strong>')
 						if(data.errors.hasOwnProperty('latitude'))
 							$('.latitude-error').html('<strong class="text-danger">'+data.errors.latitude[0]+'</strong>')
 						if(data.errors.hasOwnProperty('longitude'))
 							$('.longitude-error').html('<strong class="text-danger">'+data.errors.longitude[0]+'</strong>')
 					}
 					else{
	                               
 						$('#table').append('<tr class="bg-info res'+data.id+'">'+data.id+'<td class="text-center"><td class="text-center">'+data.label +'</td><td class="text-center">'+data.adress +'</td><td class="text-center">'+data.latitude +'</td>	<td class="text-center">'+data.longitude+'</td><td><a href="" class="btn btn-xs btn-success btn-edit" data-id="'+data.id+'" data-label="'          +data.label+'"  data-adress="'         +data.adress+'"   data-latitude="'   +data.latitude+'" data-longitude="'    +data.longitude+'"><span class="fa fa-edit"></span></a>  </td> <td><a  class="btn btn-xs btn-danger pull-right btn-delete" data-id="'+data. id+'" data-label="'+data.label+
 							
 			'"><span class="fa fa-trash"></span></a></td></tr>');

 						$('.invalid-feedback').text('');
 						$('#label').val("");
 					     $('#adress').val("");
 					     $('#latitude').val("");
 					   $('#longitude').val("");


 					}

 				},

 			});
 		}
 	</script>
 	<!-- Script edit restaurant-->
 	<script type="text/javascript">
 		$(document).on('click','.btn-edit', function(){
 		    if(('.action-button-rest').length)
 		    	$('.action-button-rest').remove();
 		    if(('.id-rest-edit').length)
 		    	$('.id-rest-edit').remove();
 			$('.create_modal_form-restaurant').modal('show');
 			$('.modal-title-res').text(' Edit Restaurant');
 			$('.action-modal').append('<button type="submit"'+
           ' class="btn btn-primary pull-right action-button-rest" name="btn_edit" id="btn_edit" onclick="edit_Restaurant()">'+
                                        'Edit Restaurant <i class="fa fa-edit"></i> </button>');

 			 $('<div class="form-group row id-rest-edit">'+
      '<label for="id" class="col-md-4 col-form-label text-md-right">id</label> <div class="col-md-8">'+
                             ' <input  type="text" class="form-control" name="id_rest_edit" id="id_rest_edit" disabled> </div> </div>').insertBefore(".form-label");
 			 $('#id_rest_edit').val($(this).data('id'));
 			 $('#label').val($(this).data('label'));
 			 $('#adress').val($(this).data('adress'));
 			 $('#latitude').val($(this).data('latitude'));
 			 $('#longitude').val($(this).data('longitude'));


 		});
 			 function edit_Restaurant(){
 			$.ajax({
 				type:'POST',
 				url:'{{ route ("edit_restaurant") }}',
 				dataType:'json',
 				data:{
 					 '_token': $('meta[name="csrf-token"]').attr('content'),
 					 'id':  $('#id_rest_edit').val(),
 					 'label':$('#label').val(),
 					 'adress':$('#adress').val(),
 					 'latitude':$('#latitude').val(),
 					 'longitude':$('#longitude').val(),
 				},
 				success:function(data){
 					if(data.errors){
 						if(data.errors.hasOwnProperty('label'))
 							$('.label-error').html('<strong class="text-danger">'+data.errors.label[0]+'</strong>');
 						if(data.errors.hasOwnProperty('adress'))
 							$('.adress-error').html('<strong class="text-danger">'+data.errors.adress[0]+'</strong>')
 						if(data.errors.hasOwnProperty('latitude'))
 							$('.latitude-error').html('<strong class="text-danger">'+data.errors.latitude[0]+'</strong>')
 						if(data.errors.hasOwnProperty('longitude'))
 							$('.longitude-error').html('<strong class="text-danger">'+data.errors.longitude[0]+'</strong>')
 					}
 					else{
	                               
 						$('.res'+data.id).replaceWith('<tr class="bg-info res'+data.id+'">'+data.id+'<td class="text-center"><td class="text-center">'+data.label +'</td><td class="text-center">'+data.adress +'</td><td class="text-center">'+data.latitude +'</td>	<td class="text-center">'+data.longitude+'</td><td><a  class="btn btn-xs btn-success btn-edit" data-id="'+data.id+'" data-label="'          +data.label+'"  data-adress="'         +data.adress+'"   data-latitude="'   +data.latitude+'" data-longitude="'    +data.longitude+'"><span class="fa fa-edit"></span></a>  </td> <td><a  class="btn btn-xs btn-danger pull-right btn-delete" data-id="'+data. id+'" data-label="'+data.label+
 							
 			'"><span class="fa fa-trash"></span></a></td></tr>');

 						$('.invalid-feedback').text('');
 						$('.create_modal_form-restaurant').modal('hide');
 						

 					}

 				},

 			});
 		}

 	</script>
 	<!-- Script delete restaurant-->
 	<script type="text/javascript">
 		$(document).on('click','.btn-delete',function(){
          $('.delete_modal_form-restaurant').modal('show');
         $('.restaurant-name').text($(this).data('label'));
         $('#id_delete_rest').val($(this).data('id'));
 		});
 		function delete_Restaurant(){
 			$.ajax({
 				type:'POST',
 				url:'{{ route("delete_restaurant")}}',
 				dataType:'json',
 				data:{
 					'_token':$('meta[name="csrf-token"]').attr('content'),
 					'id':$('#id_delete_rest').val(),


 				},
 				success:function(data){
 					 $('.res'+$('#id_delete_rest').val()).remove();
                     $('.delete_modal_form-restaurant').modal('hide');
 				},
 			});
 		}
 	</script>
		<div class="row">
    	<h1  class="text-center"> list of Restaurant</h1>
    	
    	@if(count($restaurant)>0)
    	<div class="table-responsive">
			<table class="table table-stripped" id="table">
				<thead>
					<th class="text-center">id</th>
					<th class="text-center">Name</th>
					<th class="text-center">Adress</th>
					<th class="text-center">Latidude</th>
					<th class="text-center">Longidude</th>
					<th colspan="2" class="text-center">Edit</th>
					
					</thead>
					<tbody>
						@foreach($restaurant as $rest)

							<tr class="bg-info res{{$rest->id}}">
								<td class="text-center">{{ $rest->id}}</td>
								<td class="text-center">{{ $rest->label }}</td>
								<td class="text-center">{{ $rest->adress }}</td>
								<td class="text-center">{{ $rest->latitude }}</td>
								<td class="text-center">{{ $rest->longitude }}</td>

								<td>
									<a  class="btn btn-xs btn-success btn-edit" data-id="{{ $rest->id}}" data-label="{{ $rest->label}}" data-adress="{{ $rest->adress}}" data-latitude="{{$rest->latitude}}" data-longitude="{{$rest->longitude}}"><span class="fa fa-edit"></span></a>
	                              </td>
	                              <td>  
	                                <a  class="btn btn-xs btn-danger pull-right btn-delete" data-id="{{$rest->id}}" data-label="{{$rest->label}}"><span class="fa fa-trash"></span></a>
	                            </td>
							</tr>
						@endforeach		
						
					</tbody>
				
			</table>
			 <div class=" col-xs-12 text-center"> <h3>{{$restaurant->links()}}
                 </h3> 
                </div>
		</div>
		@else
		<h1 class="text-center text-danger"> no Information in data base</h1>
		@endif
	</div>
</div>
@endsection