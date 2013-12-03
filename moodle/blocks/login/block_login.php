<html>
<style type="text/css">

input.butt
{

    background: #0A84FF;
   background: -webkit-gradient(linear, left top, left bottom, from(#B43104), to(#1C1C1C));
   background: -webkit-linear-gradient(top, #419AFB, #7EA3FF);
   background: -moz-linear-gradient(top, #419AFB, #7EA3FF);
   background: -ms-linear-gradient(top, #419AFB, #7EA3FF);
   background: -o-linear-gradient(top, #419AFB, #7EA3FF);
   padding: 1px 10px;
   -webkit-border-radius: 8px;
   -moz-border-radius: 8px;
   border-radius: 8px;
   -webkit-box-shadow: rgba(0,0,0,1) 0 1px 0;
   -moz-box-shadow: rgba(0,0,0,1) 0 1px 0;
   box-shadow: rgba(0,0,0,1) 0 1px 0;
   text-shadow: rgba(0,0,0,.4) 0 1px 0;
   color: white;
   font-size: 14px;
   font-family: Georgia, serif;
   text-decoration: none;
   vertical-align: middle;
}
</style>
</html>







<?php

class block_login extends block_base {
    function init() {
        $this->title = get_string('pluginname', 'block_login');
    }

    function applicable_formats() {
        return array('site' => true);
    }

    function get_content () {
        global $USER, $CFG, $SESSION;
        $wwwroot = '';
        $signup = '';

        if ($this->content !== NULL) {
            return $this->content;
        }

        if (empty($CFG->loginhttps)) {
            $wwwroot = $CFG->wwwroot;
        } else {
            // This actually is not so secure ;-), 'cause we're
            // in unencrypted connection...
            $wwwroot = str_replace("http://", "https://", $CFG->wwwroot);
        }

        if (!empty($CFG->registerauth)) {
            $authplugin = get_auth_plugin($CFG->registerauth);
            if ($authplugin->can_signup()) {
                $signup = $wwwroot . '/login/signup.php';
            }
        }
        // TODO: now that we have multiauth it is hard to find out if there is a way to change password
        $forgot = $wwwroot . '/login/forgot_password.php';

        if (empty($CFG->xmlstrictheaders) and !empty($CFG->loginpasswordautocomplete)) {
            $autocomplete = 'autocomplete="off"';
        } else {
            $autocomplete = '';
        }

        $username = get_moodle_cookie();

        $this->content = new stdClass();
        $this->content->footer = '';
        $this->content->text = '';

        if (!isloggedin() or isguestuser()) {   // Show the block

            $this->content->text .= "\n".'<form class="loginform" id="login" method="post" action="'.get_login_url().'" '.$autocomplete.'>';

            $this->content->text .= '<div class="c1 fld username"><label for="login_username">'.get_string('username').'</label>';
            $this->content->text .= '<input type="text" name="username" id="login_username" value="'.s($username).'" /></div>';

            $this->content->text .= '<div class="c1 fld password"><label for="login_password">'.get_string('password').'</label>';

            $this->content->text .= '<input type="password" name="password" id="login_password" value="" '.$autocomplete.' /></div>';

            if (isset($CFG->rememberusername) and $CFG->rememberusername == 2) {
                $checked = $username ? 'checked="checked"' : '';
                $this->content->text .= '<div class="c1 rememberusername"><input type="checkbox" name="rememberusername" id="rememberusername" value="1" '.$checked.'/>';
                $this->content->text .= ' <label for="rememberusername">'.get_string('rememberusername', 'admin').'</label></div>';
            }

            $this->content->text .= '<div class="c1 btn"><input class="butt"  type="submit" value="'.get_string('login').'" /></div>';

            $this->content->text .= "</form>\n";

            if (!empty($signup)) {
                $this->content->footer .= '<div><a href="'.$signup.'">'.get_string('startsignup').'</a></div>';
            }
            if (!empty($forgot)) {
                $this->content->footer .= '<div><a href="'.$forgot.'">'.get_string('forgotaccount').'</a></div>';
            }
        }

        return $this->content;
    }
}


