const ipnElement=document.querySelector('#login_ipnPassword')
const btnElement=document.querySelector('#login_btnPassword')
const eyeElement=document.querySelector('#login_btnEye')

let statusEye=false;

btnElement.addEventListener('click',function(){
    
    const currentType=ipnElement.getAttribute('type')
    ipnElement.setAttribute('type',currentType==='password'?'text':'password')
    
})
