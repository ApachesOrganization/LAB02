<?php
			class Users extends Controller {
				public function __construct(){
					$this->userModel = $this->model('User');
				}

				public function login(){
					$data = [
						'usuario'   => '',
						'contra'    => '', 
						'userError' => '',
						'passError' => ''
					];
					
					
					if($_SERVER['REQUEST_METHOD']== 'POST'){
						$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
						$data = [                    
							'usuario'    => trim($_POST['txtUsua']),
							'contra'     => trim($_POST['txtContra']),                    
							'userError'  => '',
							'passError'  => ''                
						];  
						
						
						if(empty($data['usuario'])){
							$data['userError'] = 'El nombre del usuario es obligatorio';
						}
						
						
						if(empty($data['contra'])){
							$data['passError'] = 'La contraseña es obligatoria';
						}
						
						
						if((empty($data['userError'])) && (empty($data['passError']))){
							
							$user = $this->userModel->login($data);
							
							
							if($user){
								$this->createSession($user);                        
							}else{
								$data['passError'] = 'Los datos de ingreso son incorrectos. Favor verificar';
							}    
						}
					}           
					
					$this->view('users/login',$data);
				}
				
				
				public function register(){
					$data = [                
						'usuario'    => '',
						'contra'     => '',
						'recontra'   => '',
						'userError'  => '',
						'passError'  => '',
						'passError2' => ''
						
					];
					
					 
					if($_SERVER['REQUEST_METHOD']== 'POST'){
						$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
						$data = [                    
							'usuario'    => trim($_POST['txtUsua']),
							'contra'     => trim($_POST['txtContra']),
							'recontra'   => trim($_POST['txtContra2']),
							'userError'  => '',
							'passError'  => '',
							'passError2' => ''
						
						];  
						
												
						$validaNombre = '/^[a-zA-Z]*$/';
						$validaContra = '/^[a-zA-Z0-9]*$/';
						
						
						if(empty($data['usuario'])){
							$data['userError'] = 'El nombre del usuario es obligatorio';
						}elseif(!preg_match($validaNombre, $data['usuario'])){
							$data['userError'] = 'El nombre de usuario solo puede contener letras';
						}
						
						
						if(empty($data['contra'])){
							$data['passError'] = 'La contraseña es obligatoria';
						}elseif(strlen($data['contra']) < 8){
							$data['passError'] = 'La contraseña debe tener al menos 8 caracteres';
						}elseif(!preg_match($validaContra, $data['contra'])){
							$data['passError'] = 'La contraseña debe tener al menos un número';
						}
						
						 
						if(empty($data['recontra'])){
							$data['passError2'] = 'La contraseña de confirmacion es obligatoria';
						}elseif(strlen($data['recontra']) < 8){
							$data['passError2'] = 'La contraseña de confirmacion debe tener al menos 8 caracteres';
						}elseif(!preg_match($validaContra, $data['recontra'])){
							$data['passError2'] = 'La contraseña de confirmacion debe tener al menos un número';
						}elseif($data['contra'] != $data['recontra']){
							$data['passError2'] = 'Las contraseñas no coinciden, favor confirmar sus datos';
						}
										
						
						if((empty($data['userError'])) && (empty($data['passError'])) && (empty($data['passError2']))){
							
							$data['contra'] = password_hash($data['contra'],PASSWORD_DEFAULT);
							
							
							if($this->userModel->register($data)){
								header('location: ' . urlRoot . '/users/login');
							}else{
								die('Algo salío mal...!');
							}                    
						}
					}
								
					$this->view('users/register',$data);
					
				}
				
				
				public function createSession($user) {
					session_start();
					$_SESSION['autenticado'] = 'Si';
					$_SESSION['usuario'] = $user->nombre;
					$_SESSION['usuario_id'] = $user->id; 
					$_SESSION['is_admin'] = $user->is_admin;
					header('location: ' . urlRoot . '/pages/index');
				}
				
				
				public function logout(){
					session_start();
					unset($_SESSION['autenticado']);
					unset($_SESSION['usuario']);
					unset($_SESSION['is_admin']);
					header('location: ' . urlRoot . '/pages/index');
				}

				
				 
			}

		?>

