<!-- resources/views/upload-filepond.blade.php -->

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
                        <filepond-gallery></filepond-gallery>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="{{ mix('js/app.js') }}"></script>
@endsection
