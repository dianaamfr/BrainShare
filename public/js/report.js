import {sendAjaxGetRequest, sendDataAjaxRequest, showToast} from "./common.js";

let reportDiv;
let reportInfo;
let modal = createModal();
listenReportFlag();
listenReportModal();

function createModal(){
    const reportModalElement = document.querySelector("#reportModal");
    const reportContent = reportModalElement.querySelector("#report-content");
    reportContent.value = "";

    return new bootstrap.Modal(reportModalElement);
}

/**
 * Listen to the report button.
 */
export function listenReportFlag(){
    const reportButtonElement = document.querySelectorAll(".report-icon");
    reportButtonElement.forEach(element => {
        element.addEventListener("click", e => canReport(e));
    });
}

function listenReportModal(){
    const submitReportButton = document.querySelector("#report-submit");
    submitReportButton.addEventListener("click", ()=>handleReport(reportInfo));
}

function canReport(e) {
    reportDiv = e.target.closest("div.report-icon");
    reportInfo = reportDiv.querySelectorAll("input");
    const elementType = reportInfo[0].value;
    const elementId = reportInfo[1].value;
    sendAjaxGetRequest('/api/report/status', {'reportType': elementType, 'id': elementId}, showModal);
}

function showModal(){
    const json = JSON.parse(this.responseText);
 
    if (json['isReported'] === false)
        modal.show();
    else if (json['exception'])
        showToast("Error on report. Make sure you're logged.", 'red');
    else {
        showToast('You have already reported this.', 'yellow');
    }
}

function handleReport(reportInfo){
    const elementType = reportInfo[0].value;
    const elementId = reportInfo[1].value;
    const content = document.querySelector("#report-content").value;

    if (elementType === "question")
        requestReport(elementId, "/api/report/question/"+ elementId, content);
    else if (elementType === "answer")
        requestReport(elementId, '/api/report/answer/' + elementId, content);
    else if (elementType === "comment")
        requestReport(elementId,'/api/report/comment/' + elementId, content);
    else if (elementType === "reported")
        requestReport(elementId,'/api/report/user/' + elementId, content);

}

function requestReport(id, url, content){
    sendDataAjaxRequest("post", url, {"content": content}, handleReportRequestAns);
}

/**
 * This function shows the message of report and toggle the reportIcon.
 */
function handleReportRequestAns(responseJson){
    if (!responseJson['success']) {
        document.querySelector("#reportModal .error").innerHTML = responseJson['error'];
        setTimeout(() => {
            document.querySelector("#reportModal .error").innerHTML = ""
        }, 5000);
    } else{
        modal.hide();
        showToast('Report done!', 'blue');
    }
}
