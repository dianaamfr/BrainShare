import {encodeForAjax, sendAjaxGetRequest, sendDataAjaxRequest, showAlert, tooltipLoad} from './common.js';

// Add event listener for each submit action button
function manageReports(){
    let discardBtn = document.querySelectorAll('button[name="discard"]');
    let revertBtn = document.querySelectorAll('button[name="revert"]');
    let deleteBtn = document.querySelectorAll('button[name="delete"]');
    let undiscardBtn = document.querySelectorAll('button[name="undiscard"]');

    discardBtn.forEach(btn => btn.addEventListener('click', discardReport));
    revertBtn.forEach(btn => btn.addEventListener('click', revertReportAction));
    deleteBtn.forEach(btn => btn.addEventListener('click', deleteReportContent));
    undiscardBtn.forEach(btn => btn.addEventListener('click', undiscardReport));
    
}

function getReportsData(report){
    let id = report.parentElement.getAttribute('data-report-id');

    return {
        'search-username': reportUsernameSearch.value, 
        'report-type': reportTypeFilter.value, 
        'report-state': reportStateFilter.value,
        'id':id
    }   
}

function discardReport(){
    sendDataAjaxRequest('put', '/api/admin/reports/discard', getReportsData(this), reportsUpdateHandler);
}

function undiscardReport(){
    sendDataAjaxRequest('put', '/api/admin/reports/undiscard', getReportsData(this), reportsUpdateHandler);
}

function revertReportAction(){
    sendDataAjaxRequest('put', '/api/admin/reports/revert', getReportsData(this), reportsUpdateHandler);
}

function deleteReportContent(){
    sendDataAjaxRequest('put', '/api/admin/reports/delete', getReportsData(this), reportsUpdateHandler);
}


function reportsUpdateHandler(response) {
 
    if(response.hasOwnProperty('error')){
        showAlert(response.error, "error", manageReportsAlert);
        return;
    } else if(response.hasOwnProperty('exception')){
        showAlert(response.message , "error", manageReportsAlert);
        return;
    }
    else {
        showAlert(response.success, "success", manageReportsAlert);
    }

    document.getElementById('reports-table').innerHTML = response.html;

    updateReportsPagination();
    manageReports();
    tooltipLoad();
}

function reportsSearchHandler() {
    let response = JSON.parse(this.responseText);
    document.getElementById('reports-table').innerHTML = response.html;

    updateReportsPagination();
    manageReports();
    tooltipLoad();
}

function searchReports(){
    reportTypeFilter.addEventListener('change', requestSearchReports);
    reportStateFilter.addEventListener('change', requestSearchReports);
    reportUsernameSearch.addEventListener('keyup', requestSearchReports);
}

function requestSearchReports(){
    let data = {'search-username': reportUsernameSearch.value, 
                'report-type': reportTypeFilter.value, 
                'report-state': reportStateFilter.value};
    sendAjaxGetRequest( '/api/admin/reports', data, reportsSearchHandler)
    window.history.pushState({}, '', '/admin/reports?' + encodeForAjax(data));

    window.scroll({top: 0, behavior: 'smooth'});
}

function changeReportsPage(event) {
    event.preventDefault();
    let page = this.href.split('page=')[1]
    let data = {'search-username': reportUsernameSearch.value, 
                'report-type': reportTypeFilter.value, 
                'report-state': reportStateFilter.value,
                'page': page};
  
    sendAjaxGetRequest('/api/admin/reports', 
        data, reportsSearchHandler)
    window.history.pushState({}, '', '/admin/reports?' + encodeForAjax(data));
}

function updateReportsPagination() {
    let pagination = document.querySelectorAll('#reports .pagination a');
    if(pagination){
        pagination.forEach(paginationLink => { paginationLink.addEventListener('click', changeReportsPage);});
    }
}

let reportTypeFilter = document.getElementById('report-type');
let reportStateFilter = document.getElementById('report-state');
let reportUsernameSearch = document.querySelector('input[name=search-username]');
let manageReportsAlert = document.getElementById('manage-reports-alert');

manageReports();
searchReports();
updateReportsPagination();
tooltipLoad();