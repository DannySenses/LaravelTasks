@extends( "layouts.app" )

@section( "content" )

    @include( "errors.errors" )

    @include( "includes.create-task-form" )

    <div class="mt-1 rounded-md shadow shadow-sm p-4 bg-white my-2 task-list incomplete-tasks">

        <h2 class="text-2xl font-semibold">In Progress</h2>

        <hr class="border-blue-400 my-1">

        @if( $incomplete_tasks->count() > 0 )

            @foreach( $incomplete_tasks as $incomplete_task )

                <div class="task" id="task-{{ $incomplete_task->id }}">

                    <h3>{{ $incomplete_task->description }}</h3>

                </div>

            @endforeach

        @else

            <div class="text-center px-8 py-5">

                <p><strong>You've got no tasks in progress, go you! Add a new task - or take the rest of the day off!</strong></p>

            </div>

        @endif

    </div>

    <div class="mt-1 rounded-md shadow shadow-sm p-4 bg-white my-2 task-list completed-tasks">

        <h2 class="text-2xl font-semibold">Completed Tasks</h2>

        <hr class="border-blue-400 my-1">

    </div>

@endsection
