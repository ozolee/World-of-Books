<?php defined('BASEPATH') || die('No direct script access allowed');


class wob_model extends CI_Model
{
	private $users          = 'users';
        private $users_results    = 'users_results';
        private $results          = 'results';
        
    public function __construct(){
        parent::__construct();
        $ci=&get_instance();
        
        if(!$this->db->table_exists('users')){
            $sql = 'CREATE TABLE users ('
                    . 'id INT(11) NOT NULL AUTO_INCREMENT,'
                    . 'user_id VARCHAR(30) NULL,'
                    . 'name VARCHAR(255) NULL,'
                    . 'email VARCHAR(255) NULL,'
                    . 'pass VARCHAR(50),'
                    . 'permission INT(9),'
                    . 'PRIMARY KEY(`id`)'
                    . ') ENGINE=InnoDB DEFAULT CHARSET=utf8;';
            $this->db->query($sql);
            
            $data = array(
                'user_id'   => 'VAR123',
                'name'      =>  'Sample Adam',
                'email'     => 'test@mail.hu',
                'pass'      => '7110eda4d09e062aa5e4a390b0a572ac0d2c0220',
                'permission'    => '0',                
            );
            $this->db->insert($this->users,$data);
        }
        
        if(!$this->db->table_exists('users_results')){
            $sql = 'CREATE TABLE users_results ('
                    . 'id INT(11) NOT NULL AUTO_INCREMENT,'
                    . 'user_id VARCHAR(30) NULL,'
                    . 'result_id INT(11) NULL,'
                    . 'PRIMARY KEY(`id`)'
                    . ') ENGINE=InnoDB DEFAULT CHARSET=utf8;';
            $this->db->query($sql);
        }
        
        if(!$this->db->table_exists('results')){
            $sql = 'CREATE TABLE results ('
                    . 'id INT(11) NOT NULL AUTO_INCREMENT,'
                    . 'date VARCHAR(30) NULL,'
                    . 'home_team VARCHAR(255) NULL,'
                    . 'away_team VARCHAR(255) NULL,'                    
                    . 'home_score INT(9) NULL,'
                    . 'away_score INT(9) NULL,'
                    . 'tournament VARCHAR(255) NULL,'        
                    . 'city VARCHAR(255) NULL,'
                    . 'country VARCHAR(255) NULL,'
                    . 'PRIMARY KEY(`id`)'
                    . ') ENGINE=InnoDB DEFAULT CHARSET=utf8;';
            $this->db->query($sql);
            
            $this->load->library('csvreader');
            $result =   $this->csvreader->parse_file('results.csv');
            
            foreach($result as $r){
                $insert = array(
                  'date' => $r['date'],
                  'home_team' => $r['home_team'],
                  'away_team' => $r['away_team'],  
                  'home_score' => $r['home_score'], 
                  'away_score' => $r['away_score'],  
                  'tournament' => $r['tournament'], 
                  'city' => $r['city'], 
                  'country' => $r['country'], 
                );                
                
                $this->db->insert($this->results,$insert);
                
                header("Refresh:0");
            }
        }
    } 
    
    //------------------------------USERS    

    public function get_user_where($where = array()){
        $this->db->select('*');
        $this->db->from($this->users);
        $this->db->where($where);

        return $this->db->get()->first_row();
    }

	
}
