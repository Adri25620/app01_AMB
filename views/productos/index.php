<div class="row justify-content-center p-3">
    <div class="col-lg-6">
        <div class="card custom-card shadow-lg" style="border-radius: 10px; border: 1px solid;">
            <div class="card-body">
                <div class="row mb-3">
                    <h4 class="text-center mb-2">REGISTRO DE PRODUCTOS</h4>
                </div>

                <div class="row justify-content-center">

                    <form id="FormProductos">
                        <input type="hidden" id="pro_id" name="pro_id">

                        <div class="row mb-3 justify-content-center">
                            
                                <label for="pro_nombre" class="form-label">Ingrese el nombre del prodcuto:</label>
                                <input type="text" class="form-control" id="pro_nombre" name="pro_nombre" placeholder="Ingrese el nombres...">
                            
                            
                                <label for="pro_cantidad" class="form-label">Ingrese la cantidad de productos:</label>
                                <input type="text" class="form-control" id="pro_cantidad" name="pro_cantidad" placeholder="Ingrese la cantidad...">
                            

                                <label for="pro_categoria" class="form-label">Seleccione la categoria</label>
                                <select name="pro_categoria" id="" class="form-select">
                                    <option value="Categorias" selected disabled>Seleccione...</option>
                                </select>
                            

                                <label for="pro_prioridad" class="form-label">Seleccione la prioridad</label>
                                <select name="pro_prioridad" id="" class="form-select">
                                    <option value="Prioridad" selected disabled>Seleccione...</option>
                                    <option value="A">Alta</option>
                                    <option value="M">Media</option>
                                    <option value="B">Baja</option>
                                </select>
                            
                            <div class="row justify-content-center mt-5">
                            <div class="col-auto">
                                <button class="btn btn-success" type="submit" id="BtnGuardar">
                                    Guardar
                                </button>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-warning d-none" type="button" id="BtnModificar">
                                    Modificar
                                </button>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-dark" type="reset" id="BtnLimpiar">
                                    Limpiar
                                </button>
                            </div>
                        </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-center p-3">
    <div class="col-lg-10">
        <div class="card custom-card shadow-lg" style="border-radius: 10px; border: 1px solid #007bff;">
            <div class="card-body p-3">
                <h3 class="text-center">COMPRAS PENDIENTES DE REALIZAR</h3>

                <div class="table-responsive p-2">
                    <table class="table table-striped table-hover table-bordered w-100 table-sm" id="TablaProductos">
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<script src="<?= asset('build/js/productos/index.js') ?>"></script>