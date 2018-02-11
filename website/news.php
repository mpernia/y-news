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
                    <!-- categories --> 
                    <ol class="breadcrumb">
                        <?php
                            if ($id_channel > 0)
                                $sql_categorie = "SELECT categories.name, categories.uuid FROM categories LEFT OUTER JOIN
                                                  feeds ON categories.id_categories = feeds.categories_id_categories WHERE feeds.id_channel = $id_channel;";
                            else
                                $sql_categorie = "SELECT categories.name, categories.uuid FROM categories;";

                            $result = exec_query($sql_categorie);
                            $count = mysqli_num_rows($result); 

                            for ($i=0; $i < $count; $i++)
                            { 
                                @mysqli_data_seek($result, $i);
                                $row = mysqli_fetch_array($result);
                                ?>
                                <li><a href="index.php?id=4<?php if ($id_channel > 0) { ?>&parent=<?php echo get_uuid("channels", "id_channel", $id_channel); } ?>&uuid=<?php echo $row["uuid"]?>"><?php echo $row["name"]; ?></a></li>
                                <?php
                            }
                            mysqli_free_result($result);
                        ?>
                    </ol>
                    <!-- categories-end-->

                    <!-- Carousel -->
                    <div class="carousel slide" id="carousel-news" data-ride="carousel"> 
                        <div class="carousel-inner" role="listbox">
                        <?php
                            $result = exec_query($sql_carousel);
                            $count = mysqli_num_rows($result);
                            
                            if ($count > 0)
                            {
                                if ($count < 6) $limit = $count; else $limit = 5;

                                for ($i=0; $i < $limit; $i++)
                                {
                                    @mysqli_data_seek($result, $i);
                                    $row = mysqli_fetch_array($result);

                                    if ($i == 0) echo "<div class=\"item active\">"; else echo "<div class=\"item\">";
                        ?>
                                <div>
                                    <h1><a href="<?php echo $row["link"]?>" target="_blank"><?php echo $row["title"]?></a></h1>
                                    <p><?php echo $row["description"] ?></p>
                                </div>                                 
                            </div>                             
                            <?php
                                }
                                mysqli_free_result($result);
                            }
                            ?>
                        </div>   
                        <?php
                            if ($count > 0)
                            {
                        ?>                      
                        <div class="carousel-indicators-inner"> 
                            <ol class="carousel-indicators"> 
                                <li data-target="#carousel-news" data-slide-to="0" class="active"></li>
                                <?php
                                    for ($j=1; $j < $limit ; $j++)
                                    { 
                                        echo "<li data-target=\"#carousel-news\" data-slide-to=\"$j\"></li>";
                                    }                                 
                                ?>
                            </ol>                             
                        </div>
                        <?php 
                            }
                        ?>                         
                    </div>
                    <!-- Carousel-end -->

                    <!-- news-row -->
                    <?php
                        $result = exec_query($sql_news);
                        $count = mysqli_num_rows($result);
                        $rows = ceil($count/2);
                        $img = 0;
                        
                        for ($k=0; $k < $rows; $k++)
                        {
                            ?>
                    <div class="row">
                            <?php                            
                            for ($l=0; $l < 2; $l++)
                            { 
                                if ($img < $count)
                                {
                                    @mysqli_data_seek($result, $img);
                                    $row = mysqli_fetch_array($result);
                                    ?>
                        <div class="col-md-6">
                            <h3><a href="<?php echo $row["link"] ?>"><?php echo $row["title"] ?></a></h3> 
                            <div class="row">
                                <div class="col-md-4 news-date"><?php echo $row["pubdate"] ?></div>
                                
                                <div class="col-md-5">
                                <label>Reviews:<span class="badge"><div id="rev<?php echo $row["id_news"]; ?>">
                                    <?php 
                                        $review = get_review($row["id_news"]); 
                                        echo $review;
                                    ?></div>
                                    </span>
                                </label>&nbsp;&nbsp;&nbsp;
                                <label>Rating:<span class="badge" id="rat<?php echo $row["id_news"]; ?>">
                                    <?php 
                                        $score = get_score($row["id_news"]); 
                                        if ($review == 0)
                                            echo 0;
                                        else{
                                            $average = (int)($score/$review);
                                            echo $average;
                                        }
                                    ?>
                                    </span></label>
                            </div>
                            <div class="btn-toolbar" role="toolbar"> 
                                <div class="btn-group" role="group">
                                    <div id="inq<?php echo $row["id_news"]; ?>">
                                        <a href="javascript:vote(1, <?php echo $row["id_news"]; ?>)"><span class="glyphicon glyphicon-star-empty text-warning"></span></a>
                                        <a href="javascript:vote(2, <?php echo $row["id_news"]; ?>)"><span class="glyphicon glyphicon-star-empty text-warning"></span></a>
                                        <a href="javascript:vote(3, <?php echo $row["id_news"]; ?>)"><span class="glyphicon glyphicon-star-empty text-warning"></span></a>
                                        <a href="javascript:vote(4, <?php echo $row["id_news"]; ?>)"><span class="glyphicon glyphicon-star-empty text-warning"></span></a>
                                        <a href="javascript:vote(5, <?php echo $row["id_news"]; ?>)"><span class="glyphicon glyphicon-star-empty text-warning"></span></a>
                                    </div>
                                </div>                                             
                            </div>
                            </div>
                            <p><?php echo $row["description"] ?></p>
                            <div class="fluid-row" style="margint-top: 20px; float: right;">
                                <div class="col-md-4">
                                    <a href="javascript:likes(<?php echo $row["id_news"]; ?>)" class="btn btn-primary" type="button"> Like 
                                        <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true">&nbsp;</span>
                                        <span id="lik<?php echo $row["id_news"]; ?>">
                                            <?php $likeid = count_rows("likes", "idlikes", "news_id_news = " . $row["id_news"]); ?>
                                            <span class="badge"><?php echo $likeid; ?></span>
                                        </span>
                                    </a>                     
                                </div>&nbsp;
                                <div class="col-md-4 col-md-offset-1">
                                    <a href="javascript:share(<?php echo $row["id_news"]; ?>)" class="btn btn-primary" type="button"> Share 
                                        <span class="glyphicon glyphicon-share" aria-hidden="true">&nbsp;</span>
                                        <span id="sha<?php echo $row["id_news"]; ?>">
                                            <?php
                                                $shaid = count_rows("shares", "idshares", "news_id_news = " . $row["id_news"]);
                                            ?>
                                            <span class="badge"><?php echo $shaid; ?></span>
                                        </span>
                                    </a>                     
                                </div>
                            </div>
                        </div>
                                    <?php
                                    $img++;
                                } 
                            }
                            ?>
                    </div>
                            <?php
                        }
                    ?>
                    <!-- news-row-end -->

