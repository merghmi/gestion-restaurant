@extends('./layouts/adminview/master')
@section('content')
<div class="container-fluid">
  <div class="col-md-6">
    <div><h2 class="text-center">Liste Of Foods</h2></div>
    <hr>
    <div class="table-responsive">
      <table class="table table-stripped">
        <thead>
          <th class="text-center" >ID</th>
          <th class="text-center">NAME</th>
          <th class="text-center">PRICE</th>
          <th class="text-center">Name Restaurant</th>
          <th colspan="2" class="text-center">EDIT</th>
        </thead>
       <! @foreach($listfood as $food)
        <tr class="bg-info food
        {{$food->id}}">
          <td>{{$food->id}}</td>
          <td>{{$food->name}}</td>
          <td>{{$food->price}}</td>
          <td>{{$food->name_restaurant}}</td>

          <td>
            <a class="btn btn-success btn-edit pull-left" data-id="{{$food->id}}" data-name="{{$food->name}}" data-restau="{{$food->name_restaurant}}"><span class="fa fa-edit"></span></a>
          </td>
          <td>
            <a class="btn btn-danger btn-delete pull-right" data-id="{{$food->id}}" data-name="{{$food->name}}" ><span class="fa fa-trash"></span></a>
          </td>
        </tr>
        @endforeach>
      </table>
    </div>
  </div>
  <div class="col-md-6">
    <div class="row">
      <h2 class="text-center">Add Food</h2>
    </div>
    <hr>
    <div class="form">
      <form>
         <div class="form-group row name">
                            <label for="name_food" class="col-md-4 col-form-label text-md-right">{{ __('Nom plat') }}</label>

                            <div class="col-md-6">
                                <input id="name_food" type="text" class="form-control" name="name_food" value="" required autofocus>

                                    <span class="name_food-error invalid-feedback" role="alert">
                                      
                                    </span>

                            </div>
         </div>
          <div class="form-group row name">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Prix') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control" name="price" value="" required autofocus>

                                    <span class="name_food-error invalid-feedback"    role="alert">
                                      
                                    </span>
                               
                            </div>
         </div>
         <div class="form-group row name">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Selectionner Restaurant') }}</label>

                            <div class="col-md-6">
                              <select class="form-control" id="name_restaurant" name="name_restaurant" onclick="">
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
      <div class="row">
        <button class="btn btn-default cancel-btn">Cancel</button>
        <button class="btn btn-success pull-right add-btn" onclick="get_categorie()">Add food</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function get_categorie(){
    $.ajax({
      type:'get',
      url:"{{ route('get_list_categorie') }}",
      DataType:'json',
      data:{
        'name_restaurant': $('#name_restaurant option:selected').text() 
      },
      success:function(data){
        console.log('hello');
      }
    });
  }
</script>

@endsection

<script type="text/javascript">
  function add_Food(){
    $.ajax({
      type:'POST',
      url:'',
      DataType:'json',
      data:{
         '_token': $('meta[name="csrf-token"]').attr('content'),
        'name': $('#name').val(),
        'name_restaurant':$('#name_restaurant option:selected').text(),
        'price':$('#price').val(),

      },
      success:function(data){
        if(data.errors){
          if(data.errors.hasOwnProperty('name'))
            $('.name-error').text(data.errors.name[0]);
          if(data.errors.hasOwnProperty('name_restaurant'))
            $('.restaurant-error').text(data.errors.name_restaurant[0]);

        }
        else{
          $('.table').append('<tr class="bg-info food'+data.id+'"> <td>'
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
        }

      },
    });
  }
</script>
