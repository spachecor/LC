<?php
    class UsuarioDAO {
        /**
         * Obtener todos los datos JSON
         */
        function get_all_data()
        {
            $json_content = file_get_contents('json/bbdd.json');
            $json = $json_content ? (array) json_decode($json_content) : [];

            $data = [];
            foreach ($json as $row) {
                if (isset($row->id)) {
                    $data[$row->id] = $row;
                }
            }
            return $data;
        }

        /**
         * Insertar datos en un archivo JSON
         */
        function insert_to_json(Usuario $usuario): array
        {
            $nombre = $usuario->getNombre();
            $email = $usuario->getEmail();

            $data = $this->get_all_data();
            $id = array_key_last($data) + 1;
            $data[$id] = (object) [
                "id" => $id,
                "nombre" => $nombre,
                "email" => $email
            ];
            $json = json_encode(array_values($data), JSON_PRETTY_PRINT);
            $insert = file_put_contents('json/bbdd.json', $json);
            if ($insert) {
                $resp['status'] = 'success';
            } else {
                $resp['failed'] = 'failed';
            }
            return $resp;
        }
    }
?>