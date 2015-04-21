<?php include './bootstrap.php'; ?>
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

        $emailType = filter_input(INPUT_POST, 'emailtype');
        $emailTypeID = filter_input(INPUT_POST, 'emailtypeID');
        $active = filter_input(INPUT_POST, 'active');
        
        $util = new Util();
        $validator = new Validator();
        $emailTypeDAO = new EmailTypeDAO($db);
        
        $emailtypeModel = new EmailTypeModel();
        $emailtypeModel->setActive($active);
        $emailtypeModel->setEmailtype($emailType);

        
        $emailTypeService = new EmailTypeService($db, $util, $validator, $emailTypeDAO, $emailtypeModel);
        
        $emailTypeService->saveForm();
    
        ?>
        
        <h3>Add email type</h3>
        <form action="#" method="post">
            <label>Email Type:</label> 
            <input type="text" name="emailtype" value="<?php echo $emailType; ?>" placeholder="" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
             <br /><br />
            <input type="submit" value="Submit" />
        </form>
        
        <?php         
             $emailTypeService->displayEmails();
         ?>
          <a href="index.php">Home page</a><br /><br /> 
    </body>
</html>
