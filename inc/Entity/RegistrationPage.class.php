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
                <link rel="stylesheet" href="../css/styles.css" />
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
                    <th>Instructor</th>
                    <th>Enroled</th>
                    <th>Remaining</th>
                    <th>Wait List</ht>

                </tr>
                <?php 
                    echo "<tr>";
                        echo "<td>".$RegistrationUser->getCRN() ."</td>";
                        echo "<td>".$RegistrationUser->getSubject() ."</td>";
                        echo "<td>".$RegistrationUser->getTitle() ."</td>";
                        echo "<td>".$RegistrationUser->getInstructorID() ."</td>";
                        echo "<td>".$RegistrationUser->getEnrl() ."</td>";
                        echo "<td>".$RegistrationUser->getRem() ."</td>";
                        echo "<td>".$RegistrationUser->getWait() ."</td>";
                    echo "</tr>";
                    
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
