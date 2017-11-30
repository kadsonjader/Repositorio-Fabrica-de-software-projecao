<?php 
	define('SALTPREFIX', '2a');
	define('COST', '08');
	define('SALTLENGTH', 22);
	
	class CryptSenha{
		
		/*
		 * BIBLIOGRAFIA
		 * Acesso em: 10/04/17. Disponível em: http://blog.thiagobelem.net/criptografando-senhas-no-php-usando-bcrypt-blowfish
		 * */
		
		public function criptografar($senha){
			
			$salt = self::generateRandomSalt();
			$hashString = self::generateHashString(COST, $salt);
			
			return $hash = crypt($senha, $hashString); //para ser guardado no banco
					
		}
		
		private function generateRandomSalt() {
			// Salt seed
			$seed = uniqid(mt_rand(), true);
			// Generate salt
			$salt = base64_encode($seed);
			$salt = str_replace('+', '.', $salt);
			return substr($salt, 0, SALTLENGTH);
		}
		
		private function generateHashString($cost, $salt) {
			return sprintf('$%s$%02d$%s$', SALTPREFIX, $cost, $salt);
		}
		
		public function check($string, $hash) {
			return (crypt($string, $hash) === $hash);
		}
		
		
	}
	
?>