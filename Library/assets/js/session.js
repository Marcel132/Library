function getSessionPath() {
  const currentPage = window.location.pathname;

  // Determine the appropriate session check path based on the current page
  if(currentPage.includes('index.html')){
    console.log('Checking session');
    return 'assets/php/checkSession.php';
  } else if(currentPage.includes('account.php')) {
      console.log('Checking session');
      return '../checkSession.php';
  } else {
      console.log('Checking session');
      return 'assets/php/checkSession.php';
  }
}

function checkUserSession() {
  const checkSessionPath = getSessionPath();

  // Send a request to check the user session
  fetch(checkSessionPath)
    .then(response => response.json())
    .then(data => {
      // If the user is logged in, display the 'add-book-btn' element
      if (data.isLoggedIn) {
        document.getElementById('add-book-btn').style.display = 'block'; 
      }
    })
    .catch(error => console.log(error));
}

// Check the user session when the DOM content is loaded
window.addEventListener('DOMContentLoaded', checkUserSession);