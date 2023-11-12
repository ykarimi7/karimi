@extends('index')
@section('content')

   <?php
       $total_users=5;
       $users=Auth()->user();

    ?>


    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 border-0">

                    <a href="#" class="btn btn-primary btn-sm float-right">Add new user</a>
                </div>
            </div>

                <table class="table table-striped datatables table-hover">
                    <colgroup>
                        <col class="span1">
                        <col class="span7">
                    </colgroup>
                    <thead>
                    <tr>
                        <th class="th-image"></th>
                        <th>Name</th>
                        <th class="desktop">Username</th>
                        <th class="desktop">Email</th>
                        <th class="desktop">Group</th>
                        <th class="desktop">Joined</th>
                        <th class="desktop">Last visited</th>
                        <th class="desktop text-center th-2action" data-toggle="tooltip" title="Number of news articles"><i class="fas fa-newspaper"></i></th>
                        <th class="desktop text-center th-2action" data-toggle="tooltip" title="Number of songs"><i class="fas fa-music"></i></th>
                        <th class="desktop text-center th-2action" data-toggle="tooltip" title="Comments"><i class="fas fa-comment fa-fw"></i></th>
                        <th class="th-2action desktop">Action</th>
                        <th class="th-checkbox">
                            <label class="engine-checkbox">
                                <input id="check-all" class="multi-check-box" type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
        </div>
    </div>


@endsection
