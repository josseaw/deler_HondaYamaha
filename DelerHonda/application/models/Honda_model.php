<?php

class Honda_model extends CI_Model
{
    public function getHonda($nama = null)
    {
        if ($nama === null) {
            return $this->db->get('honda')->result_array();
        } else {
            return $this->db->get_where('honda', ['nama' => $nama])->result_array();
        }
    }

    public function deleteHonda($nama)
    {
        $this->db->delete('honda', ['nama' => $nama]);
        return $this->db->affected_rows();
    }

    public function createHonda($data)
    {
        $this->db->insert('honda', $data);
        return $this->db->affected_rows();
    }

    public function updateHonda($data, $id)
    {
        $this->db->update('honda', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
}
