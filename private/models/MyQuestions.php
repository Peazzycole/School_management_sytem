<?php



class MyQuestions extends Model
{

    public $errors = array();

    protected $table = 'test_questions';

    protected $allowedColumns = [
        'question',
        'date',
        'test_id',
        'question_type',
        'answer',
        'choices',
        'image'
    ];

    protected $beforeInsert = [
        'make_user_id'
    ];

    protected $afterSelect = [
        'get_user'
    ];

    public function validate($DATA)
    {
        $this->errors = array();

        // check for class name
        if (empty($DATA['question'])) {
            $this->errors['question'] = "Please Add a valid Question";
        }


        if (count($this->errors) == 0) {
            return true;
        }

        return false;
    }




    public function make_user_id($data)    // thesame with the User user_id
    {
        if (isset($_SESSION['USER']->user_id)) {
            $data['user_id'] = $_SESSION['USER']->user_id;
        }
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
