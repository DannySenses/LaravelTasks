@extends( "layouts.app" )

@section( "content" )

    @include( "errors.errors" )

    @include( "includes.create-task-form" )

    <div class="mt-1 rounded-md shadow shadow-sm p-4 bg-white my-2 task-list">

        <h2 class="text-2xl font-semibold">In Progress</h2>

        <hr class="border-blue-400 my-1">

        @foreach( $incomplete_tasks as $incomplete_task )

            <div class="task" id="task-{{ $incomplete_task->id }}">

                <h3>{{ $incomplete_task->description }}</h3>

            </div>

        @endforeach

    </div>

@endsection
