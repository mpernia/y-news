<?php
    /*
    Copyright (c) 2018, Maikel Enrique Pernia Matos
    Contact: perniamatos@infomed.sld.cu

    All rights reserved.

    This file is part of the Y News website.

    BSD License
    You may use this file under the terms of the BSD license as follows:

    Redistribution and use in source and binary forms, with or without
    modification, are permitted provided that the following conditions
    are met:
    1. Redistributions of source code must retain the above copyright
        notice, this list of conditions and the following disclaimer.
    2. Redistributions in binary form must reproduce the above copyright
        notice, this list of conditions and the following disclaimer in the
        documentation and/or other materials provided with the distribution.
    3. Neither the name of copyright holders nor the names of its
        contributors may be used to endorse or promote products derived
        from this software without specific prior written permission.

    THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
    "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED
    TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR
    PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL COPYRIGHT HOLDERS OR CONTRIBUTORS
    BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
    CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
    SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
    INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
    CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
    ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
    POSSIBILITY OF SUCH DAMAGE.
    */

    function db_connect()
    {
        $server = "localhost";
        $username = "root";
        $password = "toor";
        $database = "ynews";

        $handle = mysqli_connect($server, $username, $password, $database);
                
        if (!$handle)
        {
            die("Connection failed: " . mysqli_connect_error());
            return false;
        }

        return $handle;
    }

    function exec_query($query)
    {
        $handle = db_connect();
        
        $result = mysqli_query($handle, $query);
        
        if (!$result) return('');

        return $result;
    }

    function count_rows($table, $field, $condition)
    {
        $handle = db_connect();

        $query = "SELECT COUNT($field) as size FROM $table";

        if (!empty($condition)) $query .= " WHERE $condition";
        
        $result = mysqli_query($handle, $query);
        
        if (!$result) return 0;
        
        $row = mysqli_fetch_assoc($result);

        $count = (int)$row['size'];
        
        mysqli_free_result($result);

        return $count;
    }

    function get_review($id)
    {
        $handle = db_connect();

        $result = mysqli_query($handle, "SELECT COUNT(news_id_news) AS id FROM rating WHERE news_id_news = $id;");
        
        if (!$result) return 0;

        $row = mysqli_fetch_assoc($result);
        
        $id = (int)$row['id'];
        
        mysqli_free_result($result);
        
        return $id;
    }
    
    function get_score($id)
    {
        $handle = db_connect();
        
        $result = mysqli_query($handle, "SELECT SUM(score) AS id FROM rating WHERE news_id_news = $id;");
        
        if (!$result) return 0;

        $row = mysqli_fetch_assoc($result);
       
        $id = (int)$row['id'];
       
        mysqli_free_result($result);
       
        return $id;
    }

    function get_id($table, $field, $uuid)
    {
        $handle = db_connect();

        $result = mysqli_query($handle, "SELECT $field FROM $table WHERE uuid = '$uuid';");
        
        if (!$result) return 0;

        $row = mysqli_fetch_assoc($result);
        
        $id = (int)$row[$field];
        
        mysqli_free_result($result);
        
        return $id;
    }

    function get_uuid($table, $field, $id)
    {
        $handle = db_connect();

        $result = mysqli_query($handle, "SELECT uuid FROM $table WHERE $field = '$id';");
        
        if (!$result) return 0;

        $row = mysqli_fetch_assoc($result);
        
        $id = $row["uuid"];
        
        mysqli_free_result($result);
        
        return $id;
    }

    function send_mail($name, $mail, $text, $uuid)
    {
        $handle = db_connect();

        $result = mysqli_query($handle, "INSERT INTO contact_messages (name, email, message, uuid) 
                                         VALUES ('$name', '$mail', '$text', '$uuid');");

        mysqli_free_result($result);
    }

    function inquest_news($id, $value)
    {
        $handle = db_connect();

        $result = mysqli_query($handle, "INSERT INTO rating (score, uuid, news_id_news) 
                                         VALUES ('$id', '1234567890x', $value);");
        
        mysqli_free_result($result);

        $total = get_review($value); 
        
        $score = get_score($value); 
        
        $average = (int)($score/$total);
        
        echo "$total|$average";
    }

    function like_news($id, $user)
    {
        $handle = db_connect();
        
        $result = mysqli_query($handle, "INSERT INTO likes (user, uuid, news_id_news) 
                                         VALUES ('$user', '1234567890', $id);");
        
        mysqli_free_result($result);

        echo count_rows("likes", "idlikes", "news_id_news = $id");
    }

    function shared_news($id, $user)
    {
        $handle = db_connect();
        
        $result = mysqli_query($handle, "INSERT INTO shares (user, uuid, news_id_news) 
                                         VALUES ('$user', '1234567890', $id);");
        
        mysqli_free_result($result);

        echo count_rows("shares", "idshares", "news_id_news = $id");
    }
?>

  
