<div class="row justify-content-center p-3">
    <div class="col-lg-10">
        <div class="card custom-card shadow-lg" style="border-radius: 10px; border: 1px solid;">
            <div class="card-body">
                <div class="row mb-3">
                    <h4 class="text-center mb-2">REGISTRO DE PRODUCTOS</h4>
                </div>

                <div class="row justify-content-center">

                    <form id="FormProductos">
                        <input type="hidden" id="pro_id" name="pro_id">

                        <div class="row mb-3 justify-content-center">
                            <div class="col-lg-6">
                                <label for="pro_nombre" class="form-label">Ingrese el nombre del prodcuto:</label>
                                <input type="text" class="form-control" id="pro_nombre" name="pro_nombre" placeholder="Ingrese el nombres...">
                            </div>
                            <div class="col-lg-6">
                                <label for="pro_cantidad" class="form-label">Ingrese la cantidad de productos:</label>
                                <input type="text" class="form-control" id="pro_cantidad" name="pro_cantidad" placeholder="Ingrese la cantidad...">
                            </div>
                            <div class="col-lg-6">
                                <label for="pro_categoria" class="form-label">Seleccione la categoria</label>
                                <select name="pro_categoria" id="" class="form-select">
                                    <option value="Categorias" selected disabled>Seleccione...</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="pro_prioridad" class="form-label">Seleccione la prioridad</label>
                                <select name="pro_prioridad" id="" class="form-select">
                                    <option value="Prioridad" selected disabled>Seleccione...</option>
                                </select>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>