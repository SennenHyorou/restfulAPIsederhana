<?php
class Jurusan_model extends CI_Model
{
    public function getJurusan($kd = null)
    {
        if ($kd === null) {
            return $this->db->get('jurusan')->result_array();
        } else {
            return $this->db->get_where('jurusan', ['kdjurusan' => $kd])->result_array();
        }
    }

    public function deleteJurusan($kd)
    {
        $this->db->delete('jurusan', ['kdjurusan' => $kd]);
        return $this->db->affected_rows();
    }

    public function createJurusan($data)
    {
        $this->db->insert('jurusan', $data);
        return $this->db->affected_rows();
    }

    public function updateJurusan($data, $kd)
    {
        $this->db->update('jurusan', $data, ['kdjurusan' => $kd]);
        return $this->db->affected_rows();
    }
}
