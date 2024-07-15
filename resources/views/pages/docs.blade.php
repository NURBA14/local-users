@extends('layout.layout')

@section('title', 'Code docs')
@section('page.title', 'Code docs')
@section('page.name', 'Code docs')


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Basic Table</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Code</th>
                                <th>Method</th>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($data)
                                @foreach ($data as $row)
                                    <tr>
                                        <td>{{ $row->id }}</td>
                                        <td>{{ $row->code }}</td>
                                        <td>{{ $row->method }}</td>
                                        <td>{{ $row->name }}</td>
                                    </tr>
                                @endforeach
                            @endisset
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
