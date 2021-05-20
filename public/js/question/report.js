
scheduleReportButton();
/**
 * Listen to the report button.
 */
function scheduleReportButton(){
    const reportButton = document.querySelectorAll(".report-icon");
    reportButton.forEach(element => {
        element.addEventListener("click", e => handleClickReport(e));
    });
}

/**
 * Sends message to the backend creating the report.
 */
function handleClickReport(e) {
    const reportDiv = e.target.closest("div.report-icon");
    const reportInfo = reportDiv.querySelectorAll("input");
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


