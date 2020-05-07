@extends('layouts.app')

@section('body')
    <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="{!! route('categorias.index') !!}">Categoria</a>
          </li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
    <div class="container-fluid">
         <div class="animated fadeIn">
             @include('coreui-templates::common.errors')
             <div class="row">
                 <div class="col-lg-12">
                      <div class="card">
                          <div class="card-header">
                              <i class="fa fa-edit fa-lg"></i>
                              <strong>Edit Categoria</strong>
                          </div>
                          <div class="card-body">
                              {!! Form::model($categoria, ['route' => ['categorias.update', $categoria->id], 'method' => 'patch']) !!}

                              @include('categorias.fields')

                              {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
         </div>
    </div>
@endsection