document.getElementById("cargar-info").addEventListener("mouseover", displayCargarInfo);
document.getElementById("cargar-info").addEventListener("mouseout", hideCargarInfo);
document.getElementById("cargar-plan").addEventListener("mouseover", displayPlanTrabajo);
document.getElementById("cargar-plan").addEventListener("mouseout", hidePlanTrabajo);

function displayCargarInfo() {
    document.getElementById("cargar-info-list").style.display = "block";
}

function hideCargarInfo() {
    document.getElementById("cargar-info-list").style.display = "none";
}

function displayPlanTrabajo() {
    document.getElementById("plan-trabajo-list").style.display = "block";
}

function hidePlanTrabajo() {
    document.getElementById("plan-trabajo-list").style.display = "none";
}