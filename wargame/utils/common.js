// review.php
const btn_back = document.querySelector('#btn_back');
btn_back.addEventListener('click', ()=>{
    window.location.href = './index.php';
})

// index.php : Home banner slides carousel every 2.5 seconds
const btn_history = document.querySelector('#history');
const history_modal = document.querySelector('#history-show');
document.addEventListener("DOMContentLoaded", function() {
    const slide_container = document.querySelector('.slide-container');
    let i = 0;
    function repeat() {
        setTimeout(() => {
            slide_container.style.transform = `translateX(${-i * 70}vw)`;
            i++;
            if (i > 2) i = 0;
            repeat(); 
        }, 2500);
    }
    repeat(); 
});

// register.php : Password input fear (double verification in registerAction.php)
const btn_create = document.querySelector('#btn_create');
btn_create.addEventListener('click', ()=>{
    const upw1 = document.querySelector('#upw').value;
    const upw2 = document.querySelector('#upw2').value;
    if(upw1 == upw2){
        window.location.href = "../index.php";
    }else if(upw1.length > 14 || upw2.length > 14){
        alert('Please write your password within 14 characters.');
        event.preventDefault();
    }
    else {
        alert('Please check your password.');
        event.preventDefault();
    }
})

// write.php : Title and body input check and back button function
document.addEventListener("DOMContentLoaded", function() {
    const back = document.querySelector('#back');
    back.addEventListener('click', () => {
        history.back(-1);
    });
}); 


function uploadFile(){ // Function for uploading files
    window.open(uploadFileForm.php, '', 'scrollbars=no, width=500, height=500');
    elementId=id;
}

const btn_submit1 = document.querySelector('#write');
btn_submit.addEventListener("click", (e)=>{
    const title = document.querySelector('#title');
    const content = document.querySelector('.text-box');
    if(title.value == '') {
        alert('Please enter a title.');
        title.focus()
        e.preventDefault();
        return
    }
    else if(content.value == ''){
        alert('Please enter a content.');
        content.focus();
        e.preventDefault();
        return
    }
})

//view.php : When the delete or edit button is clicked, the button text changes
const list_btn = document.querySelector('#list_btn');
const edit_btn = document.querySelector('#edit_btn');
const modal_text = document.querySelector('#modal-text');
const delete_btn = document.querySelector('#delete_btn');
const modal = document.querySelector('#modal');
const modal_delete = document.querySelector('#modal-delete');
const modal_cancel = document.querySelector('#modal-cancel');

// A function that clears the modal window again by pressing the cancel button after it appears.
modal_cancel.addEventListener('click', ()=>{
    modal.classList.remove('show-modal')
})
// Press the list button to switch to the board page
list_btn.addEventListener('click', ()=>{
    window.location.href = './board.php';
});
// When you press delete, change the button text in the modal window to delete and move to deleteAction.php.
delete_btn.addEventListener('click', () => {
    modal_text.textContent = "삭제";
    modal.classList.add('show-modal');
    modal_text.addEventListener('click', ()=>{
    const delPassword = document.querySelector('#inputPass').value;
    window.location.href = `./deleteAction.php?idx=<?=$row['idx']?>&inputPass=${delPassword}`;
})
});
// When you press Edit, change the button text in the modal window to Edit and move to editAction.php.
edit_btn.addEventListener('click', ()=>{
    modal_text.textContent = '수정';
    modal.classList.add('show-modal');
    modal_text.addEventListener('click', ()=>{
        const editPassword = document.querySelector('#inputPass').value;
        window.location.href = `./edit.php?idx=<?=$row['idx']?>&inputPass=${editPassword}`;
    })
})

//edit.php
document.addEventListener("DOMContentLoaded", function() {
    const back = document.querySelector('#back');
    back.addEventListener('click', () => {
        window.location.href = "./board.php";
    });
});
const btn_submit = document.querySelector('#write');
btn_submit.addEventListener("click", (e)=>{
    const title = document.querySelector('#title');
    const content = document.querySelector('.text-box');
    if(title.value == '') {
        alert('Please enter a title.');
        title.focus()
        e.preventDefault();
        return
    }
    else if(content.value == ''){
        alert('Please enter a content.');
        content.focus();
        e.preventDefault();
        return
    }
})

//board.php
function redirectToWritePage() {
    window.location.href = "./write.php";
}