<?php

class Members extends db
{
    function getMemberJoin()
    {
        $query = "SELECT * FROM members JOIN job ON members.id_job=job.id_job ORDER BY members.id";
        return $this->execute($query);
    }
    function getMember()
    {
        $query = "SELECT * FROM members";
        return $this->execute($query);
    }

    function getMemberById($id)
    {
        $query = "SELECT * FROM members JOIN job ON members.id_job=job.id_job WHERE members.id=$id";
        return $this->execute($query);
    }

    // function searchProduser($keyword)
    // {
    //     // ...
    //     $query = "SELECT * FROM producer JOIN agencies ON producer.agencies=agencies.id_agensi JOIN music ON producer.music_id=music.id_music JOIN album ON producer.album_id=album.id_album WHERE producer_nama LIKE '%$keyword%' OR agensi LIKE '%$keyword%' OR musik LIKE '%$keyword%' OR album LIKE '%$keyword%' ORDER BY producer.producer_id;";
    //     return $this->execute($query);
    // }

    function addMember($data)
    {

        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $join_date = $data['join_date'];
        $id_job = $data['id_job'];

        $query = "INSERT INTO members VALUES('','$name', '$email' , '$phone', '$join_date', '$id_job')";

        return $this->execute($query);
    }

    function updateMember($data)
    {
        // ...
        $id = $data['id'];
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $join_date = $data['join_date'];
        $id_job = $data['id_job'];

        $query = "UPDATE members SET name = '$name', email = '$email',
        phone = $phone,
        join_date = '$join_date',
        id_job = '$id_job' WHERE
        members.id = '$id'";

        return $this->execute($query);
    }

    function deleteMember($id)
    {
        // ...
        $query = "DELETE FROM members WHERE id = $id";
        return $this->execute($query);
    }
}
