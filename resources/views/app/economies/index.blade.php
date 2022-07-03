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
                @can('create', App\Models\Economy::class)
                <a
                    href="{{ route('economies.create') }}"
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
                    @lang('crud.dimensi_n_presupuesto.index_title')
                </h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-right">
                                @lang('crud.dimensi_n_presupuesto.inputs.financiacion')
                            </th>
                            <th class="text-right">
                                @lang('crud.dimensi_n_presupuesto.inputs.becas_auxilio')
                            </th>
                            <th class="text-right">
                                @lang('crud.dimensi_n_presupuesto.inputs.costos_calidad')
                            </th>
                            <th class="text-right">
                                @lang('crud.dimensi_n_presupuesto.inputs.costos_manutencion')
                            </th>
                            <th class="text-right">
                                @lang('crud.dimensi_n_presupuesto.inputs.costos_parqueadero')
                            </th>
                            <th class="text-left">
                                @lang('crud.dimensi_n_presupuesto.inputs.academic_program_id')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($economies as $economy)
                        <tr>
                            <td>{{ $economy->financiacion ?? '-' }}</td>
                            <td>{{ $economy->becas_auxilio ?? '-' }}</td>
                            <td>{{ $economy->costos_calidad ?? '-' }}</td>
                            <td>{{ $economy->costos_manutencion ?? '-' }}</td>
                            <td>{{ $economy->costos_parqueadero ?? '-' }}</td>
                            <td>
                                {{ optional($economy->academicProgram)->name ??
                                '-' }}
                            </td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $economy)
                                    <a
                                        href="{{ route('economies.edit', $economy) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $economy)
                                    <a
                                        href="{{ route('economies.show', $economy) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $economy)
                                    <form
                                        action="{{ route('economies.destroy', $economy) }}"
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
                            <td colspan="7">{!! $economies->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
