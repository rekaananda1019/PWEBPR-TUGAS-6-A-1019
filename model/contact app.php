<?php
require_once("config/conn.php");

class Contact {
    static function select($id='') {
        global $conn;
        $sql = "SELECT * FROM contact";
        if ($id != '') {
            $sql .= " WHERE id_contact = $id";
        }
        $result = $conn->query($sql);
        $rows = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }

    static function insert($data=[]) {
        global $conn;
        $sql = "INSERT INTO contact (no_hp, nama, email, tgl_lahir, jns_kelamin) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssss', $data['phone_number'], $data['owner'], $data['email'], $data['tgl_lahir'], $data['jns_kelamin']);
        $stmt->execute();
        $result = $stmt->affected_rows > 0 ? true : false;
        return $result;
    }

    static function update($data=[]) {
        global $conn;
        $sql = "UPDATE contact SET no_hp = ?, nama = ?, email = ?, tgl_lahir = ?, jns_kelamin = ? WHERE id_contact = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssssi', $data['phone_number'], $data['owner'], $data['email'], $data['tgl_lahir'], $data['jns_kelamin'], $data['id']);
        $stmt->execute();
        $result = $stmt->affected_rows > 0 ? true : false;
        return $result;
    }

    static function delete($id='') {
        global $conn;
        $sql = "DELETE FROM contact WHERE id_contact = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->affected_rows > 0 ? true : false;
        return $result;
    }
}

?>
