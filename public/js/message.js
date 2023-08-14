setTimeout(removeMessages,3000);

function removeMessages(){
    const msgError = document.querySelectorAll('.message-error');
    const msgInfo = document.querySelectorAll('.message-info');

    msgError.forEach(function(element){
       element.remove();
    });

    msgInfo.forEach(function (element) {
       element.remove();
    })
}
