import { Dropdown } from "bootstrap";
import Swal from "sweetalert2";
import { validarFormulario } from '../funciones';
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { data } from "jquery";



const FormProductos = document.getElementById('FormProductos');
const BtnGuardar = document.getElementById('BtnGuardar');
const BtnModificar = document.getElementById('BtnModificar');
const BtnLimpiar = document.getElementById('BtnLimpiar');


const limpiarTodo = () => {

    FormProductos.reset();
    BtnGuardar.classList.remove('d-none');
    BtnModificar.classList.add('d-none');
}


const GuardarProducto = async (event) => {

    event.preventDefault();
    BtnGuardar.disabled = true;

    if (!validarFormulario(FormProductos, ['pro_id'])) {
        Swal.fire({
            position: "center",
            icon: "info",
            title: "FORMULARIO INCOMPLETO",
            text: "Debe de validar todos los campos",
            showConfirmButton: true,
        });
        BtnGuardar.disabled = false;
        return;
    }

    const body = new FormData(FormProductos);
    const url = '/app01_AMB/productos/guardarAPI';
    const config = {
        method: 'POST',
        body
    }

    try {

        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();

        const { codigo, mensaje } = datos

        if (codigo == 1) {

            await Swal.fire({
                position: "center",
                icon: "success",
                title: "Exito",
                text: mensaje,
                showConfirmButton: true,
            });

            limpiarTodo();
            BuscarProductos();

        } else {

            await Swal.fire({
                position: "center",
                icon: "info",
                title: "Error",
                text: mensaje,
                showConfirmButton: true,
            });
        }

    } catch (error) {
        console.log(error)
    }
    BtnGuardar.disabled = false;

}


const BuscarProductos = async () => {

    const url = '/app01_AMB/productos/buscarAPI';
    const config = {
        method: 'GET'
    }

    try {

        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        const { codigo, mensaje, data } = datos

        if (codigo == 1) {

            await Swal.fire({
                position: "center",
                icon: "success",
                title: "Exito",
                text: mensaje,
                showConfirmButton: true,
            });

            datatable.clear().draw();
            datatable.rows.add(data).draw();
        } else {

            await Swal.fire({
                position: "center",
                icon: "info",
                title: "Error",
                text: mensaje,
                showConfirmButton: true,
            });
        }

    } catch (error) {
        console.log(error)
    }
}


const BuscarProductosComprados = async () => {
    const url = '/app01_AMB/productos/buscompraAPI';
    const config = {
        method: 'GET'
    }

    try {
        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        const { codigo, mensaje, data } = datos

        if (codigo == 1) {
            datatables.clear().draw();
            datatables.rows.add(data).draw();
        } else {
            console.log('Error al cargar productos comprados:', mensaje);
        }

    } catch (error) {
        console.log('Error:', error)
    }
}


const datatable = new DataTable('#TablaProductos', {
    dom: `
        <"row mt-3 justify-content-between" 
            <"col" l> 
            <"col" B> 
            <"col-3" f>
        >
        t
        <"row mt-3 justify-content-between" 
            <"col-md-3 d-flex align-items-center" i> 
            <"col-md-8 d-flex justify-content-end" p>
        >
    `,
    language: lenguaje,
    data: [],
    columns: [
        {
            title: 'No.',
            data: 'pro_id',
            width: '%',
            render: (data, type, row, meta) => meta.row + 1
        },
        { title: 'Nombre', data: 'pro_nombre' },
        { title: 'Cantidad', data: 'pro_cantidad' },
        { title: 'Categoria', data: 'cat_nom' },
        {
            title: 'Prioridad',
            data: 'pro_prioridad',
            render: (data, type, row) => {

                const prioridad = row.pro_prioridad

                if (prioridad == "A") {
                    return "ALTA"
                } else if (prioridad == "M") {
                    return "MEDIANA"
                } else if (prioridad == "B") {
                    return "BAJA"
                }
            }
        },
        {
            title: 'Acciones',
            data: 'pro_id',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => {
                return `
                 <div class='d-flex justify-content-center'>
                     <button class='btn btn-warning modificar mx-1' 
                         data-id="${data}" 
                         data-nombre="${row.pro_nombre}"
                         data-cantidad="${row.pro_cantidad}"
                         data-categoria="${row.pro_categoria}"
                         data-prioridad="${row.pro_prioridad}">    
                         <i class="bi bi-pencil-square"></i> Modificar
                     </button>
                     <button class='btn btn-danger eliminar mx-1' 
                         data-id="${data}">
                        <i class="bi bi-trash3 me-1"></i>Eliminar
                     </button>
                     <button class='btn btn-success comprar mx-1' 
                         data-id="${data}">
                        <i class="bi bi-bag me-1"></i>Comprar
                     </button>
                 </div>`;
            }
        }
    ]
});


const ModificarProducto = async (event) => {

    event.preventDefault();
    BtnModificar.disabled = true;

    if (!validarFormulario(FormProductos, [''])) {
        Swal.fire({
            position: "center",
            icon: "info",
            title: "FORMULARIO INCOMPLETO",
            text: "Debe de validar todos los campos",
            showConfirmButton: true,
        });
        BtnGuardar.disabled = false;
    }

    const body = new FormData(FormProductos);

    const url = '/app01_AMB/productos/modificarAPI';
    const config = {
        method: 'POST',
        body
    }

    try {

        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        const { codigo, mensaje } = datos

        if (codigo == 1) {

            await Swal.fire({
                position: "center",
                icon: "success",
                title: "Exito",
                text: mensaje,
                showConfirmButton: true,
            });

            limpiarTodo();
            BuscarProductos();

        } else {

            await Swal.fire({
                position: "center",
                icon: "info",
                title: "Error",
                text: mensaje,
                showConfirmButton: true,
            });

        }

    } catch (error) {
        console.log(error)
    }
    BtnModificar.disabled = false;

}



const llenarFormulario = (event) => {

    const datos = event.currentTarget.dataset

    document.getElementById('pro_id').value = datos.id
    document.getElementById('pro_nombre').value = datos.nombre
    document.getElementById('pro_cantidad').value = datos.cantidad
    document.getElementById('pro_categoria').value = datos.categoria
    document.getElementById('pro_prioridad').value = datos.prioridad

    BtnGuardar.classList.add('d-none');
    BtnModificar.classList.remove('d-none');

    window.scrollTo({
    top: 0
});
}



const EliminarProductos = async (e) => {

    const idPro = e.currentTarget.dataset.id

    const AlertaConfirmarEliminar = await Swal.fire({
        position: "center",
        icon: "info",
        title: "¿Desea ejecutar esta acción?",
        text: 'Esta completamente seguro que desea eliminar este registro',
        showConfirmButton: true,
        confirmButtonText: 'Si, Eliminar',
        confirmButtonColor: 'red',
        cancelButtonText: 'No, Cancelar',
        showCancelButton: true
    });

    if (AlertaConfirmarEliminar.isConfirmed) {

        const url = `/app01_AMB/productos/eliminar?id=${idPro}`;
        const config = {
            method: 'GET'
        }

        try {

            const consulta = await fetch(url, config);
            const respuesta = await consulta.json();
            const { codigo, mensaje } = respuesta;

            if (codigo == 1) {

                await Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Exito",
                    text: mensaje,
                    showConfirmButton: true,
                });
                
               BuscarProductos();
               BuscarProductosComprados();
            } else {
                await Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "Error",
                    text: mensaje,
                    showConfirmButton: true,
                });
            }

        } catch (error) {
            console.log(error)
        }
    }
}



const ProductoComprado = async (e) => {
    const idPro = e.currentTarget.dataset.id;

    const AlertaConfirmarCompra = await Swal.fire({
        position: "center",
        icon: "info",
        title: "¿Desea ejecutar esta acción?",
        text: 'Esta completamente seguro que compró el producto',
        showConfirmButton: true,
        confirmButtonText: 'Si, Correcto',
        confirmButtonColor: 'green',
        cancelButtonText: 'No, Cancelar',
        showCancelButton: true
    });

    if (AlertaConfirmarCompra.isConfirmed) {
        const url = `/app01_AMB/productos/comprado?id=${idPro}`;
        const config = {
            method: 'GET'
        }

        try {
            const consulta = await fetch(url, config);
            const respuesta = await consulta.json();
            const { codigo, mensaje } = respuesta;

            if (codigo == 1) {
                await Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Exito",
                    text: mensaje,
                    showConfirmButton: true,
                });
                
                BuscarProductos();
                BuscarProductosComprados();
            } else {
                await Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "Error",
                    text: mensaje,
                    showConfirmButton: true,
                });
            }

        } catch (error) {
            console.log(error)
        }
    }
}


const datatables = new DataTable('#ProductosComprados', {
    dom: `
        <"row mt-3 justify-content-between" 
            <"col" l> 
            <"col" B> 
            <"col-3" f>
        >
        t
        <"row mt-3 justify-content-between" 
            <"col-md-3 d-flex align-items-center" i> 
            <"col-md-8 d-flex justify-content-end" p>
        >
    `,
    language: lenguaje,
    data: [],
    columns: [
        {
            title: 'No.',
            data: 'pro_id',
            width: '%',
            render: (data, type, row, meta) => meta.row + 1
        },
        { title: 'Nombre', data: 'pro_nombre' },
        { title: 'Cantidad', data: 'pro_cantidad' },
        { title: 'Categoria', data: 'cat_nom' },
        {
            title: 'Prioridad',
            data: 'pro_prioridad',
            render: (data, type, row) => {

                const prioridad = row.pro_prioridad

                if (prioridad == "A") {
                    return "ALTA"
                } else if (prioridad == "M") {
                    return "MEDIANA"
                } else if (prioridad == "B") {
                    return "BAJA"
                }
            }
        },
        {
            title: 'Acciones',
            data: 'pro_id',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => {
                return `
                 <div class='d-flex justify-content-center'>
                     <button class='btn btn-danger eliminar mx-1' 
                         data-id="${data}">
                        <i class="bi bi-trash3 me-1"></i>Eliminar
                     </button>
                 </div>`;
            }
        }
    ]
});






BuscarProductos();
FormProductos.addEventListener('submit', GuardarProducto);
BtnLimpiar.addEventListener('click', limpiarTodo);
BtnModificar.addEventListener('click', ModificarProducto);
datatable.on('click', '.modificar', llenarFormulario);
datatable.on('click', '.eliminar', EliminarProductos);
datatable.on('click', '.comprar', ProductoComprado);
BuscarProductosComprados(); 
datatables.on('click', '.eliminar', EliminarProductos);