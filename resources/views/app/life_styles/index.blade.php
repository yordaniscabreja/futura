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
                @can('create', App\Models\LifeStyle::class)
                <a
                    href="{{ route('life-styles.create') }}"
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
                    @lang('crud.dimensi_n_estilos_de_vida.index_title')
                </h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-right">
                                @lang('crud.dimensi_n_estilos_de_vida.inputs.ambiente')
                            </th>
                            <th class="text-right">
                                @lang('crud.dimensi_n_estilos_de_vida.inputs.diversion_ocio')
                            </th>
                            <th class="text-right">
                                @lang('crud.dimensi_n_estilos_de_vida.inputs.descanso_relax')
                            </th>
                            <th class="text-right">
                                @lang('crud.dimensi_n_estilos_de_vida.inputs.cultura_ecologica')
                            </th>
                            <th class="text-right">
                                @lang('crud.dimensi_n_estilos_de_vida.inputs.servicio_estudiante')
                            </th>
                            <th class="text-left">
                                @lang('crud.dimensi_n_estilos_de_vida.inputs.academic_program_id')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lifeStyles as $lifeStyle)
                        <tr>
                            <td>{{ $lifeStyle->ambiente ?? '-' }}</td>
                            <td>{{ $lifeStyle->diversion_ocio ?? '-' }}</td>
                            <td>{{ $lifeStyle->descanso_relax ?? '-' }}</td>
                            <td>{{ $lifeStyle->cultura_ecologica ?? '-' }}</td>
                            <td>
                                {{ $lifeStyle->servicio_estudiante ?? '-' }}
                            </td>
                            <td>
                                {{ optional($lifeStyle->academicProgram)->name
                                ?? '-' }}
                            </td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $lifeStyle)
                                    <a
                                        href="{{ route('life-styles.edit', $lifeStyle) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $lifeStyle)
                                    <a
                                        href="{{ route('life-styles.show', $lifeStyle) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $lifeStyle)
                                    <form
                                        action="{{ route('life-styles.destroy', $lifeStyle) }}"
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
                            <td colspan="7">{!! $lifeStyles->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
