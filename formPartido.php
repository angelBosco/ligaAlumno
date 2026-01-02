<div class="container my-3">
    <!-- my-3 da un margen con la barra de navegacion -->
    <!-- margin funciona contra elementos externos y padding contra elementos internos -->
    <div class="row">
        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 py-4 bg-light">
            <h2>Partido1</h2>
            <form method="POST"> <!-- action="procesaRegistro.php" -->
                <?php
                include_once "procesaPartido.php";
                ?>
                <div class="mb-3">
                    <label for="codigo" class="form-label">Equipo Local</label>
                    <input type="text" class="form-control" name="equipoL" id="equipoL" placeholder="Nombre Equipo Local" autofocus>
                    <label for="codigo" class="form-label">Goles Local</label>
                    <input type="number" class="form-control" name="golesL" id="golesL" placeholder="Goles Local">
                </div>
                <div class="mb-3">
                    <label for="codigo" class="form-label">Equipo Visitante</label>
                    <input type="text" class="form-control" name="equipoV" id="equipoV" placeholder="Nombre Equipo Visitante" autofocus>
                    <label for="codigo" class="form-label">Goles Visitante</label>
                    <input type="number" class="form-control" name="golesV" id="golesV" placeholder="Goles Visitante">
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success" name="btnGuardar" value="ok">Guardar</button>
                    <button class="btn btn-light">limpiar</button>
                </div>
            </form>
        </div>