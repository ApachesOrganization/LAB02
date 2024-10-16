<?php
			class User{
				private $db;
				
				public function __construct(){
					$this->db = new Database;
				}
				
				public function getUsers(){
					$this->db->query('select * from usuarios');
					$regis = $this->db->resultSet();
					return $regis;
				}
				public function login($data){
					$this->db->query('select * from usuarios where nombre = :nomb');
					
					$this->db->bind(':nomb',$data['usuario']);
					
					$tupla = $this->db->singleRow();
					
					$contra = $tupla->contrasena;        
					
					if(password_verify($data['contra'], $contra)){
						return $tupla;    
					}else{
						return false;
					}
				}
				
				public function register($data){
					$this->db->query('insert into usuarios(nombre,contrasena)values(:nomb,:cont)');
					$this->db->bind(':nomb',$data['usuario']);
					$this->db->bind(':cont',$data['contra']);
					
					if($this->db->execute()){
						return true;
					}else{
						return false;
					}                            
				}
				public function getUserById($id) {
					$this->db->query('SELECT * FROM usuarios WHERE id = :id');
					$this->db->bind(':id', $id);
					return $this->db->singleRow();
				}
				
			}
		?>