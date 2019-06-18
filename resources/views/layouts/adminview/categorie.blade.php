@extends('./layouts/adminview/master')
@section('content')<!--
<style type="text/css">
  <style type="text/css">
  
​table {
    width: 200%;
    display:block;
}
thead {
   display: block;
    width: 100%;
    height: 20%;
}
tbody {
    height: 500px;
    display: block;
    width: 1000px;
    overflow-y: auto;
}
</style>-->
<div class="container">
  <div class="col-md-6 ">
    <div><h2 class="text-center">Liste Of Cateegorie</h2></div>
    <hr>
    <div class="table-responsive ">
      <table class="table table-stripped ">
        <thead>
          <th class="text-center" >ID</th>
          <th class="text-center">NAME</th>
          <th class="text-center">Name Restaurant</th>
          <th colspan="2" class="text-center">EDIT</th>
        </thead>
        <tbody>
        @foreach($listCateg as $cat)
        <tr class="bg-info cat{{$cat->id}}">
          <td>{{$cat->id}}</td>
          <td>{{$cat->name}}</td>
          <td>{{$cat->name_restaurant}}</td>
          <td>
            <a class="btn btn-success btn-edit pull-left" data-id="{{$cat->id}}" data-name="{{$cat->name}}"
             data-restau="{{$cat->name_restaurant}}" data-img="{{$cat->image_categ}}" ><span class="fa fa-edit"></span></a>
          </td>
          <td>
            <a class="btn btn-danger btn-delete pull-right" data-id="{{$cat->id}}" 
              data-name="{{$cat->name}}"  ><span class="fa fa-trash"></span></a>
          </td>
        </tr>
        @endforeach
      </tbody>
      </table>
    </div>
  </div>
  <div class="col-md-6">
    <div class="row">
      <h2 class="text-center">Add Categorie</h2>
    </div>
    <hr>
    <div class="form">
      <form>
         <div class="form-group row name">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-5">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ?
                                 ' is-invalid' : '' }}" name="name" id="name" value="{{ old('name') }}" >

                                    <span class="name-error invalid-feedback" role="alert">
                                      
                                    </span>
                               
                            </div>
         </div>
         <div class="form-group row restaurant">
                            <label for="name" class="col-md-4 col-form-label text-md-right">
                            {{ __('Select a Restaurant') }}</label>

                            <div class="col-md-5">
                              <select class="form-control" id="name_restaurant" name="name_restaurant">
                                <option ></option>
                                 @foreach($listRestaurant as $rest)
                                 <option>{{$rest->label}} - {{$rest->adress}}</option>
                                 @endforeach
                              </select>
                              <span class="restaurant-error invalid-feedback" role="alert">
                              </span>
                               
                            </div>
         </div>
          <div class="form-group row image">
                            <label for="image" class="col-md-4 col-form-label text-md-right">
                            {{ __('Image') }}</label>

                            <div class="col-md-5">
                                 <div class="input-group"> 
                                  <input type="file" name="file" id="file" accept="image/*" class="hidden">
                                    <input type="text" class="form-control" placeholder="ajouter image" disabled="true" id="image_cat" name="image_cat"> 
                                    <span class="input-group-btn">
                                        <a  name="add_image" id="add_image" class="btn btn-flat form-control " 
                                        onclick="document.getElementById('file').click();return false;"><strong><i class="glyphicon glyphicon-picture"></i></strong>
                                        </a>
                                    </span>
                                  </div>
                              
                                   
                               
                            </div>
         </div>
      </form>
      <div class="form-group row action">
        
            <button class="btn btn-danger cancel-btn col-md-3" style="position: center;">Cancel</button>
       
        <div class="col-md-7 button-add">
         <button class="btn btn-success pull-right add-btn" onclick="add_categ()">Add Categorie</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- add image function-->
<script src="{{ asset('adminLTE/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<script type="text/javascript">
 $(document).ready(function(){
        $('input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
            $('#image_cat').val(fileName);
    });
      });
</script>
<script type="text/javascript">
  $(document).on('click','.btn-edit',function(){
    if((".button-edit").length)
      $(".button-edit").remove();
    if((".id-cat-edit").length)
      $(".id-cat-edit").remove();
  $('.button-add').remove();
  $("#name").val($(this).data('name'));
  $("#name_restaurant").val($(this).data('restau'));
  $('#image_cat').val($(this).data('img'));
  $('.action').append(' <div class="col-md-5 button-edit">'+
         '<button class="btn btn-success pull-right add-btn"'+
         ' onclick="edit_categ()">Edit Categorie</button> </div>');
   $('<div class="form-group row id-cat-edit">'+
      '<label for="id_cat" class="col-md-4 col-form-label text-md-right">id</label> <div class="col-md-5">'+
       ' <input  type="text" class="form-control" name="id_cat" id="id_cat" disabled> </div> </div>').insertBefore('.name');
   $('#id_cat').val($(this).data('id'));
  });
</script>




<!--- function addd new categorie-->
<script type="text/javascript">
  function add_categ(){
    $.ajax({
      type:'POST',
      url:'{{route("add_categorie")}}',
      DataType:'json',
      data:{
        '_token': $('meta[name="csrf-token"]').attr('content'),
        'name': $('#name').val(),
        'name_restaurant':$('#name_restaurant option:selected').text(),
        'image_categ' : $('#image_cat').val(),



      },
      success:function(data){
        if(data.errors){
          if(data.errors.hasOwnProperty('name'))
            $('.name-error').text(data.errors.name[0]);
          if(data.errors.hasOwnProperty('name_restaurant'))
            $('.restaurant-error').text(data.errors.name_restaurant[0]);

        }
        else{
          $('.table').append('<tr class="bg-info cat'+data.id+'"> <td>'
            +data.id+'</td><td>'+data.name+'</td><td>'+data.name_restaurant
            +'</td> <td> <a class="btn btn-success btn-edit pull-left" data-id="'
            +data.id+'" data-name="'+data.name+'" data-restau="'+data.name_restaurant+
            '"><span class="fa fa-edit"></span></a> </td><td>'+ 
            '<a class="btn btn-danger btn-delete pull-right" data-id="'+data.id+
            '" data-name="'+data.name+
            '" ><span class="fa fa-trash"></span></a> </td></tr>');
          $('.invalid-feedback').text('');

          $('#name').val('');
          $('#name_restaurant').val('');
           $('#image_cat').val('');

          
        }

      },
    });
  }
  // function edit a categorie
   function edit_categ(){
    $.ajax({
      type:'POST',
      url:'{{route("edit_categorie")}}',
      DataType:'json',
      data:{
        '_token': $('meta[name="csrf-token"]').attr('content'),
        'id':$('#id_cat').val(),
        'name': $('#name').val(),
        'name_restaurant':$('#name_restaurant option:selected').text(),
        'image_categ' : $('#image_cat').val(),
      },
      success:function(data){
        if(data.errors){
          if(data.errors.hasOwnProperty('name'))
            $('.name-error').text(data.errors.name[0]);
          if(data.errors.hasOwnProperty('name_restaurant'))
            $('.restaurant-error').text(data.errors.name_restaurant[0]);

        }
        else{
          $('.cat'+data.id).replaceWith('<tr class="bg-info cat'+data.id+'"> <td>'
            +data.id+'</td><td>'+data.name+'</td><td>'+data.name_restaurant
            +'</td> <td> <a class="btn btn-success btn-edit pull-left" data-id="'
            +data.id+'" data-name="'+data.name+'" data-restau="'+data.name_restaurant+
            '" data-img="'+data.image_categ+'"><span class="fa fa-edit"></span></a> </td><td>'+ 
            '<a class="btn btn-danger btn-delete pull-right" data-id="'+data.id+
            '" data-name="'+data.name+
            '" ><span class="fa fa-trash"></span></a> </td></tr>');

          $('.invalid-feedback').text('');
          $('#name').val('');

          $('#name_restaurant').val('');
          $('#image_cat').val('');
          $('.button-edit').remove();
           $('.action').append(' <div class="col-md-5 button-edit">'+
         '<button class="btn btn-success pull-right add-btn"'+
         ' onclick="add_categ()">add Categorie</button> </div>');
           $('.id-cat-edit').remove();

        }

      },
    });
  }

</script>
<!-- delete categorie-->
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
                            <h3 class="text-center">are you sure want to delete  <span class="name-cat"></span></h3>
                            <input type="text" name="id_cat_delete" id="id_cat_delete" class="id-cat hidden" >
                      </div>
                      <div class="modal-footer">
                          <button  type="button" class="btn btn-danger pull-left" data-dismiss="modal">close</button>
                              
                                  <button type="submit" class="btn btn-primary pull-right delete" name="btn_delete" id="btn_delete" onclick="deleteCateg();return false;">
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
         $('.name-cat').html($(this).data('name'));
         $('#id_cat_delete').val($(this).data('id'));

       } );

function deleteCateg(){
    
   $.ajax({
     type:'post',
     url:"{{ route('delete_categorie')}}",
     data:{
        '_token':"{{ csrf_token() }}",
        'id':parseInt($('#id_cat_delete').val()),
     },
     success: function(data){
        $('.cat'+$('#id_cat_delete').val()).remove();
        $('#delete_modal_form').modal('hide');
          console.log("success");
     },
   });
     console.log(($('#id_cat_delete').val())+"  slimmm");
}
 </script>
@endsection