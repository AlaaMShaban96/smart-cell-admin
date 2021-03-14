@extends('Dashbord/layout/master')

@section('style')

@endsection

@section('content')

<div class="content">

    <div class="animated fadeIn">
        <div class="clearfix"></div>
        <div class="orders">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body text-center">
                            
                            <h4 class="box-title">المتاجر   </h4>
                        </div>
                        <div class="card-body text-right">
                            <div class="table-stats order-table ov-h">
                                <table class="table ">
                                    <thead>
                                        @if ($empty)
                                                <tr>
                                                    <th> </th>
                                                    <th>ربط قواعد البيانات</th>
                                                    <th>البريد الﻹلكتروني</th>
                                                    <th>رقم المتجر</th>
                                                    
                                                </tr>
                                        @else
                                           
                                            <tr>
                                                <th> </th>
                                                <th> نوع الاشتراك</th>
                                                <th>تاريخ انتهاء الاشتراك</th>
                                                <th>صورة</th>
                                                <th>المتجر</th>
                                                <th>رقم المتجر</th>
                                                
                                            </tr>
                                        @endif
                                     
                                    </thead>
                                    <tbody id="tbodyOrders">
                                        @foreach ($stores as $store)
                                            @if ($empty)
                                                
                                                <tr>
                                                    <td>
                                                        <a href="{{url('/store/'.$store->id)}}" class="btn btn-primary  button-overlay mr-3" ><i class="fa fa-folder-open" aria-hidden="true"></i></a>
                                                    </td>
                                                    <td>{{$store->database_link}}</td>
                                                    <td>{{$store->email}}</td>                     
                                                    <td>{{$store->id}}</td>                     
                                                </tr> 
                                            @else
                                                <tr>
                                                    <td>
                                                        <div class="row">
                                                            <div class='col'>
                                                                <a href="{{url('/store/'.$store->id.'/edit')}}" class="btn btn-primary  button-overlay mr-3" ><i class="fa fa-pencil" aria-hidden="true"></i></a>

                                                            </div> 
                                                                <div class='col'>
                                                                    <form action="{{url('/store/'.$store->id )}}" method="post">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button type="submit" class="btn btn-danger  button-overlay mr-3" ><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                                    </form>
                                                                </div> 
                                                            
                                                        </div>
                                                        
                                                    </td>
                                                    <td>
                                                        <form action="{{url('/store/renew/'.$store->id)}}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="expiringDate" value="{{$store->expiringDate}}">
                                                            <button type="submit" class="btn btn-success  button-overlay mr-3"><i class="fa fa-check" aria-hidden="true"></i></button>
                                                            <label for=""> سنة</label>
                                                            <input type="radio" id="renew1" name="renew" value="12" required>
                                                            <label for="">تلاتة شهور</label>
                                                            <input type="radio" id="renew1" name="renew" value="3" required>
                                                            <label for="">شهر</label>
                                                            <input type="radio" id="renew1" name="renew" value="1" required>
                                                        </form>
                                                        
                                                    </td>
                                                    <td>{{\Carbon\Carbon::parse($store->expiringDate)->format('d-m-Y')}}</td>
                                                    <td>  <img src="{{$store->icon}}" alt="{{$store->name}} صورة" width="50" height="50">  </td>
                                                    <td>{{$store->name}}</td>                     
                                                    <td>{{$store->id}}</td>                     
                                                </tr> 
                                            @endif
                                                                              
                                        @endforeach
                                     
                                    </tbody>
                                </table>
                            </div> <!-- /.table-stats -->
                        </div>
                    </div> <!-- /.card -->
                </div>  <!-- /.col-lg-8 -->
            </div>
        </div>

    </div>
</div>

@endsection
@section('script')

@endsection