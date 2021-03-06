  <?php 

 class User {
    

 protected static $db_table = "users";  
 public $id;
 public $username;
 public $password;
 public $first_name;
 public $last_name;



 

     public static function find_all_users(){
      return self::find_this_query(" SELECT * FROM users ");


     }

    public static function find_users_by_id($user_id){
    
     global $database;

     $the_result_array = self::find_this_query("SELECT * FROM users WHERE id = $user_id LIMIT 1");
     return !empty($the_result_array) ? array_shift($the_result_array):false;

     return $found_user;

    }



    public static function find_this_query($sql){
        
    	global $database;
        
    	$result_set = $database-> query($sql);

    	$the_object_array = array();
         
        while($row = mysqli_fetch_array($result_set)){

        	$the_object_array[] = self::instantation($row);

        }

       /* debugger($the_object_array,true);*/
        return $the_object_array;

    }

     public static  function verify_user($username, $password){

      global $database;

      $username = $database->escape_string($username);
      
      $password = $database->escape_string($password);

      $sql = " SELECT * FROM  users WHERE ";
      $sql.= " username = '{$username}' ";
      $sql.= " AND password = '{$password}'";
      $sql.= "LIMIT 1";   

    $the_result_array =  self::find_this_query($sql);

    return !empty($the_result_array) ? array_shift($the_result_array) : false;


     } 


    public  static function instantation($the_record){

          $the_object = new self;

          foreach ($the_record as $the_attribute => $value){
           
           if($the_object->has_the_attribute($the_attribute)){

           	 $the_object->$the_attribute = $value;
           }

          } 
          return $the_object;    
    }

 

    private function has_the_attribute($the_attribute){

        $object_properties = get_object_vars($this);

        return array_key_exists($the_attribute, $object_properties);

    }

    
    protected  function properties(){

      return get_object_vars($this);
    }
    



   public function save(){

    return isset($this->id) ? $this->update() : $this->create();


   }


    public function create() {

     global $database;
      $properties = $this->properties();

     $sql = "INSERT INTO " .self::$db_table. "(". implode(",",array_keys($properties))  .")";
     $sql.= "VALUES ('".  implode(" ',' ", array_values($properties))."') ";
     

     

    if($database->query($sql)){

       $this->id = $database ->the_insert_id();

       return true;
      
    } else {

      return false;

    }



    }


    public function update(){
     
     global $database;
     $sql = " UPDATE " .self::$db_table. " SET  ";
     $sql.=  " username= '".$database->escape_string($this->username)." ',";
     $sql.=  " password= '".$database->escape_string($this->password)." ',";
     $sql.=  " first_name= '".$database->escape_string($this->first_name)." ',";
     $sql.=  " last_name= '".$database->escape_string($this->last_name) ." '";
     $sql.=  " WHERE id= '".$database->escape_string($this->id);

      /*debugger($sql,true);// error sql falikrako xa*/
      
      $database->query($sql);
     


      return (mysqli_afftected_rows($database->connection) == 1) ? true : false;


    } // end of update method

    public function delete(){

      global $database;

      $sql = " DELETE FROM  " .self::$db_table. " ";
      $sql.= " WHERE id= ". $database->escape_string($this->id);
      $sql.= " LIMIT 1";
      debugger($sql,true);
      $database->query($sql);
      return (mysqli_afftected_rows($database->connection) == 1) ? true : false;

  

    }//end of delte method




 } //End OF userClass

 ?>