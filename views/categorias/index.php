<div class="row justify-content-center p-3">
    <div class="col-lg-6">
        <div class="card custom-card shadow-lg" style="border-radius: 10px; border: 1px solid;">
            <div class="card-body">
                <div class="row mb-3">
                    <h4 class="text-center mb-2">REGISTRO DE CATEGORIAS</h4>
                </div>

                <div class="row justify-content-center">

                    <form id="FormCategorias">
                        <input type="hidden" id="cat_id" name="cat_id">

                        <div class="row mb-3 justify-content-center">

                            <label for="cat_nombre" class="form-label">Ingrese el nombre de la categoria:</label>
                            <input type="text" class="form-control" id="cat_nombre" name="cat_nombre" placeholder="Ingrese la categoria...">

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
                <h3 class="text-center">CATEGORIAS REGISTRADAS</h3>

                <div class="table-responsive p-2">
                    <table class="table table-striped table-hover table-bordered w-100 table-sm" id="TablaCategorias">
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<script src="<?= asset('build/js/categorias/index.js') ?>"></script>