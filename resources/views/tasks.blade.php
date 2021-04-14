@extends( "layouts.app" )

@section( "content" )

    @include( "errors.errors" )

    @include( "includes.create-task-form" )

    <div class="mt-1 rounded-md shadow shadow-sm p-4 bg-white my-2 task-list incomplete-tasks">

        <h2>In Progress</h2>

        <hr>

        @if( $incomplete_tasks->count() > 0 )

            @foreach( $incomplete_tasks as $incomplete_task )

                <div class="task" id="task-{{ $incomplete_task->id }}">

                    <h3>{{ $incomplete_task->description }}</h3>

                </div>

            @endforeach

        @else

            <div class="no-tasks">

                <p><strong>You've got no tasks in progress, go you! Assign or add a new task - or take the rest of the day off!</strong></p>

            </div>

        @endif

    </div>

    <div class="mt-1 rounded-md shadow shadow-sm p-4 bg-white my-2 task-list next-tasks">

        <h2>Up Next</h2>

        <hr>

        <div class="no-tasks">

            <p><strong>You've got no tasks in progress, go you! Add a new task - or take the rest of the day off!</strong></p>

        </div>

    </div>

    <div class="mt-1 rounded-md shadow shadow-sm p-4 bg-white my-2 task-list completed-tasks">

        <h2>Completed Tasks</h2>

        <hr>

        <div class="no-tasks">

            <p><strong>You haven't completed any tasks yet!</strong></p>

        </div>

    </div>

@endsection
