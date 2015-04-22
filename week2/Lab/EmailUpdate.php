<?php namespace week2\kheron;?>
<?php include './bootstrap.php'; 

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        $dbConfig = array(
            "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
            "DB_USER"=>'root',
            "DB_PASSWORD"=>''
        );

        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
       
        $util = new Util();
        $validator = new Validator();
        $emailDAO = new EmailDAO($db);
        $emailModel = new EmailModel();
         
        if ( $util->isPostRequest() ) {
            
            $emailModel->map(filter_input_array(INPUT_POST));
                       
        } else {
            $emailid = filter_input(INPUT_GET, 'emailid');
            $emailModel = $emailDAO->getById($emailid);
        }
        
        $emailid = $emailModel->getEmailid();
        $email = $emailModel->getEmail();
        $active = $emailModel->getActive();  
        $emailType = $emailModel->getEmailtype();
        $emailTypeid = $emailModel->getEmailtypeid();
              
        
        $emailService = new EmailService($db, $util, $validator, $emailDAO, $emailModel);
        
        $emailService->saveForm();

        ?>
        
        
         <h3>UPDATE email type</h3>
        <form action="#" method="post">
            <label>Email:</label>            
            <input type="text" name="email" value="<?php echo $email; ?>" placeholder="" />
            <br /><br />
            <input type="hidden" name="emailid" value="<?php echo $emailid; ?>" />
            <input type="hidden" name="emailtypeid" value="<?php echo $emailTypeid; ?>" />
            <label>Email Type:</label> 
            <input type="text" name="emailtype" value="<?php echo $emailType; ?>" placeholder="" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
             <br /><br />
            <input type="submit" value="Submit" />
        </form>
         
         
         <?php         
             $emailService->displayEmails();                        
         ?>
          <a href="index.php">Home page</a><br /><br /> 
    </body>
</html>
