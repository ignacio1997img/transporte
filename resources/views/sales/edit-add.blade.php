@extends('voyager::master')

@section('page_title', 'Añadir Venta')

@section('page_header')
    <h1 class="page-title">
        <i class="fa-solid fa-ticket-alt"></i>
        Añadir Venta Pasajes y Encomiendas
    </h1>
@stop

@section('content')
    @php
        // $cashier = App\Models\Cashier::where('user_id', Auth::user()->id)->where('status', 'abierta')->first();
    @endphp
    <div class="page-content edit-add container-fluid">
        <form id="form-sale" action="{{ route('sales.store') }}" method="post">
            @csrf
            {{-- <input type="hidden" name="cashier_id" value="{{ $cashier ? $cashier->id : null }}"> --}}
            <div class="row">
                @if (setting('ventas.cashier_required') && !$cashier)
                    <div class="col-md-12" style="margin-bottom: 5px">
                        <div class="panel panel-bordered" style="border-left: 5px solid #CB4335">
                            <div class="panel-body" style="padding: 10px">
                                <div class="col-md-12">
                                    <h5 class="text-danger">Advertencia</h5>
                                    <h4>Debe abrir caja antes de registrar ventas. &nbsp; <a href="{{ route('cashiers.create') }}?redirect=admin/sales/create" class="btn btn-success">Abrir ahora <i class="voyager-plus"></i></a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-md-8">
                    <div class="panel panel-bordered">
                        <div class="panel-body" style="padding: 10px 0px">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="product_id">Buscar producto</label>
                                    <div class="input-group">
                                        <select class="form-control" id="select-product_id"></select>
                                        <div class="input-group-btn">
                                            <button class="btn btn-success" id="btn-add-service" type="button" style="margin-top: -1px;">
                                                <i class="glyphicon glyphicon-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" style="height: 300px; max-height: 300px; overflow-y: auto">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width: 30px">N&deg;</th>
                                                <th>Detalles</th>
                                                <th style="min-width: 100px">Precio</th>
                                                <th style="min-width: 100px">Cantidad</th>
                                                <th style="min-width: 100px" class="text-right">Subtotal</th>
                                                <th style="width: 50px"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-body">
                                            <tr id="tr-empty" @if(1==1) style="display: none" @endif>
                                                <td colspan="6" style="height: 240px">
                                                    <h4 class="text-center text-muted" style="margin-top: 50px">
                                                        <i class="glyphicon glyphicon-shopping-cart" style="font-size: 50px"></i> <br><br>
                                                        Lista de venta vacía
                                                    </h4>
                                                </td>
                                            </tr>
                                            {{-- @if ($proforma)
                                                @foreach ($proforma->details as $item)
                                                    @php
                                                        $code_product = $item->product ? $item->product->id : date('Ymd');
                                                        if($item->product){
                                                            $detail_product = '<b>'.$item->product->name.($item->product->code ? ' | '.$item->product->code : '').'<br> <small>'.$item->product->category->name.'</small></b>';
                                                        }else{
                                                            $detail_product = '<b>'.$item->description.'</b>';
                                                        }
                                                    @endphp
                                                    <tr class="tr-item" id="tr-item-{{ $code_product }}">
                                                        <td class="td-item">{{ $loop->iteration }}</td>
                                                        <td>
                                                            {!! $detail_product !!}
                                                            <input type="hidden" name="product_id[]" value="{{ $item->product ? $item->product->id : $item->description }}" />
                                                        </td>
                                                        <td width="150px">
                                                            <input type="number" name="price[]" id="select-price-{{ $code_product }}" onchange="getSubtotal({{ $code_product }})" onkeyup="getSubtotal({{ $code_product }})" min="0.1" step="{{ setting('otros.decimal_quantity') ?? '0.1' }}" class="form-control" value="{{ $item->price }}" readonly />
                                                        </td>
                                                        <td width="100px"><input type="number" name="quantity[]" class="form-control" id="input-quantity-{{ $code_product }}" onkeyup="getSubtotal({{ $code_product }})" onchange="getSubtotal({{ $code_product }})" value="1" min="1" step="1" max="{{ $item->quantity }}" readonly/></td>
                                                        <td width="120px" class="text-right"><h4 class="label-subtotal" id="label-subtotal-{{ $code_product }}">{{ $item->quantity * $item->price }}</h4></td>
                                                        <td width="50px" class="text-right"><button type="button" onclick="removeTr({{ $code_product }})" class="btn btn-link"><i class="voyager-trash text-danger"></i></button></td>
                                                    </tr>
                                                @endforeach
                                            @endif --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <textarea name="observations" class="form-control" rows="2" placeholder="Observaciones"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-bordered">
                        <div class="panel-body" style="padding: 10px 0px">
                            <div class="form-group col-md-12">
                                <label for="customer_id">Cliente</label>
                                <div class="input-group">
                                    <select name="customer_id" id="select-customer_id" class="form-control"></select>
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" title="Nuevo cliente" data-target="#modal-create-customer" data-toggle="modal" style="margin: 0px" type="button">
                                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="date">NIT/CI</label>
                                <input type="text" name="dni" id="input-dni" value="" class="form-control" placeholder="NIT/CI">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="date">Monto recibido</label>
                                <input type="number" name="amount" id="input-amount" min="0" step="{{ setting('otros.decimal_quantity') ?? '0.1' }}" class="form-control" placeholder="Monto recibo Bs.">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="date">Descuento</label>
                                <input type="number" name="discount" id="input-discount" min="0" step="{{ setting('otros.decimal_quantity') ?? '0.1' }}" class="form-control" placeholder="Descuento Bs.">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="date">Fecha de venta</label>
                                <input type="date" name="date" value="{{ date('Y-m-d') }}" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="next_payment">Próximo pago</label>
                                <input type="date" name="next_payment" min="{{ date('Y-m-d') }}"  class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <div class="checkbox">
                                    {{-- <label><input type="checkbox" style="width: 15px; height: 15px" id="checkbox-proforma" name="proforma" value="1" @if ($proforma) disabled @endif>Proforma</label> <br>
                                    @if (!setting('ventas.select_payment_method'))
                                    <label><input type="checkbox" style="width: 15px; height: 15px" name="payment_type" value="2">Pago con Qr/Transferencia</label>
                                    @endif --}}
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <h2 class="text-right"><small>Total: Bs.</small> <b id="label-total">0.00</b></h2>
                            </div>
                            <div class="form-group col-md-12 text-center">
                                @if (setting('ventas.select_payment_method'))
                                    <button type="button" id="btn-submit" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-confirm">Vender <i class="voyager-basket"></i></button>
                                @else
                                    <button type="submit" id="btn-submit" class="btn btn-primary btn-block">Vender <i class="voyager-basket"></i></button>
                                @endif

                                {{-- Botón de profroma --}}
                                <button type="submit" id="btn-proforma" class="btn btn-danger btn-block" style="display: none">Generar proforma <i class="voyager-file-text"></i></button>

                                <a href="{{ route('sales.index') }}" >Volver a la lista</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Confirmar --}}
            @if (setting('ventas.select_payment_method'))
                <div class="modal fade" tabindex="-1" id="modal-confirm" role="dialog">
                    <div class="modal-dialog modal-primary">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title"><i class="voyager-check"></i> Confirmar venta</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="payment_type">Método de pago</label>
                                    <select name="payment_type" id="select-payment_type" class="form-control" required>
                                        <option value="" disabled selected>Seleccionar método de pago</option>
                                        <option value="1">Efectivo</option>
                                        <option value="2">Qr/Transferencia</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary" id="btn-confirm">Confirmar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </form>
    </div>

    {{-- Popup para imprimir el recibo --}}
    <div id="popup-button">
        <div class="col-md-12" style="padding-top: 5px">
            <h4 class="text-muted">Desea imprimir el recibo?</h4>
        </div>
        <div class="col-md-12 text-right">
            <button onclick="javascript:$('#popup-button').fadeOut('fast')" class="btn btn-default">Cerrar</button>
            <a id="btn-print" href="#" target="_blank" title="Imprimir" class="btn btn-danger">Imprimir <i class="glyphicon glyphicon-print"></i></a>
        </div>
    </div>

    {{-- Modal crear cliente --}}
    <form action="{{ url('admin/people/store') }}" id="form-create-customer" method="POST">
        <div class="modal fade" tabindex="-1" id="modal-create-customer" role="dialog">
            <div class="modal-dialog modal-primary">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="voyager-trash"></i> Desea eliminar el siguiente registro?</h4>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="type" value="normal">
                        <input type="hidden" name="status" value="activo">
                        <div class="form-group">
                            <label for="full_name">Nombres</label>
                            <input type="text" name="first_name" class="form-control" placeholder="Juan" required>
                        </div>
                        <div class="form-group">
                            <label for="full_name">Apellidos</label>
                            <input type="text" name="last_name" class="form-control" placeholder="Perez" required>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="full_name">NIT/CI</label>
                                <input type="text" name="ci" class="form-control" placeholder="123456789" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="full_name">Celular</label>
                                <input type="text" name="phone" class="form-control" placeholder="76558214">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="full_name">Género</label>
                                <select name="gender" id="gender" class="form-control select2" required>
                                    <option value="" disabled selected></option>
                                    <option value="masculino">Masculino</option>
                                    <option value="femenino">Femenino</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address">Dirección</label>
                            <textarea name="address" class="form-control" rows="3" required placeholder="C/ 18 de nov. Nro 123 zona central"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-primary btn-save-customer" value="Guardar">
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop

@section('css')
    <style>
        .form-group{
            margin-bottom: 10px !important;
        }
        .label-description{
            cursor: pointer;
        }
        #popup-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 400px;
            height: 100px;
            background-color: white;
            box-shadow: 5px 5px 15px grey;
            z-index: 1000;

            /* Mostrar/ocultar popup */
            @if(session('sale_id'))
            animation: show-animation 1s;
            @else
            right: -500px;
            @endif
        }

        @keyframes show-animation {
            0% {
                right: -500px;
            }
            100% {
                right: 20px;
            }
        }
    </style>
@endsection

@section('javascript')
    <script src="{{ asset('vendor/tippy/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/tippy/tippy-bundle.umd.min.js') }}"></script>
    <script>
        var productSelected, customerSelected;
        var typeAmountReceived = "{{ setting('ventas.type_amount_received') }}"
        var is_proforma = false;
        $(document).ready(function(){
            
            @if(session('sale_id'))
                let saleId = "{{ session('sale_id') }}";
                $('#btn-print').attr('href', `{{ url('admin/sales/print') }}/${saleId}`);
            @endif

            // En caso de tratar de vender una proforma
            getTotal();

            // Ocultar popup de impresión
            setTimeout(() => {
                $('#popup-button').fadeOut('fast');
            }, 8000);

            $('#select-product_id').select2({
                placeholder: '<i class="fa fa-search"></i> Buscar...',
                escapeMarkup : function(markup) {
                    return markup;
                },
                language: {
                    inputTooShort: function (data) {
                        return `Por favor ingrese ${data.minimum - data.input.length} o más caracteres`;
                    },
                    noResults: function () {
                        return `<i class="far fa-frown"></i> No hay resultados encontrados`;
                    }
                },
                quietMillis: 250,
                minimumInputLength: 2,
                ajax: {
                    url: "{{ url('admin/products/list/ajax') }}",        
                    processResults: function (data) {
                        let results = [];
                        data.map(data =>{
                            results.push({
                                ...data,
                                disabled: data.stock > 0 || is_proforma ? false : true
                            });
                        });
                        return {
                            results
                        };
                    },
                    cache: true
                },
                templateResult: formatResultProducts,
                templateSelection: (opt) => {
                    productSelected = opt;
                    return opt.name;
                }
            }).change(function(){
                if($('#select-product_id option:selected').val()){
                    let product = productSelected;
                    if($('.table').find(`#tr-item-${product.id}`).val() === undefined){
                        $('#table-body').append(`
                            <tr class="tr-item" id="tr-item-${product.id}">
                                <td class="td-item"></td>
                                <td>
                                    <b class="label-description" id="description-${product.id}">${product.name} ${product.code ? ' | '+product.code : ''}<br> <small>${product.category.name}</small></b>
                                    <input type="hidden" name="product_id[]" value="${product.id}" />
                                </td>
                                <td width="150px">
                                    <select name="price[]" class="form-control" id="select-price-${product.id}" onchange="getSubtotal(${product.id})" required>
                                        <option value="${product.price}">${product.price}</option>
                                        ${product.wholesale_price ? `<option value="${product.wholesale_price}">${product.wholesale_price}</option>` : ''}
                                    </select>
                                </td>
                                <td width="100px"><input type="number" name="quantity[]" class="form-control" id="input-quantity-${product.id}" onkeyup="getSubtotal(${product.id})" onchange="getSubtotal(${product.id})" value="1" min="1" step="1" max="${!is_proforma ? product.stock : ''}" required/></td>
                                <td width="120px" class="text-right"><h4 class="label-subtotal" id="label-subtotal-${product.id}">${product.price}</h4></td>
                                <td width="50px" class="text-right"><button type="button" onclick="removeTr(${product.id})" class="btn btn-link"><i class="voyager-trash text-danger"></i></button></td>
                            </tr>
                        `);
                        // popover
                        let image = "{{ asset('images/default.jpg') }}";
                        if(product.images){
                            image = JSON.parse(product.images)[0];
                            image = "{{ asset('storage') }}/" + image.replace('.', '-cropped.');
                        }

                        let last_price = 'No definido';
                        if(product.purchases_details.length > 0){
                            last_price = product.purchases_details[0].price;
                        }

                        tippy(`#description-${product.id}`, {
                            content: `  <div style="display: flex; flex-direction: row">
                                            <div style="margin-right:10px">
                                                <img src="${image}" width="70px" alt="${product.name}" />
                                            </div>
                                            <div>
                                                <b>${product.name}</b><br>
                                                <small>categoría: <b>${product.category.name}</b></small><br>
                                                <small>Marca: <b>${product.brand.name}</b> | Precio: Bs. <b>${product.wholesale_price ? product.wholesale_price+' - ' : ''} ${product.price}</b></small><br>
                                                <small>Stock: <b>${product.stock} Unids.</b> | Ubicación: <b>${product.location ? product.location : ''}</b></small><br>
                                                <small>Último precio de compra: Bs. <b>${last_price}</b></small><br>
                                            </div>
                                        </div>`,
                            allowHTML: true,
                            maxWidth: 450,
                        });

                        setNumber();
                        getSubtotal(product.id);
                        $(`#select-price-${product.id}`).select2({tags: true});
                    }else{
                        toastr.info('EL producto ya está agregado', 'Información')
                    }

                    $('#select-product_id').val('').trigger('change');
                }
            });

            $('#select-customer_id').select2({
                // tags: true,
                placeholder: '<i class="fa fa-search"></i> Buscar...',
                escapeMarkup : function(markup) {
                    return markup;
                },
                language: {
                    inputTooShort: function (data) {
                        return `Por favor ingrese ${data.minimum - data.input.length} o más caracteres`;
                    },
                    noResults: function () {
                        return `<i class="far fa-frown"></i> No hay resultados encontrados`;
                    }
                },
                quietMillis: 250,
                minimumInputLength: 2,
                ajax: {
                    url: "{{ url('admin/people/list/ajax') }}",        
                    processResults: function (data) {
                        let results = [];
                        data.map(data =>{
                            results.push({
                                ...data,
                                disabled: false
                            });
                        });
                        return {
                            results
                        };
                    },
                    cache: true
                },
                templateResult: formatResultPeople,
                templateSelection: (opt) => {
                    customerSelected = opt;
                    // return opt.first_name;
                    return opt.first_name?opt.first_name+' '+opt.last_name:'<i class="fa fa-search"></i> Buscar... ';
                }
            }).change(function(){
                if(customerSelected){
                    $('#input-dni').val(customerSelected.ci ? customerSelected.ci : '');
                }
            });

            $('#form-create-customer').submit(function(e){
                e.preventDefault();
                $('.btn-save-customer').attr('disabled', true);
                $('.btn-save-customer').val('Guardando...');
                // alert(1)
                $.post($(this).attr('action'), $(this).serialize(), function(data){
                    toastr.success('Usuario creado', 'Éxito');
                    
                    if(data.people.id){
                        toastr.success('Usuario creado', 'Éxito');
                        $(this).trigger('reset');
                    }else{
                        toastr.error(data.error, 'Error');
                    }
                })
                .always(function(){
                    $('.btn-save-customer').attr('disabled', false);
                    $('.btn-save-customer').text('Guardar');
                    $('#modal-create-customer').modal('hide');
                });
            });

            $('#checkbox-proforma').click(function(){
                let checked = $(this).is(':checked')
                is_proforma = checked;
                if(checked){
                    $('#btn-submit').fadeOut('fast');
                    $('#btn-proforma').fadeIn('fast');
                    $('#select-payment_type').prop('required', false);
                }else{
                    $('#btn-submit').fadeIn('fast');
                    $('#btn-proforma').fadeOut('fast');
                    $('#select-payment_type').prop('required', true);
                }
            });

            $('#form-sale').submit(function(e){
                $('#btn-submit').attr('disabled', 'disabled');
                $('#btn-proforma').attr('disabled', 'disabled');
                $('#btn-confirm').attr('disabled', 'disabled');
            });

            $('#input-discount').keyup(function(){
                getTotal();
            });

            $('#input-discount').change(function(){
                getTotal();
            });

            $('#btn-add-service').click(function(){
                let code = new Date().getMilliseconds();
                let step_value = "{{ setting('otros.decimal_quantity') ?? '0.1' }}";
                $('#table-body').append(`
                    <tr class="tr-item" id="tr-item-${code}">
                        <td class="td-item"></td>
                        <td><textarea name="product_id[]" class="form-control" rows="3" required></textarea></td>
                        <td width="150px"><input type="number" name="price[]" id="select-price-${code}" onchange="getSubtotal(${code})" onkeyup="getSubtotal(${code})" min="0.1" step="${step_value}" class="form-control" required /></td>
                        <td width="100px"><input type="number" name="quantity[]" id="input-quantity-${code}" class="form-control" value="1" readonly/></td>
                        <td width="120px" class="text-right"><h4 class="label-subtotal" id="label-subtotal-${code}">0</h4></td>
                        <td width="50px" class="text-right"><button type="button" onclick="removeTr(${code})" class="btn btn-link"><i class="voyager-trash text-danger"></i></button></td>
                    </tr>
                `);
                setNumber();
            });
        });

        function getSubtotal(id){
            let price = $(`#select-price-${id}`).val() ? parseFloat($(`#select-price-${id}`).val()) : 0;
            let quantity = $(`#input-quantity-${id}`).val() ? parseFloat($(`#input-quantity-${id}`).val()) : 0;
            $(`#label-subtotal-${id}`).text((price * quantity).toFixed(2));
            getTotal();
        }

        function getTotal(){
            let total = 0;
            let discount = $('#input-discount').val() ? parseFloat($('#input-discount').val()) : 0;
            $(".label-subtotal").each(function(index) {
                total += parseFloat($(this).text());
            });
            $('#label-total').text((total - discount).toFixed(2));
            $('#input-amount').attr('max', total.toFixed(2));
            $('#input-discount').attr('max', total.toFixed(2));
            
            // Si la opción de ingresar el monto recibido está deshabilitada se debe autocompletar el input
            if(!typeAmountReceived && !$('#checkbox-proforma').is(':checked')){
                $('#input-amount').attr('value', (total - discount).toFixed(2));
            }
        }

        function setNumber(){
            var length = 0;
            $(".td-item").each(function(index) {
                $(this).text(index +1);
                length++;
            });

            if(length > 0){
                $('#tr-empty').css('display', 'none');
            }else{
                $('#tr-empty').fadeIn('fast');
            }
        }

        function removeTr(id){
            $(`#tr-item-${id}`).remove();
            $('#select-product_id').val("").trigger("change");
            setNumber();
            getTotal();
        }

        function formatResultProducts(option){
            // Si está cargando mostrar texto de carga
            if (option.loading) {
                return '<span class="text-center"><i class="fas fa-spinner fa-spin"></i> Buscando...</span>';
            }
            let image = "{{ asset('images/default.jpg') }}";
            if(option.images){
                let images = JSON.parse(option.images);
                image = "{{ asset('storage') }}/"+images[0].replace('.', '-cropped.');
            }

            // Mostrar u ocultar el código en los resultados de busquedas
            let show_code = "{{ setting('productos.use_code') }}";

            // Mostrar las opciones encontradas
            return $(`  <div style="display: flex">
                            <div style="margin: 0px 10px">
                                <img src="${image}" width="60px" />
                            </div>
                            <div>
                                <b style="font-size: 16px">${show_code ? String(option.code ? option.code : option.id).padStart(4, "0")+' | ' : ''} ${option.name}</b><br>
                                ${option.category.name} | ${option.brand.id > 1 ? option.brand.name+' - ' : ''} ${option.price} Bs. ${option.stock > 0 ? ' | '+option.stock+' Unidades' : '<label class="label label-danger">Agotado</label>'} ${option.location ? ' | '+option.location : ''}
                                ${option.description ? '<br>'+option.description : ''}
                            </div>
                        </div>`);
        }

        function formatResultPeople(option){
            // Si está cargando mostrar texto de carga
            if (option.loading) {
                return '<span class="text-center"><i class="fas fa-spinner fa-spin"></i> Buscando...</span>';
            }
            // Mostrar las opciones encontradas
            return $(`  <div>
                            <b style="font-size: 16px; color: rgb(255, 255, 255)">${option.first_name} ${option.last_name} </b><br>
                            <small style="color: rgb(255, 255, 255) !important">NIT/CI: ${option.ci ? option.ci : 'No definido'} - Cel: ${option.phone ? option.phone : 'No definido'}</small>
                        </div>`);
        }
    </script>
@stop
