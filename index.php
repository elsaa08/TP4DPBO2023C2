<?php
include_once("models/Template.class.php");
include_once("models/db.class.php");
include_once("controllers/Members.controller.php");

$members = new MembersController();

if (isset($_POST['add'])) { //data button
  $members->add($_POST);
} else if (isset($_POST['edit'])) { //data button
  $members->edit($_POST);
} else if (!empty($_GET['new'])) {
  $members->formbeginadd();
} else if (!empty($_GET['id_delete'])) {
  $id = $_GET['id_delete'];
  $members->delete($id);
} else if (!empty($_GET['id_edit'])) {
  $id = $_GET['id_edit'];
  $members->formbeginedit($id);
} else {
  $members->index();
}
