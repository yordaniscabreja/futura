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
                @can('create', App\Models\Wellness::class)
                <a
                    href="{{ route('wellnesses.create') }}"
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
                    @lang('crud.dimensi_n_bienestar.index_title')
                </h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-right">
                                @lang('crud.dimensi_n_bienestar.inputs.orientacion_psicologia')
                            </th>
                            <th class="text-right">
                                @lang('crud.dimensi_n_bienestar.inputs.actividades_deportivas')
                            </th>
                            <th class="text-right">
                                @lang('crud.dimensi_n_bienestar.inputs.actividades_culturales')
                            </th>
                            <th class="text-right">
                                @lang('crud.dimensi_n_bienestar.inputs.plan_covid19')
                            </th>
                            <th class="text-right">
                                @lang('crud.dimensi_n_bienestar.inputs.felicidad_entorno')
                            </th>
                            <th class="text-left">
                                @lang('crud.dimensi_n_bienestar.inputs.academic_program_id')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($wellnesses as $wellness)
                        <tr>
                            <td>
                                {{ $wellness->orientacion_psicologia ?? '-' }}
                            </td>
                            <td>
                                {{ $wellness->actividades_deportivas ?? '-' }}
                            </td>
                            <td>
                                {{ $wellness->actividades_culturales ?? '-' }}
                            </td>
                            <td>{{ $wellness->plan_covid19 ?? '-' }}</td>
                            <td>{{ $wellness->felicidad_entorno ?? '-' }}</td>
                            <td>
                                {{ optional($wellness->academicProgram)->name ??
                                '-' }}
                            </td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $wellness)
                                    <a
                                        href="{{ route('wellnesses.edit', $wellness) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $wellness)
                                    <a
                                        href="{{ route('wellnesses.show', $wellness) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $wellness)
                                    <form
                                        action="{{ route('wellnesses.destroy', $wellness) }}"
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
                            <td colspan="7">{!! $wellnesses->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
