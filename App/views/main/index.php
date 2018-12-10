<?php
if (!isset($_SESSION['id'])) {
    $this->redirect('/chat/login');
}
?>
<a href="" id="ex_logout">Logout</a>
<a href="" class="open">Open group chat</a>

<!--group chat-->

<div>
    <div class="cont dhide">
        <img src="public/images/del.png" alt="delete" class="delete image">
        <h3>Chat</h3>
        <div class="text" id="text">

        </div>
        <div>
            <div contenteditable="true" id="message" class="message"></div>
        </div>
        <button id="btn" class="btn btn-success">Send<img src="public/images/send.png " class="image" alt="send image">
        </button>
    </div>

    <!-- personal chat -->

    <div>
        <div class="cont dhide1">
            <img src="public/images/del.png" alt="delete1" id="delete1" class="image">
            <h3>Personal Chat With <em id="usern"></em></h3>
            <div class="text" id='text1'>
            </div>
            <div>
                <div contenteditable="true" id="message1" class="message"></div>
            </div>

            <button id="persbtn" class="btn btn-success">Send<img src="public/images/send.png " class="image"
                                                                  alt="send image"></button>
        </div>
    </div>

    <!--Friends-->
    <div class="friendsDiv">
        <div class="users"></div>
    </div>
</div>
