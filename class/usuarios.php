<?php
class Usuarios{   
    
    private $usuariosTable = "usuarioswsv3";     
	public $id; 
	public $conteo_mensajes;
	public $mensaje_principal; 
	public $mensaje_lineal; 
	public $vip;
	public $name_fecha_restante;
	public $whatsapp_accounts_phone_number;
	public $whatsapp_accounts_updated_at;
	public $subscription_plan_name;
	public $subscription_expired_at;
	public $subscription_updated_at;
	public $account_limit;

    private $conn;
	
    public function __construct($db){
        $this->conn = $db;
    }	
	
	function read(){	
		if($this->id) {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->usuariosTable." WHERE id = ?");
			$stmt->bind_param("i", $this->id);					
		} else {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->usuariosTable);		
		}		
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
	
	function create(){
		
		$stmt = $this->conn->prepare("
			INSERT INTO ".$this->usuariosTable."(
				`conteo_mensajes`, 
				`mensaje_principal`, 
				`mensaje_lineal`, 
				`vip`, 
				`name_fecha_restante`, 
				`whatsapp_accounts_phone_number`, 
				`whatsapp_accounts_updated_at`, 
				`subscription_plan_name`, 
				`subscription_expired_at`, 
				`subscription_updated_at`, 
				`account_limit`
				)VALUES(?,?,?,?,?,?,?,?,?,?,?)");
		
		$this->conteo_mensajes = htmlspecialchars(strip_tags($this->conteo_mensajes));
		$this->mensaje_principal = htmlspecialchars(strip_tags($this->mensaje_principal));
		$this->mensaje_lineal = htmlspecialchars(strip_tags($this->mensaje_lineal));
		$this->vip = htmlspecialchars(strip_tags($this->vip));
		$this->name_fecha_restante = htmlspecialchars(strip_tags($this->name_fecha_restante));
		$this->whatsapp_accounts_phone_number = htmlspecialchars(strip_tags($this->whatsapp_accounts_phone_number));
		$this->whatsapp_accounts_updated_at = htmlspecialchars(strip_tags($this->whatsapp_accounts_updated_at));
		$this->subscription_plan_name = htmlspecialchars(strip_tags($this->subscription_plan_name));
		$this->subscription_expired_at = htmlspecialchars(strip_tags($this->subscription_expired_at));
		$this->subscription_updated_at = htmlspecialchars(strip_tags($this->subscription_updated_at));
		$this->account_limit = htmlspecialchars(strip_tags($this->account_limit));

		$stmt->bind_param("sssssssssss", 
		$this->conteo_mensajes, 
		$this->mensaje_principal, 
		$this->mensaje_lineal, 
		$this->vip, 
		$this->name_fecha_restante, 
		$this->whatsapp_accounts_phone_number, 
		$this->whatsapp_accounts_updated_at, 
		$this->subscription_plan_name, 
		$this->subscription_expired_at, 
		$this->subscription_updated_at, 
		$this->account_limit);

		if($stmt->execute()){
			return true;
		}
	 
		return false;		 
	}
		
	function update(){
	 
		$stmt = $this->conn->prepare("
			UPDATE ".$this->usuariosTable." SET 
			`nombre`=?,
			`conteo_mensajes`=?, 
				`mensaje_principal`=?, 
				`mensaje_lineal`=?, 
				`vip`=?, 
				`name_fecha_restante`=?, 
				`whatsapp_accounts_phone_number`=?, 
				`whatsapp_accounts_updated_at`=?, 
				`subscription_plan_name`=?, 
				`subscription_expired_at`=?, 
				`subscription_updated_at`=?, 
				`account_limit`=?
			WHERE `id` = ?");
	 
			$this->conteo_mensajes = htmlspecialchars(strip_tags($this->conteo_mensajes));
			$this->mensaje_principal = htmlspecialchars(strip_tags($this->mensaje_principal));
			$this->mensaje_lineal = htmlspecialchars(strip_tags($this->mensaje_lineal));
			$this->vip = htmlspecialchars(strip_tags($this->vip));
			$this->name_fecha_restante = htmlspecialchars(strip_tags($this->name_fecha_restante));
			$this->whatsapp_accounts_phone_number = htmlspecialchars(strip_tags($this->whatsapp_accounts_phone_number));
			$this->whatsapp_accounts_updated_at = htmlspecialchars(strip_tags($this->whatsapp_accounts_updated_at));
			$this->subscription_plan_name = htmlspecialchars(strip_tags($this->subscription_plan_name));
			$this->subscription_expired_at = htmlspecialchars(strip_tags($this->subscription_expired_at));
			$this->subscription_updated_at = htmlspecialchars(strip_tags($this->subscription_updated_at));
			$this->account_limit = htmlspecialchars(strip_tags($this->account_limit));
			$this->id = htmlspecialchars(strip_tags($this->id));
	 
		$stmt->bind_param("sssssssssssi", 
		$this->conteo_mensajes, 
		$this->mensaje_principal, 
		$this->mensaje_lineal, 
		$this->vip, 
		$this->name_fecha_restante, 
		$this->whatsapp_accounts_phone_number, 
		$this->whatsapp_accounts_updated_at, 
		$this->subscription_plan_name, 
		$this->subscription_expired_at, 
		$this->subscription_updated_at, 
		$this->account_limit,
		$this->id);
		
		if($stmt->execute()){
			return true;
		}
	 
		return false;
	}
	
	function delete(){
		
		$stmt = $this->conn->prepare("
			DELETE FROM ".$this->usuariosTable." 
			WHERE id = ?");
			
		$this->id = htmlspecialchars(strip_tags($this->id));
	 
		$stmt->bind_param("i", $this->id);
	 
		if($stmt->execute()){
			return true;
		}
	 
		return false;		 
	}

	function estado(){	
		if($this->id) {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->usuariosTable." WHERE whatsapp_accounts_phone_number = ? ORDER BY id DESC LIMIT 1");
			$stmt->bind_param("s", $this->id);					
		} else {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->usuariosTable." WHERE whatsapp_accounts_phone_number = ? ORDER BY id DESC LIMIT 1");		
		}		
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
		
}
?>