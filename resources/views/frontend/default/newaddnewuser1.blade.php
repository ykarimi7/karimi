
@extends('index')
@section('content')
    <div id="page-content">
        <div class="container">


            @if ($message = Session::get('success'))
                <div id="sess1" class="alert alert-success alert-block">
                    <strong>{{ $message }}</strong>
                </div>
            @endif


            @if ($message1 = Session::get('unsuccess'))
                <div id="sess1" class="alert alert-success alert-block">
                    <strong>{{ $message1 }}</strong>
                </div>
            @endif


            @if ($errors->any())
                <ul>
                    <div id="sess1" class="alert alert-success alert-block">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>


                        @endforeach
                    </div>

                </ul>
            @endif



            <form   method="post" action="{{route('frontend.newedituser',$var->id)}}" enctype="multipart/form-data">

                {{csrf_field()}}

                <div class="card-body">

                    <div class="form-group  col-lg-6 col-12 ">
                        <label id="menu" for="exampleInputEmail1">Ad Soyad</label>
                        <input type="text" name="name1" class="form-control"   value="{{ $var->name }}" id="exampleInputEmail1" placeholder="name">
                    </div>
                    <div class="col-lg-3"></div>
                    <div class="form-group  col-lg-6 col-12 ">
                        <label id="menu" for="exampleInputEmail1">Şube Adı</label>
                        <input type="text" name="name" class="form-control"   value="{{ $var->username }}" id="exampleInputEmail1" placeholder="name" readonly  >
                    </div>
                    <div class="col-lg-3"></div>
                    <div class="form-group col-lg-6 col-12 ">
                        <label id="menu" for="exampleInputEmail1">E-Posta</label>
                        <input type="email" name="email" class="form-control"  value="{{ $var->email }}"  id="exampleInputEmail1" placeholder="email">
                    </div>
                    <div class="col-lg-3"></div>
                    <div class="form-group col-lg-6 col-12 ">
                        <label id="menu" for="tel">Telefon</label>
                        <input type="text" name="tel" class="form-control"   value="{{ $var->tel }}" id="exampleInputEmail1" placeholder="telfon">
                    </div>





                    <button id="send-button" class="btn btn-primary form-side__btn" type="submit">Kaydet
                        <div id="button-spinner" style="margin-left: 10px; width: 15px; height: 15px; display: none" class="spinner-border"></div>
                    </button>
                </div>
            </form>




        </div>
    </div>
@endsection