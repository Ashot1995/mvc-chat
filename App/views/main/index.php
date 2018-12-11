<?php
if (!isset($_SESSION['id'])) {
    $this->redirect('/chat/login');
}
?>
<h3>Welcome <em id = "yourname"></em></h3>
<a href="" id="ex_logout">Logout</a>
<a href="#" class="open">Open group chat</a>

<!--group chat-->

<div >
    <div class="cont dhide">
        <img src="public/images/del.png" alt="delete" class="delete image">
        <h3>Group Chat</h3>
        <div class="text" id="text">

        </div>
        <div>
            <textarea id="message" class="message" placeholder="Enter your message"></textarea>
        </div>
        <span class="errmess"></span>

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
                <textarea id="message1" class="message" placeholder="Enter your message"></textarea>
            </div>
            <span class="errmess1"></span>
            <button id="persbtn" class="btn btn-success">Send<img src="public/images/send.png " class="image"
                                                                  alt="send image"></button>
        </div>
    </div>

    <!--Friends-->
    <div class="friendsDiv">
        <div class="users"><em>Your friends</em></div>
    </div>

</div>
