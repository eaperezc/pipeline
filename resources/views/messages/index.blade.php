@extends('layouts.app')

@section('content')

<div class="container">

    @if ($messages->count() > 0)
        <h2 class="title">
            Pipeline {{ $pipeline->name }} messages
            <div class="pull-right">
                <a class="btn btn-primary" href="/pipeline/{{ $pipeline->id }}">Back To Pipeline Diagram</a>
            </div>
        </h2>
        <hr>

        <div class="panel panel-default">
            <div class="panel-body">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>Id</td>
                            <td>Created At</td>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($messages as $message)
                            <tr>
                                <td width="50px">{{ $message->id }}</td>
                                <td>{{ $message->created_at }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                {{ $messages->links() }}

            </div>
        </div>
    @else

        <div class="panel panel-default col-md-4 col-md-offset-4">
          <div class="panel-body" style="text-align: center;">
            <p>Yoy don't have any messages yet but it's never too late to start. Start now!</p>
          </div>
        </div>

    @endif

</div>

@endsection
