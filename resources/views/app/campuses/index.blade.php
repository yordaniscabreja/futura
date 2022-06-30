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
                @can('create', App\Models\Campus::class)
                <a
                    href="{{ route('campuses.create') }}"
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
                    @lang('crud.dimensi_n_campus_universitario.index_title')
                </h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-right">
                                @lang('crud.dimensi_n_campus_universitario.inputs.conectividad')
                            </th>
                            <th class="text-right">
                                @lang('crud.dimensi_n_campus_universitario.inputs.salones')
                            </th>
                            <th class="text-right">
                                @lang('crud.dimensi_n_campus_universitario.inputs.laboratorios')
                            </th>
                            <th class="text-right">
                                @lang('crud.dimensi_n_campus_universitario.inputs.cafeterias_restaurantes')
                            </th>
                            <th class="text-right">
                                @lang('crud.dimensi_n_campus_universitario.inputs.espacios_comunes')
                            </th>
                            <th class="text-left">
                                @lang('crud.dimensi_n_campus_universitario.inputs.university_id')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($campuses as $campus)
                        <tr>
                            <td>{{ $campus->conectividad ?? '-' }}</td>
                            <td>{{ $campus->salones ?? '-' }}</td>
                            <td>{{ $campus->laboratorios ?? '-' }}</td>
                            <td>
                                {{ $campus->cafeterias_restaurantes ?? '-' }}
                            </td>
                            <td>{{ $campus->espacios_comunes ?? '-' }}</td>
                            <td>
                                {{ optional($campus->university)->name ?? '-' }}
                            </td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $campus)
                                    <a
                                        href="{{ route('campuses.edit', $campus) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $campus)
                                    <a
                                        href="{{ route('campuses.show', $campus) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $campus)
                                    <form
                                        action="{{ route('campuses.destroy', $campus) }}"
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
                            <td colspan="7">{!! $campuses->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
