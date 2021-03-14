@extends('Dashbord/layout/master')

@section('style')

<style>

</style>

@endsection

@section('content')


<div class="content">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <a href="{{url('/store/empty-stores')}}" class="button-overlay">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-1">
                                    <svg width="20%" height="20%" viewBox="0 0 56 52" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                                        <g transform="matrix(1,0,0,1,-22.2257,-36.6863)">
                                            <g transform="matrix(1.39436,0,0,1.32378,16.5785,31.3912)">
                                                <path d="M26,35.9L26,33L19,38L26,43L26,39.9L38.1,39.9C40.2,39.9 42.1,38.8 43.1,37C44.1,35.2 44.2,33 43.1,31.2L41,27.3L37.5,29.3L39.7,33.2C40.2,34 39.8,34.8 39.7,35C39.5,35.3 39.1,35.9 38.1,35.9L26,35.9ZM10.449,21.34L4.8,31.4C3.8,33.2 3.8,35.4 4.8,37.2C5.8,39 7.7,40.1 9.8,40.1L15,40.1L15,36L9.9,36C9,36 8.5,35.4 8.3,35.1C8.1,34.8 7.8,34.1 8.3,33.3L13.925,23.361L16.4,24.8L15.6,16.3L7.8,19.8L10.449,21.34ZM32.192,19.793L29.6,21.3L37.4,24.8L38.2,16.3L35.677,17.767L29.8,7.3C28.6,5.3 26.4,4 24,4C21.6,4 19.4,5.3 18.2,7.4L15.9,11.4L19.5,13.4L21.8,9.3C22.2,8.5 23,8 24,8C25,8 25.8,8.5 26.3,9.3L32.192,19.793Z" style="fill:rgb(76,175,80);fill-rule:nonzero;"/>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="count">{{$stores->where('name',"")->count()}}</span></div>
                                        <div class="stat-heading">المتاجر المتاحة</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <a href="#" class="button-overlay">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-1">
                                    <svg width="20%" height="20%" viewBox="0 0 48 43" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                                        <g transform="matrix(1,0,0,1,-26.3609,-41.4266)">
                                            <g transform="matrix(1.81839,0,0,1.83247,22.7241,35.9291)">
                                                <path d="M15,3C14.168,3 13.456,3.507 13.154,4.229L2.301,22.947L2.301,22.949C2.105,23.265 2.001,23.629 2,24C2,25.097 2.903,26 4,26C4.047,26 4.094,25.998 4.141,25.994L4.145,26L25.855,26L25.859,25.992C25.906,25.996 25.953,25.999 26,26C27.097,26 28,25.097 28,24C28,23.628 27.895,23.263 27.699,22.947L27.684,22.92C27.683,22.919 27.682,22.919 27.682,22.918L16.846,4.229C16.544,3.507 15.832,3 15,3ZM13.787,11.359L16.213,11.359L16.012,17.832L13.988,17.832L13.787,11.359ZM15.004,19.811C15.826,19.811 16.318,20.253 16.318,21.008C16.318,21.749 15.826,22.189 15.004,22.189C14.176,22.189 13.68,21.749 13.68,21.008C13.68,20.253 14.175,19.811 15.004,19.811Z" style="fill:rgb(255,204,0);fill-rule:nonzero;"/>
                                            </g>
                                        </g>
                                    </svg>                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="count">{{$expiringStore}}</span></div>
                                        <div class="stat-heading">تنبية بالمتاجر منتهية الاشتراك</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <a href="{{url('/store/active-stores')}}" class="button-overlay" >
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-1">
                                    <svg width="15%" height="15%" viewBox="0 0 47 59" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                                        <g transform="matrix(1,0,0,1,-26.6588,-23.4505)">
                                            <path d="M30.83,81.667L69.17,81.667C69.723,81.667 70.17,81.22 70.17,80.667L70.17,71.437C70.17,66.295 65.987,62.112 60.846,62.112L39.154,62.112C34.013,62.112 29.83,66.295 29.83,71.437L29.83,80.667C29.83,81.22 30.277,81.667 30.83,81.667ZM31.83,71.437C31.83,67.398 35.115,64.112 39.154,64.112L60.846,64.112C64.885,64.112 68.17,67.398 68.17,71.437L68.17,79.667L31.83,79.667L31.83,71.437ZM60.749,46.439C60.749,40.512 55.927,35.69 50,35.69C44.073,35.69 39.251,40.512 39.251,46.439C39.251,52.366 44.073,57.188 50,57.188C55.927,57.188 60.749,52.366 60.749,46.439ZM41.251,46.439C41.251,41.615 45.176,37.69 50,37.69C54.824,37.69 58.749,41.615 58.749,46.439C58.749,51.263 54.824,55.188 50,55.188C45.176,55.188 41.251,51.263 41.251,46.439ZM67.648,47.93L72.203,47.93C72.831,47.93 73.341,47.421 73.341,46.792C73.341,46.163 72.831,45.653 72.203,45.653L67.648,45.653C67.019,45.653 66.51,46.163 66.51,46.792C66.51,47.421 67.019,47.93 67.648,47.93ZM27.797,47.93L32.352,47.93C32.981,47.93 33.49,47.421 33.49,46.792C33.49,46.163 32.981,45.653 32.352,45.653L27.797,45.653C27.169,45.653 26.659,46.163 26.659,46.792C26.659,47.421 27.169,47.93 27.797,47.93ZM36.716,35.117C36.938,35.34 37.229,35.451 37.521,35.451C37.812,35.451 38.104,35.34 38.326,35.117C38.771,34.673 38.771,33.952 38.326,33.507L35.105,30.287C34.661,29.842 33.94,29.842 33.495,30.287C33.051,30.731 33.051,31.452 33.495,31.897L36.716,35.117ZM62.479,35.451C62.77,35.451 63.062,35.339 63.284,35.117L66.504,31.897C66.949,31.452 66.949,30.731 66.504,30.287C66.06,29.842 65.339,29.842 64.894,30.287L61.674,33.507C61.229,33.951 61.229,34.672 61.674,35.117C61.896,35.339 62.188,35.451 62.479,35.451ZM50,30.282C50.629,30.282 51.139,29.772 51.139,29.144L51.139,24.589C51.139,23.96 50.629,23.451 50,23.451C49.371,23.451 48.861,23.96 48.861,24.589L48.861,29.144C48.861,29.772 49.371,30.282 50,30.282Z" style="fill:rgb(0,146,173);fill-rule:nonzero;"/>
                                        </g>
                                    </svg>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="count">{{$stores->where('name',!"")->count()}}</span></div>
                                        <div class="stat-heading">المتاجر النشطة</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

           
        </div>


        <div class="clearfix"></div>

        <div class="orders">
            <div class="row">
                <div class="col-xl-12">
                    <div class='text-right'>
                        <a href='{{url('/store/create')}}' class="btn btn-success text-white m-3 button-overlay ">انشاء متجر </a>

                    </div>

                    <div class="card">
                        <div class="card-body text-center">

                            <h4 class="box-title">المتاجر   </h4>
                        </div>
                        <div class="card-body text-right">
                            <div class="table-stats order-table ov-h">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th> نوع الاشتراك</th>
                                            <th>تاريخ انتهاء الاشتراك</th>
                                            <th>البريد الالكتروني</th>
                                            <th>صورة</th>
                                            <th>المتجر</th>
                                            <th>رقم المتجر</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyOrders">
                                        @foreach ($stores->where('name','!=','') as $store)
                                        @if (\Carbon\Carbon::parse($store->expiringDate)->diffInDays(\Carbon\Carbon::now())<= 10)
                                            <tr>
                                                <td>
                                                    <form action="{{url('/store/renew/'.$store->id)}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="expiringDate" value="{{$store->expiringDate}}">
                                                        <button type="submit" class="btn btn-success button-overlay mr-3">تجديد الاشتراك</button>
                                                        <label for=""> سنة</label>
                                                        <input type="radio" id="renew1" name="renew" value="12" required>
                                                        <label for="">تلاتة شهور</label>
                                                        <input type="radio" id="renew1" name="renew" value="3" required>
                                                        <label for="">شهر</label>
                                                        <input type="radio" id="renew1" name="renew" value="1" required>
                                                    </form>
                                                    
                                                </td>
                                                <td>{{\Carbon\Carbon::parse($store->expiringDate)->diffInDays(\Carbon\Carbon::now())}}</td>
                                                <td>{{$store->email}}</td>
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
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
{{-- <script>var app = @json($todayOrder,JSON_PRETTY_PRINT);</script>
<script src="{{asset('assets/js/date.js')}}"></script>
<script src="{{asset('js/dashbord/team/index.js')}}"></script> --}}
<script>

</script>
@endsection