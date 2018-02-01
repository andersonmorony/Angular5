@extends('layouts.ged')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-12">

                <!-- Breadcrumbs -->
                <ol class="breadcrumb">
                 <li class="breadcrumb-item active">
                 Malote
                 </li>
                 </ol>
                 @if(app('request')->input('erro') )

                    <div class="alert alert-danger" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button><strong>Erro ao cadastrar malote</strong>
                      <br><small>Malote já foi cadastrado, por favor verifique o código do dia antes de cadastrar o malote ou se o malote já foi cadastrado.</small>
                    </div>

                @endif 
                @if(app('request')->input('negado') )

                    <div class="alert alert-danger" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button><strong>Acesso Negado!</strong>
                      <br><small>- Seu usuário não possui privilégio.</small>
                    </div>

                @endif
                 @if(app('request')->input('edit') )

                    <div class="alert alert-success" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>Malote <strong>editado</strong> com sucesso!
                    </div>

                @endif
                 @if(app('request')->input('status') )

                    <div class="alert alert-info" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                       Para cadastrar um novo formulário você precisa <strong>selecionar</strong> o malote que ele pertence.<br>
                      <small>- Selecione um dos malotes já cadastrado abaixo ou cadastre um novo malote</small>
                    </div>

                @endif
                 @if(app('request')->input('deletado') )

                    <div class="alert alert-success" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>Malote <strong>Deleteado</strong> com sucesso!
                    </div>

                @endif
                 <div class="card">
                     <div class="card-body">                         
                        <a href="{{ url('/ged/malote/create') }}" class="btn btn-success btn-sm" title="Adicionar Malote">
                            Novo Malote
                        </a>
                     </div>
                 </div>
                 <br>
                <div class="card">

                    <div class="card-body">
                        <div class="table-responsive table-striped table-sm">
                            <table id="index_datatable" class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Protocolo</th>
                                        <th>Operador Interno</th>
                                        <th>Quem Entregou</th>
                                        <th>Data</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($malote as $item)
                                    <tr>
                                        <td>{{$loop->iteration or $item->id}}</td>
                                        <td>{{ $item->protocolo }}</td>

                                        @foreach($usuarios as $user)

                                            @if($user->id == $item->operador_interno)
                                                <td>{{ $user->nome }}</td>
                                            @endif
                                            
                                        @endforeach

                                        @foreach($usuarios as $user)

                                            @if($user->id == $item->quem_entregou)
                                                <td>{{ $user->nome }}</td>
                                            @endif
                                        @endforeach

                                        <td>{{ date( 'd/m/Y' , strtotime($item->dt_recebimento)) }}</td>
                                        
                                        <td>

                                            <a href="{{ url('/ged/formulario_malote/create?malote=' .$item->id) }}" title="Adicionar Formulário"><button class="btn btn-success btn-sm"> Adicionar Formulário</button></a>
                                            <a href="{{ url('/ged/malote/' . $item->id) }}" title="Listar"><button class="btn btn-primary btn-sm"> Listar</button></a>
                                            <a href="{{ url('/ged/malote/' . $item->id . '/edit') }}" title="Editar Malote"><button class="btn btn-warning btn-sm"> Editar</button></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/ged/malote', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('Apagar', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm btn-apagar',
                                                        'title' => 'Apagar Malote',
                                                        'onclick'=>'return confirm("Confirmar exclusão?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
