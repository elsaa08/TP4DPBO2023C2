<?php

class Job extends db
{
    // function getMemberJoin()
    // {
    //     $query = "SELECT * FROM job JOIN job ON members.id_job=job.id_job ORDER BY members.id";
    //     return $this->execute($query);
    // }
    function getJob()
    {
        $query = "SELECT * FROM job";
        return $this->execute($query);
    }

    function getJobById($id)
    {
        $query = "SELECT * FROM job WHERE id_job=$id";
        return $this->execute($query);
    }

    // function searchProduser($keyword)
    // {
    //     // ...
    //     $query = "SELECT * FROM producer JOIN agencies ON producer.agencies=agencies.id_agensi JOIN music ON producer.music_id=music.id_music JOIN album ON producer.album_id=album.id_album WHERE producer_nama LIKE '%$keyword%' OR agensi LIKE '%$keyword%' OR musik LIKE '%$keyword%' OR album LIKE '%$keyword%' ORDER BY producer.producer_id;";
    //     return $this->execute($query);
    // }

    function addJob($data)
    {
        $job_name = $data['job_name'];

        $query = "INSERT INTO job VALUES('','$job_name')";

        //cb ubah
        return $this->execute($query);
    }

    function updateJob($id, $data)
    {
        //  $id = $data['id_job'];
        $job_name = $data['job_name'];

        $query = "UPDATE job SET job_name = '$job_name' WHERE id_job = $id";

        return $this->execute($query);
    }

    function deleteJob($id)
    {
        // ...
        $query = "DELETE FROM job WHERE id_job = '$id'";
        return $this->execute($query);
    }
}
