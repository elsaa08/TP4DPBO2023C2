<?php
include_once("models/Template.class.php");
include_once("models/db.class.php");
include_once("controllers/Job.Controller.php");

$job = new JobController();

if (isset($_POST['add'])) { //data button
    $job->add($_POST);
} else if (!empty($_POST['id'])) { //data button
    $id = $_POST['id'];
    $job->edit($id, $_POST);
} else if (!empty($_GET['new'])) {
    $job->formbeginadd();
} else if (!empty($_GET['id_delete'])) {
    $id = $_GET['id_delete'];
    $job->delete($id);
} else if (!empty($_GET['id_edit'])) {
    $id = $_GET['id_edit'];
    $job->formbeginedit($id);
} else {
    $job->index();
}
