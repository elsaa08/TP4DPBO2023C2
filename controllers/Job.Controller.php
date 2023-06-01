<?php
include_once("connection.php");
include_once("models/Members.class.php");
include_once("models/Job.class.php");
include_once("views/Job.view.php");

class JobController
{
    //private $members;
    private $job;

    function __construct()
    {
        // $this->members = new Members(Connection::$db_host, Connection::$db_user, Connection::$db_pass, Connection::$db_name);
        $this->job = new Job(Connection::$db_host, Connection::$db_user, Connection::$db_pass, Connection::$db_name);
    }

    public function index()
    {
        //  $this->members->open();
        $this->job->open();
        //  $this->members->getMemberJoin();
        $this->job->getjob();

        $data = array(
            //  'members' => array(),
            'job' => array()
        );
        while ($row = $this->job->getResult()) {
            array_push($data['job'], $row);
        }
        // $this->members->close();
        $this->job->close();

        $view = new JobView();
        $view->render($data);
    }

    function add($data)
    {
        $this->job->open();
        $this->job->addJob($data);
        $this->job->close();
        header("location:job.php");
    }
    function formbeginadd()
    {
        $id = null;
        $view = new Template("templates/jobform.html");
        $view->replace("GET_ID", $id);
        $view->replace("DATA_BUTTON", 'add');
        $view->replace("DATA_TITLE", 'Add');
        $view->write();
    }
    function edit($id, $data)
    {
        $this->job->open();
        $this->job->updateJob($id, $data);
        $this->job->close();

        header("location:job.php");
    }
    function formbeginedit($id)
    {
        $this->job->open();
        $this->job->getJobById($id);
        $data = array();
        while ($row = $this->job->getResult()) {
            $data[] = $row;
        }
        $this->job->close();
        if (count($data) > 0) {
            foreach ($data as $val) {
                $id = $val[0];
                $nama_job = $val[1];
            }
        }
        $view = new Template("templates/jobform.html");
        $view->replace("DATA_BUTTON", 'edit');
        $view->replace("DATA_TITLE", 'Edit');
        $view->replace("GET_ID", $id);
        $view->replace("DATA_JOB", $nama_job);
        $view->write();
    }

    function delete($data)
    {
        $this->job->open();
        $this->job->deleteJob($data);
        $this->job->close();

        header("location:job.php");
    }
}
