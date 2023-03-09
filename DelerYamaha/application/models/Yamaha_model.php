<?php

class Yamaha_model extends CI_Model
{
    public function getYamaha($nama = null)
    {
        if ($nama === null) {
            return $this->db->get('yamaha')->result_array();
        } else {
            return $this->db->get_where('yamaha', ['nama' => $nama])->result_array();
        }
    }

    public function deleteYamaha($nama)
    {
        $this->db->delete('yamaha', ['nama' => $nama]);
        return $this->db->affected_rows();
    }

    public function createYamaha($data)
    {
        $this->db->insert('yamaha', $data);
        return $this->db->affected_rows();
    }

    public function updateYamaha($data, $id)
    {
        $this->db->update('yamaha', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
}
