<?php


function Create()
{
    require 'connection.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $descricao = $_POST['descricao'];

        if ($descricao !== null) {

            $sql = "INSERT INTO tarefas (`descricao`) VALUES ('$descricao');";

            if ($conn->query($sql) === TRUE) {
                header("Location: index.php");
            } else {
                echo "Erro: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        } else {
            header("Location: index.php");
        }
    }
}

function Delete($id)
{
    require 'connection.php';

    $id = $_GET['id'];

    $sql = "DELETE FROM tarefas WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}


function Read()
{
    require 'connection.php';

    if ($conn) {
        $sql = "SELECT * FROM tarefas ORDER BY id DESC;";

        if ($result = $conn->query($sql)) {
            return $result;
        } else {
            die('Erro na consulta: ' . $conn->error);
        }
    }
}

function Update()
{
    require 'connection.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $edit_id = $_POST['edit_id'];
        $edit_descricao = $_POST['edit_descricao'];

        $sql = "UPDATE `tarefas` SET `descricao` = '$edit_descricao' WHERE `tarefas`.`id` = '$edit_id';";

        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}

function Btn_Update($id_verificar, $verificar)
{
    require 'connection.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $id_verificar = $_POST['id'];
        $verificar = $_POST['verificar'];

        $sql = "UPDATE `tarefas` SET `verificar` = '$verificar' WHERE `tarefas`.`id` = '$id_verificar';";

        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}
function Status($id_verificar)
{
    require 'connection.php';

    if ($conn) {
        $sql = "SELECT verificar FROM tarefas where id = $id_verificar";

        if ($result = $conn->query($sql)) {
            $row = $result->fetch_assoc();
            if ($row['verificar'] == 0) {
                return 0;
            } else {
                return 1;
            }
        } else {
            die('Erro na consulta: ' . $conn->error);
        }
    }
}


function Read_status($id_verificar)
{
    require 'connection.php';

    if ($conn) {
        $sql = "SELECT verificar FROM tarefas where id = $id_verificar";

        if ($result = $conn->query($sql)) {
            $row = $result->fetch_assoc();
            if ($row['verificar'] == 0) {
                return print("<div style='background-color: red; color: white; padding: 10px; border-radius: 5px;'>DESATIVADO</div>");
                header("Location: index.php");
            } else {
                return print("<div style='background-color: green; color: white; padding: 10px; border-radius: 5px;'>ATIVO</div>");
                header("Location: index.php");
            }
        } else {
            die('Erro na consulta: ' . $conn->error);
        }
    }
}

function Update_status($id_status)
{
    require 'connection.php';

    if ($conn) {
        $sql = "SELECT verificar FROM tarefas where id = $id_status";

        if ($result = $conn->query($sql)) {
            $row = $result->fetch_assoc();

            if ($row['verificar'] == 0) {
                $sql = "UPDATE `tarefas` SET `verificar` = '1' WHERE `tarefas`.`id` = '$id_status';";
            } else {
                $sql = "UPDATE `tarefas` SET `verificar` = '0' WHERE `tarefas`.`id` = '$id_status';";
            }

            if ($conn->query($sql) === TRUE) {
                header("Location: index.php");
            } else {
                echo "Erro: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        }
    }
}
