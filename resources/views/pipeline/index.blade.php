@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="title">Available Pipelines</h2>
    <hr>

    @if ($pipelines->count() > 0)
        <div class="well">
            <a href="/pipeline/create" class="btn btn-primary">Add a new Pipeline</a>
        </div>

        <div class="panel panel-default">
            <div class="panel-body">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>Id</td>
                            <td style="text-align: center; width: 100px">Status</td>
                            <td>Name</td>
                            <td>Created At</td>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($pipelines as $pipeline)
                            <tr>
                                <td width="50px">{{ $pipeline->id }}</td>
                                <td style="text-align: center;">
                                    @if ($pipeline->status)
                                    <i style="color:green" class="fa fa-circle" aria-hidden="true"></i>
                                    @else
                                    <i style="color:red" class="fa fa-circle" aria-hidden="true"></i>
                                    @endif
                                 </td>
                                <td><a href="/pipeline/{{ $pipeline->id }}">{{ $pipeline->name }}</a></td>
                                <td>{{ $pipeline->created_at }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                {{ $pipelines->links() }}

            </div>
        </div>
    @else

        <div class="panel panel-default col-md-4 col-md-offset-4">
          <div class="panel-body" style="text-align: center;">

            <img src="/images/light-bulb.png">
            <p>Yoy don't have any pipelines yet but it's never too late to start. Start now!</p>
            <a href="/pipeline/create" class="btn btn-primary">Create your first pipeline!</a>
          </div>
        </div>

    @endif

</div>

@endsection
