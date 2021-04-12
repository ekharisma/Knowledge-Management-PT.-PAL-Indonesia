<?php
class FileInteraction
{
    public static function likeCounter($id, $currentLike)
    {
        require('../config/db_sql.php');
        $sql = 'UPDATE tb_berkas SET view=view+1 WHERE id_berkas=?';
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('i', $id);
        if ($stmt->execute()) {
            return $currentLike++;
        }
    }

    public static function downloadCounter($id, $currentComment)
    {
        require('../config/db_sql.php');
        $sql = "UPDATE tb_berkas SET download=download+1 WHERE id_berkas=?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('i', $id);
        if ($stmt->execute()) {
            return $currentComment++;
        } else {
            return false;
        }
    }

    public static function addComent($id) {
        require('../config/db_sql.php');
    }
}
