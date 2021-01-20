<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<div class="main-container">


<form action="https://eventoutlet.ru/dev-imports-editor" method="post">
    @csrf
<table class="table table-striped">
    @foreach($users as $user)
        <tr>
            <td>
                <a href="{{ route('site.users.show', $user->slug) }}" target="_blank">{{ $user->name }}</a>
            </td>
            <td>
                <span>{{ $user->city->name }}</span>

            </td>
            <td>
                <span>{{ $user->speciality->name }}</span>
            </td>
            <td>
                @if ($user->info->vk)
                    <a target="_blank" href="{{ $user->info->vk }}">link</a>
                @else
                    <span>нет</span>
                @endif
            </td>
            <td width="900px">
                    <textarea rows="20" name="description[{{ $user->id }}]">{{ $user->info->about_me }}</textarea>
            </td>
        </tr>
    @endforeach

</table>
    <div class="d-flex justify-content-between">
        <div class="pt-2">
            {!! $users->render() !!}
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Обновит</button>
        </div>
    </div>
</form>


</div>



<style>
    * {
        font-family: Arial, sans-serif;
        font-size: 18px;
    }
    .main-container {
        max-width: 1600px;
        margin: 0 auto;
        margin-top: 40px;
    }
    table {
        border-spacing: 0;
        width: 100%;
    }

    td {
        padding: 10px 20px;
        border-bottom: 1px solid #ccc;
    }

    textarea {
        width: 100%;
    }
</style>