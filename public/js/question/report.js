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

    if (elementType === "question")
        requestReport(elementId, );
    else if (elementType === "answer")
        requestReport(elementId);
    else if (elementType === "comment")
        requestReport(elementId);
}

function requestReport(id, path){
    console.log(id, path);
}

/**
 * This function shows the message of report and toggle the reportIcon.
 */
function handleReportRequestAns(){

}

/**
 * Set the report button to empty or full.
 */
function toggleReportIcon(){

}


