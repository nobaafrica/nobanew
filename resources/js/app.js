window.copyToClipBoard = function (elId, popId) {
    /* Get the text field */
    var copyText = document.getElementById(elId);
    // /* Select the text field */
    copyText.select();
    copyText.setSelectionRange(0, 99999); /* For mobile devices */
    // /* Copy the text inside the text field */
    navigator.clipboard.writeText(copyText.value);
    // /* Alert the copied text */
    var popElement = document.getElementById(popId)
    var toolTip = new bootstrap.Tooltip(popElement, {
        'title': "Copied the text: " + copyText.value
    })
    toolTip.toggle()
    setTimeout(function(){
        toolTip.hide()
    }, 1000)
}

