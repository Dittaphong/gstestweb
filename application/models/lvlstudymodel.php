<?phpdefined('BASEPATH') OR exit('No direct script access allowed');class lvlstudymodel extends CI_Model {  public function lvlall()  {    $query = $this->db->get('attribute_level');    return $query->result_array();  }}