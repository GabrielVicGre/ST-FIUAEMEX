<table class="actividades-tbl">
    <?php
    $acts = $controller->listActividades();

    foreach ($acts as &$act) {
    ?>
        <tr>
            <form action="Views/Administrador/actividades.php" method="GET">
                <td><?php echo $act['clave_actividad']; ?></td>
                <td>
                    <p class="short"><?php echo $act['desc_actividad']; ?></p>
                </td>
                <td><?php echo date_format(date_create($act['fecha_alta']), "d-m-Y"); ?></td>
                <td><button class="submit-btn" type="submit" name="action" value="edit">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                    </button></td>
                <td><button class="submit-btn" type="submit" name="delete" value="delete">
                        <i class="fa fa-times" aria-hidden="true"></i>
                </td>
                <input type="hidden" name="id_actividad" value="<?php echo $act['id_actividad']; ?>">
            </form>
        </tr>
    <?php
    }
    ?>
</table>