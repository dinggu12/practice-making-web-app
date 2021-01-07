//id가 white_btn인것을 getElementById하고 결과를 wbtn변수에 넣는다.
//value가 white나 black인 버튼이 눌리면 뒤의 콜백함수를 실행하여
//class이름이 white나 black 으로 바뀌고 style.css에 설정된 class설정으로 인해
// 배경화면이 검정색이나 흰색으로 바뀐다. 
wbtn = document.getElementById('white_btn');
wbtn.addEventListener('click', function(){
  document.getElementById('target').className='white';
})

bbtn = document.getElementById('black_btn');
bbtn.addEventListener('click', function(){
  document.getElementById('target').className='black';
})
