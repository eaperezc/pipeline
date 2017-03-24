@extends('layouts.app')

@section('content')

<div class="container">

    @if ($pipelines->count() > 0)
        <div class="well">
            <a href="/pipeline/create" class="btn btn-primary">Add a new Pipeline</a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Name</td>
                    <td>Created At</td>
                </tr>
            </thead>

            <tbody>

                @foreach ($pipelines as $pipeline)
                    <tr>
                        <td>{{ $pipeline->id }}</td>
                        <td><a href="/pipeline/{{ $pipeline->id }}">{{ $pipeline->name }}</a></td>
                        <td>{{ $pipeline->created_at }}</td>
                    </tr>
                @endforeach

            </tbody>

        </table>

        {{ $pipelines->links() }}

    @else

        <div class="panel panel-default col-md-4 col-md-offset-4">
          <div class="panel-body" style="text-align: center;">

            <img src="/images/light-bulb.png">
            <p>Yoy don't have any pipelines yet it's never too late to start. Start now!</p>
            <a href="/pipeline/create" class="btn btn-primary">Create your first pipeline!</a>
          </div>
        </div>

    @endif

</div>

@endsection
