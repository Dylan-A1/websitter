<?php
// Database Settings
define("DB_HOST", "localhost");
define("DB_NAME", "iam_database");
define("DB_CHARSET", "utf8mb4");
define("DB_USER", "root");
define("DB_PASSWORD", "");

// OTP Settings
define("OTP_VALID", 1); // Expires after 1 minute 
define("OTP_LEN", 8);    // 8 characters long

// Email Settings
define("FROM_EMAIL", "noreply@bluecare.com"); 

class OTP {
    private $pdo = null;
    private $stmt = null;
    public $error = "";
    
    function __construct() {
        try {
            // Constructs the data source name string using constants for database host, name and character set
            $this->pdo = new PDO(
                "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET,
                DB_USER, DB_PASSWORD, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            $this->error = "Connection failed to database: " . $e->getMessage();
        }
    }
 
    function __destruct() {
        if ($this->stmt !== null) { $this->stmt = null; }
        if ($this->pdo !== null) { $this->pdo = null; }
    }

    // A function is defined called 'query' that accepts '$sql' along with '$data,' being the data array 
    function query($sql, $data=null) {
        try {
            $this->stmt = $this->pdo->prepare($sql);
            $this->stmt->execute($data);
            return true;
        // Handles any PDOException errors that happen across the query execution
        } catch (PDOException $e) {
            $this->error = "Query failed: " . $e->getMessage();
            return false;
        }
    }

    // A function is defined called 'generate' that accepts an email address being an input
    function generate($email) {
        // Employs the '!filter_var' function to verify whether $email conforms to a valid email format
        // If not, the condition is assessed as true
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error = "Invalid email format";
            return false;
        }

        // Retrieves all records associated with OTP for the specified email from the otp table by executing an SQL query
        $this->query("SELECT * FROM `otp` WHERE `email`=?", [$email]);  
        $otp = $this->stmt->fetch();
        
        // Verifies whether '$otp' is an array and assesses if the current time precedes expiration time of the OTP
        if (is_array($otp) && (strtotime("now") < strtotime($otp["timestamp"])) + (OTP_VALID * 60)) {
            $this->error = "You already have a pending OTP.";
            return false;
        }

        // Generates the OTP with letters and numbers
        $alphabets = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = "";
        for ($i=0; $i<OTP_LEN; $i++) { 
            // In each iteration, a randomc character is chosen from '$alphabets' and added to '$pass'
            $pass .= $alphabets[rand(0, strlen($alphabets) - 1)]; 
        }

        // Tries are made to perform a 'SQL REPLACE INTO' query, which either adds a new OTP record
        // Or modifies an existing one if the email is present in the otp table
        if (!$this->query("REPLACE INTO `otp` (`email`, `pass`, `timestamp`) VALUES (?,?,NOW())",
            [$email, password_hash($pass, PASSWORD_DEFAULT)])) {
            return false;
        }

        
        $subject = 'OTP code';
        $message = "Here is your OTP code: $pass\n\nYou have ".OTP_VALID." minute before it expires.";
        $headers = "From: " . FROM_EMAIL . "\r\n" .
                   "Reply To: " . FROM_EMAIL . "\r\n" .
                   "X-Mailer: PHP/" . phpversion();

        // Tries to send an email using PHP's mail() function to send an email to the
        // designated recipient ($email) along with the '$subject' '$message' and '$headers'
        if (mail($email, $subject, $message, $headers)) {
            return true;
        } else {
            $this->error = "The OTP could not be sent.";
            return false;
        }
    }

    // A function is called 'challenge' where '$email,' and '$password' are input parameters
    function challenge($email, $pass) {
        // Runs an SQL query to obtain the OTP information linked to the specified email from the otp table
        $this->query("SELECT * FROM `otp` WHERE `email`=?", [$email]);
        $otp = $this->stmt->fetch();

        if (!is_array($otp)) {
            $this->error = "Request for the OTP was not found";
            return false;
        }
        
        // Transforms the present time 'now' and the timestamp of the OTP into Unix timestamps
        // subsequently verifying whether the OTP has expired
        if (strtotime("now") > strtotime($otp["timestamp"]) + (OTP_VALID * 60)) {
            $this->error = "OTP has expired.";
            return false;
        }

        if (!password_verify($pass, $otp["pass"])) {
            $this->error = "Incorrect OTP.";
            return false;
        }
        
        $this->query("DELETE FROM `otp` WHERE `email`=?", [$email]);
        return true;
    }
}

// The OTP class is created for a new instance and associated to the $_OTP variable
$_OTP = new OTP();
?>
