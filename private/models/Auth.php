<?php


class Auth
{

    public static function authenticate($row)
    {

        $_SESSION['USER'] = $row;
    }

    public static function logout()
    {

        if (isset($_SESSION['USER'])) {
            unset($_SESSION['USER']);
        }
    }

    public static function login()
    {
        if (isset($_SESSION['USER'])) {
            return true;
        } else {
            return false;
        }
    }


    public static function __callStatic($method, $params)  //call function for calling undefined methods
    {

        $prop = strtolower(str_replace("get", "", $method));

        if (isset($_SESSION['USER']->$prop)) {
            return $_SESSION['USER']->$prop;
        }
        return 'Unknown';
    }




    public static function switch_school($id)
    {
        if (isset($_SESSION['USER']) && $_SESSION['USER']->rank == 'superAdmin') {
            $user = new User();
            $school = new School();


            if ($row = $school->where('id', $id)) {
                $row = $row[0];

                $arr['school_id'] = $row->school_id;
                $user->update($_SESSION['USER']->id, $arr);
                $_SESSION['USER']->school_id = $row->school_id;
                $_SESSION['USER']->school_name = $row->school;
            }

            return true;
        }
        return false;
    }

    public static function access($rank = 'student')
    {
        if (!isset($_SESSION['USER'])) {
            return false;
        }

        $loggedInRank = $_SESSION['USER']->rank;

        $RANK['superAdmin'] = ['superAdmin', 'admin', 'lecturer', 'reception', 'student'];
        $RANK['admin'] = ['admin', 'lecturer', 'reception', 'student'];
        $RANK['lecturer'] = ['lecturer', 'reception', 'student'];
        $RANK['reception'] = ['reception', 'student'];
        $RANK['student'] = ['student'];

        if (!isset($RANK[$loggedInRank])) {
            return false;
        }

        if (in_array($rank, $RANK[$loggedInRank])) {
            return true;
        }

        return false;
    }
}
