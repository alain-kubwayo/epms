// Functions for togggling the sidebar

var sidebarOpen = false;
var sidebar = document.getElementById("sidebar");
var sidebarCloseIcon = document.getElementById("sidebarIcon");

function toggleSidebar() {
  if (!sidebarOpen) {
    sidebar.classList.add("sidebar_responsive");
    sidebarOpen = true;
  }
}

function closeSidebar() {
  if (sidebarOpen) {
    sidebar.classList.remove("sidebar_responsive");
    sidebarOpen = false;
  }
}

// USE OF REGEX TO VALIDATE MORTALITY FORM INPUT DATA 

const date = document.getElementById('Date');
const deaths = document.getElementById('Deaths');
const form = document.getElementById('form');
const errorElement = document.getElementById('error');

form.addEventListener('submit', (e) => {
  let messages = [];

  if(!/^\d{4}-\d{2}-\d{2}$$/g.test(date.value)){
    messages.push('Invalid Date');
  };
  console.log(date.value);
  // if(deaths.value.length === 0){
  //   messages.push('Deaths must be a positive integer including 0.');
  // };
  if(!/^\d*[0-9]+\d*$/g.test(deaths.value)){
    messages.push('Deaths must be a positive integer including 0.');
  };
  console.log(deaths.value);

  if(messages.length > 0){
    e.preventDefault();
    errorElement.innerText = messages.join(', ');
  };
});




