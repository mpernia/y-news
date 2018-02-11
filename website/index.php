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

    if (isset($_GET['id'])) { $id = (int)$_GET['id']; }

    if (isset($_GET['uuid'])) { $uuid = $_GET['uuid']; }

    if (isset($_GET['parent'])) { $parent = $_GET['parent']; }

    if (isset($_GET['search'])) { $search = $_GET['search']; }

    if (isset($_POST['sendmail'])) { $sendmail = (int)$_POST['sendmail']; } 

    if (isset($_POST['msgname'])) { $msgname = $_POST['msgname']; }

    if (isset($_POST['msgmail'])) { $msgmail = $_POST['msgmail']; }

    if (isset($_POST['msgtext'])) { $msgtext = $_POST['msgtext']; }

    require_once("functions.php");

    if (!empty($id) )
    {
        switch ($id)
        {
            case 1 :
                        show_contact_page();
                    break;
            case 2 :
                        show_static_page($uuid);
                    break;
            case 3 :
                        show_news_page($uuid);
                    break;
            case 4 :
                        show_select_news_page($uuid, $parent);
                break;
        }
    }else{
        if (!empty($search))
            show_search_page($search);
        else
            show_news_page("");
    }

    if ($sendmail == 1) send_mail($msgname, $msgmail, $msgtext, '1234567890');

?>