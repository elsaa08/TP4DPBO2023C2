<?php

class MembersView
{
    public function render($data)
    {
        $no = 1;
        $dataMembers = null;
        foreach ($data['members'] as $val) {
            list($id) = $val;
            $dataMembers .= "<tr>
                <td>" . $no++ . "</td>
                <td>" . $val['name'] . "</td>
                <td>" . $val['email'] . "</td>
                <td>" . $val['phone'] . "</td>
                <td>" . $val['join_date'] . "</td>
                <td>" . $val['job_name'] . "</td>
                <td>
                <a  href='index.php?id_edit=" . $id . "'class ='btn btn-success'>Update</a>
                <a href='index.php?id_delete= " . $id . "'class ='btn btn-danger' >Delete</a>
                </td>
               </tr>";
        }
        $view = new Template("templates/index.html");
        $view->replace("DATA_TABEL_INDEX", $dataMembers);
        $view->write();
    }
}
