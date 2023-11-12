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



                  <form  id="formProcess" method="post" action="{{url('/newaddnewuser')}}" enctype="multipart/form-data">

                        {{csrf_field()}}                <div class="page-header ">
                              <h1 > <span style="margin-left: 30%" data-translate-text="Muşteri Ekleme Formu">Muşteri Ekleme Formu</span></h1>
                        </div>
                        <div id="column1" class="full settings">

                              <div class="content row">

                                    <div class="col-lg-3 col-12"></div>
                                    <div class=" col-lg-6 col-12">
                                          <div class="form-control">
                                                <label class="control-label" for="name"  placeholder="Name"  value="{{ old('name') }}" data-translate-text="FORM_NAME">{{ __('web.FORM_NAME') }}</label>
                                                <input  name="name" maxlength="175"  type="text" required>
                                          </div>
                                    </div>

                              </div>


                              <div class="content row">
                                    <div class="col-lg-3 col-12"></div>
                                    <div class=" col-lg-6 col-12">
                                          <div class="form-control">
                                                <label class="control-label" for="email"  placeholder="Email"   value="{{ old('email') }}" data-translate-text="Email">Email</label>
                                                <input  name="email" maxlength="175"  type="email" required>
                                          </div>
                                    </div>

                              </div>
                              <div class="content row">
                                    <div class="col-lg-3 col-12"></div>
                                    <div class=" col-lg-6 col-12">
                                          <div class="form-control">
                                                <label class="control-label" for="tel" placeholder="Telfon"  value="{{ old('tel') }}" data-translate-text="Telfon">Telfon</label>
                                                <input class="span4" name="tel" maxlength="175"  type="text" required>
                                          </div>
                                    </div>

                              </div>

                              <div class="content row">
                                    <div class="col-lg-3 col-12"></div>
                                    <div class=" col-lg-6 col-12">
                                          <div class="form-control">
                                                <label class="control-label" for="password"  placeholder="Şifre"  data-translate-text="Şifre">Şifre</label>
                                                <input class="span4" name="password" maxlength="175"    type="password" required>
                                          </div>
                                    </div>

                              </div>

                              <div class="content row">
                                    <div class="col-lg-3 col-12"></div>
                                    <div class=" col-lg-6 col-12">
                                          <div class="form-control">
                                                <label class="control-label" for="re-password"  placeholder="Şifre Tekrari"   data-translate-text="Şifre Tekrari">Şifre Tekrari</label>
                                                <input class="span4" name="repassword" maxlength="175"    type="password" required>
                                          </div>
                                    </div>

                              </div>


                              <button id="send-button" class="btn btn-primary form-side__btn" type="submit">Kaydet
                                    <div id="button-spinner" style="margin-left: 10px; width: 15px; height: 15px; display: none" ></div>
                              </button>


                        </div>

                  </form>
            </div>
      </div>
@endsection