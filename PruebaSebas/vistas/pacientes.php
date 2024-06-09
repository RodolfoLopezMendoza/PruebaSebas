<?php
$title = '';
ob_start();
?>

<style>
    #listadoregistros {
        display: none;
    }
    .custom-btn {
        width: 100%; /* Ajusta el ancho según sea necesario */
        margin-bottom: 5px; /* Agrega margen inferior para separar los botones */
    }
    #tbllistado-container {
        overflow-x: auto;
    }
</style>
<h1 class="display-4"><?= $title ?></h1>

<div class="container-fluid mb-3 card p-3">
    <!--<div class="row">
        <div class="col-md-3">
            <label for="id">cedula:</label>
            <input class="form-control" type="text" id="cedula" name="cedula">
        </div>
        <div class="col-md-3">
            <label for="nombre">nombre:</label>
            <input class="form-control" type="text" id="nombre" name="nombre">
        </div>
        <div class="col-md-3">
            <label for="direccion">direccion:</label>
            <input class="form-control" type="text" id="direccion" name="direccion">
        </div>
        <div class="col-md-3">
            <label for="genero">genero:</label>
            <input class="form-control" type="text" id="genero" name="genero">
        </div>
        <div class="col-md-3">
            <label for="fechaNac">fechaNac:</label>
            <input class="form-control" type="date" id="fechaNac" name="fechaNac">
        </div>

        <div class="col-md-3">
            <label for="ocupacion">ocupacion:</label>
            <input class="form-control" type="date" id="ocupacion" name="ocupacion">
        </div>

        <div class="col-md-3">
            <label for="telefono1">telefono1:</label>
            <input class="form-control" type="date" id="telefono1" name="telefono1">
        </div>
        
        <div class="col-md-3">
            <label for="telefono2">telefono2:</label>
            <input class="form-control" type="date" id="telefono2" name="telefono2">
        </div>
        
        <div class="col-md-3">
            <label for="email">email:</label>
            <input class="form-control" type="date" id="email" name="email">
        </div>
        
        <div class="col-md-3">
            <label for="provincia"a>provincia:</label>
            <input class="form-control" type="date" id="provincia" name="provincia">
        </div>

        <div class="col-md-3">
            <label for="canton">canton:</label>
            <input class="form-control" type="date" id="canton" name="canton">
        </div>

        <div class="col-md-3">
            <label for="fechaIngreso">fechaIngreso:</label>
            <input class="form-control" type="date" id="fechaIngreso" name="fechaIngreso">
        </div>
        
        <div class="col-md-3">
            <label for="sucursal">sucursal:</label>
            <input class="form-control" type="date" id="sucursal" name="sucursal">
        </div>
        
    </div>-->
    <div class="row p-3">
        <button type="button" class="col-md mr-1 btn btn-success custom-btn" id="Agregar" onclick="agregar()">Agregar</button>
        <button type="button" class="col-md mr-1 btn btn-primary custom-btn" id="Listar" onclick="listar()">Buscar</button>
        <button type="button" class="col-md mr-1 btn btn-warning custom-btn" id="Editar" onclick="editar()" disabled>Editar</button>
        <button type="button" class="col-md mr-1 btn btn-danger custom-btn" id="Eliminar" onclick="eliminar()" disabled>Eliminar</button>
        <button type="button" class="col-md mr-1 btn btn-secondary custom-btn" id="Limpiar" onclick="limpiar()">Limpiar</button>
    </div>
</div>

<div class="container-fluid mb-3 card p-3" id="listadoregistros">
    <div class="row table-responsive pl-3">
        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
                <th>cedula</th>
                <th>nombre</th>
                <th>direccion</th>
                <th>genero</th>
                <th>fechaNac</th>
                <th>ocupacion</th>
                <th>telefono1</th>
                <th>telefono2</th>
                <th>email</th>
                <th>provincia</th>
                <th>canton</th>
                <th>fechaIngreso</th>
                <th>sucursal</th>

            </thead>
            <tbody>
            </tbody>
           <!-- <<tfoot>
            <th>cedula</th>
                <th>nombre</th>
                <th>direccion</th> 
                <th>genero</th>
                <th>fechaNac</th>
                <th>ocupacion</th>
                <th>telefono1</th>
                <th>telefono2</th>
                <th>email</th>
                <th>provincia</th>
                <th>canton</th>
                <th>fechaIngreso</th>
                <th>sucursal</th>
            </tfoot> -->    
            
        </table>
    </div>
</div>
<?php
$content = ob_get_clean();
include './includes/layout.php';0
?>

<script>
    listar();

    function habilitar_botones() {
        document.getElementById("Agregar").disabled = true;
        document.getElementById("Eliminar").disabled = false;
        document.getElementById("Editar").disabled = false;
    }

    function desabilitar_botones() {
        document.getElementById("Agregar").disabled = false;
        document.getElementById("Eliminar").disabled = true;
        document.getElementById("Editar").disabled = true;
    }

    function agregar() {
        var id = $("#id").val();
        var deudor = $("#deudor").val();
        var cuota = $("#cuota").val();
        var cuotacapital = $("#cuotacapital").val();
        var fechapago = $("#fechapago").val();

        if (id == '' || deudor == ''|| cuota == '' || cuotacapital == '' || fechapago == '') {
            Swal.fire('Faltan Datos');
        } else {
            $.ajax({
                type: "POST",
                url: "../ajax/pacientes.php?op=guardar",
                data: {
                    cedula: id,
                    deudor: deudor,
                    cuota: cuota,
                    cuotacapital: cuotacapital,
                    fechapago: fechapago
                },
                success: function(response) {
                    Swal.fire(response);
                    limpiar();
                    listar();
                }
            });
        }
    }

    function eliminar() {
        var id = $("#id").val();
        var deudor = $("#deudor").val();
        var cuota = $("#cuota").val();
        var cuotacapital = $("#cuotacapital").val();
        var fechapago = $("#fechapago").val();

        $.ajax({
            type: "POST",
            url: "../ajax/pacientes.php?op=eliminar",
            data: {
                id: id,
                deudor: deudor,
                cuota: cuota,
                cuotacapital: cuotacapital,
                fechapago: fechapago
            },
            success: function(response) {
                Swal.fire(response);
                limpiar();
                listar();
            }
        });
    }

    function editar() {
        var id = $("#id").val();
        var deudor = $("#deudor").val();
        var cuota = $("#cuota").val();
        var cuotacapital = $("#cuotacapital").val();
        var fechapago = $("#fechapago").val();

        $.ajax({
            type: "POST",
            url: "../ajax/pacientes.php?op=editar",
            data: {
                id: id,
                deudor: deudor,
                cuota: cuota,
                cuotacapital: cuotacapital,
                fechapago: fechapago
            },
            success: function(response) {
                Swal.fire(response);
            }
        }).done(function() {
            listar();
        });
    }

    function buscar() {
        var id = $("#id ").val();

        $.ajax({
            type: "POST",
            url: "../ajax/pacientes.php?op=mostrar",
            data: {
                id : id 
            },
            success: function(response) {
                var resultado = JSON.parse(response);
                document.getElementById("id ").value = resultado['id '];
                document.getElementById("deudor").value = resultado['deudor'];
                document.getElementById("cuota").value = resultado['cuota'];
                document.getElementById("cuotacapital").value = resultado['cuotacapital'];
                document.getElementById("fechapago").value = resultado['fechapago'];
            }
        });
    }

    function mostrar(cedulapaciente) {
        habilitar_botones();
       // document.getElementById("listadoregistros").style.display = "none";
        $.ajax({
            type: "POST",
            url: "../ajax/pacientes.php?op=mostrar",
            data: {
                cedula: cedulapaciente
            },
            success: function(response) {
                var resultado = JSON.parse(response);
                document.getElementById("cedula").value = resultado['cedula'];
                document.getElementById("nombre").value = resultado['nombre'];
                document.getElementById("direccion").value = resultado['direccion'];
                document.getElementById("genero").value = resultado['genero'];
                document.getElementById("fechNac").value = resultado['fechNac'];
                document.getElementById("ocupacion").value = resultado['ocupacion'];
                document.getElementById("telefono1").value = resultado['telefono1'];
                document.getElementById("telefono2").value = resultado['telefono2'];
                document.getElementById("email").value = resultado['email'];
                document.getElementById("provincia").value = resultado['provincia'];
                document.getElementById("canton").value = resultado['canton'];
                document.getElementById("fechaIngreso").value = resultado['fechaIngreso'];
                document.getElementById("sucursal").value = resultado['sucursal'];
            }
        });
    }

    function limpiar() {
        document.getElementById("id").value = "";
        document.getElementById("deudor").value = "";
        document.getElementById("cuota").value = "";
        document.getElementById("cuotacapital").value = "";
        document.getElementById("fechapago").value = "";
        desabilitar_botones();
    }

    //Función Listar
    function listar() {
        document.getElementById("listadoregistros").style.display = "block";
        tabla = $('#tbllistado').dataTable({
            "aProcessing": true, //Activamos el procesamiento del datatables
            "aServerSide": true, //Paginación y filtrado realizados por el servidor
            dom: 'Bfrtip', //Definimos los elementos del control de tabla
            buttons: [
                //'copyHtml5',
                //'excelHtml5',
                //'csvHtml5',
                //'pdf'
            ],
            "ajax": {
                url: "../ajax/pagos.php?op=listar",
                type: "get",
                dataType: "json",
                error: function(e) {
                    console.log(e.responseText);
                }
            },
            "bDestroy": true,
            "iDisplayLength": 5, //Paginación
            "order": [
                [0, "asc"]
            ] //Ordenar (columna,orden)
        }).DataTable();
    }
</script>
</body>

</html>
