@extends('users.layouts.app')
@section('title','checkout')
@section('content')

    <table class="table">
        <tr>
            <thead>
            <th>First Name</th>
            <th>Last name</th>
            <th>Country</th>
            <th>Streetadress1</th>
            <th>Streetadress2</th>
            <th>Town</th>
            <th>Post Code</th>
            <th>Phone</th>
            <th>Total</th>
            </thead>
        </tr>
        <tr>
            <tbody>
                <td>{{$order->fname}}</td>
                <td>{{$order->lname}}</td>
                <td>{{$order->country}}</td>
                <td>{{$order->streetadress1}}</td>
                <td>{{$order->streetadress2}}</td>
                <td>{{$order->town}}</td>
                <td>{{$order->postcode}}</td>
                <td>{{$order->phone}}</td>
                <td>{{$order->total}}</td>

            </tbody>
        </tr>

    </table>

    @endsection
