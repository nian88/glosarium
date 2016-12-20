@extends('backpack::layout')

@section('header')
    <section class="content-header">
      <h1>
        @lang('category.title')
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li>
            <a href="{{ route('admin.word.index') }}">
                @lang('word.index')
            </a>
        </li>
        <li class="active">@lang('category.index')</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">{{ $title }}</div>
                </div>

                <div class="panel-body">

                    @if ($categories->total() >= 1)
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <th>@lang('category.field.slug')</th>
                                <th>@lang('category.field.name')</th>
                                <th>@lang('category.field.updated')</th>
                                <th class="text-right">@lang('category.field.actions')</th>
                            </thead>

                            <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        <a href="#" class="name" data-type="text" data-pk="{{ $category->id }}" data-name="name" data-value="{{ $category->name }}">
                                            {{ $category->name }}
                                        </a>
                                    </td>
                                    <td class="updated-{{ $category->id }}">{{ $category->updated_at->format(config('backpack.base.default_datetime_format')) }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('word.category.show', [$category->slug]) }}" target="_blank" class="btn btn-default btn-xs">
                                            <i class="fa fa-search fa-fw"></i>
                                        </a>

                                        <a href="{{ route('admin.category.edit', [$category->id]) }}" class="btn btn-primary btn-xs">
                                            <i class="fa fa-edit fa-fw"></i>
                                        </a>

                                        <a href="{{ route('admin.category.destroy', [$category->id]) }}" class="btn btn-danger btn-xs">
                                            <i class="fa fa-trash fa-fw"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                        <div class="alert alert-info">
                            Hasil pencarian tidak ditemukan atau belum ada kata yang disimpan.
                        </div>
                    @endif

                    {{ $categories->appends(['query' => request('query')])->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after_css')
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
@endpush

@push('after_script')
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

    <script>
        $(document).ready(function(){
            $.fn.editable.defaults.ajaxOptions = {type: "PUT"};

            $('.name').editable({
                url: '{{ route('admin.category.updateable') }}',
                emptytext: '{{ trans('category.field.empty') }}',
                success: function(response, value){
                    if (response.isSuccess == true) {
                        $('td.updated-' + response.data.id).text(response.data.updated)
                    }
                    else {
                        alert(response.message);
                    }
                }
            })
        })
    </script>
@endpush
