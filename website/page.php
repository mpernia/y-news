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
?>
        <!-- container-end -->        
        
            <div class="container-fluid news-page">
                <!-- sidebar -->
                <div class="col-xs-12 col-sm-2 sidebar-offcanvas" id="sidebar">
                    <!-- menu -->
                    <div>
                        <ul class="nav nav-pills nav-stacked nav-pills-stacked-example" style="padding-top: -24px;"> 
                            <li role="presentation" class="active"><a>RSS Channels</a></li> 
                            <?php
                                $result = exec_query("SELECT * FROM channels;");
                                $count = mysqli_num_rows($result);

                                for ($i=0; $i < $count; $i++)
                                {
                                    @mysqli_data_seek($result, $i);
                                    $row = mysqli_fetch_array($result);

                                    echo "<li role=\"presentation\"><a href=\"index.php?id=3&uuid=" . $row["uuid"]. "\">" . $row["name"] . "</a></li>";
                                }
                                mysqli_free_result($result);
                            ?>                                                        
                        </ul>
                    </div>
                    <!-- menu-end -->
                </div>
                <!-- sidebar-end -->

                <!-- content -->
                <div class="col-xs-12 col-sm-10">
                

