<form action="/create-task" method="POST" class="my-2">

    @csrf

    <div class="mt-1 rounded-md shadow shadow-sm p-4 bg-white my-2">

        <h1 class="text-2xl font-semibold">Add a new Task</h1>

        <input type="text" name="task_description" id="task_description" placeholder="Task description" class="border-gray-300 bg-gray-100 p-2 my-2 rounded-md" style="width: 100%;" />

        <div class="text-right my-1">

            <button type="submit" class="btn btn-blue">Add Task</button>

        </div>

    </div>

</form>
