<?php
class LogPage
{

    public static $title = "";

    static function header()
    { ?>
        <!-- Start the page 'header' -->
        <!DOCTYPE html>
        <html>

        <head>
            <title></title>
            <meta charset="utf-8">
            <meta name="author" content="Team1">
            <title><?php echo self::$title; ?></title>
            <link href="css/login.css" rel="stylesheet">
        </head>

        <body>
            <header>
                <h1><?php echo self::$title; ?></h1>
            </header>
            <article class="container">
            <?php }

        static function footer()
        { ?>
                <!-- Start the page's footer -->
            </article>
            <div class="footer">
                <p class="pagefooterdiv">
                    <span class="releasetext">Release: 0.0.1</span>
                </p>
                <div class="banner_copyright">
                    <div>© 2020 Course 3280002 Team 1.<br>This software contains confidential and proprietary information of Douglas college or its subsidiaries.<br>Use of this software is limited for study purpose, any other commercial purpose is prohibited.</div>
                </div>
            </div>
        </body>

        </html>

    <?php }

    static function loginDescription($error = null)
    { ?>
    <!-- Start the page's show login form -->
    <section class="login-container">
        <div class="login-content">
            <h1>Login</h1>
            <?php echo $error ? "<h5 class='login-error'>" . $error . "</h5>" : null ?>
            <p>Please fill in your credentials to login.</p>
        <?php

    }

    static function loginForm()
    {
        ?>
            <!-- Start the page's add entry form -->
            <section class="form1">

                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                    <table CLASS="dataentrytable" SUMMARY="This data entry table is used to format the user login fields">
                        <tr>
                            <td CLASS="delabel" scope="row"><LABEL for=UserID><SPAN class="fieldlabeltext">User ID:</SPAN></LABEL></td>
                            <td CLASS="dedefault"><input class="login-input" type="text" name="username" size="26" maxlength="9" ID="UserID" /></td>
                        </tr>
                        <tr>
                            <td CLASS="delabel" scope="row"><LABEL for=PIN><SPAN class="fieldlabeltext">PIN:</SPAN></LABEL></td>
                            <td CLASS="dedefault"><input class="login-input" type="password" name="PIN" size="26" maxlength="20" ID="PIN" /></td>
                        </tr>
                    </table>
                    <p>
                        <input class="btn-primary" type="submit" value="Login" />
                </form>
            </section>
        </div>

    <?php
    }

    static function displayTeam()
    {
    ?>
        <div class="logout">
        <h2>Team 1: Thanks for your visiting</h2>
        <table>
            <thead><tr>
                <th>Name</th>
                <th>Student ID</th>
                </tr>
            </thead>
        <?php
            echo "<tbody>";
            $teams = array("Viana Maia Fernando"=>"300320728", "Giladi Joel"=>"300302313", "Wei Qiuming"=>"300312797");
            foreach($teams as $name => $studentID)  {         
                // make sure to use the correct tr class
                echo '<tr>';
                echo "<td>$name</td>";
                echo "<td>$studentID</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";

            echo "<a class='back btn-primary' href='Team1.php'>Back</a>";
            echo "</div>";
    }
}


?>