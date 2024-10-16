<?php
			session_start();
			
			function isLoggedIn(){
				if(isset($_SESSION['usuario'])){
					return true;
				}else{
					return false;
				}
			}   
		?>