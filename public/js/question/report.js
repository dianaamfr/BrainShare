
scheduleReportButton();
/**
 * Listen to the report button.
 */
function scheduleReportButton(){
    const reportButton = document.querySelectorAll(".report-icon");
    reportButton.forEach(element => {
        element.addEventListener("click", requestReport);
    });
}

/**
 * Sends message to the backend creating the report.
 */
function requestReport(){

}

/**
 * This function shows the message of report and toggle the reportIcon.
 */
function handleRequestAns(){

}

/**
 * Set the report button to empty or full.
 */
function toggleReportIcon(){

}


