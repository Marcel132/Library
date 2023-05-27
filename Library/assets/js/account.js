console.log('Connect success ') //Checking connection file account.js with account.html

var visible = "visible" // class .visible
var blurElement = "blurred" // class .blurred

function blur(){
  addBookBtn.classList.add(blurElement)   // 
  navigation.classList.add(blurElement)   // Adding class to four elements 
  books.classList.add(blurElement)        //
  footer.classList.add(blurElement)       //
}
function unblur(){
  account.classList.remove(blurElement)     //
  navigation.classList.remove(blurElement)  // Removing class from five* elements
  books.classList.remove(blurElement)       //
  footer.classList.remove(blurElement)      //
  addBookBtn.classList.remove(blurElement)  //
}

profileButton.addEventListener('click', () => {
  account.classList.toggle(visible) // Enable and disable class `visible`
  libraryDiv.classList.remove(visible) //If accout has class `visible`, then remove class `visible` from libraryDiv


  if(account.classList.contains(visible)){
    blur()
    console.log("Open account...")  // Show communique about enable account form 
  } else{
    unblur()
    console.log("Close account...") // Show communique about disable account form 
  }
})

// library form & button

addBookBtn.addEventListener('click', () => {
    libraryDiv.classList.toggle(visible)  // Enable and disable class `visible`
    account.classList.remove(visible) //If libraryDiv has class `visible`, then remove class `visible` from account

  
    if(libraryDiv.classList.contains(visible)){
      blur()
      console.log("Open 'add book' form...") // Show communique about enable libraryDiv form 
    } else {
      unblur()
      console.log("Close 'add book' form...") // Show communique about disable libraryDiv form 
    }
  });