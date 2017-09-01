@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de Usuário</h3>
            {!! Button::primary(Icon::plus().' Novo usuário')->asLinkTo(route('admin.users.create')) !!}
        </div>
        <br/>
        <div class="row">
            {!! 
            Table::withContents($users->items())
                ->hover()
                ->condensed()
                ->bordered()
                ->callback('Ações', function($field, $model){
                    $linkEdit = route('admin.users.edit', ['user' => $model->id]);
                    $linkShow = route('admin.users.show', ['user' => $model->id]);
                    return Button::link(Icon::pencil() .' Editar')->asLinkTo($linkEdit). ' | '
                          .Button::link(Icon::create('eye-open').' Ver')->asLinkTo($linkShow);
                })
            !!}
        </div>
        {!! $users->links() !!}
    </div>

@endsection