@extends('index')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 border-0">

                    <a href="{{ route('frontend.files.multiple.uploads.create') }}" class="btn btn-primary btn-sm float-right">upload files</a>
                </div>
            </div>


            <form method="post" action="#" enctype="multipart/form-data">

                {{ csrf_field() }}


                <div class="row">

                    <div class="  form-group  col-lg-6 col-6 ">
                    </div>
                    <div class="  form-group  col-lg-2 col-6 ">
                        <label for="exampleInputEmail1">Date1</label>
                        <input type="date" name="date1" class="form-control" id="exampleInputEmail1"
                               placeholder="date1">
                    </div>
                    <div class=" form-group  col-lg-2 col-6 ">

                        <label for="exampleInputEmail1">Date2</label>
                        <input type="date" name="date2" class="form-control" id="exampleInputEmail1"
                               placeholder="date1">

                    </div>
                    <div class="col-lg-2 col-6 ">
                        <button style="margin-top: 25px;" class="btn btn-primary " type="submit">Ara
                            <div id="button-spinner" style="margin-left: 10px; width: 15px; height: 15px; display: none"
                                 class=""></div>
                        </button>
                    </div>

                </div>



            </form>

            <table class="table table-striped datatables table-hover">
                <colgroup>
                    <col class="span1">
                    <col class="span7">
                </colgroup>
                <thead class="thead-dark">
                <tr>
                    <th class="desktop">Head 1</th>
                    <th class="desktop">Head 2</th>
                    <th class="desktop">Head 3</th>
                    <th class="desktop">Head 4</th>
                    <th class="desktop">Head 5</th>
                    <th class="desktop">Head 6</th>
                    <th class="th-2action desktop">Head 7</th>
                    <th class="th-checkbox">
                        <label class="engine-checkbox">
                            <input id="check-all" class="multi-check-box" type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                    </th>
                </tr>
                </thead>
                <tbody>

                <tr>
                    <td style="align-content: center">hbeythtyhtyhty</td>
                    <td style="align-content: center">hbeythtyhtyhty</td>
                    <td style="align-content: center">hbeythtyhtyhty</td>
                    <td style="align-content: center">hbeythtyhtyhty</td>
                    <td style="align-content: center">hbeythtyhtyhty</td>
                    <td style="align-content: center">hbeythtyhtyhty</td>
                    <td>
                        <form method="POST" action="#" style="display: contents;">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="confirm-button">
                                <svg style="color:red" xmlns="http://www.w3.org/2000/svg" width="16"
                                     height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                    <path fill-rule="evenodd"
                                          d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                </svg>
                            </button>

                        </form>

                        <a style="color:#0b2e13" href="#">
                            <svg width="24" stroke-width="1.5" height="16" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                        d="M20 12V5.74853C20 5.5894 19.9368 5.43679 19.8243 5.32426L16.6757 2.17574C16.5632 2.06321 16.4106 2 16.2515 2H4.6C4.26863 2 4 2.26863 4 2.6V21.4C4 21.7314 4.26863 22 4.6 22H11"
                                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M8 10H16M8 6H12M8 14H11" stroke="currentColor" stroke-linecap="round"
                                      stroke-linejoin="round" />
                                <path
                                        d="M16 5.4V2.35355C16 2.15829 16.1583 2 16.3536 2C16.4473 2 16.5372 2.03725 16.6036 2.10355L19.8964 5.39645C19.9628 5.46275 20 5.55268 20 5.64645C20 5.84171 19.8417 6 19.6464 6H16.6C16.2686 6 16 5.73137 16 5.4Z"
                                        fill="currentColor" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                <path
                                        d="M17.9541 16.9394L18.9541 15.9394C19.392 15.5015 20.102 15.5015 20.5399 15.9394V15.9394C20.9778 16.3773 20.9778 17.0873 20.5399 17.5252L19.5399 18.5252M17.9541 16.9394L14.963 19.9305C14.8131 20.0804 14.7147 20.2741 14.6821 20.4835L14.4394 22.0399L15.9957 21.7973C16.2052 21.7646 16.3988 21.6662 16.5487 21.5163L19.5399 18.5252M17.9541 16.9394L19.5399 18.5252"
                                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>

                    </td>

                </tr>

                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')

@endsection
