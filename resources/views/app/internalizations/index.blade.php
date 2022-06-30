@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row">
            <div class="col-md-6">
                <form>
                    <div class="input-group">
                        <input
                            id="indexSearch"
                            type="text"
                            name="search"
                            placeholder="{{ __('crud.common.search') }}"
                            value="{{ $search ?? '' }}"
                            class="form-control"
                            autocomplete="off"
                        />
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">
                                <i class="icon ion-md-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-right">
                @can('create', App\Models\Internalization::class)
                <a
                    href="{{ route('internalizations.create') }}"
                    class="btn btn-primary"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">
                    @lang('crud.dimensi_n_internacionalizaci_n.index_title')
                </h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-right">
                                @lang('crud.dimensi_n_internacionalizaci_n.inputs.intercambios_movilidad')
                            </th>
                            <th class="text-right">
                                @lang('crud.dimensi_n_internacionalizaci_n.inputs.facilidad_acceso')
                            </th>
                            <th class="text-right">
                                @lang('crud.dimensi_n_internacionalizaci_n.inputs.relevancia_internacional')
                            </th>
                            <th class="text-right">
                                @lang('crud.dimensi_n_internacionalizaci_n.inputs.convenios_internacionales')
                            </th>
                            <th class="text-right">
                                @lang('crud.dimensi_n_internacionalizaci_n.inputs.segundo_idioma')
                            </th>
                            <th class="text-left">
                                @lang('crud.dimensi_n_internacionalizaci_n.inputs.university_id')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($internalizations as $internalization)
                        <tr>
                            <td>
                                {{ $internalization->intercambios_movilidad ??
                                '-' }}
                            </td>
                            <td>
                                {{ $internalization->facilidad_acceso ?? '-' }}
                            </td>
                            <td>
                                {{ $internalization->relevancia_internacional ??
                                '-' }}
                            </td>
                            <td>
                                {{ $internalization->convenios_internacionales
                                ?? '-' }}
                            </td>
                            <td>
                                {{ $internalization->segundo_idioma ?? '-' }}
                            </td>
                            <td>
                                {{ optional($internalization->university)->name
                                ?? '-' }}
                            </td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $internalization)
                                    <a
                                        href="{{ route('internalizations.edit', $internalization) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $internalization)
                                    <a
                                        href="{{ route('internalizations.show', $internalization) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $internalization)
                                    <form
                                        action="{{ route('internalizations.destroy', $internalization) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-light text-danger"
                                        >
                                            <i class="icon ion-md-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">
                                {!! $internalizations->render() !!}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
