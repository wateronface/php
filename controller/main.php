<?php
class main extends spController
{
	function index(){
		//这里需要判断session
		if(isset($_SESSION['username'])){
			$this->display("main.htm"); // 显示模板，这里使用的模板是根目录/tpl/green/index.html。
		}else{
			$this->display("login.htm"); // 显示模板，这里使用的模板是根目录/tpl/green/index.html。
		}
	}

		
		
	function loginform(){
        $this->display("login.htm"); // 显示模板，这里使用的模板是根目录/tpl/green/index.html。
        
	}
	
	function login(){
        $username = $this->spArgs("username"); // 用spArgs接收spUrl传过来的username
        $password = $this->spArgs("password"); // 用spArgs接收spUrl传过来的password
        	
        
        $user = spClass("user");  // 还是用spClass
        $conditions = array('username'=>$username,'password'=>$password); // 制造查找条件，这里是使用ID来查找属于ID的那条留言记录
        $result = $user->find($conditions);  // 这次是用find来查找，我们把$condition（条件）放了进去
        if($result){
        	$_SESSION['username']=$username;
        	$_SESSION['password']=$password;
        	spClass('spAcl')->set($result['role']);
        	$this->jump("index.php?c=main&a=index");
        }else{
        	unset($_SESSION['username']);
        	unset($_SESSION['password']);
        	spClass('spAcl')->set("");
        	$this->jump("index.php?c=main&a=loginform");
        }
        
	}
	
	
	function logout(){
    	unset($_SESSION['username']);
    	unset($_SESSION['password']);
    	spClass('spAcl')->set("");
        $this->display("login.htm"); // 显示模板，这里使用的模板是根目录/tpl/green/index.html。
	}
	
	
}