<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <title>Document</title>
</head>
<body>
<div class="container text-center mt-5">
    <div class="justify-content-center ">

        <h1>Добавить задачу</h1>
        <div class="d-flex justify-content-center ">
            <form action="{{ route('todo.add')}}" method="post">
                @csrf
                <input style="width: 400px" type="text" name="name" class=" form-control m-4 "
                       placeholder="напишите ваши цели на сегодня...">
                <input type="submit" class="btn btn-primary" value="Добавить задачу">
            </form>
        </div>
        <table class="table table-borderless">
            @foreach( $todos as $todo)
                <tbody >
                <tr>
                    <td class=""><p class="fs-3 todo-text">{{ $todo->name }}</p></td>
                    <td>
                        <form action="{{ route('todo.ready') }}" method="post">
                            @csrf
                            <input type="hidden" name="task_id" value="{{ $todo->id }}">
                            <button type="submit" class="ready-task btn btn-success"
                                    data-task-id="{{ $todo->id }}">сделано</button>
                        </form>

                    </td>
                    <td>
                        <form action="{{ route('todo.delete', ['id' => $todo->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Удалить</button>
                        </form>

                    </td>
                </tr>
                </tbody>
            @endforeach
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ready-task').on('click', function (e) {
            e.preventDefault();
            var taskId = $(this).data('task-id');
            var $thisButton = $(this);

            $.ajax({
                url: '/todo-ready',
                method: 'POST',
                data: {
                    task_id: taskId,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.success) {
                        $thisButton.closest('tr').find('.todo-text').addClass('text-decoration-line-through');
                    }
                },
                error: function () {
                    $('#message').text('An error occurred. Please try again later.').css('color', 'red');
                }
            });
        });
    });

</script>
</body>


</html>
