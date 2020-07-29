<?php 
class RegistrationPage {
    static function PrintHeader() {
        ?><!doctype html>
        <html>
            <head>
                <title></title>
                <title></title>
                <meta charset="utf-8">
                <title></title>   
                <link rel="stylesheet" href="css/styles.css" />
            </head>

            <body>
            <h1>Course Registration Form</h1>
        <?php }
       static function printTable($RegistrationUser) {
            ?>
            <section class="main">
            <table>
             <thead>
                <tr>
                    <th>CRN</th> <!-- ReservationID -->
                    <th>Subject</th>
                    <th>Title</th>
                    <th>Registered on:</ht>

                </tr>
                <?php 
                foreach($RegistrationUser as $courses)
                {
                    echo "<tr>";
                        echo "<td>".$courses->getCRN() ."</td>";
                        echo "<td>".$courses->getSubject() ."</td>";
                        echo "<td>".$courses->getTitle() ."</td>";
                        echo "<td>".$courses->getRegistrationDate() ."</td>";
                    echo "</tr>";
                }
                    
                ?>
            </thead>
            </table>
            </section>
            <?php 
                }
            static function PrintForm($CourseList) {
            ?>
            <section class="form1">
            <form  method="POST">
                <select name="courses" id="courses">
                    <option disabled selected>Choose your course</option>
                    <?php
                foreach($CourseList as $CourseID)
                    echo "<option value='".$CourseID->getSubject()."-".$CourseID->getCRN()."'>".$CourseID->getSubject()."-".$CourseID->getCRN()."</option>";
                    ?>
                </select>
                <br>
                <br>
                <br>
                <input type="submit" name="action" value="Show Info"/> <input type="submit" name="action" value="Register"/>
                    
            </form>

            <?php
            }

            static function PrintCourseInfo($CourseInfo) {
                ?>
            <table>
             <thead style="background: rgba(0, 0, 0, 0)">
                <tr>
                    <th>Title</th>
                    <th>Title</th>
                    <th>Title</th>
                    <th>Title</th>
                    <th>Title</th>
                    <th>Title</th>


                </tr>
                <?php 
                foreach($CourseInfo as $course)
                {
                    echo "<tr>";
                        echo "<td>".$course->getTitle() ."</td>";
                        echo "<td>".$course->getTitle() ."</td>";
                        echo "<td>".$course->getTitle() ."</td>";
                        echo "<td>".$course->getTitle() ."</td>";
                        echo "<td>".$course->getTitle() ."</td>";
                        echo "<td>".$course->getTitle() ."</td>";
                    echo "</tr>";
                }
                    
                ?>
            </thead>
            </table>
    
                <?php
                }

            static function PrintFooter(){
                ?>
                        </section>
                    </body>
                </html>
                <?php
            }


}
?>
