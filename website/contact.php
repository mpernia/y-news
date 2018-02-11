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

    include_once("header.php");
?>
    <div class="container-fluid news-page">
        <h1>Contact us</h1>
        <p>Please it send any comment or suggestion to the team of development of Y News.</p>
        <form class="form-inline" method="post" action="index.php"> 
            <input type="hidden" name="sendmail" id="sendmail" value="1">
            <div class="form-group"> 
                <label>Name:</label><br>                
                <input class="form-control" name="msgname" id="msgname" placeholder="Jane Doe"> 
            </div>             
            <div class="form-group"> 
                <label>Email:</label><br>                 
                <input type="email" class="form-control" name="msgmail" id="msgmail" placeholder="jane.doe@example.com">
            </div>
            <div class="fluitd-row"><p>
                <div class="form-group"> 
                    <label>Message:</label><br>                 
                    <textarea class="form-control input-lg" rows="3" name="msgtext" id="msgtext" placeholder="Write your message..."></textarea>                 
                </div>
            </div><p>
            <div class="form-group">              
                <button type="submit" class="btn btn-default">Send</button>
            </div>            
        </form>
    </div>
<?php
    include_once("footer.php");
?>
