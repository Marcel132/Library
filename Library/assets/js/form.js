console.log('Connect success') //Checking connection file account.js with account.html

var visible = "visible" // class .visible
var blurElement = "blurred" // class .blurred

function blur(){
  navigation.classList.add(blurElement)   //
  addBookBtn.classList.add(blurElement)   // Adding class to three elements 
  footer.classList.add(blurElement)       //
}
function unblur(){
  navigation.classList.remove(blurElement)  //
  addBookBtn.classList.remove(blurElement)  // Removing class from three elements
  footer.classList.remove(blurElement)      //
}

logInBtn.addEventListener("click", () => {
  logInForm.classList.toggle(visible) // Changing class (Enable/Disable) in login form
  signUpForm.classList.remove(visible) // Remove class visible from sign up form
  libraryDiv.classList.remove(visible) // Remove class visible from library

  if(logInForm.classList.contains("visible")){
    blur()
    console.log("Open log in form...")  // Show communique about enable account form
  } else{
    unblur()
    console.log("Close log in form...") // Show communique about disable account form
  } 

})

signUpBtn.addEventListener("click", () => {
  signUpForm.classList.toggle(visible) // Changing class (Enable/Disable) in signup form
  logInForm.classList.remove(visible) // Remove class visible from  login form
  libraryDiv.classList.remove(visible) // Remove class visible from library
  
  if(signUpForm.classList.contains("visible")){
    blur()
    console.log("Open sign up form...") // Show communique about enable account form
  } else{
    unblur()
    console.log("Close sign up form...") // Show communique about disable account form 
  }

})

addBookBtn.addEventListener('click', () => {
  libraryDiv.classList.toggle(visible) // Changing class (Enable/Disable) in library
  logInForm.classList.remove(visible) // Remove class visible from  login form
  signUpForm.classList.remove(visible) // Remove class visible from signup form

  if(libraryDiv.classList.contains("visible")){
    blur()
    console.log("Open 'add book' form...") // Show communique about enable account form
  } else{
    unblur()
    console.log("Close 'add book' form...") // Show communique about disable account form 
  }

});
// #########################################################################




