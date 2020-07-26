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
       static function printTable($student) {
            ?>
            <section class="main">
            <table>
             <thead>
                <tr>
                    <th>CRN</th> <!-- ReservationID -->
                    <th>Subject</th>
                    <th>Title</th>
                    <th>Instructor</th>
                    <th>Enroled</th>
                    <th>Remaining</th>
                    <th>Wait List</ht>

                </tr>
                <?php 
                    foreach($student as $course){
                        echo "<li>".$student->getCRN() ."</li>";
                        echo "<li>".$student->getSubject() ."</li>";
                        echo "<li>".$student->getTitle() ."</li>";
                        echo "<li>".$student->getInstructorID() ."</li>";
                        echo "<li>".$student->getEnrl() ."</li>";
                        echo "<li>".$student->getRem() ."</li>";
                        echo "<li>".$student->getWait() ."</li>";
                    }
                ?>
            </thead>
            </table>
            </section>
            <?php 
                }
            static function PrintForm() {
            ?>
            <section class="form1">
            <form>
                   
                <select name="courses" id="courses">
                    <option value="1">1110</option>
                    <option value="2">1280</option>
                    <option value="3">2200</option>
                    <option value="4">3300</option>
                </select>
                <br>
                <input type="submit" name="submit">
                    
            </form>
            </section>
            <?php
            }
            static function PrintFooter(){
                ?>
                    </body>
                </html>
                <?php
            }


}
?>
