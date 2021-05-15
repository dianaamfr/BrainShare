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
    
    //sendDataAjaxRequest('put', '/api/admin/report/' + id, {}, reportUpdatedHandler);
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

let reportTypeFilters = document.getElementById('report-type');
let reportUsernameSearch = document.querySelector('input[name=search-username-report]');
let manageReportsAlert = document.getElementById('manage-users-alert');
manageReports();