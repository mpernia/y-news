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

    include_once("database.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Website to take a news from RSS feeds services">
        <meta name="author" content="Maikel Enrique Pernia Matos">
        <meta name="author-contact" content="perniamatos@infomed.sld.cu">
        <title>Y News</title>
        <!-- Bootstrap core CSS -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="offcanvas.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>
    <body>
        <!-- navbar -->
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">Y News</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <?php
                            $result = exec_query("SELECT uuid FROM static_pages WHERE id_static_page = 1;");
                            $row = mysqli_fetch_array($result);
                        ?>
                        <li>
                            <a href="index.php?id=2&uuid=<?php echo $row["uuid"]; ?>" target="_blank">About</a>
                        </li>
                        <?php
                            mysqli_free_result($result);
                        ?>
                        <li>
                            <a href="index.php?id=1" target="_blank">Contact</a>
                        </li>
                        <?php
                            $result = exec_query("SELECT id_static_page FROM static_pages;");
                            $count = mysqli_num_rows($result);
                            mysqli_free_result($result);

                            if ($count > 1)
                            {
                        ?>
                        <li class="dropdown">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="Other pages">... <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <?php
                                $result = exec_query("SELECT * FROM static_pages WHERE id_static_page > 1");
                                $count = mysqli_num_rows($result);

                                for ($i=0; $i < $count; $i++)
                                {
                                    @mysqli_data_seek($result, $i);
                                    $row = mysqli_fetch_array($result);
                                ?>
                                <li><a href="index.php?id=2&uuid=<?php echo $row["uuid"]; ?>" target="_blank"><?php echo $row["title"]; ?></a></li>
                                <?php
                                }
                                mysqli_free_result($result);
                                ?>
                            </ul>
                        </li>
                        <?php
                            }
                        ?>
                    </ul>
                    <form class="navbar-form navbar-right" target=""  accept-charset="utf-8" id="search-form" name="search-form">
                        <input id="search" name="search" type="text" class="form-control" placeholder="Search...">
                    </form>
                </div>
            </div>
        </nav>
        <!-- navbar-end -->
