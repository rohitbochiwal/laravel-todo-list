<!DOCTYPE html>
<html>
<head>
    <title>Laravel To-Do List</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"></head>
<body>
    <div class="container">
        <h1>My To-Do List</h1>

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Enter a task" required>
            <button type="submit">Add Task</button>
        </form>

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <p style="color: red;">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Show All Tasks Button -->
        <form action="{{ route('tasks.showAll') }}" method="GET" style="margin-top: 10px;">
            <button type="submit" class="btn-show-all">Show All Tasks</button>
        </form>

        <ul>
            @foreach ($tasks as $task)
                <li>
                    <div class="left">
                        @if (!$task->completed)
                            <form action="{{ route('tasks.complete', $task->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <input type="checkbox" onChange="this.form.submit()" />
                            </form>
                            <span>{{ $task->name }}</span>
                        @else
                            <input type="checkbox" checked disabled>
                            <span style="text-decoration: line-through; color: gray;">{{ $task->name }}</span>
                        @endif
                    </div>

                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this task?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>
