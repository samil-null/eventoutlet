<div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-10" role="document">
        <div class="modal-content bg-gradient-danger">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-notification">Удаление записи</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-3 text-center">
                    <i class="ni ni-bell-55 ni-3x"></i>
                    <h4 class="heading mt-4">Удалить запись?</h4>
                    <p>Она будет удалена безвозвратно!</p>
                </div>
            </div>
            <form class="modal-footer" action="{{ $route }}" method="post">
                {{ method_field('delete') }}
                @csrf
                <button type="submit" class="btn btn-white">Удалить</button>
                <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Закрыть</button>
            </form>
        </div>
    </div>
</div>