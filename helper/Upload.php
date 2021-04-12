<?php 
    class Upload {
        public static function kategori($id) {
            require_once('../config/db_sql.php');
            $sql = "SELECT * FROM sub1_kategori WHERE kategori_id=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            echo "<option value='0'>Choose sub category 1</option>"; {
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['sub1_kategori_id'] . "'>" . $row['sub1_kategori_nama'] . "</option>";
            }
        }
        }

        public static function sub1Kategori($id) {
            require_once('../config/db_sql.php');
            $sql = "SELECT * FROM sub2_kategori WHERE sub1_kategori_id=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            echo "<option value='0'>Choose sub category 2</option>";
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['sub2_kategori_id'] . "'>" . $row['sub2_kategori_nama'] . "</option>";
            }
        }

        public static function sub2Kategori($id) {
            require_once('../config/db_sql.php');
            $sql = "SELECT * FROM sub3_kategori WHERE sub2_kategori_id=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            echo "<option value='0'>Choose sub category 3</option>";
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['sub3_kategori_id'] . "'>" . $row['sub3_kategori_nama'] . "</option>";
            }
        }

        public static function sub3Kategori($id) {
            require_once('../config/db_sql.php');
            $sql = "SELECT * FROM sub4_kategori WHERE sub3_kategori_id=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            echo "<option value='0'>Choose sub category 4</option>";
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['sub4_kategori_id'] . "'>" . $row['sub4_kategori_nama'] . "</option>";
            }
        }
    }

    if(isset($_GET['kategori'])) {
        Upload::kategori($_GET['kategori']);
        unset($_GET['kategori']);
    }

    if(isset($_GET['subkategori1'])) {
        Upload::sub1Kategori($_GET['subkategori1']);
        unset($_GET['subkategori1']);
    }

    if(isset($_GET['subkategori2'])) {
        Upload::sub2Kategori($_GET['subkategori2']);
        unset($_GET['subkategori2']);
    }

    if(isset($_GET['subkategori3'])) {
        Upload::sub3Kategori($_GET['subkategori3']);
        unset($_GET['subkategori3']);
    }