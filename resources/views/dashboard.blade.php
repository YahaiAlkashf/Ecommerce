@extends('layout.dashboardlayout')
@section('contant')
<div class="contant">
    <div class="title-info">
        <p>dashboard</p>
        <i class="fas fa-chart-bar"></i>
    </div>

    <div class="data-info">
        <div class="box">
            <i class="fas fa-user"></i>
            <div class="data">
                <p>user</p>
                <span>100</span>
            </div>
        </div>


        <div class="box">
            <i class="fas fa-pen"></i>
            <div class="data">
                <p>post</p>
                <span>45</span>
            </div>
        </div>

        <div class="box">
            <i class="fas fa-table"></i>
            <div class="data">
                <p>products</p>
                <span>47</span>
            </div>
        </div>

        <div class="box">
            <i class="fas fa-dollar"></i>
            <div class="data">
                <p>revenue</p>
                <span>$1000</span>
            </div>
        </div>
    </div>

    <div class="title-info">
        <p>pruduct</p>
        <i class="fas fa-table"></i>
    </div>
    <div class="create">
   <a href="{{route('pruducts.create')}}">add pruduct</a>
    </div>

    <table>
        <thead>
            <tr>
                 <th>product</th>
                 <th>price</th>
                 <th>count</th>
                 <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($Products as $Product)
            <tr>
                    
                
                <td class="record">{{$Product->name}}</td>
                <td class="record"><span class="price">{{$Product->price}}</span></td>
                <td class="record"><span class="count">{{$Product->count}}</span></td>
                <td class="card">
                    {{-- <a href="#" class="view">View</a> --}}
                    <a href="{{route('pruducts.edit',$Product->id)}}" class="edit">Edit</a>
                    <form action="{{route('products.delete',$Product->id)}}" method="POST">
                        @csrf
                        @method('delete')
                    <button  class="delete">delete</button>
                    </form>
                </td>
            </tr>
            @endforeach


@endsection
