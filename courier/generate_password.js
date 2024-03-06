
function generatePassword() {
    const capital = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const smallLetters = 'abcdefghijklmnopqrstuvwxyz';
    const allCharacters = capital + smallLetters;

    var cPass = '';
  
    for (var i = 0; i < 6; i++) {
      var index = Math.floor(Math.random() * allCharacters.length);
    cPass += allCharacters.charAt(index);

    }

    const symbols = '!@#$%^&*+?';
    var sPass=''
      for(var j=0;j<2;j++){
        var sIndex=Math.floor(Math.random()*symbols.length);

        sPass+=symbols.charAt(sIndex)
      }

    const numbers = '1234567890';
    var nPass=''
      for(var k=0;k<2;k++){
      var nIndex=Math.floor(Math.random()*numbers.length)
      nPass+=numbers.charAt(nIndex)
      }


      var password=cPass+sPass+nPass;
    document.getElementById("suggested_password").textContent = password;


 }

