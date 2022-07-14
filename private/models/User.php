<?php

class User extends Model
{


    protected $allowedColumns = [
        'firstname',
        'lastname',
        'email',
        'password',
        'gender',
        'rank',
        'date',
        'image'
    ];

    protected $beforeInsert = [
        'make_user_id',
        'make_school_id',
        'hash_password'
    ];

    protected $beforeUpdate = [
        'hash_password'
    ];



    public function validate($DATA, $id = '')
    {
        $errors = array();

        // check for firstname
        if (empty($DATA['firstname']) || !preg_match('/^[a-zA-Z]+$/', $DATA['firstname'])) {
            $this->errors['firstname'] = "Only letters allowed in First Name";
        }

        // check for lastname 
        if (empty($DATA['lastname']) || !preg_match('/^[a-zA-Z]+$/', $DATA['lastname'])) {
            $this->errors['lastname'] = "Only letters allowed in Last Name";
        }


        // check for email
        if (empty($DATA['email']) || !filter_var($DATA['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Must be in Email format";
        }

        // check if email already exists
        $user = new User();
        $man = $user->where('email', $DATA['email']);

        if (trim($id) == "") {
            $query = "select * from users where email = :email ";
            $dat = $this->query($query, ['email' => $DATA['email']]);
            if (!empty($dat[0]->email)) {
                $this->errors['email'] = "Email already exists";
            }
        } else {
            if ($this->query("select email from $this->table where email = :email && user_id != :id", ['email' => $DATA['email'], 'id' => $id])) {
                $this->errors['email'] = "Email already exists";
            }
        }







        // check password match
        if (isset($DATA['password'])) {
            if (empty($DATA['password']) || $DATA['password'] != $DATA['password2']) {
                $this->errors['password'] = "The Passwords do not match";
            }

            if (strlen($DATA['password']) < 8) {
                $this->errors['password'] = "Password must be at least 8 characters long";
            }
        }


        // check for gender
        $genders = ['female', 'male'];
        if (empty($DATA['gender']) || !in_array($DATA['gender'], $genders)) {
            $this->errors['gender'] = "No Gender Selected";
        }

        // check for rank
        if (empty($DATA['rank'])) {
            $this->errors['rank'] = "No Rank Selected";
        }

        if (count($this->errors) == 0) {
            return true;
        }

        return false;
    }



    public function make_user_id($data)
    {
        $data['user_id'] = random_string(60);
        return $data;
    }

    public function make_school_id($data)
    {
        if (isset($_SESSION['USER']->school_id)) {
            $data['school_id'] = $_SESSION['USER']->school_id;
        }
        return $data;
    }





    public function hash_password($data)
    {
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }
}
