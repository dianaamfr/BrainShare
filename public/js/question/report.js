

let reportDiv;
let reportInfo;

listenReportFlag();
listenReportModal();
/**
 * Listen to the report button.
 */
function listenReportFlag(){
    const reportButtonElement = document.querySelectorAll(".report-icon");
    reportButtonElement.forEach(element => {
        element.addEventListener("click", e => showModal(e));
    });
}

function listenReportModal(){
    const submitReportButton = document.querySelector("#report-submit");
    submitReportButton.addEventListener("click", ()=>handleReport(reportInfo));
}

function showModal(e) {
    const reportModal = createModal();
    reportModal.show();
    reportDiv = e.target.closest("div.report-icon");
    reportInfo = reportDiv.querySelectorAll("input");
}

function createModal(){
    const reportModalElement = document.querySelector("#reportModal");
    const reportContent = reportModalElement.querySelector("#report-content");
    reportContent.value = "";

    return new bootstrap.Modal(reportModalElement);
}

function handleReport(reportInfo){
    const elementType = reportInfo[0].value;
    const elementId = reportInfo[1].value;
    const content = document.querySelector("#report-content").value;

    if (elementType === "question")
        requestReport(elementId, "/api/report/question/"+ elementId, content);
    else if (elementType === "answer")
        requestReport(elementId, 'api/report/answer/' + elementId, content);
    else if (elementType === "comment")
        requestReport(elementId,'api/report/comment/' + elementId, content);
}

function requestReport(id, url, content){
    sendDataAjaxRequest("post", url, {"content": content}, handleReportRequestAns);
}

/**
 * This function shows the message of report and toggle the reportIcon.
 */
function handleReportRequestAns(responseJson){
    console.log(responseJson);
}

/**
 * Set the report button to empty or full.
 */
function toggleReportIcon(){

}


