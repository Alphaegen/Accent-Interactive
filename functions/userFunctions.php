<?php
/**
* Secure login/registration user class.
*/

class User{
    /** @var object $pdo Copy of PDO connection */
    private $pdo;
    /** @var object of the logged in user */
    private $user;
    /** @var string error msg */
    private $msg;
    /** @var int number of permitted wrong login attemps */
    private $permitedAttemps = 5;

    /**
    * Connection init function
    * @param string $conString DB connection string.
    * @param string $user DB user.
    * @param string $pass DB password.
    *
    * @return bool Returns connection success.
    */
    public function dbConnect($conString, $user, $pass){
        if(session_status() === PHP_SESSION_ACTIVE){
            try {
                $pdo = new PDO($conString, $user, $pass);
                $this->pdo = $pdo;
                return true;
            }catch(PDOException $e) {
                $this->msg = 'Connection did not work out!';
                return false;
            }
        }else{
            $this->msg = 'Session did not start.';
            return false;
        }
    }

    /**
    * Return the logged in user.
    * @return user array data
    */
    public function getUser(){
        return $this->user;
    }

    /**
    * Login function
    * @param string $email User email.
    * @param string $password User password.
    *
    * @return bool Returns login success.
    */
    public function login($email,$password){
        if(is_null($this->pdo)){
            $this->msg = 'Connection did not work out!';
            return false;
        }else{
            $pdo = $this->pdo;
            $stmt = $pdo->prepare('SELECT id, fname, infix, lname, email, telephone, sname, snumber, city, postcode, country, confirmed, wrong_logins, password, user_role FROM users WHERE email = ? and confirmed = 1 limit 1');
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if(password_verify($password,$user['password'])){
                if($user['wrong_logins'] <= $this->permitedAttemps){
                    $this->user = $user;
                    session_regenerate_id();
                    $_SESSION['user']['id'] = $user['id'];
                    $_SESSION['user']['fname'] = $user['fname'];
                    $_SESSION['user']['infix'] = $user['infix'];
                    $_SESSION['user']['lname'] = $user['lname'];
                    $_SESSION['user']['email'] = $user['email'];
                    $_SESSION['user']['telephone'] = $user['telephone'];
                    $_SESSION['user']['sname'] = $user['sname'];
                    $_SESSION['user']['snumber'] = $user['snumber'];
                    $_SESSION['user']['city'] = $user['city'];
                    $_SESSION['user']['postcode'] = $user['postcode'];
                    $_SESSION['user']['country'] = $user['country'];
                    $_SESSION['user']['confirmed'] = $user['confirmed'];
                    $_SESSION['user']['user_role'] = $user['user_role'];
                    return true;
                }else{
                    $this->msg = 'This user account is blocked, please contact our support department.';
                    return false;
                }
            }else{
                $this->registerWrongLoginAttemp($email);
                $this->msg = 'Invalid login information or the account is not activated.';
                return false;
            }
        }
    }

    /**
    * Register a new user account function
    * @param string $email User email.
    * @param string $fname User first name.
    * @param string $lname User last name.
    * @param string $pass User password.
    * @return boolean of success.
    */
    public function registration($email, $fname, $infix, $lname, $telephone, $sname, $snumber, $postcode, $city, $country, $pass){
        $pdo = $this->pdo;
        if($this->checkEmail($email)){
            $this->msg = 'This email is already taken.';
            return false;
        }
        if(!(isset($email) && isset($fname) && isset($lname) && isset($pass) && filter_var($email, FILTER_VALIDATE_EMAIL))){
            $this->msg = 'Insert all valid requered fields.';
            return false;
        }

        $pass = $this->hashPass($pass);
        $confCode = $this->hashPass(date('Y-m-d H:i:s').$email);
        $stmt = $pdo->prepare('INSERT INTO users (email, fname, infix, lname, telephone, sname, snumber, postcode, city, country, password, confirm_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        if($stmt->execute([$email, $fname, $infix, $lname, $telephone, $sname, $snumber, $postcode, $city, $country, $pass,$confCode])){


            if($this->sendConfirmationEmail($email)){
                return true;
            }else{
                $this->msg = 'confirmation email sending has failed.';
                return false;
            }
        }else{
            $this->msg = 'Inserting a new user failed.';
            return false;
        }
    }

    /**
    * Email the confirmation code function
    * @param string $email User email.
    * @return boolean of success.
    */
    private function sendConfirmationEmail($email){
        $pdo = $this->pdo;
        $stmt = $pdo->prepare('SELECT confirm_code FROM users WHERE email = ? limit 1');
        $stmt->execute([$email]);
        $code = $stmt->fetch();

        $subject = 'Confirm your registration';
        $message = 'Please confirm you registration by pasting this code in the confirmation box: '.$code['confirm_code'];
        $headers = 'X-Mailer: PHP/' . phpversion();

        if(mail($email, $subject, $message, $headers)){
            return true;
        }else{
            return false;
        }
    }

    /**
    * Activate a login by a confirmation code and login function
    * @param string $email User email.
    * @param string $confCode Confirmation code.
    * @return boolean of success.
    */
    public function emailActivation($email,$confCode){
        $pdo = $this->pdo;
        $stmt = $pdo->prepare('UPDATE users SET confirmed = 1 WHERE email = ? and confirm_code = ?');
        $stmt->execute([$email,$confCode]);
        if($stmt->rowCount()>0){
            $stmt = $pdo->prepare('SELECT id, fname, lname, email, wrong_logins, user_role FROM users WHERE email = ? and confirmed = 1 limit 1');
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            $this->user = $user;
            session_regenerate_id();
            if(!empty($user['email'])){
            	$_SESSION['user']['id'] = $user['id'];
	            $_SESSION['user']['fname'] = $user['fname'];
	            $_SESSION['user']['lname'] = $user['lname'];
	            $_SESSION['user']['email'] = $user['email'];
	            $_SESSION['user']['user_role'] = $user['user_role'];
	            return true;
            }else{
            	$this->msg = 'Account activitation failed.';
            	return false;
            }
        }else{
            $this->msg = 'Account activitation failed.';
            return false;
        }
    }

    // /**
    // * Password change function
    // * @param int $id User id.
    // * @param string $pass New password.
    // * @return boolean of success.
    // */
    // public function passwordChange($id,$pass){
    //     $pdo = $this->pdo;
    //     if(isset($id) && isset($pass)){
    //         $stmt = $pdo->prepare('UPDATE users SET password = ? WHERE id = ?');
    //         if($stmt->execute([$id,$this->hashPass($pass)])){
    //             return true;
    //         }else{
    //             $this->msg = 'Password change failed.';
    //             return false;
    //         }
    //     }else{
    //         $this->msg = 'Provide an ID and a password.';
    //         return false;
    //     }
    // }


    public function EditUser($email, $fname, $infix, $lname, $telephone, $sname, $snumber, $postcode, $city, $country, $wrong_logins, $user_role, $confirmed, $id){
        $pdo = $this->pdo;
        $stmt = $pdo->prepare('UPDATE users SET email=?, fname=?, infix=?, lname=?, telephone=?, sname=?, snumber=?, postcode=?, city=?, country=?, wrong_logins=?, user_role=?, confirmed=? WHERE id=?');
        if($stmt->execute([$email, $fname, $infix, $lname, $telephone, $sname, $snumber, $postcode, $city, $country, $wrong_logins, $user_role, $confirmed, $id])){
            $this->msg = 'Editing user completed.';
            return true;
        }else{
            $this->msg = 'Editing user failed.';
            return false;
        }
    }

    public function RemoveUser($id){
        $pdo = $this->pdo;
        $stmt = $pdo->prepare('DELETE FROM users WHERE id=?');
        if($stmt->execute([$id])){
            $this->msg = 'Removing user completed.';
            return true;
        }else{
            $this->msg = 'Removing user failed.';
            return false;
        }
    }

    public function AddUser($email, $fname, $infix, $lname, $telephone, $sname, $snumber, $postcode, $city, $country, $wrong_logins, $user_role, $confirmed, $password){
        $pdo = $this->pdo;
        if($this->checkEmail($email)){
            $this->msg = 'This email is already taken.';
            return false;
        }
        if(!(isset($email) && isset($fname) && isset($lname) && isset($password) && filter_var($email, FILTER_VALIDATE_EMAIL))){
            $this->msg = 'Insert all valid required fields.';
            return false;
        }

        $pass = $this->hashPass($password);
        $confCode = $this->hashPass(date('Y-m-d H:i:s').$email);
        $stmt = $pdo->prepare('INSERT INTO users (email, fname, infix, lname, telephone, sname, snumber, postcode, city, country, wrong_logins, user_role, confirmed, password, confirm_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        if($stmt->execute([$email, $fname, $infix, $lname, $telephone, $sname, $snumber, $postcode, $city, $country, $wrong_logins, $user_role, $confirmed, $pass, $confCode])){
            if($this->sendConfirmationEmail($email)){
                return true;
            }else{
                $this->msg = 'confirmation email sending has failed.';
                return false;
            }
        }else{
            $this->msg = 'Inserting a new user failed.';
            return false;
        }
    }





    // EventPage
    public function EditEvent($img, $eventname, $seats, $starttime, $endtime, $city, $address, $description, $smalldesc, $price, $id){
        $pdo = $this->pdo;
        $stmt = $pdo->prepare('UPDATE events SET img=?, eventname=?, seats=?, starttime=?, endtime=?, city=?, address=?, description=?, smalldesc=?, price=? WHERE id=?');
        if($stmt->execute([$img, $eventname, $seats, $starttime, $endtime, $city, $address, $description, $smalldesc, $price, $id])){
            $this->msg = 'Editing event completed.';
            return true;
        }else{
            $this->msg = 'Editing event failed.';
            print_r($stmt->errorInfo());
            return false;
        }
    }

    public function RemoveEvent($id){
        $pdo = $this->pdo;
        $stmt = $pdo->prepare('DELETE FROM events WHERE id=?');
        if($stmt->execute([$id])){
            $this->msg = 'Removing event completed.';
            return true;
        }else{
            $this->msg = 'Removing event failed.';
            return false;
        }
    }

    public function AddEvent($img, $eventname, $seats, $starttime, $endtime, $city, $address, $description, $smalldesc, $price){
        $pdo = $this->pdo;
        $stmt = $pdo->prepare('INSERT INTO events (img, eventname, seats, starttime, endtime, city, address, description, smalldesc price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        if($stmt->execute([$img, $eventname, $seats, $starttime, $endtime, $city, $address, $description, $smalldesc, $price])){
                return true;
        }else{
            $this->msg = 'Inserting a new event failed.';
            print_r($stmt->errorInfo());
            return false;
        }
    }

    public function Pay($id, $email, $quantity){
      $pdo = $this->pdo;
      $firstQuery = $pdo->prepare('SELECT price, eventname FROM events WHERE id=?');

      if($firstQuery->execute([$id])) {
        $firstQueryResults = $firstQuery->fetch();

        $eventname = $firstQueryResults['eventname'];
        $priceperticket = floatval($firstQueryResults['price']);
        $numberoftickets = floatval($quantity);

        $total = floatval($numberoftickets * $priceperticket);
        $stmt = $pdo->prepare('INSERT INTO orders (eventname, user_email, seats, total) VALUES (?, ?, ?, ?)');

          if($stmt->execute([$eventname, $email, $quantity, $total])){
                  return true;
          }else{
            $this->msg = 'Inserting a new order failed.';
            print_r($stmt->errorInfo());
            return false;
          }
      }else{
        $this->msg = 'Price per ticket is not known.';
        print_r($stmt->errorInfo());
        return false;
      }
    }


    /**
    * Check if email is already used function
    * @param string $email User email.
    * @return boolean of success.
    */
    private function checkEmail($email){
        $pdo = $this->pdo;
        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ? limit 1');
        $stmt->execute([$email]);
        if($stmt->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }


    /**
    * Register a wrong login attemp function
    * @param string $email User email.
    * @return void.
    */
    private function registerWrongLoginAttemp($email){
        $pdo = $this->pdo;
        $stmt = $pdo->prepare('UPDATE users SET wrong_logins = wrong_logins + 1 WHERE email = ?');
        $stmt->execute([$email]);
    }

    /**
    * Password hash function
    * @param string $password User password.
    * @return string $password Hashed password.
    */
    private function hashPass($pass){
        return password_hash($pass, PASSWORD_DEFAULT);
    }

    /**
    * Print error msg function
    * @return void.
    */
    public function printMsg(){
        print $this->msg;
    }

    /**
    * Logout the user and remove it from the session.
    *
    * @return true
    */
    public function logout() {
        $_SESSION['user'] = null;
        session_regenerate_id();
        return true;
    }



    /**
    * List users function
    *
    * @return array Returns list of users.
    */
    public function listUsers(){
        if(is_null($this->pdo)){
            $this->msg = 'Connection did not work out!';
            return [];
        }else{
            $pdo = $this->pdo;
            $stmt = $pdo->prepare('SELECT id, fname, infix, lname, email, telephone, sname, snumber, postcode, city, country, wrong_logins, user_role, confirmed FROM users');
            $stmt->execute();
            $users = $stmt->fetchAll();
            return $users;
        }
    }

    /**
    * List users function
    *
    * @return array Returns list of events.
    */
    public function listEvents(){
        if(is_null($this->pdo)){
            $this->msg = 'Connection did not work out!';
            return [];
        }else{
            $pdo = $this->pdo;
            $stmt = $pdo->prepare('SELECT id, img, eventname, seats, starttime, endtime, city, address, description, smalldesc, price FROM events ORDER BY starttime ASC');
            $stmt->execute();
            $events = $stmt->fetchAll();
            return $events;
        }
    }

    /**
    * List users function
    *
    * @return array Returns list of events.
    */
    public function listOrders($admin, $email){
        if(is_null($this->pdo)){
            $this->msg = 'Connection did not work out!';
            return [];
        }else{
            $pdo = $this->pdo;
            if($admin==false) {
              $stmt = $pdo->prepare('SELECT id, user_email, eventname, seats, total, timestamp FROM orders WHERE user_email=? ORDER BY timestamp DESC');
              $stmt->execute([$email]);
            }else{
              $stmt = $pdo->prepare('SELECT id, user_email, eventname, seats, total, timestamp FROM orders ORDER BY timestamp DESC');
              $stmt->execute();
            }

            $orders = $stmt->fetchAll();
            return $orders;
        }
    }

    /**
    * List users function
    *
    * @return array Returns list of events.
    */
    public function eventDetails($id){
        if(is_null($this->pdo)){
            $this->msg = 'Connection did not work out!';
            return [];
        }else{
            $pdo = $this->pdo;
            $stmt = $pdo->prepare('SELECT img, eventname, seats, starttime, endtime, city, address, description, price FROM events WHERE id=?');
            $stmt->execute([$id]);
            $events = $stmt->fetchAll();
            return $events;
        }
    }

    /**
    * Simple template rendering function
    * @param string $path path of the template file.
    * @return void.
    */
    public function render($path,$vars = '') {
        ob_start();
        include($path);
        return ob_get_clean();
    }

    /**
    * Template for login form function
    * @return void.
    */
    public function loginForm() {
        print $this->render(loginForm);
    }

    /**
    * Template for register form function
    * @return void.
    */
    public function registerForm() {
        print $this->render(registerForm);
    }

    /**
    * Template for register form function
    * @return void.
    */
    public function detailPage($id) {
      $event = $this->eventDetails($id);
        print $this->render(detailpage, $event);
    }


    /**
    * Template for user page function
    * @return void.
    */
    public function userPage() {
	$users = [];
	if($_SESSION['user']['user_role'] == 2){
		$users = $this->listUsers();
	}
        print $this->render(userPage,$users);
    }

    /**
    * Template for events function
    * @return void.
    */
    public function eventPage() {
  $events = [];
  if($_SESSION['user']['user_role'] == 2){
    $events = $this->listEvents();
  }
    print $this->render(eventList,$events);
    }

    /**
    * Template for events function
    * @return void.
    */
    public function orderPage() {
  $email = $_SESSION['user']['email'];
  $orders = [];
  if($_SESSION['user']['user_role'] == 2){
    $admin = true;
    $orders = $this->listOrders($admin, $email);
  } else {
    $admin = false;
    $orders = $this->listOrders($admin, $email);
  }
    print $this->render(orderList,$orders);
    }

    /**
    * Template for events function
    * @return void.
    */
    public function events() {
  $event = [];
  $event = $this->listEvents();
  print $this->render(tickets,$event);
    }
  }
