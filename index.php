<?php
require 'crud.php';

if (isset($_GET['delete']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if (Delete($id)) {
    }
}

if (isset($_GET['validar']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if (Update_status($id)) {
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <title>To-do-list Caprem</title>
</head>

<body>
    <div class="select"><label> DANIEL CAROLINO - TESTE CAPREM</label>
        <div class="container">
            <form class="select-main" action="<?php Create() ?>" method="POST">
                <div class="mb-3">
                    <label for="select-main-form" class="form-label"><i
                            class="bi bi-card-checklist"></i>&nbsp;INSIRA SUA TAREFA</label>
                    <input class="form-control" type="text" name="descricao" id="descricao" required>
                </div>
                <button type="submit" class="btn-form"><i class="bi bi-plus-circle"></i>
                    ADICIONAR</button>
            </form>
        </div><br>

        <?php
        $result = Read();
        if ($result->num_rows <= 0) { ?>
            <div class="container ">
                <div class="card">
                    <label class="card-header">BEM VINDO!</label>
                    <div class="card-body w-500">
                        <label class="card-title"><i class="emoji bi bi-emoji-smile"> &nbsp;SEM TAREFAS A FAZER.</i></label>
                        <img src="imagem.png" width="100%">
                    </div>
                </div>
            </div>

            <?php } else {
            while ($row = $result->fetch_assoc()) { ?>

                <div class="container">
                    <div class="card container-card">
                        <label class="card-header"><?php Read_status($row['id']) ?></label>
                        <div class="card-body card-text">
                            <?php if (Status($row['id']) == 0) { ?>
                                <h3 class="card-title"><s> <?php echo $row['descricao'] ?></s></h3>
                            <?php } else { ?>
                                <h3 class="card-title"> <?php echo $row['descricao'] ?></h3>
                            <?php } ?>
                            <div class="btn-todo-card">
                                <div class="btn-todo">
                                    <button class="card-btn-editar" data-bs-toggle="modal" data-bs-target="#ModalEditar" data-id="<?php echo $row['id']; ?>"
                                        data-descricao="<?php echo htmlspecialchars($row['descricao']); ?>"><i class="btn-editar bi bi-pencil-square"></i> &nbsp;EDITAR</button>
                                </div>

                                <div class="btn-todo">
                                    <button class="card-btn-delete"><a style="text-decoration: none;color:rgb(255, 255, 255);" href="index.php?delete=true&id=<?php echo $row['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir esta tarefa?');">
                                            <i class="btn-excluir bi bi-trash"></i>&nbsp;EXCLUIR</a></button>
                                </div>
                                <div class="btn-todo">
                                    <button class="card-btn-status"><a style="text-decoration: none;color:rgb(255, 255, 255);" href="index.php?validar=true&id=<?php echo $row['id']; ?>">
                                            <i class="bi bi-arrow-clockwise"></i>&nbsp;STATUS</a></button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
       
    </div>

    <div class="modal fade" id="ModalEditar" tabindex="-1" aria-labelledby="ModalEditarTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="modal-title" id="ModalEditarTitle">Editar tarefa</label>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="select-main" action="<?php Update() ?>" method="POST">
                        <div class="mb-3">
                            <label for="edit_descricao" class="form-label">
                                <i class="bi bi-card-checklist"></i> EDITAR SUA TAREFA
                            </label>
                            <input class="form-control" type="text" name="edit_descricao" id="edit_descricao" required>
                            <input type="hidden" name="edit_id" id="edit_id">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Salvar edição</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
     

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>