<?php 
class RegistrationPage extends SuperPage {

    public static $User;
    
    public static $RegistrationUser;

    public static $CourseList;

    public static $CourseInfo;

    public static $Instructor;

    public static $coursesArray;

    public static $Tuition;

    public static $title = "Course Registration Form";

    static function PrintHeader()
    { ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title></title>
            <meta charset="utf-8">
            <meta name="author" content="<?php echo static::$author; ?>">
            <title><?php echo static::$title; ?></title>
            <link href="<?php echo static::$style; ?>" rel="stylesheet">
            <link href="<?php echo static::$bootstrapStyle; ?>" rel="stylesheet">
        </head>

        <body>
            <header>
                <div class="header-container">
                    <h1><?php echo static::$title; ?></h1>
                    <div><?php echo "UserID: " .$_SESSION['loggedin']; ?></div>
                    <a class="btn btn-link" href="LogOut.php">Log Out</a>
                </div>
            </header>

            <?php static::onMessage(); ?>
            <article>
    <?php }
    //End PrintHeader()
    
    static function body() {
        self::printTable();
        self::PrintForm();
        self::PrintCourseInfo();
    }

    //Print all the course information registred by a student
    static function printTable() {
    $RegistrationUser = self::$RegistrationUser;
        ?>
        <section class="main">
        <table class="table table-striped table-dark">
            <thead>
            <tr>
                <th>CRN</th>
                <th>Subject</th>
                <th>Title</th>
                <th>Registered on:</th>
                <th>Drop</th>
            </tr>
            <?php 
            foreach($RegistrationUser as $courses)
            {
                self::$coursesArray[] = $courses->getSubject()."-".$courses->getCRN();
                echo "<tr>";
                    echo "<td>".$courses->getCRN() ."</td>";
                    echo "<td>".$courses->getSubject() ."</td>";
                    echo "<td>".$courses->getTitle() ."</td>";
                    echo "<td>".$courses->getRegistrationDate() ."</td>";
                    echo "<td><a href='delete-registration?crn=" . $courses->getCRN() . "&subject=" . $courses->getSubject() . "'>drop course</a></td>";
                    
                echo "</tr>";
            }
            ?>
        </thead>
        </table>
        <!-- Tuition payment form -->
        <form method="post">
            <label for="tuition"><strong>Tuition Due:</strong></label>
            <input type="text" disabled value="<?php echo self::$Tuition->getAmountOwing();?>"/>
            <input type="number" name="payment"/>
            <input class="btn btn-primary btn-sm" type="submit" name="TuitionSubmit" value="Pay Tuition"/>
        </form>
        </section>
        <?php }

        //Course list in the select button
        static function PrintForm() {
            $CourseList = self::$CourseList;
        ?>
        <section class="form1">
        <form  method="POST">
            <select class="custom-select" name="courses" id="courses" >
                <option disabled selected>Choose your course</option>
                <?php
            foreach($CourseList as $CourseID) {
                $value = $CourseID->getSubject()."-".$CourseID->getCRN();
                if (in_array( $value, self::$coursesArray)){
                    echo "<option value='". $value ."' disabled>".$CourseID->getSubject()."-".$CourseID->getCRN()."</option>";
                } else {
                    if(isset($_POST['courses']) && $_POST['courses']== $value)
                        $select = "selected";
                    else
                        $select = '';
                    echo "<option value='". $value ."'" . $select . ">".$CourseID->getSubject()."-".$CourseID->getCRN()."</option>";
                }
            }
                ?>
            </select>
            <br>
            <br>
            <br>
            <button class="btn btn-primary" type="submit" name="action" value="Show Info"> Show Info</button>
            <button class="btn btn-outline-primary" type="submit" name="action" value="Register"> Register</button>
                
        </form>

        <?php }

        //This function will print the course information when the user clicks the show info button 
        static function PrintCourseInfo() {
            if ( (!isset(self::$CourseInfo)) || (!isset(self::$Instructor)) ){
                return;
            }
            //Prints course information and then prints course instructor information underneath.
            $CourseInfo = self::$CourseInfo; 
            $Instructor = self::$Instructor;
            ?>
            <table class="table table-bordered table-dark">
                <thead>
                <tr>

                    <th>Title</th>
                    <td><?php echo $CourseInfo->getTitle()." (".$CourseInfo->getSubject()."-".$CourseInfo->getCRN().")";?></td>
                </tr>
                <tr>
                    <th>Credits</th>
                    <td><?php echo $CourseInfo->getCredits();?></td>
                </tr>
                <tr>
                    <th>PreReq</th>
                    <td><?php echo $CourseInfo->getPreReq();?></td>
                </tr>
                <tr>
                    <th>Duration</th>
                    <td><?php echo $CourseInfo->getDuration();?></td>
                </tr>
                <tr>
                    <th>Enrl</th>
                    <td><?php echo $CourseInfo->getEnrl();?></td>
                </tr>
                <tr>
                    <th>Rem</th>
                    <td><?php echo $CourseInfo->getRem();?></td>
                </tr>
                <tr>
                    <th>Wait</th>
                    <td><?php echo $CourseInfo->getWait();?></td>
                </tr>
                <tr>
                    <th>Instructor Name</th>
                    <td><?php echo $Instructor->getInstructorName();?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo $Instructor->getEmail();?></td>
                </tr>
                <tr></tr>
            </thead>
            </table>

        <?php }

}
?>
