@extends('./layouts/adminview/master')
@section('content')
<div class="container-fluid">
  <div class="col-md-8">
    <div><h2 class="text-center">Liste Of Foods</h2>
    </div>
    <hr>
    <div class="table-responsive">
      <table class="table table-stripped">
        <thead>
          <th class="text-center">ID</th>
          <th class="text-center">NAME</th>
          <th class="text-center">PRICE</th>
          <th class="text-center">Name Restaurant</th>
          <th colspan="2" class="text-center">EDIT</th>
        </thead>
       @foreach($listfood as $food)
        <tr class="bg-info food{{$food->id}}">
          <td>{{$food->id}}</td>
          <td>{{$food->name}}</td>
          <td>{{$food->price}}</td>
          <td>{{$food->name_restaurant}}</td>

          <td>
            <a class="btn btn-success btn-edit pull-left" data-id="{{$food->id}}" data-name="{{$food->name}}"data-price="{{ $food->price }}" data-restau="{{$food->name_restaurant}}" data-categ="{{$food->name_categorie}}" data-img="{{$food->image}}" ><span class="fa fa-edit"></span></a>
          </td>
          <td>
            <a class="btn btn-danger btn-delete pull-right" data-id="{{$food->id}}" data-name="{{$food->name}}"  ><span class="fa fa-trash"></span></a>
          </td>
        </tr>
        @endforeach
      </table>
    </div>
  </div>
  <div class="col-md-4">
    <div class="row">
      <h2 class="text-center">Add Food</h2>
    </div>
    <hr>
    <div class="form">
      <form method="post" accept="multipart/form-data" action="" id="upload_form" name="upload_form">
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
         <div class="form-group row name">
                            <label for="name_food" class="col-md-6 col-form-label text-md-right">{{ __('Nom plat') }}</label>

                            <div class="col-md-6">
                                <input id="name_food" type="text" class="form-control" name="name_food" value="" required autofocus>

                                    <span class="name_food-error invalid-feedback" role="alert">
                                      
                                    </span>

                            </div>
         </div>
          <div class="form-group row price">
                            <label for="price" class="col-md-6 col-form-label text-md-right">{{ __('Prix') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control" name="price" value="" required autofocus>

                                    <span class="price-error invalid-feedback"    role="alert">
                                      
                                    </span>
                               
                            </div>
         </div>
         <div class="form-group row Restaurant">
                            <label for="name" class="col-md-6 col-form-label text-md-right">{{ __('Selectionner Restaurant') }}</label>

                            <div class="col-md-6">
                              <select class="form-control" id="name_restaurant" name="name_restaurant" onclick="get_categorie()">
                                <option ></option>
                                 @foreach($listRestaurant as $rest)
                                 <option>{{$rest->label}}_{{$rest->adress}}</option>
                                 @endforeach
                              </select>
                              <span class="restaurant-error invalid-feedback" role="alert">
                              </span>
                            </div>
                             
         </div>
         <div class="form-group row categ">
                      <label for="categorie" class="col-md-6 col-form-label text-md-right">
                            {{ __('Categorie') }}</label>
                       <div class="col-md-6">
                              <select class="form-control" id="name_categ" name="name_categ" >
                               
                                 
                              </select>
                              <span class="categorie-error invalid-feedback" role="alert">
                              </span>
                               
                       </div>
          </div>
          <div class="form-group row image">
                            <label for="image" class="col-md-6 col-form-label text-md-right">
                            {{ __('Image') }}</label>

                            <div class="col-md-6">
                                 <div class="input-group"> 
                                  <input type="file" name="file" id="file" accept="image/*" class="hidden">
                                    <input type="text" class="form-control" placeholder="ajouter image" disabled="true" id="image_food" name="image_food"> 
                                    <span class="input-group-btn">
                                        <a  name="add_image" id="add_image" class="btn btn-flat form-control " 
                                        onclick="document.getElementById('file').click();return false;"><strong><i class="glyphicon glyphicon-picture"></i></strong>
                                        </a>
                                    </span>
                                  </div>
                              
                                   
                               
                            </div>
         </div>
      </form>
      <div class="row action">
        <button class="btn btn-default cancel-btn" onclick="cancel()">Cancel</button>
        <button class="btn btn-success pull-right button-add" onclick="add_Food()">Add food</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
        $('input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
            $('#image_food').val(fileName);
    });
      });
</script>
</script>
 
<script type="text/javascript">
  function get_categorie(){
    
    $.ajax({
      type:'get',
      url:"{{ route('get_list_categorie') }}",
      DataType:'json',
      data:{
        '_token':"{{ csrf_token() }}",
        'name_restaurant': $('#name_restaurant option:selected').text() 
      },
      success:function(data){

         $('.invalid-feedback').text('');
         $("#name_categ").empty();
         if(data.length>0){
          $("#name_categ").append('<option value=""></option>')
          for (var i =  0; i < data.length; i++) {
            $("#name_categ").append('<option value="'+data[i].name+'">'+data[i].name+'</option>');
          }
          
        }
        else{
          
          $('.restaurant-error').text("please select a Restaurant");
          $('.categorie-error').text("please select a Restaurant");
        }
      }
    });
  }
</script>
<script type="text/javascript">
  $(document).on('click','.btn-edit',function(){
    if((".button-edit").length)
      $(".button-edit").remove();
    if((".id-food-edit").length)
      $(".id-food-edit").remove();
  $('.button-add').remove();
  $("#name_food").val($(this).data('name'));
  
  $("#name_restaurant").val($(this).data('restau'));
  get_categorie();

  $("#price").val($(this).data('price'));
  $('#image_food').val($(this).data('img'));
 
  $('.action').append(
         '<button class="btn btn-success pull-right button-edit"'+
         ' onclick="edit_Food()">Edit Food</button>');
   $('<div class="form-group row id-food-edit">'+
      '<label for="id_food" class="col-md-6 col-form-label text-md-right">id</label> <div class="col-md-6">'+
       ' <input  type="text" class="form-control" name="id_food" id="id_food" disabled> </div> </div>').insertBefore('.name');
   $('#id_food').val($(this).data('id'));
    $('#name_categ').val($(this).data('categ'));
  });
</script>
<!-- delete part-->
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
                            <h3 class="text-center">are you sure want to delete  <span class="name-food"></span></h3>
                            <input type="text" name="id_food_delete" id="id_food_delete" class="id-food hidden" >
                      </div>
                      <div class="modal-footer">
                          <button  type="button" class="btn btn-danger pull-left" data-dismiss="modal">close</button>
                              
                                  <button type="submit" class="btn btn-primary pull-right delete" name="btn_delete" id="btn_delete" onclick="delete_Food();return false;">
                                      <i class="glyphicon glyphicon-trash"> </i>delete
                                  </button>
                                
                              </div> 
                    </div>
              </div>
 </div>
 <script type="text/javascript">
   
       $(document).on('click','.btn-delete',function(){
         $('#delete_modal_form').modal('show');
         $('.modal-body').css('color','red');
         $('.name-food').html($(this).data('name'));
         $('#id_food_delete').val($(this).data('id'));

       } );

function delete_Food(){
    
   $.ajax({
     type:'post',
     url:"{{ route('delete_food')}}",
     data:{
        '_token':"{{ csrf_token() }}",
        'id':parseInt($('#id_food_delete').val()),
     },
     success: function(data){
        $('.food'+$('#id_food_delete').val()).remove();
        $('#delete_modal_form').modal('hide');
          console.log("success");
     },
   });
     
}
 </script>

@endsection

<script type="text/javascript">
  function add_Food(){
    $.ajax({
      type:'POST',
      url:'{{ route("add_food") }}',
      DataType:'json',
      data:{
        '_token': "{{ csrf_token() }}",
        'name': $('#name_food').val(),
        'price':$('#price').val(),
        'name_restaurant':$('#name_restaurant option:selected').text(),

        'name_categorie':$('#name_categ option:selected').text(),
        'image': $('#image_food').val(),



      },
      success:function(data){
         console.log(data);
        if(data.errors){
          if(data.errors.hasOwnProperty('name'))
            $('.name_food-error').text(data.errors.name[0]);
          if(data.errors.hasOwnProperty('name_restaurant'))
            $('.restaurant-error').text(data.errors.name_restaurant[0]);
          if(data.errors.hasOwnProperty('name_categorie'))
            $('.categorie-error').text(data.errors.name_categorie[0]);
          if(data.errors.hasOwnProperty('price'))
            $('.price-error').text(data.errors.price[0]);


        }
        else{
          $('.table').append('<tr class="bg-info food'+data.id+'"> <td>'
            +data.id+'</td><td>'+data.name+'</td><td>'+data.price+'</td><td>'+data.name_restaurant
            +'</td> <td> <a class="btn btn-success btn-edit pull-left" data-id="'
            +data.id+'" data-name="'+data.name+'"data-prix="'+ data.price +'" data-restau="'+data.name_restaurant+'" data-categ="'+data.name_categorie+'" data-img="'+data.image+
            '" onclick="edit_Food()"><span class="fa fa-edit"></span></a> </td><td>'+ 
            '<a class="btn btn-danger btn-delete pull-right" data-id="'+data.id+
            '" data-name="'+data.name+
            '" onclick="delete_Food()"><span class="fa fa-trash"></span></a> </td></tr>');
          $('.invalid-feedback').text('');
          $('#name_food').val('');
          $('#price').val('');
          $('#name_restaurant').val('');
          $('#name_categ').val('');
          $("#image_food").val('');
        }

      },
    });
  }
</script>
<script type="text/javascript">
  function cancel(){
      if((".button-edit").length)
      $(".button-edit").remove();
    if((".id-food-edit").length)
      $(".id-food-edit").remove();
      $('.invalid-feedback').text('');
          $('#name_food').val('');
          $('#price').val('');
          $('#name_restaurant').val('');
          $('#name_categ').val('');
          $('#image_food').val('');
         if((".button-add").length<=0)
          $('.button-add').remove();
        
       

          $('.action').append(
                   '<button class="btn btn-success pull-right button-add"'+
                   ' onclick="add_Food()">Add Food</button>');
         
           
  }
</script>
<!-- edit food function-->
<script type="text/javascript">
  function edit_Food(){
    $.ajax({
       type:'POST',
      url:'{{ route("edit_food") }}',
      DataType:'json',
      data:{
        '_token': "{{ csrf_token() }}",
        'id':$('#id_food').val(),
        'name': $('#name_food').val(),
        'price':$('#price').val(),
        'name_restaurant':$('#name_restaurant option:selected').text(),

        'name_categorie':$('#name_categ option:selected').text(),
        'image': $('#image_food').val(),



      },
      success:function(data){
         console.log(data);
        if(data.errors){
          if(data.errors.hasOwnProperty('name'))
            $('.name_food-error').text(data.errors.name[0]);
          if(data.errors.hasOwnProperty('name_restaurant'))
            $('.restaurant-error').text(data.errors.name_restaurant[0]);
          if(data.errors.hasOwnProperty('name_categorie'))
            $('.categorie-error').text(data.errors.name_categorie[0]);
          if(data.errors.hasOwnProperty('price'))
            $('.price-error').text(data.errors.price[0]);


        }
        else{
          $('.food'+data.id).repalceWith('<tr class="bg-info food'+data.id+'"> <td>'
            +data.id+'</td><td>'+data.name+'</td><td>'+data.price+'</td><td>'+data.name_restaurant
            +'</td> <td> <a class="btn btn-success btn-edit pull-left" data-id="'
            +data.id+'" data-name="'+data.name+'"data-prix="'+ data.price +'" data-restau="'+data.name_restaurant+'" data-categ="'+data.name_categorie+'" data-img="'+data.image+
            '" onclick="edit_Food()"><span class="fa fa-edit"></span></a> </td><td>'+ 
            '<a class="btn btn-danger btn-delete pull-right" data-id="'+data.id+
            '" data-name="'+data.name+
            '" onclick="delete_Food()"><span class="fa fa-trash"></span></a> </td></tr>');
          $('.invalid-feedback').text('');
          $('#name_food').val('');
          $('#price').val('');
          $('#name_restaurant').val('');
          $('#name_categ').val('');
          $("#image_food").val('');
        }

      },
    });
  }
  
</script>
