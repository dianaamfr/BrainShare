import {encodeForAjax, sendAjaxGetRequest, sendDataAjaxRequest, showAlert} from './common.js';

// Add event listener for each submit action button
function manageReports(){
    let reportActions =  document.getElementsByClassName('report-actions');

    if(reportActions) {
        Array.from(reportActions).forEach(reportActionForm => { reportActionForm.addEventListener('submit', updateReport);});
    }
}

// Send update ban / delete /discard request with Ajax
function updateReport(event){
    event.preventDefault();
    let action = this.querySelector('.report-action');
    if(action.value == 'none') return;
    
    let id = this.querySelector('input[name="report-id"]')

    let data = {
        'search-username': reportUsernameSearch.value, 
        'report-type': reportTypeFilter.value, 
        'report-state': reportStateFilter.value,
        'id':id.value
    }   

    if(action.value == 'discard') {
        sendDataAjaxRequest('put', '/api/admin/reports/discard', data, reportsUpdateHandler);
    } 
    else if (action.value == 'delete') {
        sendDataAjaxRequest('put', '/api/admin/reports/delete', data, reportsUpdateHandler);
    }
}

function reportsUpdateHandler(response) {
    console.log(response)
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
}

function reportsSearchHandler() {
    let response = JSON.parse(this.responseText);
    document.getElementById('reports-table').innerHTML = response.html;

    updateReportsPagination();
    manageReports();
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