import {encodeForAjax, sendAjaxGetRequest, sendDataAjaxRequest, showAlert, tooltipLoad, setConfirmationModal} from './common.js';

// Add event listener for each submit action button
function manageReports(){

    let discardBtn = document.querySelectorAll('button[name="discard"]');
    let revertBtn = document.querySelectorAll('button[name="revert"]');
    let deleteBtn = document.querySelectorAll('button[name="delete"]');
    let undiscardBtn = document.querySelectorAll('button[name="undiscard"]');

    deleteBtn.forEach(btn => btn.addEventListener('click', () => {
        const contentType = btn.parentElement.parentElement.parentElement.children[1].innerText;
        const username = btn.parentElement.parentElement.parentElement.children[4].innerText;
        const text = contentType === 'User' ? `ban the User <strong>${username}</strong>` : `delete this ${contentType}`;

        setConfirmationModal(`Delete Reported ${contentType}`, 
            `Are you sure you want to ${text}?`, 
            deleteReportContent.bind(btn),
            modal);  
    }));

    revertBtn.forEach(btn => btn.addEventListener('click', () => {
        const contentType = btn.parentElement.parentElement.parentElement.children[1].innerText;
        const username = btn.parentElement.parentElement.parentElement.children[4].innerText;
        const text = contentType === 'User' ? `unban <strong>${username}</strong>` : `restore this ${contentType}`;

        setConfirmationModal(`Restore Deleted ${contentType}`, 
            `Are you sure you want to ${text}? `, 
            revertReportAction.bind(btn),
            modal);  
    }));

    discardBtn.forEach(btn => btn.addEventListener('click', () => {
        setConfirmationModal('Discard Report', 
            `Are you sure you want to discard this report? If you proceed this report will be moved to the "Handled Reports".`, 
            discardReport.bind(btn),
            modal);  
    }));

    undiscardBtn.forEach(btn => btn.addEventListener('click', () => {
        setConfirmationModal('Undiscard Report', 
            `Are you sure you want to undiscard this report? If you proceed this report will be moved to the "Pending Reports".`, 
            undiscardReport.bind(btn),
            modal);  
    }));
    
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

let modal = new bootstrap.Modal(document.querySelector('.confirmationModal'));

manageReports();
searchReports();
updateReportsPagination();
tooltipLoad();
