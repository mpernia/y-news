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
                </div>
                <!-- content-end -->                
            </div>
            <!-- container-end-->
        
        <!-- row -end -->

        <!-- footer -->
        <footer >
            <hr>
            <h4 align="center">Copyright &copy; 2018 | Y News Inc. | All rights reserved.</h4>
        </footer>
        <!-- footer-end -->
        
        <!-- Bootstrap core JavaScript
    ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
        <script src="bootstrap/js/ajax.js"></script>
        <script  language="javascript">
            $(document).ready(function ()
            {
                $('[data-toggle="offcanvas"]').click(function ()
                {
                    $('.row-offcanvas').toggleClass('active')
                });
            });            
        </script>
    </body>

    <script language="javascript">
        document.ondblclick = function ()
        {
            var sel = (document.selection && document.selection.createRange().text) ||
                      (window.getSelection && window.getSelection().toString());

            window.location='index.php?search=' + sel;
        };
    </script>
    
</html>
