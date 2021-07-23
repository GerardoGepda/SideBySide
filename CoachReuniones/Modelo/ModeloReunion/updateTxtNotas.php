<?php
try {
    session_start();
    header("Content-type: application/json; charset=utf-8");
    $input = json_decode(file_get_contents("php://input"), true);
    $data = array();

    if (isset($input['template'])) {
        //template contiene la información del txt
        $template = $input['template'];
        $open = fopen("../../docs/notasFaltantes.txt", "w+");
        if (fwrite($open, " " . $template)) {
            echo json_encode(array("result" => "actualizado", "text" => $input['template']));
            fclose($open);
        } else {
            echo json_encode(array("result" => "No actualizado"));
            fclose($open);
        }
    }
} catch (\Throwable $th) {
    echo json_encode(array("error" => $th));
}
