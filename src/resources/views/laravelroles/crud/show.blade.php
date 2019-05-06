@extends(config('roles.bladeExtended'))

@section(config('roles.titleExtended'))
    {!! trans('laravelroles::laravelroles.titles.show-role') !!}
@endsection

@php
    switch (config('roles.bootstapVersion')) {
        case '3':
            $containerClass = 'panel';
            $containerHeaderClass = 'panel-heading';
            $containerBodyClass = 'panel-body';
            break;
        case '4':
        default:
            $containerClass = 'card';
            $containerHeaderClass = 'card-header';
            $containerBodyClass = 'card-body';
            break;
    }
    $bootstrapCardClasses = (is_null(config('roles.bootstrapCardClasses')) ? '' : config('roles.bootstrapCardClasses'));
@endphp

@section(config('roles.bladePlacementCss'))
    @if(config('roles.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('roles.datatablesCssCDN') }}">
    @endif
    @if(config('roles.enableFontAwesomeCDN'))
        <link rel="stylesheet" type="text/css" href="{{ config('roles.fontAwesomeCDN') }}">
    @endif
    @include('laravelroles::laravelroles.partials.styles')
    @include('laravelroles::laravelroles.partials.bs-visibility-css')
@endsection

@section('content')

    @include('laravelroles::laravelroles.partials.flash-messages')

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-10 offset-lg-1">
                <div class="{{ $containerClass }} {{ $bootstrapCardClasses }}">
                    <div class="{{ $containerHeaderClass }}">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                @isset($typeDeleted)

                                    {!! trans('laravelroles::laravelroles.titles.show-role-deleted', ['name' => $item->name]) !!}

                                @else

                                    {!! trans('laravelroles::laravelroles.titles.show-role', ['name' => $item->name]) !!}

                                @endisset
                            </span>
                            <div class="pull-right">
                                @isset($typeDeleted)
                                    <a href="" class="btn btn-outline-danger btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('laravelroles::laravelroles.tooltips.back-roles-deleted') }}">
                                        <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                        {!! trans('laravelroles::laravelroles.buttons.back-to-roles-deleted') !!}
                                    </a>
                                @else
                                    <a href="{{ route('laravelroles::roles.index') }}" class="btn btn-outline-secondary btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('laravelroles::laravelroles.tooltips.back-roles') }}">
                                        <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                        {!! trans('laravelroles::laravelroles.buttons.back-to-roles') !!}
                                    </a>
                                @endisset
                            </div>
                        </div>
                    </div>
                    <div class="{{ $containerBodyClass }}">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {!! trans('laravelroles::laravelroles.cards.role-info-card.role-id') !!}
                                <span class="badge badge-pill">
                                    {{ $item->id }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {!! trans('laravelroles::laravelroles.cards.role-info-card.role-name') !!}
                                <span class="badge badge-pill">
                                    {{ $item->name }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {!! trans('laravelroles::laravelroles.cards.role-info-card.role-desc') !!}
                                <span class="badge badge-pill">
                                    @if($item->desc)
                                        {{ $item->desc }}
                                    @else
                                        <span class="text-muted">
                                            {!! trans('laravelroles::laravelroles.cards.role-info-card.none') !!}
                                        </span>
                                    @endif
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {!! trans('laravelroles::laravelroles.cards.role-info-card.role-level') !!}
                                <span class="badge badge-pill">
                                    @if($item->level)
                                        {{ $item->level }}
                                    @else
                                        <span class="text-muted">
                                            {!! trans('laravelroles::laravelroles.cards.role-info-card.none') !!}
                                        </span>
                                    @endif
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {!! trans('laravelroles::laravelroles.cards.role-info-card.role-permissons') !!}
                                @if($item['permissions']->count() > 0)
                                    <div>
                                        @foreach($item['permissions'] as $itemUserKey => $itemUser)
                                            <span class="badge badge-pill badge-primary float-right">
                                                {{ $itemUser->name }}
                                            </span>
                                            <br />
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-muted">
                                        {!! trans('laravelroles::laravelroles.cards.none-count') !!}
                                    </span>
                                @endif
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {!! trans('laravelroles::laravelroles.cards.role-info-card.created') !!}
                                <span class="badge badge-pill">
                                    {!! $item->created_at->format('m/d/Y H:ia') !!}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {!! trans('laravelroles::laravelroles.cards.role-info-card.updated') !!}
                                <span class="badge badge-pill">
                                    {!! $item->updated_at->format('m/d/Y H:ia') !!}
                                </span>
                            </li>
                            @if ($item->deleted_at)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {!! trans('laravelroles::laravelroles.cards.role-info-card.deleted') !!}
                                    <span class="badge badge-pill">
                                        {!! $item->deleted_at->format('m/d/Y H:ia') !!}
                                    </span>
                                </li>
                            @endif
                        </ul>
                        <div class="row">
                            <div class="col-sm-6 mt-3">
                                @isset($typeDeleted)

                                    // TODO

                                @else
                                    <a class="btn btn-sm btn-secondary btn-block text-white mb-0" href="{{ route('laravelroles::roles.edit', $item->id) }}" data-toggle="tooltip" title="{{ trans("laravelroles::laravelroles.tooltips.edit-role") }}">
                                        {!! trans("laravelroles::laravelroles.buttons.edit-larger") !!}
                                    </a>
                                @endisset
                            </div>
                            <div class="col-sm-6 mt-3">
                                @isset($typeDeleted)

                                    // TODO

                                @else
                                    {{-- @include('laravelroles::forms.delete-item') --}}
                                     @include('laravelroles::laravelroles.forms.delete-sm', ['type' => 'Role' ,'item' => $item, 'large' => true])
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        @include('laravelroles::laravelroles.modals.confirm-modal',[
            'formTrigger' => 'confirmRestore',
            'modalClass' => 'success',
            'actionBtnIcon' => 'fa-check'
        ])

        @include('laravelroles::laravelroles.modals.confirm-modal',[
            'formTrigger' => 'confirmDelete',
            'modalClass' => 'danger',
            'actionBtnIcon' => 'fa-trash-o'
        ])

@endsection

@section(config('roles.bladePlacementJs'))
    @if(config('roles.enablejQueryCDN'))
        <script type="text/javascript" src="{{ config('roles.JQueryCDN') }}"></script>
    @endif
    @include('laravelroles::laravelroles.scripts.confirm-modal', ['formTrigger' => '#confirmDelete'])
    @if (config('roles.enabledDatatablesJs'))
        @include('laravelroles::laravelroles.scripts.datatables')
    @endif
    @if(config('roles.tooltipsEnabled'))
        @include('laravelroles::laravelroles.scripts.tooltips')
    @endif
@endsection

@yield('inline_template_linked_css')
@yield('inline_footer_scripts')