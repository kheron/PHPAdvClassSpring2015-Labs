<?php namespace week2\kheron;?>
<?php include './bootstrap.php';?>
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
        
        
        $email = filter_input(INPUT_POST, 'email');
        $emailType = filter_input(INPUT_POST, 'emailtype');
        $emailTypeid = filter_input(INPUT_POST, 'emailtypeid');
        $active = filter_input(INPUT_POST, 'active');
        
        $util = new Util();
        $validator = new Validator();
        $emailDAO = new EmailDAO($db);
        
        $emailTypeDAO = new EmailTypeDAO($db);
        
        //$emailtypeModel = new EmailTypeModel();
        //$emailtypeModel->setActive($active);
        //$emailtypeModel->setEmailtype($emailType);
        $emailTypes = $emailTypeDAO->getAllRows();
        
        
          
        
        $emailModel = new EmailModel();
        $emailModel->setEmail($email);
        //$emailModel->setLogged($logged);
       // $emailModel->setLastupdated($lastupdated);
        $emailModel->setActive($active);
        $emailModel->setEmailtypeid($emailTypeid);
        //$emailModel->setEmailtype($emailType);
        $emailService = new EmailService($db, $util, $validator, $emailDAO, $emailModel);    
        $emailService->saveForm();
        
        
        
        
        if ( $util->isPostRequest() ) {
            //var_dump($emailModel);
            /*
            if ( $emailDAO->save($emailModel) ) {
                echo 'Email Added';
            } else {
                echo 'Email not added using this';
            }
                 */   
        }
        
        ?>
        
        
         <h3>Add email</h3>
        <form action="#" method="post">
            <label>Email:</label>            
            <input type="text" name="email" value="<?php echo $email; ?>" placeholder="" />
            <br /><br />
            <label>Email Type:</label>
            <select name="emailtypeid">
            <?php 
                foreach ($emailTypes as $value) {
                    if ( $value->getEmailtypeid() == $emailTypeid ) {
                        echo '<option value="',$value->getEmailtypeid(),'" selected="selected">',$value->getEmailtype(),'</option>';  
                    } else {
                        echo '<option value="',$value->getEmailtypeid(),'">',$value->getEmailtype(),'</option>';
                    }
                }
            ?>
            </select>
            <br /><br />     
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />    
            <br /><br />
            <input type="submit" value="Submit" />
        </form>
         
         <?php 
            
         $emailService->displayEmails();

         ?>
         </table>         
         <a href="index.php">Home page</a><br /><br /> 
    </body>
</html>
