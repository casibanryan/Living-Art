<?php
    $connection = new mysqli("localhost", "root", "", "living_art");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require "../phpmailer/src/Exception.php";
    require "../phpmailer/src/PHPMailer.php";
    require "../phpmailer/src/SMTP.php";

    function post_art() {
        global $connection;
        $title = $_POST['title'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $categories = $_POST['categories'];
        $description = $_POST['description'];
        $features = $_POST['features'];
        $user_id = $_POST['user_id'];
        if($user_id) {
            $path = "../images/shop/artwork/";
            $filename = $title . "-" . rand(1,50);
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $finalname = $filename . '.' . $ext;
            $image = $finalname;
            $tmp = $_FILES['image']['tmp_name'];
            $path .= $finalname;
            move_uploaded_file($tmp, $path);
            $query_insert = "call post_art(?, ?, ?, ?, ?, ?, ?, ?)";
            $cmd = $connection->prepare($query_insert);
            $cmd->bind_param('ssiisssi', $image, $title, $price, $quantity, $categories, $description, $features, $user_id);
            if($cmd->execute()) {
                echo 1;
            } 
            else {
                echo 0;
            }
        }
        else {
            echo 3; // not login
        }
    
        $cmd->close();
        $connection->close();
    }

    function show_artwork() {
        global $connection;
        $query_show = "call show_artwork()";
        $cmd = $connection->prepare($query_show);
        $cmd->execute();

        $result = $cmd->get_result();
        if($result) {
            $data = array();
            while($r = $result->fetch_array())
            {
                $data[] = $r;
            }
            echo json_encode($data);
        }
        else {
            echo json_encode(mysqli_error($connection));
        }

        $cmd->close();
        $connection->close();
    }

    function on_search($id) {
        global $connection;
        $query_onSearch = "call on_search(?)";
        $cmd = $connection->prepare($query_onSearch);
        $cmd->bind_param('i', $id);
        $cmd->execute();

        $result = $cmd->get_result();
        if($result) {
            $data = array();
            while($r = $result->fetch_array())
            {
                $data[] = $r;
            }
            echo json_encode($data);
        }
        else {
            echo json_encode(mysqli_error($connection));
        }
        $cmd->close();
        $connection->close();
    }


    function contact_us() {
        global $connection;
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $query_contact_us = "call contact_us(?, ?, ?, ?)";
        $cmd = $connection->prepare($query_contact_us);
        $cmd->bind_param('ssss', $name, $email, $subject, $message);

        if($cmd->execute()) {
            echo 1;
        }
        else {
            echo 0;
        }

        $cmd->close();
        $connection->close();
    }

    function fnSignUp(){
        global $connection;
        $email = $_POST['email'];
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $getemailquery = $connection->prepare("SELECT * FROM user_table where email = ?");
        $getemailquery->bind_param("s",$email);
        $getemailquery->execute();
        $getemailresult = $getemailquery->get_result();
        if(mysqli_num_rows($getemailresult) == 0){
            $query = $connection->prepare("INSERT INTO user_table(fullname, username, email, pword) VALUES(?,?,?,?)");
            $query->bind_param("ssss",$fullname, $username, $email, $password);
            $query->execute();
            $query->close();

            echo 2; // user successfully saved;
        }
        else
        {
            echo 1; // email already exists
        }
        $connection->close();
    }

    function login(){
        global $connection;
        $email = $_POST['email'];
        $password = $_POST['password'];
        $query = $connection->prepare("SELECT * FROM user_table WHERE email = ?");
        $query->bind_param("s", $email);
        $query->execute();
        $result = $query->get_result();
        if(mysqli_num_rows($result) == 0){
            echo 2; // email not exists
        }
        else
        {
            while($row = $result->fetch_array()){
                if($row['pword'] == $password){
                    $_SESSION['user_id'] = $row["user_id"];
                    $_SESSION['email'] = $row["email"];
                    $_SESSION['fullname'] = $row["fullname"];
                    echo 1; // login success
                }
                else {
                    echo 3; // incorrect password
                }
            }
        }
        $query->close();
        $connection->close();
    }

    function add_toCart() {
        global $connection;
        $user_id = $_POST['user_id'];
        $art_id = $_POST['art_id'];
        $query_add_toCart = "call add_toCart(?, ?)";
        $query = $connection->prepare($query_add_toCart);
        $query->bind_param("ii", $user_id, $art_id);
        if($query->execute()) {
           echo 1;
        }
        else {
           echo 0;
        }
        $query->close();
        $connection->close();
    }

    function view_cart() {
        global $connection;
        $user_id = $_POST['user_id'];
        $query_show = "SELECT * FROM cart WHERE user_id = $user_id";
        $cmd = $connection->prepare($query_show);
        $cmd->execute();
        $result = $cmd->get_result();
        if($cmd) {
            $data = array();
            while($i = $result->fetch_array()) {
                $art_id = $i['art_id'];
                $query_art = $connection->prepare("SELECT * FROM artwork WHERE art_id = $art_id");
                $query_art->execute();
                $artwork = $query_art->get_result();
                While($j = $artwork->fetch_array()) {
                    $data[] = $j;
                }
                $query_art->close();
            }
            echo json_encode($data);
        }
        else {
            echo json_encode(mysqli_error($connection));
        }
        $cmd->close();
        $connection->close();
    }

    function delete_cart() {
        global $connection;
        $art_id = $_POST['art_id'];
        $user_id = $_POST['user_id'];
        $query_delete = $connection->prepare("DELETE FROM cart WHERE art_id = $art_id AND user_id = $user_id");
        $query_delete->execute();
        $query_delete->close();
        $connection->close();
    }

    function checkout() {
        global $connection;
        $full_name = $_POST['full_name'];
        $user_address = $_POST['user_address'];
        $zipcode = $_POST['zipcode'];
        $city = $_POST['city'];
        $country = $_POST['user_country'];
        $items = $_POST['items'];
        $total = $_POST['total'];
        $user_id = $_POST['user_id'];
        $query_order = $connection->prepare("call checkout(?,?,?,?,?,?,?,?)");
        $query_order->bind_param('ssissiii', $full_name, $user_address, $zipcode, $city, $country, $items, $total, $user_id);
        if($query_order->execute()) {
            echo 1;
        }
        else {
            echo 0;
        }
        $query_order->close();
        $connection->close();
    }

    function clear_cart() {
        global $connection;
        $user_id = $_POST['user_id'];
        $query = $connection->prepare("DELETE FROM cart WHERE user_id = $user_id");
        $query->execute();
        $query->close();
        $connection->close();
    }

    function not_show() {
        global $connection;
        $order_id = $_POST['order_id'];
        $query = $connection->prepare("call not_show('$order_id')");
        if($query->execute()) {
            echo 1;
        }
        else {
            echo 0;
        }
        $query->close();
        $connection->close();
    }

    function view_address() {
        global $connection;
        $id = $_POST['id'];
        $query = $connection->prepare("SELECT * FROM checkout WHERE order_id = $id");
        $query-> execute();
        $result = $query->get_result();
        $data = array();
        while($row = $result->fetch_array()) {
            $data[] = $row;
        }
        echo json_encode($data);
        $query->close();
        $connection->close();
    }

    function update_address() {
        global $connection;
        $id = $_POST['order_id'];
        $full_name = $_POST['full_name'];
        $user_address = $_POST['user_address'];
        $zipcode = $_POST['zipcode'];
        $city = $_POST['city'];
        $user_country = $_POST['user_country'];
        $phone = $_POST['phone'];

        $query = $connection->prepare("call update_address(?, ?, ?, ?, ?, ?, ?)");
        $query->bind_param('ssissii', $full_name, $user_address, $zipcode, $city, $user_country, $phone, $id);
        if($query-> execute()) {
            echo 1;
        }
        else {
            echo 0;
        }
        $query->close();
        $connection->close();
    }

    function upload_profile() {
        global $connection;
        $user_id = $_POST['user_id'];
        $path = "../images/profile/";
        $filename = "Profile-" . uniqid();
        $ext = pathinfo($_FILES["profile_picture"]["name"], PATHINFO_EXTENSION);
        $finalname = $filename .".".$ext;
        $image = $finalname;
        $tmp = $_FILES['profile_picture']['tmp_name'];
        $path .= $finalname;
        move_uploaded_file($tmp, $path);
        $query = "UPDATE user_table SET profile = ? WHERE user_id = ?";
        $cmd = $connection->prepare($query);
        $cmd->bind_param('si', $image, $user_id);
        if($cmd->execute()) {
            echo 1;
        }
        else {
            echo 0; 
        } 
        $cmd->close();
        $connection->close();
    }
    
    function forgot_password(){
        global $connection;
        $email = $_POST['email'];
        $verification_code = rand(100000, 999999);
        $query = $connection->prepare("SELECT * FROM user_table WHERE email = ?");
        $query->bind_param('s', $email);
        $query->execute();
        $result = $query->get_result();
        if(mysqli_num_rows($result) == 0){
            echo 2; // email not exists
        }
        else
        {   
            // Store the cipher method
            $ciphering = "AES-128-CTR";
            // Use OpenSSl Encryption method
            $iv_length = openssl_cipher_iv_length($ciphering);
            $options = 0;
            // Non-NULL Initialization Vector for encryption
            $encryption_iv = '1234567891011121';
            // Store the encryption key
            $encryption_key = "GeeksforGeeks";
            // Use openssl_encrypt() function to encrypt the data
            $encryption = openssl_encrypt($verification_code, $ciphering,$encryption_key, $options, $encryption_iv);
            $body = "Verification code : ".$verification_code.", Click <a href='http://localhost/art-system/reset-password.php?email=".$email."&verification-code=".$encryption."' target='_blank'>here</a> to reset your password";
            $subject = "Reset Password";
            mailer($email,$body,$subject);
        }
        $connection->close();
    }

    function reset_password() {
        global $connection;
        $verification_code = $_POST['code1']; // encrpyted code
        // Non-NULL Initialization Vector for decryption
        $decryption_iv = '1234567891011121';
        // Store the decryption key
        $decryption_key = "GeeksforGeeks";
        // Use openssl_decrypt() function to decrypt the data
        $decryption=openssl_decrypt ($verification_code, "AES-128-CTR", $decryption_key, 0, $decryption_iv);
        $code = $_POST['code']; // user input
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if($code != $decryption || $password != $confirm_password) {
            echo 2; // wrong verification code and not equal password
        }
        else {
            $query = $connection->prepare("UPDATE user_table SET pword = ? WHERE email = ?");
            $query->bind_param("ss", $password, $email);
            $query->execute();
            echo 1; // correct
        }
        $query->close();
        $connection->close();
    }

    function mailer($email, $body, $subject){
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'TLS';
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->IsHTML(true);
        $mail->Username = "lord.ochea@gmail.com";
        $mail->Password = "boang utok@l";
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->setFrom("lord.ochea@gmail.com");
        $mail->addAddress($email);
        $mail->Subject = $subject;
        $mail->MsgHTML($body);
        if(!$mail->send()){
            echo json_encode($mail->ErrorInfo);
        }
        else{
            echo 1;
        }
    }

    function newsletter() {
        $email = $_POST['email'];
        $body = 'Thank you for subscribing us, unfortunately our email marketing is under maintenance char, hahah, we will update this soon.!';
        $subject = "Subscription Email ";
        mailer($email,$body,$subject);
    }

?>

