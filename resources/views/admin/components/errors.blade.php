
@if ($errors)
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            @if(count($errors))
                @foreach(\Illuminate\Support\Arr::collapse($errors->getMessages()) as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="alert-inner--icon"><i class="ni ni-air-baloon"></i></span>
                        <span class="alert-inner--text"><strong>Ошибка!</strong> {{ $error }}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endif
