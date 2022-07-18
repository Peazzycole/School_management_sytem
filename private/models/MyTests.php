<?php



class MyTests extends Model
{

    public $errors = array();

    protected $table = 'tests';

    protected $allowedColumns = [
        'test',
        'date',
        'class_id',
        'description'
    ];

    protected $beforeInsert = [
        'make_user_id',
        'make_school_id',
        'make_class_id',
        'make_test_id'
    ];

    protected $afterSelect = [
        'get_user'
    ];

    public function validate($DATA)
    {
        $this->errors = array();

        // check for class name
        if (empty($DATA['test']) || !preg_match('/^[a-zA-Z0-9 ]+$/', $DATA['test'])) {
            $this->errors['test'] = "Only letters and numbers allowed in test Name";
        }


        if (count($this->errors) == 0) {
            return true;
        }

        return false;
    }



    public function make_school_id($data)    // thesame with the User user_id
    {
        if (isset($_SESSION['USER']->school_id)) {
            $data['school_id'] = $_SESSION['USER']->school_id;
        }
        return $data;
    }
    public function make_user_id($data)    // thesame with the User user_id
    {
        if (isset($_SESSION['USER']->user_id)) {
            $data['user_id'] = $_SESSION['USER']->user_id;
        }
        return $data;
    }

    public function make_test_id($data)
    {

        $data['test_id'] = random_string(60);
        return $data;
    }

    public function get_user($data)
    {
        $user = new User();
        foreach ($data as $key => $row) {
            $result = $user->where('user_id', $row->user_id);
            $data[$key]->user =  is_array($result) ? $result[0] : false;
        }
        return $data;
    }
}
