
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="application/javascript">
    //copy-paste from:https://tuhrig.de/basic-auth-log-out-with-javascript/

    function logout() {

        // To invalidate a basic auth login:
        //
        // 	1. Call this logout function.
        //	2. It makes a GET request to an URL with false Basic Auth credentials
        //	3. The URL returns a 401 Unauthorized
        // 	4. Forward to some "you-are-logged-out"-page
        // 	5. Done, the Basic Auth header is invalid now

        jQuery.ajax({
            type: "GET",
            url: "/admin/",
            async: false,
            username: "logmeout",
            password: "123456",
            headers: { "Authorization": "Basic realm=\"SH++\"" }
        })
            .done(function(){
                // If we don't get an error, we actually got an error as we expect an 401!
            })
            .fail(function(){
                // We expect to get an 401 Unauthorized error! In this case we are successfully
                // logged out and we redirect the user.
                window.location = "/";
            });

        return false;
    }
    logout()
    </script>
<?php
session_destroy();
unset($_SESSION);
?>