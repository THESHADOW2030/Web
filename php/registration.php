<?php
   // $conn = pg_connect("host=localhost port=5432 dbname=InfoHealth user=postgres password=THEDARK2030");

$conn = pg_connect("host=localhost port=5432 dbname=InfoHealth user=postgres password=THEDARK2030");
session_start();
if(!$conn)
    {
        //echo "Not connected to database<br>";
    }
    else {
        //echo "Connected to database<br>";

        if (isset($_POST['email']))
            $email = $_POST['email'];
        if (isset($_POST['userRegistration']))
            $user = $_POST['userRegistration'];
        if (isset($_POST['passwordRegistration']))
            $password = $_POST['passwordRegistration'];
        if (isset($_POST['repeatpassword']))
            $password2 = $_POST['repeatpassword'];
        //  echo $password2;

        if (!($password == $password2)) {
            echo '20';
            return;

        } else {
            // return;


            $q1 = " SELECT *
                FROM public.users
                WHERE username = $1";

            $q3 = " SELECT *
                FROM public.users
                WHERE email = $1";


            $query = "SELECT * FROM public.users WHERE username = '$user'";

            $result = pg_query($conn, $query);

            $query2 = "SELECT * FROM public.users WHERE email = '$email'";
            $result2 = pg_query($conn, $query2);

            //check if query is not empty
            if (pg_num_rows($result) > 0)  //
            {
                echo '10'; //username already exists
                return;
            } else if (pg_num_rows($result2) > 0) {
                echo "11"; //email already exists
                return;
            } else {
                $q2 = "INSERT INTO public.users (username, password, email) VALUES ($1, $2, $3)";
                $result = pg_query_params($conn, $q2, array($user, $password, $email));
                if ($result) {
                    echo "1";
                    //Start session
                    $_SESSION['user'] = $user;
                    $_SESSION['password'] = $password;
                    //Redirect to homepage
                //    header("Location: ../homepage/homepage.html");
                } else {
                    echo "0";
                }
            }


        }
    }



/*





        return;
























        $result = pg_query_params($conn, $q1, array($user));
        $result1 = pg_query_params($conn, $q3, array($email));
        if($line = pg_fetch_array($result,null,PGSQL_ASSOC))
        {
            echo "0";
            $q2 = "INSERT INTO public.users (username, password,email) VALUES ($1, $2,$3);";
            $data = pg_query_params($conn, $q2, array($user, $password,$email));
            if ($data)  //ho inserito correttamente l'utente
            {
                echo "1";
                $_SESSION['user'] = $user;
                header("Location: ../homepage/homepage.php");


            }
            else
            {
                echo "Errore Interno!!";
            }

            $q3 = "INSERT INTO public.user_info (username) VALUES ($1)";
            $data = pg_query_params($conn, $q3, array($user));





          //  header("Location: ../login.html");
        }
        elseif($line = pg_fetch_array($result1,null,PGSQL_ASSOC))
        {
            echo "-1";

        }
        else
        {
            $q2 = "INSERT INTO public.users (username, password,email) VALUES ($1, $2,$3);";
            $data = pg_query_params($conn, $q2, array($user, $password,$email));
            if ($data)
            {
                $_SESSION['user'] = $user;
                header("Location: ../homepage/homepage.php");

            }
            else
            {
                echo "Errore Interno!";
            }
            //header("Location: ../login.html");
        }
    }
*/
?>