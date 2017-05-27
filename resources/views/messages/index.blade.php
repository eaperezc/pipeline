@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="title">
        Pipeline <b>{{ $pipeline->name }}</b> messages
        <div class="pull-right">
            <a class="btn btn-link" href="/pipeline/{{ $pipeline->id }}"><i class="fa fa-angle-left"></i> Back To Diagram</a>
        </div>
    </h2>
    <hr>

    @if ($messages->count() > 0)


    <div class="row">

        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">Messages</div>
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
                                    <td><a href="#">{{ $message->created_at }}</a></td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    {{ $messages->links() }}

                </div>
            </div>
        </div>


        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">History</div>
                <div class="panel-body">

                    <table class="table">
                        <tbody>

                            <tr class="danger">
                                <td style="width: 50px;text-align: center;">
                                <i class="fa fa-times-circle text-danger"></i></td>
                                <td>An error occured. Please review and retry node</td>
                            </tr>

                            <tr>
                                <td style="text-align: center;">
                                <i class="fa fa-facebook-square"></i></td>
                                <td>Something was Posted on facebook</td>
                            </tr>

                            <tr>
                                <td style="text-align: center;">
                                <i class="fa fa-clock-o"></i></td>
                                <td>Wait for 5 minutes</td>
                            </tr>

                            <tr class="warning">
                                <td style="text-align: center;">
                                <i class="fa fa-exclamation-triangle text-warning"></i></td>
                                <td>The system retried the node. After trying again the result was the following: An email was sent. This is a big message to test how a long text looks on the grid</td>
                            </tr>

                            <tr>
                                <td style="text-align: center;">
                                <i class="fa fa-envelope-o"></i></td>
                                <td>An email was sent</td>
                            </tr>

                            <tr>
                                <td style="text-align: center;">
                                <i class="fa fa-lightbulb-o"></i></td>
                                <td>The message was sent to the pipeline</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
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
