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
            <tr>
                <td class="record">smart watch</td>
                <td class="record"><span class="price">30$</span></td>
                <td class="record"><span class="count">60</span></td>
                <td class="card">
                    <a href="#" class="view">View</a>
                    <a href="#" class="edit">Edit</a>
                    <a href="#" class="delete">delete</a>
                </td>
            </tr>


@endsection
