@extends('voyager::master')

@section('page_title', 'Documentos')

@if(auth()->user()->hasPermission('edit_afiliados'))

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-photos"></i> Documentos
    </h1>
    <a href="#" data-toggle="modal" data-target="#modal-documento" class="btn btn-success btn-add-new">
        <i class="voyager-plus"></i> <span>Nuevo</span>
    </a>
@stop

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                @forelse ($documentos as $item)
                                    <div class="col-md-3">
                                        <div class="panel panel-bordered">
                                            <div style="position: absolute; top:5px; right:5px; z-index: 10">
                                                <button type="button" data-toggle="modal" data-target="#modal-eliminar-documento" data-id="{{ $item->id }}" class="btn btn-danger btn-delete"><span class="voyager-trash"></span></button>
                                            </div>
                                            <div class="panel-body" style="padding: 0px">
                                                <a href="{{ url('storage/'.$item->imagen) }}" class="thumbnail" data-fancybox="galeria1" data-caption="{{ $item->titulo }}">
                                                    <img src="{{ url('storage/'.str_replace('.', '-cropped.', $item->imagen)) }}"  alt="{{ $item->titulo }}" width="100%">
                                                </a>
                                            </div>
                                            <div class="panel-footer text-center">
                                                <h5>{{ $item->titulo ?? 'Sin titulo' }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <h3 class="text-center text-muted" style="margin-top: 20px"> <span class="voyager-photos"></span> No existen documentos del afiliado</h3>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  
    <!-- Modal agregar documento -->
    <form method="POST" action="{{ route('afiliados.documentos.store', ['id' => $id]) }}" enctype="multipart/form-data">
        <div class="modal fade" id="modal-documento" tabindex="-1" role="dialog" aria-labelledby="modal-documentoLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modal-documentoLabel">Nuevo documento</h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            @csrf
                            <div class="form-group">
                                <label>Titulo del documento</label>
                                <input type="text" name="titulo" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Documento</label>
                                <input type="file" name="file" class="form-control" accept="image/x-png,image/jpg,image/jpeg" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- modal delete --}}
    <form id="form-delete" method="POST">
        <div class="modal fade" id="modal-eliminar-documento" tabindex="-1" role="dialog" aria-labelledby="modal-eliminar-documentoLabel">
            <div class="modal-dialog modal-danger" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modal-eliminar-documentoLabel">Eliminar documento</h4>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="afiliado_id" value="{{ $id }}">
                        <p class="text-muted">Desea eliminar el documento de forma permanente?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-danger">Sí, eliminar!</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop

@section('css')
    <link href="{{url('plugins/fancybox/fancybox.min.css')}}" type="text/css" rel="stylesheet">
@stop

@section('javascript')
    <script src="{{url('plugins/fancybox/fancybox.min.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $('.btn-delete').click(function(){
                let id = $(this).data('id');
                let url = "{{ url('admin/afiliados/id_afiliado/documentos/destroy') }}"
                url = url.replace('id_afiliado', id)
                $('#form-delete').attr('action', url);
            });
        });
    </script>
@stop

@else
    @section('content')
        @include('layouts.error')
    @endsection
@endif
