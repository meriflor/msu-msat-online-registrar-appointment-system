var dashboard = document.getElementById('dashboard-doc-app');
var profile = document.getElementById('edit-profile');
var settings = document.getElementById('account-settings');
var appRecords = document.getElementById('appointment-records');

function dashboardView(){
    dashboard.style.display = 'block';
    profile.style.display = 'none';
    settings.style.display = 'none';
    appRecords.style.display = 'none';
}

function profileView(){
    profile.style.display = 'block';
    dashboard.style.display = 'none';
    settings.style.display = 'none';
    appRecords.style.display = 'none';
}

function settingsView(){
    settings.style.display = 'block';
    dashboard.style.display = 'none';
    profile.style.display = 'none';
    appRecords.style.display = 'none';
}

function recordsView(){
    appRecords.style.display = 'block';
    dashboard.style.display = 'none';
    profile.style.display = 'none';
    settings.style.display = 'none';
}