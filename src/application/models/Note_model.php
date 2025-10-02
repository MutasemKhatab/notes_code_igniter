<?php

class Note_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_notes()
    {
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $query = $this->db->get('notes');
        return $query->result_array();
    }

    public function create_note($data)
    {
        return $this->db->insert('notes', $data);
    }

    public function update_note($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->where('user_id', $this->session->userdata('user_id'));
        return $this->db->update('notes', $data);
    }

    public function get_note_by_id($id)
    {
        $query = $this->db->get_where('notes', array(
            'id' => $id,
            'user_id' => $this->session->userdata('user_id')
        ));
        return $query->row_array();
    }

    public function delete_note($id)
    {
        $this->db->where('id', $id);
        $this->db->where('user_id', $this->session->userdata('user_id'));
        return $this->db->delete('notes');
    }
}