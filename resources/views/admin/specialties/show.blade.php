@extends('admin.layout.index')

@section('content')
    @include('admin.components.statistics')
    <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-danger modal-dialog-centered modal-10" role="document">
            <div class="modal-content bg-gradient-danger">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="py-3 text-center">
                        <i class="ni ni-bell-55 ni-3x"></i>
                        <h4 class="heading mt-4">You should read this!</h4>
                        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white">Ok, Got it</button>
                    <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Специальность</h3>
                            </div>
                            <div class="col-4 text-right">
                                <button href="#!" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-notification">Удалить</button>
                                <a href="#!" class="btn btn-sm btn-primary">Сохранить</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form>
                            <h6 class="heading-small text-muted mb-4">Информация</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="input-username">Название</label>
                                            <input type="text" id="input-username" class="form-control form-control-alternative" placeholder="Название" value="{{ $speciality->name }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
