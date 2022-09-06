<?php
if(isset($_POST['Email'])){
    // used to store the subject of the email and who its being sent too
    // for testing purposes just my emial is here will figure out how to have multiple people at a later date
    $email_to = "galizio712@gmail.com";
    $email_subject = "dating website";

    //used to catch errors with the form submission
    function problems($error){
        echo "unfortunately there were problem(s) with your message. ";
        echo "These are the error(s) with your message <br>";
        echo $error . "<br><br>";
        echo "Please fix these errors and try to send your message again <br><br>";
        die();
    }

    //used to get the data from the form
    $sender_Name = $_POST['Name'];
    $sender_Email = $_POST['Email'];
    $sender_Message =$_POST['Message'];

    //empty error message to help the user submit a valid form
    $error_MSG ="";
    //regex used to check that the user has entered a vaild email
    $email_REGEX = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if(!preg_match($email_REGEX, $sender_Email)){
        $error_MSG .='This email address does not appear to be valid, please enter a valid email.<br>';
    }


    //checks to see if the message is validd by being longer then 2 charactes
    if(strlen($sender_Message)<2){
        $error_MSG .= 'The message entered does not appear to be valid';
    }
    //if we have ran into a problem call the problems displayer
    if(strlen($error_MSG) >0){
        problems($error_MSG);
    }
    $emailMessage = "DETAILS FROM FORM BELOW.\n\n";
    function cleaner($string){
        $bad = array("contact-type", "bcc: ", "to:", "cc:", "href");
        return str_replace($bad, "",$string);
    }
    //used to generate the message
    $emailMessage .= " Name: " . cleaner($sender_Name);
    $emailMessage .= "\n Email: " . cleaner($sender_Email);
    $emailMessage .= "\n Message: ". cleaner($sender_Message);

    //creates the header for the email

    $headers= 'From: ' . $sender_Email. "\r\n" .'Reply-To' . $sender_Email ."\r\n". 'X-Mailer: PHP/' .phpversion();
    @mail($email_to, $email_subject, $emailMessage, $headers);

?>

<!-- Success message -->
Thank you for getting in touch with us we will ge back to you ASAP
<?php
}
?>