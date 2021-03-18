@extends('Dashbord/layout/master')

@section('style')

@endsection

@section('content')

<div class="content">

    @if(Session::has('message'))
    <div class="alert {{ Session::get('alert-class') }} text-center">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <i class="material-icons">x</i>
        </button>
        <p class="h4" >{{ Session::get('message') }}</p> 
    </div>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
                <i class="feather icon-info mr-1 align-middle"></i>
                <span>{{ $error }}</span>
            </div>
        @endforeach
    @endif
    <a href='{{url('/index')}}' class="button-overlay btn btn-warning text-white m-3">رجوع</a>

    <form action="{{url("/store")}}" class='text-right' method="POST" enctype="multipart/form-data" >
        @csrf
        @method('POST')

            <div class="bg-white p-3 text-center">
                <h3>معلومات الاتصال  بالمتجر</h3>
                <br>
                <div class="form-row ">
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Email</label>
                    <div class="input-group ">
                        <input type="text" class="form-control" value='{{$store->email}}' name='email' id="inlineFormInputGroup" placeholder="Email" required>
                        <div class="input-group-addon"><i class="fa fa-envelope-o" aria-hidden="true"></i></div>

                    </div> 
                </div>
                <div class="form-group col-md-6">
                    <label for="inputAddress">Database link</label>
                    <div class="input-group ">
                        <input type="text" class="form-control" value='{{$store->database_link}}' name='database_link' id="inlineFormInputGroup" placeholder="Database link" required>
                        <div class="input-group-addon"><i class="fa fa-link" aria-hidden="true"></i></div>

                    </div> 
                </div>
                </div>
                <div class="form-row ">
                    <div class="form-group col-md-6">
                    <label for="inputAddress">Id data</label>
                    <div class="input-group ">
                        <input type="text" class="form-control" value='{{$store->id_data}}' name='id_data' id="inlineFormInputGroup" placeholder="Id data" required>
                        <div class="input-group-addon"><i class="fa fa-id-card-o" aria-hidden="true"></i></div>
                    </div> 
                </div>
                    <div class="form-group col-md-6">
                    <label for="inputAddress2">Id system</label>
                    <div class="input-group ">
                        <input type="text" class="form-control" value='{{$store->id_system}}'  name='id_system' id="inlineFormInputGroup" placeholder="Id system" required>
                        <div class="input-group-addon"><i class="fa fa-id-card-o" aria-hidden="true"></i></div>
                    </div>
                </div>
                </div>
                <div class="form-row ">
                    <div class="form-group col-md-3">
                        <div class="custom-file">
                            <input type="file" name='SA0' accept="application/json" class="custom-file-input" id="validatedCustomFile"  >
                            <label class="custom-file-label" for="validatedCustomFile">Choose SA0..
                                @if (isset($store->SA0))
                                <i class="fa fa-check" aria-hidden="true"></i>
                                @else
                                <i class="fa fa-exclamation" aria-hidden="true"></i>
                                @endif
                                </label>
                        </div>
                        
                    </div>
                    <div class="form-group col-md-3">
                        <div class="custom-file">
                            <input type="file" name='SA1'accept="application/json" class="custom-file-input" id="validatedCustomFile" >
                            <label class="custom-file-label" for="validatedCustomFile">Choose SA1...
                                @if (isset($store->SA1))
                                <i class="fa fa-check" aria-hidden="true"></i>
                                @else
                                <i class="fa fa-exclamation" aria-hidden="true"></i>
                                @endif
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <div class="custom-file">
                            <input type="file" name='SA2'accept="application/json" class="custom-file-input" id="validatedCustomFile" >
                            <label class="custom-file-label" for="validatedCustomFile">Choose SA2...
                                @if (isset($store->SA2))
                                <i class="fa fa-check" aria-hidden="true"></i>
                                @else
                                <i class="fa fa-exclamation" aria-hidden="true"></i>
                                @endif
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <div class="custom-file">
                            <input type="file" name='SA3'accept="application/json" class="custom-file-input" id="validatedCustomFile" >
                            <label class="custom-file-label" for="validatedCustomFile">Choose SA3...
                                @if (isset($store->SA3))
                                <i class="fa fa-check" aria-hidden="true"></i>
                                @else
                                <i class="fa fa-exclamation" aria-hidden="true"></i>
                                @endif
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <div class="custom-file">
                            <input type="file" name='SA4'accept="application/json" class="custom-file-input" id="validatedCustomFile" >
                            <label class="custom-file-label" for="validatedCustomFile">Choose SA4...
                                @if (isset($store->SA4))
                                <i class="fa fa-check" aria-hidden="true"></i>
                                @else
                                <i class="fa fa-exclamation" aria-hidden="true"></i>
                                @endif
                            </label>
                        </div>
                    </div>
                </div>
            </div> 

        <button type="submit" class="btn btn-success mt-3">انشاء</button>
      </form>
</div>
  
@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<script>
function selectImage() {
  document.getElementById('validatedCustomFile').click();
}
$('#datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });
</script>
@endsection