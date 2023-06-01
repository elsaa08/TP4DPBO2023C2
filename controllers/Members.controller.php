<?php
include_once("connection.php");
include_once("models/Members.class.php");
include_once("models/Job.class.php");
include_once("views/Members.view.php");

class MembersController
{
    private $members;
    private $job;

    function __construct()
    {
        $this->members = new Members(Connection::$db_host, Connection::$db_user, Connection::$db_pass, Connection::$db_name);
        $this->job = new Job(Connection::$db_host, Connection::$db_user, Connection::$db_pass, Connection::$db_name);
    }

    public function index()
    {
        $this->members->open();
        $this->job->open();
        $this->members->getMemberJoin();
        $this->job->getjob();

        $data = array(
            'members' => array(),
            'job' => array()
        );
        while ($row = $this->members->getResult()) {
            array_push($data['members'], $row);
        }
        $this->members->close();
        $this->job->close();

        $view = new MembersView();
        $view->render($data);
    }

    function add($data)
    {
        $this->members->open();
        $this->members->addMember($data);
        $this->members->close();

        header("location:index.php");
    }
    function formbeginadd()
    {
        $this->job->open();
        $this->job->getJob();
        $job = array();
        while ($row = $this->job->getResult()) {
            array_push($job, $row);
        }
        $this->job->close();
        $dataJob = null;
        $id = null;
        foreach ($job as $val) {
            list($id, $name) = $val;
            $dataJob .= "<option value='" . $id . "'>" . $name . "</option>";
        }
        $view = new Template("templates/form.html");
        $view->replace("GET_ID", $id);
        $view->replace("OPTION", $dataJob);
        $view->replace("DATA_BUTTON", 'add');
        $view->replace("DATA_TITLE", 'Add');
        $view->write();
    }

    function edit($data)
    {
        $this->members->open();
        $this->members->updateMember($data);
        $this->members->close();

        header("location:index.php");
    }
    function formbeginedit($id)
    {
        $this->members->open();
        $this->job->open();
        $this->members->getMemberById($id);
        $this->job->getJob();
        $data = array(
            'members' => null,
            'job' => array()
        );
        $dataM = $data['members'];

        $dataM = $this->members->getResult();
        while ($row = $this->job->getResult()) {
            array_push($data['job'], $row);
        }
        $dataJ = null;
        foreach ($data['job'] as $val) {
            list($id, $name) = $val;
            $dataJ .= "<option value='" . $id . "' " . ($id == $dataM['id_job'] ? "selected" : "") . ">" . $name . "</option>";
        }
        //  foreach ($dataM as $val) {
        //     $id = $val[0];
        //     $name = $val[1];
        // }
        $this->members->close();
        $this->job->close();
        $view = new Template("templates/form.html");
        $view->replace("DATA_BUTTON", 'edit');
        $view->replace("DATA_TITLE", 'Edit');
        $view->replace("GET_ID", $dataM['id']);
        $view->replace("DATA_NAME", $dataM['name']);
        $view->replace("DATA_EMAIL", $dataM['email']);
        $view->replace("DATA_PHONE", $dataM['phone']);
        $view->replace("DATA_JOINDATE", $dataM['join_date']);
        $view->replace("OPTION", $dataJ);
        $view->write();
    }

    function delete($data)
    {
        $this->members->open();
        $this->members->deleteMember($data);
        $this->members->close();

        header("location:index.php");
    }
}
