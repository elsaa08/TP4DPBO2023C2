<?php

class JobView
{
    public function render($data)
    {
        $dataJob = null;
        $no = 1;

        foreach ($data['job'] as $val) {
            list($id) = $val;
            $dataJob .= "<tr>
                <td>" . $no++ . "</td>
                <td>" . $val['job_name'] . "</td>
                <td>
                <a href='job.php?id_edit=" . $val['id_job'] . "'class ='btn btn-success'>Update</a>
                <a href='job.php?id_delete= " . $id . "'class ='btn btn-danger'>Delete</a>
                </td>
               </tr>";
        }
        $view = new Template("templates/job.html");
        $view->replace("DATA_TABEL_INDEX", $dataJob);
        $view->write();
    }
}
