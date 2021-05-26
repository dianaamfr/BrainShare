/**
 * By loading this the page and defined the variables:
 * toastMessageWarning, toastMessageReply and toastMessageError, a toast will show showing the messages.
 */

import {showToast} from "./common.js";

if ( typeof toastMessageWarning !== 'undefined')
    showToastWarning(toastMessageWarning);
if (typeof toastMessageError !== 'undefined')
    showToastError(toastMessageError)
if (typeof toastMessageReply !== 'undefined')
    showToastReply(toastMessageReply);

function showToastWarning(toastMessageWarning){
    showToast(toastMessageWarning, "yellow");
}

function showToastReply(toastMessageReply){
    showToast(toastMessageReply, "blue")
}

function showToastError(toastMessageError){
    showToast(toastMessageError, "red");
}

