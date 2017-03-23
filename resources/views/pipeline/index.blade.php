@extends('layouts.app')

@section('content')

<div class="container">

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

</div>

@endsection
