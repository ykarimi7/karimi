@extends('index')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 border-0">
                    <span class="btn btn-primary btn-sm float-right">upload files</span>
                </div>

                <div class="card-header py-3 border-0">
                    <div id="app">
                        <FilePondGallery></FilePondGallery>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
