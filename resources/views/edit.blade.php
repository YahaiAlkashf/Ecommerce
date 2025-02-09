<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{asset('css/create.css')}}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>dashboard</title>
  <style>
    *{
        padding: 0;
        margin: 0;
        color: white;
        font-family: sans-serif;
    }
    body{
        background-color: #001;
        display: flex !important;

    }
    .img-box{
        width: 50px;
        height: 50px;
        border-radius:50%; 
        overflow: hidden;
        border: 3px solid white;
        flex-shrink: 0;
    }
    .profile{
        display: flex;
        align-items: center;
        gap:25px;
    }
    .profile h2{
       font-size: 20px;
       text-transform: capitalize;
    }
    .img-box img{
      width:100%;
      
    }
    .menu{
        background-color: #123;
        width: 60px;
        height:100vh;
        padding: 20px;
        overflow: hidden;
        transition: .5s;
    }
    .menu:hover{
        width:260px;
    }
    ul{
        list-style: none;
        position: relative;
        height: 95%;
    }
    ul li a{
        text-decoration: none;
        display: block;
        padding:10px;
        margin:10px 0;
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap:40px;
        transition: .5s;
    }
    ul li a:hover,.box,.data-info .box:hover,.record:hover{
      background-color: #ffffff55;
    }
    .logout{
        position: absolute;
        bottom: 0;
        width:100%;
    }
    .logout {
    background-color: #a00;
    }
    ul li a i{
        font-size: 30px;
    }
    .contant{
        width:100%;
        margin: 10px;   
    }
    .title-info{
       background-color: #0481ff;
       padding:10px;
       display: flex;
       justify-content: space-between;
       border-radius: 8px;
       align-items: center;
       margin: 10px 0;
    }
    .data-info{
        display: flex;
        gap:10px;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }
    .data-info .box{
        flex-basis: 150px;
        height: 150px;
        border-radius:8px;
        background-color: #123;
        flex-grow: 1;    
        display: flex;
        align-items: center;
        justify-content: space-around;
    }
    .data-info .box i{
        font-size: 40px;
    }
    .data-info .box .data{
        text-align: center;
    }
    .data-info .box span{
        font-size: 30px;
    }
    table{
        width:100%;
        text-align: center;
        border-spacing: 10px;
    }
    th{
    height: 40px;
    }
    td,th{
        background-color: #123;
        border-radius: 8px;
        max-height: 80px;
        transition: .5s;
    }
    th{
        background-color: #0481ff
    }
    .count,.price{
        padding:8px;
        border-radius: 6px;
    }
    .price{
        background-color: green;
    }
    .count{
        background-color: yellow;
        color: black;
    }
    .card{
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        
        gap:5px;
        max-height: 85px;
    }
    .card  a{
      text-decoration: none;
      padding: 8px;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      height: 20px;
      flex-grow: 1;
     justify-content: center;
    }
    .card .view{
        background-color: #0481FF;
        border-radius: 8px;
    }
    .card .view:hover{
        background-color: #0266cc;
    }
    .card .edit{
        background-color: #28a745;
        border-radius: 8px;
    }
    .card .edit:hover{
        background-color:#218838;
    }
    .card .delete{
        background-color: #ff4d4d;
        border-radius: 8px;
    }
    .card .delete:hover{
        background-color:#cc0000;
    }
    .create{
        text-align: center;
        margin: 15px 0;
    }
    .create a{
        background-color: #28a745 !important;
        width:100px;
        border: none;
        padding: 10px;
        border-radius: 8px;
        cursor: pointer;
        transition: .5s;
        font-size:15px;
        text-decoration: none;
      
    }
    .create a:hover{
        background-color: #218838 !important;
    }
  </style>
</head>
<body>
    <div class="page">
    <div class="menu">
        <ul>
            <li class="profile"> 
                <div class="img-box">
                    <img src="/img/user.webp" alt="profile">
                </div>
                <h2>yahya alkashf</h2>
            </li>
            <li>
                <a href="{{route('dashboard')}}" class="box">
                    <i class="fas fa-home"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-user-group"></i>
                    <p>Clients</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-chart-pie"></i>
                    <p>Charts</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-pen"></i>
                    <p>Post</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-star"></i>
                    <p>Favorit</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-cog"></i>
                    <p>Setting</p>
                </a>
            </li>
            <li>
                <a href="#" class="logout">
                    <i class="fas fa-sign-out"></i>
                    <p>Logout</p>
                </a>
            </li>
        </ul>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="{{route('products.update',$product->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="create-pruduct">
            <h2>add product</h2>
            <input type="text"  class="file" placeholder="name"  name="name"   value="{{$product->name}}">
            <input type="text"  class="file" placeholder="price"  name="price" value="{{$product->price}}">
            <input type="text"  class="file" placeholder="count"  name="count" value="{{$product->count}}">
            <textarea type="text"  name="description" class="file" placeholder="description" style=" resize: none;    width: 100%;
            max-width: 400px;
            height: 200px;
            padding: 15px;
            font-size: 18px;">{{$product->description}}</textarea>
            <input type="file" id="photo" class="file-image" name="image">
            <button >Edit</button>
            
        </div>
        </form>
        </div>
</tbody>
</table>
</div>


</body>
</html>