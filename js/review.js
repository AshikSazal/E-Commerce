var form1 = document.getElementById('form1');
var number=document.getElementById('number');
var error=document.getElementById('error');

form1.addEventListener('submit', (e) => {
  if (number.value === '' ||number.value === null) {
    e.preventDefault();
  }
  else if(number.value <0 || number.value>5){
    e.preventDefault();
  }
});
