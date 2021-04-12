<?php

class QueryConverter {
    public function toJson($result) {
        $db_data = array();
        while ($row = $result->fetch_assoc()){
            $db_data[] = $row;
        }
        return json_encode($db_data);
    }
}