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
    
    let id = action.getAttribute('data-reported-content');
    let type = action.getAttribute('data-report-type');

    if(action.value == 'discard') {
        sendDataAjaxRequest('put', '/api/admin/reports/discard', {'id':id , 'type': type}, reportsUpdateHandler);
    }
}

function reportsUpdateHandler(response) {
    document.getElementById('reports-table').innerHTML = response.html;

   //updateReportsPagination();
    manageReports();
}

function reportsSearchHandler() {
    let response = JSON.parse(this.responseText);
    document.getElementById('reports-table').innerHTML = response.html;

   //updateReportsPagination();
    manageReports();
}

function searchReports(){
    if(reportUsernameSearch){
        reportTypeFilter.addEventListener('change', requestSearchReports);
        reportUsernameSearch.addEventListener('keyup', requestSearchReports);
    } 
}

function requestSearchReports(){
    let data = {'search-username-report': reportUsernameSearch.value, 'type-filter': reportTypeFilter.value};
    sendAjaxGetRequest( '/api/admin/reports', data, reportsSearchHandler)
    window.history.pushState({}, '', '/admin/reports?' + encodeForAjax(data));
}

/*
function changeReportsPage(event) {
    event.preventDefault();
    let page = this.href.split('page=')[1]
    let data = {'search-username': reportUsernameSearch.value, 'page': page}
  
    sendAjaxGetRequest('/api/admin/reports', 
        data, reportsSearchUpdateHandler)
    window.history.pushState({}, '', '/admin/report?' + encodeForAjax(data));
}

function updateReportsPagination() {
    let pagination = document.querySelectorAll('#reports .pagination a');
    if(pagination){
        pagination.forEach(paginationLink => { paginationLink.addEventListener('click', changeReportsPage);});
    }
}
*/

let reportTypeFilter = document.getElementById('report-type');
let reportUsernameSearch = document.querySelector('input[name=search-username-report]');
let manageReportsAlert = document.getElementById('manage-users-alert');
manageReports();
searchReports();
