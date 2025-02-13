<div class="col-md-12">
    <div class="table-responsive">
        <table id="dataTable" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th style="text-align: center">Detalles</th>
                    <th style="text-align: center">Año</th>                    
                    <th style="text-align: center">Color</th>
                    <th style="text-align: center">Modelo</th>
                    <th style="text-align: center">Marca</th>
                    <th style="text-align: center">Capacidad</th>
                    <th style="text-align: center">Estado</th>
                    <th class="text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>
                        <table>
                            @php
                                $image = asset('image/default.png');
                                if($item->image){
                                    $image = asset('storage/'.str_replace('.', '-cropped.', $item->image));
                                }
                                $now = \Carbon\Carbon::now();
                            @endphp
                            <tr>
                                <td rowspan="3"><img src="{{ $image }}" alt="{{ $item->numberChassis }} " style="width: 60px; height: 60px; border-radius: 30px; margin-right: 10px"></td>
                                <td>
                                    Nº de placa / Registro: {{ $item->numberRegistration?strtoupper($item->numberRegistration):'SN' }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Nº de Motor: {{ $item->numberEngine?strtoupper($item->numberEngine):'SN' }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Nº de Chasis: {{ $item->numberChassis?strtoupper($item->numberChassis):'SN' }}
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td>{{ date('Y', strtotime($item->year)) }} </td>
                    <td>{{ $item->color?$item->color:'SN' }}</td>
                    <td>{{ $item->model?$item->model:'SN' }}</td>
                    <td>{{ $item->brand?$item->brand:'SN' }}</td>
                    <td>{{ $item->ability?$item->ability.' Asientos':'SN' }}</td>
                    <td style="text-align: center">
                        @if ($item->status==1)  
                            <label class="label label-success">Activo</label>
                        @else
                            <label class="label label-warning">Inactivo</label>
                        @endif

                        
                    </td>
                    <td class="no-sort no-click bread-actions text-right">
                        @if (auth()->user()->hasPermission('read_vehicles'))
                            <a href="{{ route('voyager.vehicles.show', ['id' => $item->id]) }}" title="Ver" class="btn btn-sm btn-warning view">
                                <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                            </a>
                        @endif
                        @if (auth()->user()->hasPermission('edit_vehicles'))
                            <a href="{{ route('voyager.vehicles.edit', ['id' => $item->id]) }}" title="Editar" class="btn btn-sm btn-primary edit">
                                <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Editar</span>
                            </a>
                        @endif
                        @if (auth()->user()->hasPermission('delete_vehicles'))
                            <a href="#" onclick="destroyItem('{{ route('voyager.vehicles.destroy', ['id' => $item->id]) }}')" title="Eliminar" data-toggle="modal" data-target="#destroy-modal" class="btn btn-sm btn-danger delete">
                                <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Eliminar</span>
                            </a>
                        @endif
                    </td>
                </tr>
                @empty
                    <tr style="text-align: center">
                        <td colspan="7" class="dataTables_empty">No hay datos disponibles en la tabla</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="col-md-12">
    <div class="col-md-4" style="overflow-x:auto">
        @if(count($data)>0)
            <p class="text-muted">Mostrando del {{$data->firstItem()}} al {{$data->lastItem()}} de {{$data->total()}} registros.</p>
        @endif
    </div>
    <div class="col-md-8" style="overflow-x:auto">
        <nav class="text-right">
            {{ $data->links() }}
        </nav>
    </div>
</div>

<script>
   
   var page = "{{ request('page') }}";
    $(document).ready(function(){
        $('.page-link').click(function(e){
            e.preventDefault();
            let link = $(this).attr('href');
            if(link){
                page = link.split('=')[1];
                list(page);
            }
        });
    });
</script>