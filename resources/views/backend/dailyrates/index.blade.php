@extends('backend.layouts.app')

@section('title') {{ __($module_action) }} {{ __($module_title) }} @endsection


@section('breadcrumbs')
<x-backend-breadcrumbs>
    <x-backend-breadcrumb-item route='{{route("backend.$module_name")}}' icon='{{ $module_icon }}'>
        {{ __($module_title) }}
    </x-backend-breadcrumb-item>

    <x-backend-breadcrumb-item type="active">{{ __($module_action) }}</x-backend-breadcrumb-item>
</x-backend-breadcrumbs>
@endsection


@section('content')
<div class="card">
    <div class="card-body">
        <x-backend.section-header>
            <i class="{{ $module_icon }}"></i> {{ __($module_title) }} <small class="text-muted">{{ __($module_action) }}</small>

            <x-slot name="subtitle">
                @lang(":module_name Management Dashboard", ['module_name'=>Str::title($module_name)])
            </x-slot>
            
        </x-backend.section-header>
        <hr>

        <div class="row mb-3">
            @foreach ($groups as $group)
            <div class="col-12 col-sm-4">
                {{ html()->form('POST', route("backend.$module_name.send"))->acceptsFiles()->class('form')->open() }}
                <div class="row mb-3">
                    <div class="col-12 col-sm-12 pb-2">
                        <div class="form-group">
                            <?php
                            $field_id = "group_id";
                            $field_name = 'group';
                            $field_lable = label_case($field_name);
                            $field_placeholder = $field_lable;
                            $required = "required";
                            ?>
                        {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
                        {{ html()->text($field_name, $group->name)->placeholder($field_placeholder)->class('form-control')->attributes(['readonly' => $required ? 'readonly' : null]) }}
                        {{ html()->hidden($field_id, $group->id)}}
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 pb-2">
                        <div class="form-group">
                            <?php
                            $field_name = 'price';
                            $field_lable = label_case($field_name);
                            $field_placeholder = $field_lable;
                            $required = "required";
                            ?>
                        {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
                        {{ html()->number($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                        </div>
                    </div>
                  
                    <div class="col-12 col-sm-12">
                        <div class="form-group">
                            @php
                                $items = $group->id;
                            @endphp
                            {{ html()->submit($text = icon('fas fa-share')." Send")->class('btn btn-success')->id($items) }}
                        </div>
                    </div>
            </div>
            {{ html()->form()->close() }}
        </div>
        @endforeach
        </div>
    </div>
    <div class="card-footer">
        <div class="row mb-3">
            <div class="col">

                <small class="float-end text-muted">
    
                </small>
            </div>
        </div>
    </div>
</div>


@endsection